<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Directions Service</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
  </head>
  <body>
    <div id="floating-panel">
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
    <div id="map"></div>
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

    <script>
      function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 7,
          center: {lat: 41.85, lng: -87.65}
        });
        directionsDisplay.setMap(map);

        var onChangeHandler = function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
        document.getElementById('start').addEventListener('change', onChangeHandler);
        document.getElementById('end').addEventListener('change', onChangeHandler);
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        directionsService.route({
          origin: document.getElementById('start').value,
          destination: document.getElementById('end').value,
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
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt_cq6yHgOOa8aUgC5_owypFYl32wSWjk&callback=initMap">
    </script>
  </body>
</html>