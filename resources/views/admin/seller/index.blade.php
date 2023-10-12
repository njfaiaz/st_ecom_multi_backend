@extends('layouts.app')
@section('title', 'All Seller')
@section('content')

<div class="d-flex flex-wrap mb-5">
    @foreach ($users as $seller)
        <div class="card m-2" style="width: 185px">
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
    {{ $users->links() }}
</div>

@endsection
