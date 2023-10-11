@extends('layouts.app')
@section('title', 'Seller Product')
@section('content')

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="d-flex p-3">
                <img src="{{ asset($shop->image) }}" class="img-thumbnail" style="height: 100px;" alt="product"/>
                <div class="mx-5">
                    <h3>{{ $shop->username }}</h3>
                    <div class="mb-2">
                        @php $rating = $shop->rating; @endphp
                        <i data-feather="star" class="nav-icon icon-xs {{ $rating > 0 ? 'text-warning':'text-muted' }} "></i>
                        <i data-feather="star" class="nav-icon icon-xs {{ $rating > 1 ? 'text-warning':'text-muted' }} "></i>
                        <i data-feather="star" class="nav-icon icon-xs {{ $rating > 2 ? 'text-warning':'text-muted' }} "></i>
                        <i data-feather="star" class="nav-icon icon-xs {{ $rating > 3 ? 'text-warning':'text-muted' }} "></i>
                        <i data-feather="star" class="nav-icon icon-xs {{ $rating > 4 ? 'text-warning':'text-muted' }} "></i>
                        <span> ({{ $rating }})</span>
                    </div>
                    <p>{{ $shop->address }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @foreach ($products as $product)
        <div class="col-12 col-sm-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
            <div class="card my-3">
                @php
                    $discountAmount = $product->regular_price - $product->sale_price;
                @endphp
                <img src="{{ asset($product->image) }}" style="height: 140px;" alt="product"/>
                <div class="card-body p-2">
                    <h5 class="mb-0">{{ $product->name }}</h5>
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
                </div>
            </div>
        </div>
    @endforeach
    {{ $products->links() }}
</div>

@endsection
