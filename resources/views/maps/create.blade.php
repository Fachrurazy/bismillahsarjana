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
                        <a href="{{ route('maps.index') }}" class="btn btn-m btn-flat btn-danger"><i
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
        <br>
        <div class="col-12">
            <div class="card">
                <div class="row">
                    <form action="http://127.0.0.1:8000/api/distance" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-4">
                                <div class="card-body">
                                    <label for="exampleInputEmail1">ORIGIN</label><br>
                                    <input type="text" name="origin" id="origin"/>
                                    <label for="exampleInputEmail1">DESTINATION 1</label><br>
                                    <input type="text" name="destination" id="destination" autocomplete="on" runat="server" />
                                    <label for="exampleInputEmail1">DESTINATION 2</label>
                                    <input type="text" name="destination1" id="destination1" autocomplete="on" runat="server" />
                                    {{-- <div id="inputcontainer">
                                        <input type="text" name="input0" id="input0" onkeyup="addInput();" />
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <button type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        var currentindex = 0;
        function addInput(){
            var lastinput = document.getElementById('input'+currentindex);
            if(lastinput.value != ''){
                var container = document.getElementById('inputcontainer');
                var newinput = document.createElement('input');
                currentindex++;
                newinput.type = "text";
                newinput.name = 'input'+currentindex;
                newinput.id = 'input'+currentindex;
                autocomplete = new google.maps.places.Autocomplete((document.getElementById(newinput.id)), {
                    componentRestrictions: {
                        country: "ID"
                    }
                });
                google.maps.event.addListener(autocomplete, 'place_changed', function() {
                    var near_place = autocomplete.getPlace();
                });
                newinput.onkeyup = addInput;
                container.appendChild(newinput);
            }
        }

    </script> --}}

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
        var origin = 'origin';
        $(document).ready(function() {
            var autocompleteorigin;
            autocompleteorigin = new google.maps.places.Autocomplete((document.getElementById(origin)), {
                // types: ['geocode'],
                componentRestrictions: {
                    country: "ID"
                }
            });

            google.maps.event.addListener(autocompleteorigin, 'place_changed', function() {
                var near_origin = autocompleteorigin.getPlace();
                // document.getElementById('cityLat').value = near_place.geometry.location.lat();
                // document.getElementById('cityLng').value = near_place.geometry.location.lng();
            });

        });
        var destination = 'destination';
        $(document).ready(function() {
            var autocompletedestination;
            autocompletedestination = new google.maps.places.Autocomplete((document.getElementById(destination)), {
                // types: ['geocode'],
                componentRestrictions: {
                    country: "ID"
                }
            });

            google.maps.event.addListener(autocompletedestination, 'place_changed', function() {
                var near_destination = autocompletedestination.getPlace();
            });
        });
        var destination1 = 'destination1';
        $(document).ready(function() {
            var autocompletedestination1;
            autocompletedestination1 = new google.maps.places.Autocomplete((document.getElementById(
                destination1)), {
                // types: ['geocode'],
                componentRestrictions: {
                    country: "ID"
                }
            });

            google.maps.event.addListener(autocompletedestination1, 'place_changed', function() {
                var near_destination = autocompletedestination1.getPlace();
            });
        });

    </script>

@stop

@section('js')

    <script>
        console.log('Hi!');

    </script>
@stop
