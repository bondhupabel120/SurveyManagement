@extends('backend.master')

@section('title')
    Update User
@endsection

@section('content')
    <div class="content-wrapper" style="font-family: Roboto">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark" style="font-family: kalpurush">Update User</h1>
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
                                <h3 class="card-title" style="font-family: kalpurush">Update User</h3>
                            </div>
                            <form name="edit_user" method="POST" action="{{ route('update.user') }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name <span class='required-star'>*</span></label>
                                                <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $user->name }}" autofocus>
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile Number <span class='required-star'>(Min:11,Max:11)*</span></label>
                                                <input type="text" name="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ $user->phone }}" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Gender <span class='required-star'></span></label>
                                                <select name="gender" class="form-control">
                                                    @if($user->gender == 1)
                                                        <option value="1">Male</option>
                                                        <option value="2">Female</option>
                                                        <option value="3">Others</option>
                                                    @elseif($user->gender == 2)
                                                        <option value="2">Female</option>
                                                        <option value="3">Others</option>
                                                        <option value="1">Male</option>
                                                    @else
                                                        <option value="3">Others</option>
                                                        <option value="1">Male</option>
                                                        <option value="2">Female</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            @if($user->image)
                                                <a href="{{ asset($user->image) }}" target="_blank">
                                                    <img src="{{ asset($user->image) }}" alt="{{ $user->name }}" style="max-height: 50px;max-width: 50px">
                                                </a>
                                            @endif
                                            <div class="form-group">
                                                <label>Image <span class='required-star'></span></label>
                                                <input type="file" name="image" class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{ old('image') }}" accept="image/*" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>E-Mail </label>
                                                <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $user->email }}" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status <span class='required-star'></span></label>
                                                <select name="status" class="form-control">
                                                    @if($user->status == 1)
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    @else
                                                        <option value="0">Inactive</option>
                                                        <option value="1">Active</option>
                                                    @endif
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
