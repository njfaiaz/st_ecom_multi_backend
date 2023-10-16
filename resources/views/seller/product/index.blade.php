@extends('layouts.app')
@section('title', 'All Product')
@section('content')

<div class="row mt-2">
    <div class="block-header">
        <h3>Popular Products</h3>
    </div>
    @foreach ($products as $product)
        <div class="col-12 col-sm-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
            <div class="card my-2" style="height: 262px;">
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
