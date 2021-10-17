@extends('user.master')

@section('title')
    Pharmacy Survey | {{ $appName }}
@endsection

@section('content')
    <?php $i = 1; ?>
    <div class="content-wrapper" style="font-family: Roboto">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark" style="font-family: kalpurush">Pharmacy Survey</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="col-sm-12">
                <div class="card">
                    <div class="container-fluid mt-2 mb-3">
                        <form action="{{ route('submit.survey') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3 container">
                                <input type="hidden" name="question_length" value="{{ $inputQuestions->count() }}">
                                @foreach ($inputQuestions as $index => $inputQuestion)
                                    @if ($inputQuestion->type == 1)
                                        <div class="form-group col-sm-6">
                                            <label class="control-label">{{ $i++ }}. {{ $inputQuestion->name }}</label>
                                            <input type="text" name="input_ans{{ $index + 1 }}" value="" class="form-control">
                                            <input type="hidden" name="question_id{{ $index + 1 }}" value="{{ $inputQuestion->id }}" class="form-control">
                                            <input type="hidden" name="question_type{{ $index + 1 }}" value="{{ $inputQuestion->type }}" class="form-control">
                                        </div>
                                    @endif

                                    @if ($inputQuestion->type == 2)
                                        <div class="form-group col-sm-6">
                                            <label class="control-label d-block">{{ $i++ }}. {{ $inputQuestion->name }}</label>
                                            <select name="dropdown_ans{{ $index + 1 }}" class="form-control">
                                                <option selected disabled>Select Option</option>
                                                @foreach ($inputQuestion->options as $dropdownItem)
                                                    <option value="{{ $dropdownItem->option }}">{{ $dropdownItem->option }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="question_type{{ $index + 1 }}" value="{{ $inputQuestion->type }}" class="form-control">
                                            <input type="hidden" name="question_id{{ $index + 1 }}" value="{{ $inputQuestion->id }}" class="form-control">
                                        </div>
                                    @endif

                                    @if ($inputQuestion->type == 3)
                                        <div class="form-group col-sm-6">
                                            <label class="control-label">{{ $i++ }}. {{ $inputQuestion->name }}</label>
                                            @foreach ($inputQuestion->options as $key => $mcqItem)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="mcq_ans{{ $index + 1 }}" value="{{ $mcqItem->option }}" id="mcqQue{{ $mcqItem }}">
                                                    <label class="form-check-label" for="mcqQue{{ $mcqItem }}">{{ $mcqItem->option }}</label>
                                                </div>
                                            @endforeach
                                            <input type="hidden" name="question_type{{ $index + 1 }}" value="{{ $inputQuestion->type }}" class="form-control">
                                            <input type="text" name="others{{ $index + 1 }}" class="form-control" placeholder="If others type here">
                                            <input type="hidden" name="question_id{{ $index + 1 }}" value="{{ $inputQuestion->id }}" class="form-control">
                                        </div>
                                    @endif

                                    @if ($inputQuestion->type == 4)
                                        <div class="form-group col-sm-6">
                                            <label class="control-label">{{ $i++ }}. {{ $inputQuestion->name }}</label>
                                            @foreach ($inputQuestion->options as $checkboxItem)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="checkbox_ans{{ $index + 1 }}[]" value="{{ $checkboxItem->option }}" id="defaultCheck{{ $checkboxItem->id }}">
                                                    <label class="form-check-label" for="defaultCheck{{ $checkboxItem->id }}"> {{ $checkboxItem->option }} </label>
                                                </div>
                                            @endforeach
                                            <input type="hidden" name="question_type{{ $index + 1 }}" value="{{ $inputQuestion->type }}" class="form-control">
                                            <input type="text" name="others{{ $index + 1 }}" class="form-control" placeholder="If others type here">
                                            <input type="hidden" name="question_id{{ $index + 1 }}" value="{{ $inputQuestion->id }}" class="form-control">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image/Audio/Video <span class='required-star'></span></label>
                                    <input id="file-input" type="file" name="images[]" class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{ old('document') }}" multiple autofocus>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div id="preview"></div>
                            </div>
                            <div class="form-group m-auto">
                                <div class="col-sm-4">
                                    <button class="btn btn-primary">Submit Survey</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
<script>
function previewImages() {
    var preview = document.querySelector('#preview');

    if (this.files) {
      [].forEach.call(this.files, readAndPreview);
    }

    function readAndPreview(file) {

      // Make sure `file.name` matches our extensions criteria
      if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
        return alert(file.name + " is not an image");
      } // else...

      var reader = new FileReader();

      reader.addEventListener("load", function() {
        var image = new Image();
        image.height = 100;
        image.width = 100;
        image.title  = file.name;
        image.src    = this.result;
        preview.appendChild(image);
      });
      reader.readAsDataURL(file);
    }
  }
  document.querySelector('#file-input').addEventListener("change", previewImages);
  </script>
@endsection
