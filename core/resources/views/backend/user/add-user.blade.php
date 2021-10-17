@extends('backend.master')

@section('title')
    Add User
@endsection

@section('content')
    <div class="content-wrapper" style="font-family: Roboto">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark" style="font-family: kalpurush">Add User</h1>
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
                                <h3 class="card-title" style="font-family: kalpurush">Add User</h3>
                                <div class="fa-pull-right">
                                    <a href="{{ route('manage.user') }}">
                                        <button class="btn btn-light"><i class="fa fa-arrow-left"></i><b> Back To User
                                                List</b></button>
                                    </a>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('save.user') }}" enctype="multipart/form-data"
                                role="form">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name <span class='required-star text-danger'>*</span></label>
                                                <input type="text" name="name"
                                                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name') }}" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile Number <span
                                                        class='required-star text-danger'>(Min:11,Max:11)*</span></label>
                                                <input type="text" name="phone"
                                                    class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                    value="{{ old('phone') }}" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Gender <span class='required-star'></span></label>
                                                <select name="gender" class="form-control">
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                    <option value="3">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Image <span class='required-star'></span></label>
                                                <input type="file" name="image"
                                                    class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}"
                                                    value="{{ old('image') }}" accept="image/*" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>E-Mail </label>
                                                <input type="email" name="email"
                                                    class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                    value="{{ old('email') }}" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password <span class=' required-star text-danger'>*</span></label>
                                                <input type="password" name="password" id="myPassword"
                                                    class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                    value="{{ old('password') }}" autofocus>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" onclick="myPasswordFunction()" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Show Password
                                                        </label>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status <span class='required-star'></span></label>
                                                <select name="status" class="form-control">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('manage.user') }}">
                                        <button type="button" class="btn btn-danger">Close</button>
                                    </a>
                                    <button type="submit" class="btn btn-info float-right">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    @include('backend.partials.password-show-hide')
@endsection
