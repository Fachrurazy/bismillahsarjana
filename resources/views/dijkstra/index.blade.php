@extends('adminlte::page')

@section('title', 'DATA KOORDINAT')
@section('content_header')
    <div class="card-header">
        <h3>PENCARIAN RUTE DIJKSTRA</h3>
    </div><br>
    {{-- <div class="row">
        <div class="col-md-2">
            <a class="btn btn-block btn-success" href="{{ route('maps.create') }}"><b>+</b> CREATE COORDINATE</a>
        </div>
    </div> --}}
    
@stop
@section('content')
<div class="container">
    {{-- <form action="{{route('dijkstra.store')}}" method="POST"> --}}
        {{-- {{ csrf_field() }} --}}
        {{-- <div class="container"> --}}
            <div class="row">
              <div class="col-md-4">
                <select name="origin" id="origin" class="custom-select" required>
                    <option value="">Pilih Titik Awal</option>
                    @foreach ($datas as $estimation)
                    <option value="{{$estimation->Nama_Cabang}}">{{$estimation->Nama_Cabang}}</option>
                    @endforeach
                </select>
                {{-- <input type="text" id="asd" value=""/> --}}
                <p hidden id="org"></p>
              </div>
              <div class="col-md-4">
                <select name="destination" id="destination" class="custom-select" required>
                    <option value="">Pilih Titik Akhir</option>
                    @foreach ($datas as $estimation)
                    <option value="{{$estimation->Nama_Cabang}}">{{$estimation->Nama_Cabang}}</option>
                    @endforeach
                </select>
                <p hidden id="dest"></p>
              </div>
              {{-- <div class="input-group-append"> --}}
                <div class="col-md-4">
                <button class="btn btn-outline-primary" type="submit" id="inputbtn" onclick="myFunction()">Cari Rute</button>
              </div>
            </div>
          </div>
    {{-- </form> --}}
  </div>
</div>
<br>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                  <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Tujuan Rute</th>
                        <td scope="col" id="namarute"></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="col">Total Jarak</th>
                        <td scope="col" id="dvDistance"></td>
                      </tr>
                      <tr>
                        <th scope="row">Total Waktu</th>
                        <td scope="col" id="dvDuration"></td>
                      </tr>
                      <tr>
                        <th scope="row">Total Biaya Bahan Bakar</th>
                        <td scope="col" id="dvBahan"></td>
                      </tr>
                      <tr>
                        <th scope="row">Rute</th>
                        <td scope="col" id="lblPath"></td>
                      </tr>
                    </tbody>
                  </table>
                    <!-- /.card-header -->
                     {{-- <div class="card-body"> 
                      <p id="namarute"></p> 
                        <h1 id="lblPath"></h1>
                        <div id="dvDistance"></div>
                    </div> --}}
                    <!-- /.card-body -->
                  </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

    <div class="card-header">
        <h3>Google Maps</h3>
        <div id="map"></div>
        {{-- <div id="floating-panel">
            <input onclick="removeLine();" type="button" value="Remove line" />
          </div> --}}
        <!--The div element for the map -->
    </div>

{{-- PENGUJIAN WHITE BOX --}}
  {{-- <//?php
    // $a=array("a"=>1.2,"b"=>2,"c"=>3);
    // if (array_sum($a) == 7) {
    //         echo('VALID');
    //     } else {
    //         echo('TIDAK VALID');
    //     }
  ?> --}}
{{-- PENGUJIAN WHITE BOX --}}
    
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

