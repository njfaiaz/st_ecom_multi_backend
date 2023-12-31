

@extends('layouts.app')
@section('title', 'Dashboard')

<style>
    body{
        margin-top:20px;
        background:#FAFAFA;
    }
    .order-card {
        color: #fff;
    }

    .bg-c-blue {
        background: linear-gradient(45deg,#4099ff,#73b4ff);
    }

    .bg-c-green {
        background: linear-gradient(45deg,#2ed8b6,#59e0c5);
    }

    .bg-c-yellow {
        background: linear-gradient(45deg,#FFB64D,#ffcb80);
    }

    .bg-c-pink {
        background: linear-gradient(45deg,#FF5370,#ff869a);
    }


    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .card .card-block {
        padding: 25px;
    }

    .order-card i {
        font-size: 26px;
    }

    .f-left {
        float: left;
    }

    .f-right {
        float: right;
    }
    </style>
@section('content')

<div class="row mt-5">
    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-blue order-card">
            <div class="card-block">
                <h5 class="m-b-20">Total Orders</h5>
                <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span>{{ $data['shopCount']->count() }}</span></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-green order-card">
            <div class="card-block">
                <h5 class="m-b-20">In Transit</h5>
                <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span>$ {{ $data['shopCount']->sum('paid') }} </span></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-pink order-card">
            <div class="card-block">
                <h5 class="m-b-20">Pending Orders</h5>
                <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span>{{ $data['pendingOrder']->count() }}</span></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-yellow order-card">
            <div class="card-block">
                <h5 class="m-b-20">Return Orders</h5>
                <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span>{{ $data['returnOrder']->count() }} </span></h2>
            </div>
        </div>
    </div>

</div>


<div class="row mt-2">
    <div class="block-header">
        <h3>Popular Products</h3>
    </div>
    @foreach ($products as $product)
        <div class="col-12 col-sm-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
            <div class="card my-2" style="height: 260px;">
                @php
                    $discountAmount = $product->regular_price - $product->sale_price;
                @endphp
                <a href="{{ route('seller.product.show', $product->id) }}">
                    <img src="{{ asset($product->image) }}" style="height: 140px; width: 100%;" alt="product"/>
                </a>
                <div class="card-body p-2">
                    <a href="{{ route('seller.product.show', $product->id) }}">
                        <h5 class="mb-0">{{ $product->name }}</h5>
                    </a>
                    <div class="d-flex justify-content-between">
                        <p class="badge bg-secondary fw-normal">{{ $product->category->name }}</p>
                        <p>
                            <s class="text-muted small">${{ round($discountAmount) }}</s>
                            <span class="text-dark fw-bold">{{ $product->sale_price }}</span>
                        </p>
                    </div>
                    <div class="d-flex ">
                        @php $rating = $product->rating; @endphp
                        <i data-feather="star" class="nav-icon icon-xs {{ $rating > 0 ? 'text-warning':'text-muted' }} "></i>
                        <i data-feather="star" class="nav-icon icon-xs {{ $rating > 1 ? 'text-warning':'text-muted' }} "></i>
                        <i data-feather="star" class="nav-icon icon-xs {{ $rating > 2 ? 'text-warning':'text-muted' }} "></i>
                        <i data-feather="star" class="nav-icon icon-xs {{ $rating > 3 ? 'text-warning':'text-muted' }} "></i>
                        <i data-feather="star" class="nav-icon icon-xs {{ $rating > 4 ? 'text-warning':'text-muted' }} "></i>
                    </div>
                    <div class="action mt-2">
                        <a href="{{ route('seller.product.show', $product->id) }}" class="btn btn-info text-white btn-sm">
                            <i data-feather="eye" class="nav-icon icon-xs"></i>
                        </a>
                        <a href="{{ route('seller.product.edit', $product->id) }}" class="btn btn-info text-white btn-sm">
                            <i data-feather="edit" class="nav-icon icon-xs"></i>
                        </a>
                        <a href="{{ route('seller.product.inactive', $product->id) }}" id="delete" class="btn btn-danger btn-sm">
                            <i data-feather="trash-2" class="nav-icon icon-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

 @endsection

