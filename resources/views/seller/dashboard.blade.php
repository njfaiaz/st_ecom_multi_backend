{{-- @extends('layouts.app')
@section('title', 'Dashboard')

<style>
body{
    margin-top:20px;
    background:#8d6e6e;
}
.order-card {
    color: #ff000000;
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
                <h6 class="m-b-20">Total Sellers</h6>
                <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span>{{ $data['sellerCount'] }}</span></h2>
                <p class="m-b-0">Active Sellers<span class="f-right">{{ $data['activeSellerCount'] }}</span></p>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-green order-card">
            <div class="card-block">
                <h6 class="m-b-20">Total Customers</h6>
                <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span>{{ $data['customerCount'] }}</span></h2>
                <p class="m-b-0">Active Customers<span class="f-right">{{ $data['activeCustomerCount'] }}</span></p>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-yellow order-card">
            <div class="card-block">
                <h6 class="m-b-20">Total Products</h6>
                <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span>{{ $data['productCount'] }}</span></h2>
                <p class="m-b-0">Active Products<span class="f-right">{{ $data['activeProductCount'] }}</span></p>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-pink order-card">
            <div class="card-block">
                <h6 class="m-b-20">Total Orders</h6>
                <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span>{{ $data['orderCount'] }}</span></h2>
                <p class="m-b-0">Delivered Orders<span class="f-right">{{ $data['deliveredOrderCount'] }}</span></p>
            </div>
        </div>
    </div>
</div>


<div class="d-flex mr-3">
    <h3>Popular Shop</h3>
</div>
<div class="d-flex flex-wrap mb-5">

    @foreach ($allSeller as $seller)
        <div class="card m-2" style="width: 190px">
            <img src="{{ asset( $seller->shop->image ) }}" alt="image" style="height: 120px;">
            <div class="card-body">
                <a
                    href="{{ route('sellerProfile', $seller->id) }}">
                    <h5 class="fw-bold">{{ $seller->shop->username }}</h5>
                </a>
                <div class=" mb-2">
                    @php $rating = $seller->shop->rating; @endphp
                        <i data-feather="star" class="nav-icon icon-xs {{ $rating > 0 ? 'text-warning':'text-muted' }} "></i>
                        <i data-feather="star" class="nav-icon icon-xs {{ $rating > 1 ? 'text-warning':'text-muted' }} "></i>
                        <i data-feather="star" class="nav-icon icon-xs {{ $rating > 2 ? 'text-warning':'text-muted' }} "></i>
                        <i data-feather="star" class="nav-icon icon-xs {{ $rating > 3 ? 'text-warning':'text-muted' }} "></i>
                        <i data-feather="star" class="nav-icon icon-xs {{ $rating > 4 ? 'text-warning':'text-muted' }} "></i>
                        <span> ({{ $rating }})</span>
                </div>
            </div>
        </div>
    @endforeach
</div>
    {{-- {{ $allSeller->links() }} --}}

{{-- @endsection --}} --}}


Seller panal
