@extends('layouts.invoice')
@section('invoice')

<main class="container invoice-wrapper" id="download-section">
    <!-- invoice Top -->
    <div class="row justify-content-between">
        <div class="col-sm-3">
            <div class="invoice-logo mb-4">
                <a href="/"><img src="{{ asset('images/logo/logo.png') }}"  class="img-thumbnail"></a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="invoice-details mb-3">
                <h4 class="invoice-details-title text-18 mb-15">Spinner Tech Ltd.</h4>
                <div class="invoice-details-inner">
                    <p class="invoice-details-para"> <strong>Address :</strong> 28 Panchlaish R/A, (3rd Floor), West of Panchlaish Model Thana,Chattogram., Chittagong, Bangladesh</p>
                    <p class="invoice-details-para"><strong>Call :</strong> 01863-202736</p>
                    <p class="invoice-details-para"><strong>E-mail :</strong> spinnertechworld@gmail.com</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-align-start text-sm-end mb-4">
            <div class="invoice-details mb-3">
                <h4 class="invoice-details-title text-18 mb-15">Payment </h4>
                <div class="invoice-details-inner">
                    <p class="invoice-details-para"><strong>Invoice Id : </strong> {{ $order->invoice_no }}</p>
                    <p class="invoice-details-para"><strong>Purchase:</strong> {{ $order->created_at->toDayDateTimeString() }} </p>
                    <p class="invoice-details-para"><strong>Payment Status :</strong>
                        @if ($order->payment_type >= 1)
                                {{ 'Non-Cod' }}
                        @else
                                {{ 'Cod' }}
                        @endif
                    </p>
                    <p class="invoice-details-para"><strong>Address: </strong> {{ $order->address->city->name }}, {{ $order->address->address }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- invoice Table -->
    <div class="table-responsive invoice-table mb-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Unit Cost</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->sale_price }} </td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ $item->sale_price * $item->quantity}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-lg-7 col-sm-4"></div>
        <div class="col-lg-5 col-md-6 col-sm-7 ms-auto">
            <table class="table">
                <tbody>
                    <tr>
                        <td>
                            <strong class="status">Subtotal</strong>
                        </td>
                        <td>${{ round($order->total_price) }}</td>
                    </tr>
                    <tr>
                        @php
                            $amount = ($order->total_price * $item->quantity) - $item->product->discount ;
                            $totalPrice = $order->total_price + $amount ;
                            $shippingCharge = $order->delivery_charge;
                            $total = ($totalPrice + $shippingCharge);
                        @endphp
                        {{-- <tr>
                            <td>
                                <strong class="status">Discount (%)</strong>
                                <td>
                                    @if ($item->product->discount == NULL)
                                        <span>- 0%</span>
                                    @else
                                        <span class="text-danger">- {{ $item->product->discount }}%</span>
                                    @endif
                                </td>
                            </td>
                        </tr> --}}
                    </tr>

                    <tr>
                        <td>
                            <strong class="status">Shipping Charge</strong>
                        </td>
                        <td>+ ${{ $order->delivery_fee }}</td>
                    </tr>

                    <tr>
                        <td>
                            <strong class="status">Discount</strong>
                        </td>
                        <td>- ${{ $order->discount }}</td>
                    </tr>

                    <tr>
                        <td class="border-bottom-0">
                            <strong>Total</strong>
                        </td>

                        <td class="border-bottom-0">
                            <strong>${{ round($order->payable) }}</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection
