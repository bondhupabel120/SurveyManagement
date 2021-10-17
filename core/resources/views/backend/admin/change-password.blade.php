@extends('backend.master')

@section('title')
    {{ $admin->name }}'s Profile
@endsection

@section('content')
    <div class="content-wrapper" style="font-family: Roboto">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark" style="font-family: kalpurush">Change Password</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title" style="font-family: kalpurush">Change Password</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('submit.change.password') }}" method="POST">
                                    @csrf
                                    <div class="row" id="included_all_description">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Current Password <span class="text-danger">*</span></label>
                                                <input type="password" name="current_password" class="form-control {{ $errors->has('current_password') ? ' is-invalid' : '' }}">
                                                <input type="hidden" name="id" value="{{ $admin->id }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>New Password <span class="text-danger">*</span></label>
                                                <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Confirm Password <span class="text-danger">*</span></label>
                                                <input type="password" name="confirm_password" class="form-control {{ $errors->has('confirm_password') ? ' is-invalid' : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-danger">Close</button>
                                        <button type="submit" class="btn btn-info float-right">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
