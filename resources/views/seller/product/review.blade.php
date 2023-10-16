@extends('layouts.app')
@section('title', 'All Review')
@section('content')

<style>
    .avatar {
        width: 64px;
        height: 64px;
        border-radius: 100%;
        margin-right: 10px;
    }

    .images {
        width: 80px;
        height: 80px;
        margin-right: -14px;
    }
</style>

 <div class="row mt-3">
    @foreach ($reviews as $review)
        <div class="col-12 col-sm-6 col-md-3 col-lg-4 mb-4 mb-lg-0">
            <div class="card mb-5 p-2">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <div>
                            <img class="avatar" src="{{ asset('images/default.png') }}">
                        </div>
                        <div class="pt-2">
                            <p class="h4 mb-0">{{ $review->user->full_name }}</p>
                            <p class="mb-0">
                                <span class="text-muted">{{ $review->rating }}.0</span>
                                @php $rating = $review->rating; @endphp
                                <i data-feather="star" class="nav-icon icon-xs {{ $rating > 0 ? 'text-warning':'text-muted' }} "></i>
                                <i data-feather="star" class="nav-icon icon-xs {{ $rating > 1 ? 'text-warning':'text-muted' }} "></i>
                                <i data-feather="star" class="nav-icon icon-xs {{ $rating > 2 ? 'text-warning':'text-muted' }} "></i>
                                <i data-feather="star" class="nav-icon icon-xs {{ $rating > 3 ? 'text-warning':'text-muted' }} "></i>
                                <i data-feather="star" class="nav-icon icon-xs {{ $rating > 4 ? 'text-warning':'text-muted' }} "></i>
                            </p>
                        </div>
                    </div>
                    <div>
                        <p class="text-muted small">{{ $review->created_at->format('d M y') }} </p>
                    </div>
                </div>

                <div class="row p-2">
                    <p class="text-muted small">{{ $review->comment }}</p>
                </div>
                <div class="row ">
                    @foreach ($review->images as $image)
                        <img src="{{ asset($image->image) }}" class="images" alt="img">
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
{{ $reviews->links() }}

@endsection
