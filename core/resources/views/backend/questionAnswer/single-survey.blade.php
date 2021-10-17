@extends('backend.master')

@section('title')
    Collected Data | {{ $appName }}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6" style="font-family: kalpurush">
                        <h1 class="m-0 text-dark">Collected Data</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Collected Data</li>
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
                                        <i class="fas fa-list"></i> Collected Data
                                    </h3>
                                </div>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body row">
                                <table id="table_id" class="table dt-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Survey Answer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($i = 1)
                                        @php($j = 1)
                                        <tr>
                                            <td>
                                                @foreach ($questions as $key => $question)
                                                    {{ $i++ }}. {{ $question->name }} <br> <hr>
                                                @endforeach
                                                @if ($answer_images->count() > 0)
                                                    * Image
                                                @endif
                                            </td>
                                            <td>
                                                @foreach ($questions as $key => $question)
                                                    @foreach ($answer as $key => $ans)
                                                        @if ($question->id == $ans->question_id)
                                                            @if ($ans->question_id != '')
                                                                {{ $j++ }}. {{ $ans->question_ans }} <br> <hr>
                                                            @else
                                                                {{ $j++ }}. null <br> <hr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                                @if ($answer_images->count() > 0)
                                                    @foreach ($answer_images as $answer_image)
                                                        @if ($answer_image->image)
                                                            <a href="{{ asset($answer_image->image) }}" target="_blank">
                                                                <img src="{{ asset($answer_image->image) }}" alt="Image" style="max-height: 100px">
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
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
