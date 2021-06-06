@extends('adminlte::page')

@section('title', 'DATA KOORDINAT')
@section('content_header')
    <div class="card-header">
        <h3>ROUTE</h3>
    </div><br>
    {{-- <div class="row">
        <div class="col-md-2">
            <a class="btn btn-block btn-success" href="{{ route('maps.create') }}"><b>+</b> CREATE COORDINATE</a>
        </div>
    </div> --}}

@stop
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-md-center">
                                <div class="col-md-4"><label>Route Name :</label></div>
                                <div class="col-md-4">{{ $route->name }}</div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-sm">
                                    <label>ORIGIN</label>
                                </div>
                                <div class="col-sm">
                                    <label>DESTINATION 1</label>
                                </div>
                                <div class="col-sm">
                                    <label>DESTINATION 2</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    {{ $route->origin }}
                                    <input type="hidden" name="origin" value="{{ $route->origin }}" id="origin">
                                </div>
                                <div class="col-md-4">
                                    {{ $route->first_destination }}
                                    <input type="hidden" name="destination1" value="{{ $route->first_destination }}" id="destination1">
                                </div>
                                <div class="col-md-4">
                                    {{ $route->last_destination }}
                                    <input type="hidden" name="destination2" value="{{ $route->last_destination }}" id="destination2">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-4">
                                    {{ $route->origin_lat }}
                                    <input type="hidden" name="origin_lat" value="{{ $route->origin_lat }}" id="origin_lat">
                                </div>
                                <div class="col-md-4">
                                    {{ $route->first_destination_lat }}
                                    <input type="hidden" name="first_destination_lat" value="{{ $route->first_destination_lat }}" id="first_destination_lat">
                                </div>
                                <div class="col-md-4">
                                    {{ $route->last_destination_lat }}
                                    <input type="hidden" name="last_destination_lat" value="{{ $route->last_destination_lat }}" id="last_destination_lat">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    {{ $route->origin_long }}
                                    <input type="hidden" name="origin_long" value="{{ $route->origin_long }}" id="origin_long">
                                </div>
                                <div class="col-md-4">
                                    {{ $route->first_destination_long }}
                                    <input type="hidden" name="first_destination_long" value="{{ $route->first_destination_long }}" id="first_destination_long">
                                </div>
                                <div class="col-md-4">
                                    {{ $route->last_destination_long }}
                                    <input type="hidden" name="last_destination_long" value="{{ $route->last_destination_long }}" id="last_destination_long">
                                </div>
                            </div>
                            <input class="btn btn-primary" id='inputbtn' type="submit" value="Show Route"/>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="box-body">
            <h3>Google Maps</h3>
            <!--The div element for the map -->
            <div id="map"></div>
        </div>
    </section>
@stop
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<style type="text/css">
    /* Set the size of the div element that contains the map */
    #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
    }

</style>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt_cq6yHgOOa8aUgC5_owypFYl32wSWjk&callback=initMap&libraries=places&language=id"
    defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

    

    function initMap() {
      var directionsService = new google.maps.DirectionsService;
      var directionsDisplay = new google.maps.DirectionsRenderer;
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 5,
        center: {lat: -0.789275, lng: 113.921327}
      });
      directionsDisplay.setMap(map);

      var onChangeHandler = function() {
        // a = document.getElementById('origin').value;
        // b = document.getElementById('destination1').value;

        calculateAndDisplayRoute(directionsService, directionsDisplay);
      };
      document.getElementById('inputbtn').addEventListener('click', onChangeHandler);
    //   document.getElementById('end').addEventListener('change', onChangeHandler);
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
      directionsService.route({
        origin: document.getElementById('origin').value,
        destination: document.getElementById('destination1').value,
        destination: document.getElementById('destination2').value,
        travelMode: 'DRIVING'
      }, function(response, status) {
        if (status === 'OK') {
          directionsDisplay.setDirections(response);
        } else {
          window.alert('Directions request failed due to ' + status);
        }
      });
    }
  </script>
@stop
@section('js')
{{-- <script>
    console.log(document.getElementById('origin').value)
</script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous"></script>

    @if (Session::has('success'))
        <script>
            swal("Berhasil!", "{!! Session::get('success') !!}", "success", {
                button: "OK",
            })

        </script>
    @endif
    <script>
        $(function() {
            $("#datakoordinat").DataTable({})
        });

    </script>

@stop
