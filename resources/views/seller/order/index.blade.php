<!DOCTYPE html>
<html lang="en">
    <head>
        @stack('meta')
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="./assets/images/favicon/favicon.ico">
        @stack('styles')
        <link href="{{ asset('dashboard/assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('dashboard/assets/libs/dropzone/dist/dropzone.css') }}"  rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('dashboard/assets/css/theme.css') }}">
        {{-- admin sweet alert ---------------------------- --}}


        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

        <script src="{{ asset('dashboard/assets/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>



        {{-- <script src="{{ asset('dashboard/assets/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.buttons.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/datatables/buttons.dataTables.min.css') }}" />
        <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
        <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script> --}}
        <title>Order List</title>
    </head>
<style>

.pagination {
  display: inline-block;
  padding-left: 0;
  margin: 20px 0;
  border-radius: 4px;
}
.pagination > li {
  display: inline;
}
.pagination > li > a,
.pagination > li > span {
  position: relative;
  float: left;
  padding: 6px 12px;
  margin-left: -1px;
  line-height: 1.42857143;
  color: #337ab7;
  text-decoration: none;
  background-color: #fff;
  border: 1px solid #ddd;
}
.pagination > li:first-child > a,
.pagination > li:first-child > span {
  margin-left: 0;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}
.pagination > li:last-child > a,
.pagination > li:last-child > span {
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
}
.pagination > li > a:focus,
.pagination > li > a:hover,
.pagination > li > span:focus,
.pagination > li > span:hover {
  z-index: 2;
  color: #23527c;
  background-color: #eee;
  border-color: #ddd;
}
.pagination > .active > a,
.pagination > .active > a:focus,
.pagination > .active > a:hover,
.pagination > .active > span,
.pagination > .active > span:focus,
.pagination > .active > span:hover {
  z-index: 3;
  color: #fff;
  cursor: default;
  background-color: #337ab7;
  border-color: #337ab7;
}
.pagination > .disabled > a,
.pagination > .disabled > a:focus,
.pagination > .disabled > a:hover,
.pagination > .disabled > span,
.pagination > .disabled > span:focus,
.pagination > .disabled > span:hover {
  color: #777;
  cursor: not-allowed;
  background-color: #fff;
  border-color: #ddd;
}




</style>
    <body>
        <div id="db-wrapper">
            @include('layouts.sidebar')
            <div id="page-content">
                @include('layouts.navbar')

                <div class="container-fluid ">
                    <div class="card mt-5 p-3">
                        <div class="header">
                            <h3>Order list</h3>
                        </div>
                        <div class="mt-5 table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable data-table">
                                <thead>
                                    <tr>
                                        <th>Invoice </th>
                                        <th>Shop Name</th>
                                        <th>User Name</th>
                                        <th>Payment</th>
                                        <th>Payment Option</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Payable</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function () {

                        var table = $('.data-table').DataTable({
                        "processing": true,
                        "retrieve": true,
                        "serverSide": true,
                        'paginate': true,
                        'searchDelay': 700,
                        "bDeferRender": true,
                        "responsive": true,
                        "autoWidth": false,
                        "pageLength": 5,
                            ajax: "{{ route('order') }}",
                            columns: [
                                {data: 'invoice_no', name: 'invoice_no'},
                                {data: 'shop.username', name: 'shop_id'},
                                {data: 'user.username', name: 'user_id'},
                                {data: 'payment_type', name: 'payment_type'},
                                {data: 'payment_option.name', name: 'payment_option_id'},
                                {data: 'total_price', name: 'total_price'},
                                {data: 'discount', name: 'discount'},
                                {data: 'payable', name: 'payable'},
                                {data: 'paid', name: 'paid'},
                                {data: 'due', name: 'due'},
                                {data: 'status', name: 'status'},
                                {data: 'created_at', name: 'created_at'},
                            ]
                        });

                    });
                </script>
            </div>
        </div>
    </body>
</html>



