@extends('layouts.app')
@section('title', 'All Product')
@section('content')


<div class="block-header mt-5">
    <div class="card-header my-5">
        <h4>All Products</h4>
    </div>
</div>

<section style="background-color: #eee;">
    <div class="container ">
        <div class="row ">
            @foreach ($products as $item)
                <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                    <div class="card  my-3 ">
                        <div class="d-flex justify-content-between p-3">
                            @php
                                $amount = $item->regular_price - $item->sale_price;
                            @endphp
                            @if ($item->regular_price == $item->sale_price)
                            <p class="lead mb-0 invisible">Today's Combo Offer</p>
                                <div
                                    class="bg-info rounded-circle invisible d-flex align-items-center justify-content-center shadow-1-strong"
                                    style="width: 50px; height: 50px;">
                                    <p class="text-white mb-2 text-center small invisible">Off $00 </p>
                                </div>
                            @else
                                <p class="lead mb-0">Today's Combo Offer</p>
                                <div
                                    class="bg-info rounded-circle d-flex align-items-center justify-content-center shadow-1-strong"
                                    style="width: 50px; height: 50px;">
                                    <p class="text-white mb-2 text-center small">Off ${{ round($amount) }} </p>
                                </div>
                            @endif
                        </div>
                        <img src="{{ asset($item->image) }}"class="Card image cap" style="height: 370px;" alt="Laptop"/>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="small"><a href="#!" class="text-muted">{{ $item['category']['name'] }}</a></p>
                                    <p class="small text-danger"><s>${{ round($amount) }}</s></p>
                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">{{ $item->name }}</h5>
                                    <h5 class="text-dark mb-0">${{ $item->sale_price }}</h5>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    @if ($item->stock_in > 0)
                                    <p class="text-muted mb-0">Available: <span class="fw-bold">{{ $item->stock_in }}</span></p>
                                    @else
                                        <span class="stock-status out-stock"> Stock Out </span>
                                    @endif
                                    <div class="ms-auto text-warning">
                                        @if($item->rating == NULL)
                                        @elseif($item->rating == 1)
                                            <i data-feather="star" class="nav-icon icon-xs"></i>
                                        @elseif($item->rating == 2)
                                            <i data-feather="star" class="nav-icon icon-xs"></i>
                                            <i data-feather="star" class="nav-icon icon-xs"></i>
                                        @elseif($item->rating == 3)
                                            <i data-feather="star" class="nav-icon icon-xs"></i>
                                            <i data-feather="star" class="nav-icon icon-xs"></i>
                                            <i data-feather="star" class="nav-icon icon-xs"></i>
                                        @elseif($item->rating == 4)
                                            <i data-feather="star" class="nav-icon icon-xs" ></i>
                                            <i data-feather="star" class="nav-icon icon-xs" ></i>
                                            <i data-feather="star" class="nav-icon icon-xs" ></i>
                                            <i data-feather="star" class="nav-icon icon-xs" ></i>
                                        @elseif($item->rating == 5)
                                            <i data-feather="star" class="nav-icon icon-xs" ></i>
                                            <i data-feather="star" class="nav-icon icon-xs" ></i>
                                            <i data-feather="star" class="nav-icon icon-xs" ></i>
                                            <i data-feather="star" class="nav-icon icon-xs" ></i>
                                            <i data-feather="star" class="nav-icon icon-xs" ></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="action mt-2">
                                    <a href="{{ route('product.show', $item->id) }}" class="btn btn-info text-white btn-sm">
                                        <i data-feather="eye" class="nav-icon icon-xs"></i>
                                    </a>
                                    <a href="{{ route('product.edit', $item->id) }}" class="btn btn-info text-white btn-sm">
                                        <i data-feather="edit" class="nav-icon icon-xs"></i>
                                    </a>
                                    <a href="{{ route('product.inactive', $item->id) }}" id="delete" class="btn btn-danger btn-sm">
                                        <i data-feather="trash-2" class="nav-icon icon-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
            {{ $products->links() }}
        </div>
    </div>
</section>

@endsection
