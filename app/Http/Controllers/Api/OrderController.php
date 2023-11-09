<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\OrderStatus;
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
            // return $orders;
        return apiResourceResponse(OrderResource::collection($orders));
    }
}
