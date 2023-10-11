@extends('layouts.app')
@section('title', 'All Blocked Seller')
@section('content')


<div class="card my-3">
    <div class="card-header d-flex justify-content-between">
        <h4>All Blocked Seller</h4>
    </div>
    <div class="card-body p-0">
        <table class="table">
            <thead class="bg-light">
              <tr class="text-white">
                <th scope="col">SI</th>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email  }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('sellerUnBlock', $user->id) }}" id="unblock" class="btn btn-danger text-white btn-sm">
                            Block
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
          {{ $users->links() }}
    </div>
</div>
@endsection
