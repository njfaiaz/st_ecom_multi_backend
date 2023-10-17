@extends('layouts.app')
@section('title', 'All Order')
@section('content')

<div class="card my-3">
    <div class="card-header d-flex justify-content-between">
        <h4>All Orders</h4>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table">
            <thead class="bg-light">
                <tr>
                    <th>Invoice </th>
                    <th>Shop Name</th>
                    <th>Customar Name</th>
                    <th>Payment Type</th>
                    <th>Payment Option</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Delivery Fee</th>
                    <th>Payable</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td><a href="{{ route('seller.orderShow', $order->invoice_no) }}" target="_blank"> {{ $order->invoice_no }}</a></td>
                    <td>{{ $order->shop->username }}</td>
                    <td>{{ $order->user->full_name}}</td>
                    <td>
                        @if ($order->payment_type >= 1)
                            {{ 'Non-Cod' }}
                        @else
                            {{ 'Cod' }}
                        @endif
                    </td>
                    <td>{{ $order->payment_option->name}}</td>
                    <td>{{ $order->total_price}}</td>
                    <td>{{ $order->discount}}</td>
                    <td>{{ $order->delivery_fee}}</td>
                    <td>{{ $order->payable}}</td>
                    <td>{{ $order->paid}}</td>
                    <td>{{ $order->due}}</td>
                    <td>
                        @if ($order->status == 1)
                            Pending
                        @elseif ($order->status == 2)
                            Processing
                        @elseif ($order->status == 3)
                            On the way
                        @elseif ($order->status == 4)
                            Shipped
                        @elseif ($order->status == 5)
                            Delivered
                        @elseif ($order->status == 6)
                            Cancelled by Customer
                        @elseif ($order->status == 7)
                            Cancelled by Seller
                        @else
                            Refunded
                        @endif
                    </td>
                    <td>{{ $order->created_at->format('Y.m.d H:i:s')}}</td>
                    <td>{{ $order->updated_at->format('Y.m.d H:i:s')}}</td>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
</div>
@endsection
