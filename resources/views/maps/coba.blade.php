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
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-4">
                        <!-- form -->
                        <form id="distance_form">
                            <div class="form-group"><label>username:</label>
                                <input class="form-control" id="username" placeholder="enter username"/>
                                <input  name="username" required="" type="hidden"/></div>
            
                            <div class="form-group"><label>origin: </label>
                                <input class="form-control" id="from_places" placeholder="enter location"/>
                                <input id="origin" name="origin" required="" type="hidden" value=""/>
                                <a class="form-control" onclick="getCurrentPosition()">Set Current Location</a>
                            </div>
            
                            <div class="form-group"><label>destination</label>
                                <input class="form-control" id="to_places" placeholder="enter location"/>
                                <input id="destination" name="destination" required="" type="hidden"/></div>
            
                            <div class="form-group">
                                <label>travel mode</label>
                                <select class="form-control" id="travel_mode" name="travel_mode">
                                    <option value="DRIVING">Driving</option>
                                    <option value="WALKING">foot</option>
                                    <option value="BICYCLING">bicycle</option>
                                    <option value="TRANSIT">transit</option>
                                </select>
                            </div>
            
                             <input class="btn btn-primary" type="submit" value="calculate_btn"/>
            
                        </form>
                    </div>
            </div>
            <div class="box-body">
                <h3>Google Maps</h3>
                <div id="floating-panel">
                    <input onclick="removeLine();" type="button" value="Remove line" />
                  </div>
                <!--The div element for the map -->
                <div id="map"></div>
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
        $(function () {
        var origin, destination, map;

        // add input listeners
        google.maps.event.addDomListener(window, 'load', function (listener) {
            setDestination();
            initMap();
        });

        // init or load map
        function initMap() {

            var myLatLng = {
                lat: 52.520008,
                lng: 13.404954
            };
            map = new google.maps.Map(document.getElementById('map'), {zoom: 16, center: myLatLng,});
        }

        function setDestination() {
            var from_places = new google.maps.places.Autocomplete(document.getElementById('from_places'));
            var to_places = new google.maps.places.Autocomplete(document.getElementById('to_places'));

            google.maps.event.addListener(from_places, 'place_changed', function () {
                var from_place = from_places.getPlace();
                var from_address = from_place.formatted_address;
                $('#origin').val(from_address);
            });

            google.maps.event.addListener(to_places, 'place_changed', function () {
                var to_place = to_places.getPlace();
                var to_address = to_place.formatted_address;
                $('#destination').val(to_address);
            });


        }

        function displayRoute(travel_mode, origin, destination, directionsService, directionsDisplay) {
            directionsService.route({
                origin: origin,
                destination: destination,
                travelMode: travel_mode,
                avoidTolls: true
            }, function (response, status) {
                if (status === 'OK') {
                    directionsDisplay.setMap(map);
                    directionsDisplay.setDirections(response);
                } else {
                    directionsDisplay.setMap(null);
                    directionsDisplay.setDirections(null);
                    alert('Could not display directions due to: ' + status);
                }
            });
        }

        // calculate distance , after finish send result to callback function
        function calculateDistance(travel_mode, origin, destination) {

            var DistanceMatrixService = new google.maps.DistanceMatrixService();
            DistanceMatrixService.getDistanceMatrix(
                {
                    origins: [origin],
                    destinations: [destination],
                    travelMode: google.maps.TravelMode[travel_mode],
                    unitSystem: google.maps.UnitSystem.IMPERIAL, // miles and feet.
                    // unitSystem: google.maps.UnitSystem.metric, // kilometers and meters.
                    avoidHighways: false,
                    avoidTolls: false
                }, save_results);
        }

        // save distance results
        function save_results(response, status) {

            if (status != google.maps.DistanceMatrixStatus.OK) {
                $('#result').html(err);
            } else {
                var origin = response.originAddresses[0];
                var destination = response.destinationAddresses[0];
                if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
                    $('#result').html("Sorry , not available to use this travel mode between " + origin + " and " + destination);
                } else {
                    var distance = response.rows[0].elements[0].distance;
                    var duration = response.rows[0].elements[0].duration;
                    var distance_in_kilo = distance.value / 1000; // the kilo meter
                    var distance_in_mile = distance.value / 1609.34; // the mile
                    var duration_text = duration.text;
                    appendResults(distance_in_kilo, distance_in_mile, duration_text);
                    sendAjaxRequest(origin, destination, distance_in_kilo, distance_in_mile, duration_text);
                }
            }
        }

        // append html results
        function appendResults(distance_in_kilo, distance_in_mile, duration_text) {
            $("#result").removeClass("hide");
            $('#in_mile').html("distance_in_mile : <span class='badge badge-pill badge-secondary'>" + distance_in_mile.toFixed(2) + "</span>");
            $('#in_kilo').html("distance_in_kilo: <span class='badge badge-pill badge-secondary'>" + distance_in_kilo.toFixed(2) + "</span>");
            $('#duration_text').html("in_text: <span class='badge badge-pill badge-success'>" + duration_text + "</span>");
        }

        // send ajax request to save results in the database
        function sendAjaxRequest(origin, destination, distance_in_kilo, distance_in_mile, duration_text) {
            var username =   $('#username').val();
            var travel_mode =  $('#travel_mode').find(':selected').text();
            $.ajax({
                url: 'common.php',
                type: 'POST',
                data: {
                    username,
                    travel_mode,
                    origin,
                    destination,
                    distance_in_kilo,
                    distance_in_mile,
                    duration_text
                },
                success: function (response) {
                    console.info(response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        // on submit  display route ,append results and send calculateDistance to ajax request
        $('#distance_form').submit(function (e) {
            e.preventDefault();
            var origin = $('#origin').val();
            var destination = $('#destination').val();
            var travel_mode = $('#travel_mode').val();
            var directionsDisplay = new google.maps.DirectionsRenderer({'draggable': false});
            var directionsService = new google.maps.DirectionsService();
           displayRoute(travel_mode, origin, destination, directionsService, directionsDisplay);
            calculateDistance(travel_mode, origin, destination);
        });

    });

function removeLine() {
  poly.setMap(null);
}

    </script>


@stop

@section('js')

    <script>
        console.log('Hi!');

    </script>
@stop
