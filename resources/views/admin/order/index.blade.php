@extends('layouts.datatable')
@section('title', 'All Brand')
@section('datatable')

<div id="db-wrapper">
    @include('layouts.sidebar')
    <div id="page-content">
        @include('layouts.navbar')
        <div class="container-fluid ">
            <div class="card mt-5 p-3">
                <div class="header">
                    <h3>Order list</h3>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <tbody>
                                <div class="panel-body"> {!! $dataTable->table() !!}  {!! $dataTable->scripts() !!}</div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

