@extends('backend.master')

@section('title')
    Login History | {{ $appName }}
@endsection

@section('css')
    @include('backend.partials.datatable-css')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6" style="font-family: kalpurush">
                        <h1 class="m-0 text-dark">Login History</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Login History</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <div class="fa-pull-left">
                                    <h3 class="card-title">
                                        <i class="fas fa-list"></i> Login History
                                    </h3>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="list" class="table dt-responsive table-bordered table-striped nowrap">
                                    <thead>
                                    <tr>
                                        <th style="font-family: Kalpurush">#</th>
                                        <th style="font-family: Kalpurush">Name</th>
                                        <th style="font-family: Kalpurush">Phone</th>
                                        <th style="font-family: Kalpurush">Login</th>
                                        <th style="font-family: Kalpurush">Logout</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
@include('backend.partials.datatable-js')
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<input type="hidden" name="user_id" value="<?php echo $id; ?>">
<script src="{{ asset('assets/common/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
        function showLoginHistory(){
            $('#list').DataTable({
               bAutoWidth: false,
               processing: true,
               serverSide: true,
               iDisplayLength: 10,
               ajax: {
                   url: "/admin/get-user-login-history",
                   method: "get",
                   data: function (d) {
                       d._token = $('input[name="_token"]').val();
                       d.id = $('input[name="user_id"]').val();
                   }
               },
               columns: [
                   {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                   {data: 'name', name: 'name'},
                   {data: 'phone', name: 'phone'},
                   {data: 'login', name: 'login'},
                   {data: 'logout', name: 'logout', orderable: false, searchable: false},
               ],
               "aaSorting": []
           });
        }
        showLoginHistory();
</script>
@endsection
