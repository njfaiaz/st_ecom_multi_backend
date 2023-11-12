<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Enums\AddressTypes;
use App\Enums\OrderStatus;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;
        $availableStatuses = OrderStatus::available_statuses();

        if ($status && !in_array($status, $availableStatuses)) {
            return errorResponse('Order status must be: ' . implode(', ', $availableStatuses), 422);
        }

        $orders = Order::when($status, function ($q) use ($status) {
            $q->where('status', OrderStatus::findValue($status));
        })->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);
        return apiResourceResponse(OrderResource::collection($orders));
    }


    public function order(OrderStoreRequest $request)
    {
        if (is_null($request->user_address_id)) {

            $validator = Validator::make($request->all(), [
                'city_id' => 'required',
                'address' => 'required|min:3',
                'is_default' => 'required',
                'phone' => 'required|digits_between:11,15|numeric',
            ]);

            if ($validator->fails()) {
                return  errorResponse($validator->errors()->first(), 422);
            }
        }

        $total_price = 0;

        //Delivery charge
        $charge = $request->delivery_place == true ? 'inside_dhaka':'outside_dhaka';
        $deliveryCharge = Setting::first()->$charge;
        $payable = ($request->total_price - $request->discount) + $deliveryCharge;


        $order = Order::create([
            'user_id' => auth()->id(),
            'shop_id' => $request->shop_id,
            'user_address_id' => $request->user_address_id,
            'payment_type' => $request->payment_type,
            'payment_option_id' => $request->payment_option_id,
            'total_price' => $request->total_price,
            'discount' => $request->discount,
            'delivery_fee' => $deliveryCharge,
            'payable' => $payable,
            'paid' => $request->paid,
            'due' => $payable - $request->paid,
        ]);


        $order->invoice_no = 'Inv' . time() . $order->id;
        $order->save();

        if ($request->user_address_id) {
            $order->orderDetail()->create([
                'invoice_no' => $order->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'user_address_id' => $request->user_address_id,
            ]);
        } else {
            $userAddress = UserAddress::create([
                'region' => $request->region,
                'address' => $request->address,
                'city' => $request->city,
                'area' => $request->area,
                'phone' => $request->phone,
                'user_id'  => auth()->id(),
                'address_type'  => AddressTypes::HOME,
            ]);

            $order->orderDetail()->create([
                'invoice_no' => $order->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'user_address_id' => $userAddress->id,
            ]);
        }

        $products = json_decode($request->products);
        foreach ($products as $product) {

            $productDetails = Product::find($product->product_id);

            if ($productDetails) {
                $orderItem = $order->items()->create([
                    'product_id' => $productDetails->id,
                    'order_id' => $productDetails->order_id,
                    'regular_price' => $productDetails->regular_price,
                    'sale_price' => $productDetails->sale_price,
                    'quantity' => $product->quantity,
                    'subtotal' => intval($productDetails->sale_price * $product->quantity),
                ]);


                foreach ($product->variants as $id) {
                    $attrDetails = ProductAttribute::find($id);
                    $orderItem->variants()->create([
                        'product_id' => $attrDetails->id,
                        'product_attribute_id' => $attrDetails->id,
                        'name' => $attrDetails->name,
                        'value' => $attrDetails->value,
                        'additional_price' => $attrDetails->additional_price,
                    ]);

                    $total_price += ($attrDetails->additional_price * $orderItem->quantity);
                }
            }
        }

        // $deliveryCharge = $deliveryCharge;
        // $order->total_price = $total_price;
        $order->save();

        return successResponse("Order created successfully");
    }

    public function ItemsPriceCalculation($items)
    {
        $totalPrice = 0;
        foreach ($items as $item) {
            $totalPrice += $item->quantity * $item->discount;
        }
        return $totalPrice;
    }

    public function show(Order $order)
    {
        if (auth()->id() != $order->user_id) {
            return errorResponse('Order not found!', 404);
        }

        $order->load('items.variants');

        return apiResponse(OrderResource::make($order));
    }

    public function orderCancel(Order $order)
    {
        if (auth()->id() != $order->user_id) {
            return errorResponse('Order not found!', 404);
        }
        $order->status = OrderStatus::CANCELLED_CUSTOMER;
        $order->save();

        return successResponse('Order Cancelled');
    }
}
