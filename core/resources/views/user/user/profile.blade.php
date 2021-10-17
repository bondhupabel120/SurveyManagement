@extends('user.master')

@section('title')
    {{ $user->name }}'s Profile
@endsection

@section('content')
    <div class="content-wrapper" style="font-family: Roboto">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark" style="font-family: kalpurush">{{ $user->name }}'s Profile</h1>
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
                                <h3 class="card-title" style="font-family: kalpurush">{{ $user->name }}'s Profile</h3>
                            </div>
                            <div class="card-body">
                                <div class="row" id="included_all_description">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" value="{{ $user->name }}" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Number </label>
                                            <input type="text" value="{{ $user->phone }}" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>E-Mail</label>
                                            <input type="text" value="{{ $user->email }}" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>User ID</label>
                                            <input type="text" value="{{ $user->user_id }}" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Image</label>
                                            @if ($user->image)
                                                <a href="{{ asset($user->image) }}" target="_blank">
                                                    <img src="{{ asset($user->image) }}" alt="Image" style="max-width: 80px">
                                                </a>
                                            @else
                                                <img src="{{ asset('assets/backend/img/no_image_found.png') }}" alt="Image" style="max-width: 80px">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            @if($user->status == 1)
                                                <button class="form-control text-left" disabled>Male</button>
                                            @elseif($user == 2)
                                                <button class="form-control text-left" disabled>Female</button>
                                            @else
                                                <button class="form-control text-left" disabled>Others</button>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            @if($user->status == 1)
                                                <button class="form-control text-left" disabled>Active</button>
                                            @else
                                                <button class="form-control text-left" disabled>Inactive</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
