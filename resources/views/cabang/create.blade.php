@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')

    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                    <p>
                        <a href="{{ route('cabang.index') }}" class="btn btn-m btn-flat btn-danger"><i
                                class="fa fa-backward"></i>Back</a>
                    </p>
                </div>
            </div>
            <div class="box-body">
                <h3>Google Maps</h3>
                <!--The div element for the map -->
                <div id="map"></div>
            </div>
        </div>

        <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
        {{-- <div class="form-group">
        <div class="col-md-12">
            <div class="card-body">
                <form method="post" action="{{ route('maps.store') }}">
                    {{ csrf_field() }}
                    <input id="searchTextField" name="nama_koordinat" type="text" size="50" placeholder="Enter a location"
                        autocomplete="on" runat="server" />
                    <input type="text" id="cityLat" name="lat" />
                    <input type="text" id="cityLng" name="long" />
                    <button type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div> --}}
        <br>
        <div class="col-12">
            <div class="card">
                <div class="row">
                    <form action="{{ route('cabang.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-4">
                                <div class="card-body">
                                    <label>Nama Cabang</label><br>
                                    <input type="text" name="Nama_Cabang" id="Nama_Cabang"/>
                                    <label>Pemilik</label><br>
                                    <input type="text" name="Pemilik" id="Pemilik"/>
                                    <label>Telepon</label><br>
                                    <input type="tel" pattern="[0][8][0-9]{10}" name="Telepon" id="Telepon"/>
                                    <label for="exampleInputEmail1">Alamat</label><br>
                                    <input type="text" name="Alamat" id="alamat" autocomplete="on" runat="server" />
                                    <label for="exampleInputEmail1">Latitude</label><br>
                                    <input type="text" id="cityLat" name="Latitude" />
                                    <label for="exampleInputEmail1">Longitute</label><br>
                                    <input type="text" id="cityLng" name="Longitude" />
                                </div>
                            </div>
                        </div>
                        <button type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            const uluru = {
                lat: -6.21462,
                lng: 106.84513
            };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }

    </script>
    <script type="text/javascript">
        var alamat = 'alamat';
        $(document).ready(function() {
            var autocompletealamat;
            autocompletealamat = new google.maps.places.Autocomplete((document.getElementById(alamat)), {
                // types: ['geocode'],
                componentRestrictions: {
                    country: "ID"
                }
            });

            google.maps.event.addListener(autocompletealamat, 'place_changed', function() {
                var near_place = autocompletealamat.getPlace();
                document.getElementById('cityLat').value = near_place.geometry.location.lat();
                document.getElementById('cityLng').value = near_place.geometry.location.lng();
                
            });

        });
    </script>

@stop

@section('js')

    <script>
        console.log('Hi!');

    </script>
@stop
