@extends('backend.master')

@section('title')
    Manage Question
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
                        <h1 class="m-0 text-dark">Manage Question</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Manage Question</li>
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
                                        <i class="fas fa-list"></i> Manage Question
                                    </h3>
                                </div>
                                <div class="fa-pull-right">
                                    <a href="{{ route('add.question') }}">
                                        <button class="btn btn-info"><i class="fa fa-plus"></i><b> Add Question</b></button>
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="list" class="table dt-responsive table-bordered table-striped nowrap">
                                    <thead>
                                    <tr>
                                        <th style="font-family: Kalpurush">#</th>
                                        <th style="font-family: Kalpurush">Organization Category</th>
                                        <th style="font-family: Kalpurush">Type</th>
                                        <th style="font-family: Kalpurush">Question</th>
                                        <th style="font-family: Kalpurush">Status</th>
                                        <th style="font-family: Kalpurush">Position</th>
                                        <th style="font-family: Kalpurush">Action</th>
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

    <div class="modal fade" id="PositionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
     aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">Position!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('save.position') }}">
                    @csrf
                    <div class="modal-body">
                        <input class="form-control" id="position" name="position_number" type="text" value="" required />
                        <input class="form-control" id="id" name="id" type="hidden" value="" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="PositionModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
     aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">Position!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('save.position') }}">
                    @csrf
                    <div class="modal-body">
                        <input class="form-control" id="position" name="position_number" type="text" required />
                        <input class="form-control" id="id" name="id" type="hidden" value="" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            Swap Position
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@include('backend.partials.datatable-js')
<script type="text/javascript">
    @if (count($errors) > 0)
        $('#PositionModal2').modal('show');
    @endif
    </script>
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<input type="hidden" name="category_id" value="<?php echo $id; ?>">
<script src="{{ asset('assets/common/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
        function showquestion(){
            $('#list').DataTable({
               bAutoWidth: false,
               processing: true,
               serverSide: true,
               iDisplayLength: 10,
               ajax: {
                   url: "/admin/get-question",
                   method: "get",
                   data: function (d) {
                       d._token = $('input[name="_token"]').val();
                       d.category_id = $('input[name="category_id"]').val();
                   }
               },
               columns: [
                   {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                   {data: 'category_name', name: 'category_name'},
                   {data: 'type', name: 'type'},
                   {data: 'name', name: 'name'},
                   {data: 'status', name: 'status'},
                   {data: 'position', name: 'position'},
                   {data: 'action', name: 'action', orderable: false, searchable: false},
               ],
               "aaSorting": []
           });
        }

        showquestion();

        function deleteQuestion(id,e){
            e.preventDefault();
            swal.fire({
                title: "Are you sure?",
                text: "You want to delete this Question!",
                icon: "warning",
                showCloseButton: true,
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Delete`,
                // dangerMode: true,
            }).then((result) => {
                if (result.value == true) {
                    swal.fire({
                        title: 'Success',
                        text: 'Question is deleted Successfully!',
                        icon: 'success'
                    }).then(function () {
                        $.ajax({
                            url: "admin/delete/question",
                            method: 'POST',
                            data: {id: id, "_token": "{{ csrf_token() }}"},
                            dataType: 'json',
                            success: function () {
                                location.reload();
                            }
                        })
                    })
                }
                else if (result.value == false) {
                    swal.fire("Cancelled", "Question is safe :)", "error");
                }
            })
        }

        function showMyModalSetTitle(i, p)
        {
            document.getElementById("position").value = p
            document.getElementById("id").value = i
            $('#PositionModal').modal('show');
        }
</script>
@endsection
