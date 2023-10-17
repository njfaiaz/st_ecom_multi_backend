@extends('layouts.app')
@section('title', 'Order Details')
@section('content')



<div class="row mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-2">Order #{{ $order->invoice_no }}</h5>
                        <h6 class="card-text text-muted">Date : {{ $order->created_at->toDayDateTimeString() }}</h6>
                    </div>
                     <div>
                        <a href="{{ route('seller.invoice',$order->id) }}" target="_blank" class="btn btn-primary">Invoice</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="product_details">
                    <table class="table">
                        <thead class="table-light">
                            <tr class="text-white">
                                <th scope="col">Product</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <?php
                                    $total_price = $item->sale_price;
                                ?>
                                <tr>
                                    <td>
                                        <img src="{{ asset($item->product->image) }}" style="width: 80px; height:80x;" class="img-thumbnail">
                                        <span>{{ $item->product->name }}
                                        <ul style="list-style-type:none;">
                                            @foreach ($item->variants as $variant)
                                                <li>{{ $variant->name }}: {{ $variant->value  }}
                                                    @if($variant->additional_price > 0)
                                                    <span class="text-success">(+${{ $variant->additional_price }})</span>
                                                    @endif
                                                </li>
                                                <?php
                                                    $total_price += $variant->additional_price
                                                ?>
                                            @endforeach
                                        </ul>
                                    </span>
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->quantity }} * {{ $total_price }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Order Summary</h5>
                <div class="product_details">
                    <table class="table">
                        <thead class="table-light">
                            <tr class="text-white">
                                <th scope="col">Descriptions</th>
                                <th scope="col">Amounts</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sub Total: </td>
                                <td class="text-center">${{ round($order->total_price) }}</td>
                            </tr>
                            <tr>
                                <td>Shipping Charge :</td>
                                <td class="text-center">+ ${{ $order->delivery_fee }}</td>
                            </tr>
                            <tr>
                                <td> Discount :</td>
                                <td class="text-center">- ${{ $order->discount }}</td>
                            </tr>
                            <tr>
                                <td>Total Amount :</td>
                                    <td class="text-center">{{ round($order->payable) }}</td>
                            </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-body">
                <h5 class="card-title">Payment Details</h5>
                <div class="product_details">
                    <table class="table">
                        <thead class="table-light">
                          <tr class="text-white">
                            <th scope="col">Descriptions</th>
                            <th scope="col">Amounts</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> Transactions:</td>
                                <td class="text-center"> hfjh</td>
                            </tr>
                            <tr>
                                <td> Payment Method:</td>
                                <td class="text-center"> {{ $order->payment_option->name }}</td>
                            </tr>
                            <tr>
                                <td> Card Numbar:</td>
                                <td class="text-center"> {{ $order->payment_option->acc_number }}</td>
                            </tr>
                            <tr>
                                <td>Total Amount :</td>
                                    <td class="text-center">{{ round($order->payable) }}</td>
                            </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
