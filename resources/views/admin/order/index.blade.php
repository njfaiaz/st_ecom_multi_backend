<!DOCTYPE html>
<html lang="en">
    <head>
        @stack('meta')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="./assets/images/favicon/favicon.ico">
        @stack('styles')
        <link href="{{ asset('dashboard/assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('dashboard/assets/libs/dropzone/dist/dropzone.css') }}"  rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('dashboard/assets/css/theme.css') }}">
        {{-- admin sweet alert ---------------------------- --}}

        <script src="{{ asset('dashboard/assets/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
        <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
        <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>


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
                        <div class="row bg-white p-3 rounded">
                            <form class="offset-1">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-3 mb-3">
                                        <label for="category_id" class="col-form-label">Start Date</label>
                                        <input type="datetime-local" class="form-control" id="start_date">
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                        <label for="subcategory_id" class="col-form-label">End Date</label>
                                        <input type="datetime-local" class="form-control" id="end_date">
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                        <label class="col-form-label">Brand Name :</label>
                                        <select class="form-control" id="statusValue">
                                            <option>Select Option</option>
                                            <option value="Codelikeice">Codelikeice</option>
                                            <option value="GreenZone">GreenZone</option>
                                            <option value="Shoe">Shoe</option>
                                            <option value="Fish">Fish</option>
                                            <option value="Meat">Meat</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-3 mt-7">
                                        <button type="button" class="btn btn-primary" id="search">Search<button>
                                        <button type="button" class="btn btn-danger" id="reset">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>



                        <div class="body my-5">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <tbody>
                                        <div class="panel-body"> {!! $dataTable->table() !!}  </div>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>

        {!! $dataTable->scripts() !!}
        <script>
            const table = $('#Order-table');
            table.on('preXhr.dt',function (e,settings,data){
                data.start_date = $('#start_date').val();
                data.end_date = $('#end_date').val();
                data.statusValue = $('#statusValue').val();
            });

            $('#search').on('click', function (){
                table.DataTable().ajax.reload();
                return false;
            });

            $('#reset').on('click', function (){
                table.on('preXhr.dt',function (e,settings,data){
                    data.start_date = '';
                    data.end_date = '';
                });

                table.DataTable().ajax.reload();
                return false;
            });


            $('#statusValue').on('chang', function (){
                table.DataTable().ajax.reload();
            });
        </script>


    </body>
</html>



