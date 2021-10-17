@extends('backend.master')

@section('title')
    Update Question
@endsection

@section('content')
<div class="content-wrapper" style="font-family: Roboto">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark" style="font-family: kalpurush">Update Question</h1>
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
                            <h3 class="card-title" style="font-family: kalpurush">Update Question</h3>
                        </div>
                        <form name="editQuestion" method="POST" action="{{ route('update.question') }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
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
                                            <label>Question Type <span class='required-star'>*</span></label>
                                            <select name="type" class="form-control" onclick="formcheck(this.value)">
                                                @if ($question->type == 1)
                                                <option value="1">Input/Text</option>
                                                <option value="2">Dropdown</option>
                                                <option value="3">MCQ</option>
                                                <option value="4">Checkbox</option>
                                                @elseif($question->type == 2)
                                                <option value="2">Dropdown</option>
                                                <option value="3">MCQ</option>
                                                <option value="4">Checkbox</option>
                                                <option value="1">Input/Text</option>
                                                @elseif($question->type == 3)
                                                <option value="3">MCQ</option>
                                                <option value="4">Checkbox</option>
                                                <option value="1">Input/Text</option>
                                                <option value="2">Dropdown</option>
                                                @elseif($question->type == 4)
                                                <option value="4">Checkbox</option>
                                                <option value="3">MCQ</option>
                                                <option value="1">Input/Text</option>
                                                <option value="2">Dropdown</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Question <span class='required-star'>*</span></label>
                                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $question->name ?? '' }}" autofocus>
                                            <input type="hidden" name="id" value="{{ $question->id }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status <span class='required-star'>*</span></label>
                                            <select name="status" class="form-control">
                                                @if ($question->status == 1)
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
                                <div id="optionCheck" style="display: @if ($question->type == 1) none @else block @endif">
                                    <div class="card">
                                        <div class="container">
                                            <div class="appendField appendFieldEdit">
                                                <div class="form-group col-sm-11">
                                                    <label class="control-label">Options</label>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-info addNewField mt-1 mb-1">Add New Option &nbsp;
                                                        <span style="font-size:16px; font-weight:bold;">+ </span>
                                                    </a>
                                                    @foreach($options as $option)
                                                    <div class="row mb-2">
                                                        <div class="col-sm-11">
                                                            <input type="text" name="option[]" value="{{ $option->option }}" class="form-control" autofocus>
                                                        </div>
                                                        <a href="#" class="deletePrevField"><span class="fa fa-trash text-danger"></span></a>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
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
    </section>
</div>
@endsection

@section('js')
    <script>
        document.forms['editQuestion'].elements['category_id'].value = '{{ $question->category_id }}'
    </script>
    @include('backend.question.question-js')
@endsection
