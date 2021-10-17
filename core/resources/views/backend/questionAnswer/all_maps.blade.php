@extends('backend.master')

@section('title')
    View All Maps
@endsection

@section('content')
<style type="text/css">
    #map {
      width: 100%;
      height: 700px;
    }
  </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6" style="font-family: kalpurush">
                        <h1 class="m-0 text-dark">All Maps Mark</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Manage Manager</li>
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
                                        <i class="fas fa-list"></i> All Maps Mark
                                    </h3>
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
        var locations = <?php print_r(json_encode($maps)) ?>;

      // Initialize and add the map
      function initMap() {

        // The location of Uluru
        // const position = { lat: locations[0]['latitude'], lng:  locations[0]['longitude']};
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 13,
          center: new google.maps.LatLng(23.8103, 90.4125),
        });
        // The marker, positioned at Uluru

        $.each( locations, function( index, value ){
            const marker = new google.maps.Marker({
            position: new google.maps.LatLng(value.latitude, value.longitude),
            map: map,
        });
        });

      }
    </script>
@endsection
