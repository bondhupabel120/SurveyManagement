@extends('backend.master')

@section('title')
    Add Question
@endsection

@section('content')
<div class="content-wrapper" style="font-family: Roboto">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark" style="font-family: kalpurush">Add Question</h1>
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
                            <h3 class="card-title" style="font-family: kalpurush">Add Question</h3>
                            <div class="fa-pull-right">
                                    <a href="{{ route('question.category.list') }}">
                                        <button class="btn btn-light"><i class="fa fa-arrow-left"></i><b> Back To Qustion List</b></button>
                                    </a>
                                </div>
                        </div>
                        <form method="POST" action="{{ route('save.question') }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="card-body">
                                <div class="row" id="included_all_description">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Organization Category <span class='required-star text-danger'>*</span></label>
                                            <select name="category_id" class="form-control select2">
                                                <option selected disabled>Select Organization Category</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Question Type <span class='required-star text-danger'>*</span></label>
                                            <select name="type" class="form-control" onclick="formcheck(this.value)">
                                                <option value="1">Input/Text</option>
                                                <option value="2">Dropdown</option>
                                                <option value="3">MCQ</option>
                                                <option value="4">Checkbox</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Question <span class='required-star text-danger'>*</span></label>
                                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status <span class='required-star'>*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="optionCheck" style="display: none">
                                    <div class="card">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-11 appendField" id="option1Id">
                                                    <div class="form-group">
                                                        <label>Options <span class='required-star text-danger'>*</span></label>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-info addNewField mt-1 mb-1">Add Option &nbsp;
                                                            <span style="font-size:16px; font-weight:bold;">+ </span>
                                                        </a>
                                                        <input type="text" name="option[]" class="form-control" autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            <a href="{{ route('question.category.list') }}">
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
    @include('backend.question.question-js')
@endsection