<script>
    var allDestination = new Array("");

    function PriorityQueue () {
      this._nodes = [];
    
      this.enqueue = function (priority, key) {
        this._nodes.push({key: key, priority: priority });
        this.sort();
      };
      this.dequeue = function () {
        return this._nodes.shift().key;
      };
      this.sort = function () {
        this._nodes.sort(function (a, b) {
          return a.priority - b.priority;
        });
      };
      this.isEmpty = function () {
        return !this._nodes.length;
      };
    }
    
    /**
     * Pathfinding starts here
     */
    function Graph(){
      var INFINITY = 1/0;
      this.vertices = {};
    
      this.addVertex = function(name, edges){
        this.vertices[name] = edges;
      };
    
      this.shortestPath = function (start, finish) {
        var nodes = new PriorityQueue(),
            distances = {},
            previous = {},
            path = [],
            smallest, vertex, neighbor, alt;
    
        for(vertex in this.vertices) {
          if(vertex === start) {
            distances[vertex] = 0;
            nodes.enqueue(0, vertex);
          }
          else {
            distances[vertex] = INFINITY;
            nodes.enqueue(INFINITY, vertex);
          }
    
          previous[vertex] = null;
        }
    
        while(!nodes.isEmpty()) {
          smallest = nodes.dequeue();
    
          if(smallest === finish) {
            path = [];
    
            while(previous[smallest]) {
              path.push(smallest);
              smallest = previous[smallest];
            }
    
            break;
          }
    
          if(!smallest || distances[smallest] === INFINITY){
            continue;
          }
    
          for(neighbor in this.vertices[smallest]) {
            alt = distances[smallest] + this.vertices[smallest][neighbor];
    
            if(alt < distances[neighbor]) {
              distances[neighbor] = alt;
              previous[neighbor] = smallest;
    
              nodes.enqueue(alt, neighbor);
            }
          }
        }
    
        return path;
      };
    }
    
    function myFunction() {
        var o = document.getElementById("origin").value;
        var d = document.getElementById("destination").value;        

        var g = new Graph();

        g.addVertex('Pabrik', {Cianjur: 80699, Sukamanah: 74677, Indramayu: 154153, Garut: 46476, Cibitung: 136040});
        g.addVertex('Tegal', {Majalengka: 126801, Brebes: 12116});
        g.addVertex('Majalengka', {Tegal: 126801, Brebes: 118629, Cirebon: 22190, Kadipaten: 13319});
        g.addVertex('Brebes', {Majalengka: 118629, Cirebon: 94045, Kadipaten: 124620, Tegal: 12116});
        g.addVertex('Kadipaten', {Majalengka: 13319, Brebes: 124620, Cirebon: 34985, Garut: 63329, Indramayu: 59748});
        g.addVertex('Cirebon', {Kadipaten: 34985, Brebes: 94045, Indramayu: 88933, Garut: 95955, Majalengka: 22190});
        g.addVertex('Indramayu', {Cirebon: 88933, Kadipaten: 59748, Garut: 102032, Pabrik: 154153, Sukamanah: 168319});
        g.addVertex('Garut', {Indramayu: 102032, Kadipaten: 63329, Cirebon: 95955, Pabrik: 46476, Sukamanah: 110648});
        g.addVertex('Sukamanah', {Cibitung: 91292, Indramayu: 168319, Garut: 110648, Pabrik: 74677, Cianjur: 9830});
        g.addVertex('Cianjur', {Pabrik: 80699, Sukamanah: 9830, Cibitung: 123669, Kranji: 109192});
        g.addVertex('Cibitung', {Sukamanah: 91292, Kranji: 18628, Cakung: 32688, Cianjur: 123669, Pabrik: 136040});
        g.addVertex('Kranji', {Bintara: 2049, Handoyo: 12220, CileungsiIndah: 25442, Cianjur: 109192, Cakung: 13811, Cibitung: 18628});
        g.addVertex('Bintara', {Tebet: 12273, Jatikramat: 11452, Handoyo: 13656, Kranji: 2049, Cakung: 13086, TanjungPriok: 30834, CileungsiIndah: 37124});
        g.addVertex('Cakung', {Kranji: 13811, Bintara: 13086, Tebet: 18366, TanjungPriok: 23057, Cibitung: 32688});
        g.addVertex('TanjungPriok', {Tebet: 21569, Bintara: 26699, Cakung: 23057});
        g.addVertex('Tebet', {Jatikramat: 17602, TanjungPriok: 21569, Cakung: 18366, Bintara: 12273, Handoyo: 23983});
        g.addVertex('Jatikramat', {Jatijajar: 26886, Cilodong: 29325, Handoyo: 7311, Bintara: 11452 , Tebet: 17602});
        g.addVertex('Handoyo', {Jatijajar: 31805, CileungsiIndah: 13222, Jatikramat: 7311, Kranji: 12220, Bintara: 13656, Tebet: 23983});
        g.addVertex('CileungsiIndah', {Handoyo: 13222, Kranji: 25442, Jatijajar: 18831, DarnoBogor: 6447});
        g.addVertex('Jatijajar', {Cilodong: 5778, DarnoBogor: 12709, Cibinong: 9201, Jatikramat: 26886, Handoyo: 31805, CileungsiIndah: 18831});
        g.addVertex('Cilodong', {DarnoBogor: 12709, Cibinong: 9201, Cikaret: 10611, Jatikramat: 29325, Jatijajar: 5778});
        g.addVertex('DarnoBogor', {Cibinong: 20108, Babakanmadang: 24522, Jatijajar: 12709, CileungsiIndah: 6447, Cilodong: 12709});
        g.addVertex('Cikaret', {Citayam: 8118, Cilodong: 10611, Cibinong: 3262});
        g.addVertex('Cibinong', {Cikaret: 3262, Citayam: 8950, Karadenan: 11006, Babakanmadang: 16519, Cilodong: 9201, DarnoBogor: 20108, Jatijajar: 9201});
        g.addVertex('Citayam', {Karadenan: 8339, Cikaret: 8118, Cibinong: 8950});
        g.addVertex('Karadenan', {Babakanmadang: 12102, Citayam: 8339, Cibinong: 11006});
        g.addVertex('Babakanmadang', {Karadenan: 12102, Cibinong: 16519, DarnoBogor: 24522});

        var hasil = g.shortestPath(o, d).concat([o]).reverse();

        document.getElementById("namarute").innerHTML = o + " - " + d;
        document.getElementById("lblPath").innerHTML = hasil;
        allDestination = hasil;

        var dataLokasi = <?php echo json_encode($dt); ?>;

        for (i in dataLokasi) {
            if (o == dataLokasi[i]["Nama_Cabang"]) {
                document.getElementById("org").innerHTML = (dataLokasi[i]["Latitude"] + "," + dataLokasi[i]["Longitude"]).toString();
            }
            if (d == dataLokasi[i]["Nama_Cabang"]) {
                document.getElementById("dest").innerHTML = (dataLokasi[i]["Latitude"] + "," + dataLokasi[i]["Longitude"]).toString();
            }
        }
                
    }
    
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt_cq6yHgOOa8aUgC5_owypFYl32wSWjk&callback=initMap&libraries=places&language=id"
        defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script>
        function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;

        var renderOptions = { draggable: true };

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5,
            center: {lat: -0.789275, lng: 113.921327}
        });
        directionsDisplay.setMap(map);

        var onChangeHandler = function() {
            calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
        document.getElementById('inputbtn').addEventListener('click', onChangeHandler);
        }
        
        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            var dataLokasi = <?php echo json_encode($dt); ?>;

            var getlatlogORG = document.getElementById("org").innerHTML;
            var latLngORG =  getlatlogORG.split(",");
            var latitudeORG = parseFloat(latLngORG[0]);
            var longitudeORG = parseFloat(latLngORG[1]);

            var getlatlogDEST = document.getElementById("dest").innerHTML;
            var latLngDEST =  getlatlogDEST.split(",");
            var latitudDEST = parseFloat(latLngDEST[0]);
            var longitudeDEST = parseFloat(latLngDEST[1]);
            
            var items = allDestination;
            var fromorigin = allDestination[0];
            var lastdestination = allDestination[allDestination.length - 1];
            console.log(fromorigin);
            console.log(lastdestination);
            var waypoints = [];
            for (var i = 0; i < items.length; i++) {
                console.log(items.length);
                console.log(items[i]);
                if (items[i] != "" || items[i] !== fromorigin || items[i] !== lastdestination) {

                    for (dl in dataLokasi) {
                        if (items[i] == dataLokasi[dl]["Nama_Cabang"]) {
                            items[i] = (dataLokasi[dl]["Latitude"] + "," + dataLokasi[dl]["Longitude"]).toString();
                        }
                    }
                    waypoints.push({
                        location: items[i],
                        stopover: true
                    });
                }
            }
            
        directionsService.route({
            origin: {lat: latitudeORG, lng: longitudeORG},
            destination: {lat: latitudDEST, lng: longitudeDEST},
            // origin: document.getElementById('org').innerHTML,
            // destination: document.getElementById('dest').innerHTML,
            waypoints: waypoints,
            optimizeWaypoints: true,
            // destination: document.getElementById('destination2').value,
            travelMode: 'DRIVING'
        }, function(response, status) {
            if (status === 'OK') {
            directionsDisplay.setDirections(response);
            computeTotalDistance(response)
            } else {
            window.alert('Directions request failed due to ' + status);
            }
        });
        }

        function computeTotalDistance(result) {
            var totalDist = 0;
            var totalTime = 0;
            var myroute = result.routes[0];
            // totalDist = distances.text;
            // totalTime = duration.text
            console.log(myroute);
            for (i = 0; i < myroute.legs.length; i++) {
                totalDist += myroute.legs[i].distance.value;
                totalTime += myroute.legs[i].duration.value;
                
            console.log( myroute.legs[i].distance.value);
            }

            // totalDist = totalDist / 1000;
            // var totalbahan = totalDist.toFixed(1) / 10 * 9500;

            DistKM = totalDist / 1000;
            calc = (DistKM.toFixed(1)/10)*9500;
            var bilangan = Math.round(calc);
	
            var	number_string = bilangan.toString(),
                sisa 	= number_string.length % 3,
                rupiah 	= number_string.substr(0, sisa),
                ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                    
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            d = Number(totalTime);
            var h = Math.floor(d / 3600);
            var m = Math.floor(d % 3600 / 60);
            var s = Math.floor(d % 3600 % 60);

            var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours ") : "";
            var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : " minutes ") : "";
            var sDisplay = s > 0 ? s + (s == 1 ? " second" : " seconds") : "";

            document.getElementById("dvDistance").innerHTML = DistKM.toFixed(1) + " Km";
            document.getElementById("dvDuration").innerHTML = hDisplay + mDisplay;
            document.getElementById("dvBahan").innerHTML = "Rp." + rupiah;
        }
        
    </script>
@stop
@section('js')
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
{{-- <script>
    $(function() {
        $("#datakoordinat").DataTable({})
    });

</script> --}}

@stop
