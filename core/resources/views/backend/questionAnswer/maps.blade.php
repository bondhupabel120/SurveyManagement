@extends('backend.master')

@section('title')
    Survey Map | {{ $appName }}
@endsection

@section('content')
<style type="text/css">
    #map {
      width: 100%;
      height: 700px;
    }
  </style>
    <div class="content-wrapper">
    <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6" style="font-family: kalpurush">
                        <h1 class="m-0 text-dark"> </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">  Map</li>
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
                                        <i class="fas fa-list"></i>  Map
                                    </h3>
                                </div>

                                <div class="fa-pull-right">
                                    <a href="{{ route('show.survey') }}">
                                        <button class="btn btn-light"><i class="fa fa-arrow-left"></i><b> Back To Collected Data</b></button>
                                    </a>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
@section('js')
<!-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiOoqYhqTnxaW2JjAz0qdo8M3mc-lf_TY&callback=initMap&libraries=&v=weekly"
      async
    ></script> -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXmeNn40DuvyNee5MVs1JvGFD1dHQWsGg&callback=initMap&libraries=&v=weekly"
      async
    ></script>
    <script>
      // Initialize and add the map
      function initMap() {
        var let = {{ $map->latitude }};
        var lng = {{ $map->longitude }};
        // The location of Uluru
        const uluru = { lat: let, lng: lng };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 16,
          center: uluru,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
          position: uluru,
          map: map,
        });
      }
    </script>
@endsection
