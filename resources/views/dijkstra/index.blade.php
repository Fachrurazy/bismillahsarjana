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
<div class="row">
    {{-- <form action="{{route('dijkstra.store')}}" method="POST"> --}}
        {{-- {{ csrf_field() }} --}}
        <div class="container">
            <div class="row">
              <div class="col-md-4">
                <select name="origin" id="origin" required>
                    <option value="">Pilih Origin</option>
                    @foreach ($datas as $estimation)
                    <option value="{{$estimation->Nama_Cabang}}">{{$estimation->Kode_Cabang}} - {{$estimation->Nama_Cabang}}</option>
                    @endforeach
                </select>
                {{-- <input type="text" id="asd" value=""/> --}}
                <p id="org"></p>
              </div>
              <div class="col-md-4">
                <select name="destination" id="destination" required>
                    <option value="">Pilih Destination</option>
                    @foreach ($datas as $estimation)
                    <option value="{{$estimation->Nama_Cabang}}">{{$estimation->Kode_Cabang}} - {{$estimation->Nama_Cabang}}</option>
                    @endforeach
                </select>
                <p id="dest"></p>
              </div>
            </div>
          </div>
          <button type="submit" id="inputbtn" onclick="myFunction()">Simpan</button>
    {{-- </form> --}}
</div>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <h1 id="lblPath">Test</h1>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <div class="box-body">
        <h3>Google Maps</h3>
        {{-- <div id="floating-panel">
            <input onclick="removeLine();" type="button" value="Remove line" />
          </div> --}}
        <!--The div element for the map -->
        <div id="map"></div>
    </div>
    <div id="dvDistance"></div>
    
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

    // g.addVertex('Pabrik', {Cikaret: 180679});
    // g.addVertex('Cikaret', {Jatijajar: 10511, Cilodong: 3781, Citayam: 8118, Karadenan: 10181, Pabrik: 180679});
    // g.addVertex('Jatijajar', {Cikaret: 10511, Cilodong: 7889, Babakanmadang: 22707});
    // g.addVertex('Cilodong', {Jatijajar: 7889, Cikaret: 3781, Citayam: 10263});
    // g.addVertex('Citayam', {Cikaret: 8118, Cilodong: 10263, Karadenan: 8339});
    // g.addVertex('Karadenan', {Cikaret: 1081, Citayam: 8339, Babakanmadang: 12102});
    // g.addVertex('Babakanmadang', {Karadenan: 12102, Jatijajar: 22707});

    g.addVertex('Pabrik', {Cibitung: 136040, Kranji: 145805});
    g.addVertex('Cibitung', {Kranji: 18628, Cakung: 32688, Pabrik: 136040});
    g.addVertex('Kranji', {Bintara: 2049, Handoyo: 12220, CileungsiIndah: 25442, Pabrik: 136040, Cakung: 13811, Cibitung: 18628});
    g.addVertex('Bintara', {Tebet: 8118, Jatikramat: 10263, Handoyo: 8339, Kranji: 13811, Cakung: 13811, TanjungPriok: 23057});
    g.addVertex('Cakung', {Kranji: 13811, Bintara: 13086, Tebet: 18366, TanjungPriok: 23057, Cibitung: 32688});
    g.addVertex('TanjungPriok', {Tebet: 21569, Bintara: 26699, Cakung: 13811});
    g.addVertex('Tebet', {Jatikramat: 17602, TanjungPriok: 23057, Cakung: 13811, Bintara: 13086});
    g.addVertex('Jatikramat', {Jatijajar: 26886, Cilodong: 29325, Handoyo: 7311, Bintara: 13086 , Tebet: 18366});
    g.addVertex('Handoyo', {Jatijajar: 31805, CileungsiIndah: 13222, Jatikramat: 17602, Kranji: 13811, Bintara: 13086});
    g.addVertex('CileungsiIndah', {Jatijajar: 18831, DarnoBogor: 6447, Kranji: 13811, Handoyo: 7311});
    g.addVertex('Jatijajar', {Cilodong: 5778, DarnoBogor: 12709, Cibinong: 9201, Jatikramat: 10263, Handoyo: 8339, CileungsiIndah: 13222});
    g.addVertex('Cilodong', {DarnoBogor: 12709, Cibinong: 9201, Cikaret: 10611, Jatikramat: 10263, Jatijajar: 31805});
    g.addVertex('DarnoBogor', {Cibinong: 20108, Babakanmadang: 24522, Jatijajar: 31805, CileungsiIndah: 13222, Cilodong: 5778});
    g.addVertex('Cikaret', {Citayam: 8118, Cilodong: 5778, Cibinong: 16519});
    g.addVertex('Cibinong', {Cikaret: 3262, Citayam: 8950, Karadenan: 11006, Babakanmadang: 16519, Cilodong: 5778, DarnoBogor: 12709, Jatijajar: 31805});
    g.addVertex('Citayam', {Karadenan: 8339, Cikaret: 3262, Cibinong: 20108});
    g.addVertex('Karadenan', {Babakanmadang: 12102, Citayam: 8118, Cibinong: 16519});
    g.addVertex('Babakanmadang', {Karadenan: 12102, Cibinong: 16519, DarnoBogor: 24522});
    
    // Log test, with the addition of reversing the path and prepending the first node so it's more readable
    // console.log(o,g);
    // console.log(g.shortestPath(o, d).concat([o]).reverse());
    var hasil = g.shortestPath(o, d).concat([o]).reverse();
    
    document.getElementById("lblPath").innerHTML = "jalur terdekat:" + hasil;
    allDestination = hasil

  if (o == "Pabrik")
    {
        document.getElementById("org").innerHTML = "-7.013085699999999,107.6455816";
    }
    else if (o == "Cibitung")
    {
        document.getElementById("org").innerHTML = "-6.2447368,107.0893353";
    }
    else if (o == "Kranji")
    {
        document.getElementById("org").innerHTML = "-6.2402719,106.9698461";
    }
    else if (o == "Bintara")
    {
        document.getElementById("org").innerHTML = "-6.2320719,106.962546";
    }
    else if (o == "Cakung")
    {
        document.getElementById("org").innerHTML = "-6.1676666,106.9483334";
    }
    else if (o == "TanjungPriok")
    {
        document.getElementById("org").innerHTML = "-6.1269396,106.8573167";
    }
    else if (o == "Tebet")
    {
        document.getElementById("org").innerHTML = "-6.227895900000001,106.8586937";
    }
    else if (o == "Jatikramat")
    {
        document.getElementById("org").innerHTML = "-6.2860957,106.9410857";
    }
    else if (o == "Handoyo")
    {
        document.getElementById("org").innerHTML = "-6.3105664,106.9847585";
    }
    else if (o == "CileungsiIndah")
    {
        document.getElementById("org").innerHTML = "-6.4076092,106.9658947";
    }
    else if (o == "Jatijajar")
    {
        document.getElementById("org").innerHTML = "-6.414000199999999,106.8704251";
    }
    else if (o == "Cilodong")
    {
        document.getElementById("org").innerHTML = "-6.4235896,106.8357255";
    }
    else if (o == "DarnoBogor")
    {
        document.getElementById("org").innerHTML = "-6.4252892,106.9481792";
    }
    else if (o == "Cikaret")
    {
        document.getElementById("org").innerHTML = "-6.468566,106.8417005";
    }
    else if (o == "Cibinong")
    {
        document.getElementById("org").innerHTML = "-6.455612399999999,106.8264144";
    }
    else if (o == "Citayam")
    {
        document.getElementById("org").innerHTML = "-6.4673531,106.8032647";
    }
    else if (o == "Karadenan")
    {
        document.getElementById("org").innerHTML = "-6.522043999999999,106.8131834";
    }
    else if (o == "Babakanmadang")
    {
        document.getElementById("org").innerHTML = "-6.561322199999999,106.8579398";
  }
   //batasan
   if (d == "Pabrik")
    {
        document.getElementById("dest").innerHTML = "-7.013085699999999,107.6455816";
    }
    else if (d == "Cibitung")
    {
        document.getElementById("dest").innerHTML = "-6.2447368,107.0893353";
    }
    else if (d == "Kranji")
    {
        document.getElementById("dest").innerHTML = "-6.2402719,106.9698461";
    }
    else if (d == "Bintara")
    {
        document.getElementById("dest").innerHTML = "-6.2320719,106.962546";
    }
    else if (d == "Cakung")
    {
        document.getElementById("dest").innerHTML = "-6.1676666,106.9483334";
    }
    else if (d == "TanjungPriok")
    {
        document.getElementById("dest").innerHTML = "-6.1269396,106.8573167";
    }
    
    else if (d == "Tebet")
    {
        document.getElementById("dest").innerHTML = "-6.227895900000001,106.8586937";
    }
    else if (d == "Jatikramat")
    {
        document.getElementById("dest").innerHTML = "-6.2860957,106.9410857";
    }
    else if (d == "Handoyo")
    {
        document.getElementById("dest").innerHTML = "-6.3105664,106.9847585";
    }
    else if (d == "CileungsiIndah")
    {
        document.getElementById("dest").innerHTML = "-6.4076092,106.9658947";
    }
    else if (d == "Jatijajar")
    {
        document.getElementById("dest").innerHTML = "-6.414000199999999,106.8704251";
    }
    else if (d == "Cilodong")
    {
        document.getElementById("dest").innerHTML = "-6.4235896,106.8357255";
    }
    else if (d == "DarnoBogor")
    {
        document.getElementById("dest").innerHTML = "-6.4252892,106.9481792";
    }
    else if (d == "Cikaret")
    {
        document.getElementById("dest").innerHTML = "-6.468566,106.8417005";
    }
    else if (d == "Cibinong")
    {
        document.getElementById("dest").innerHTML = "-6.455612399999999,106.8264144";
    }
    else if (d == "Citayam")
    {
        document.getElementById("dest").innerHTML = "-6.4673531,106.8032647";
    }
    else if (d == "Karadenan")
    {
        document.getElementById("dest").innerHTML = "-6.522043999999999,106.8131834";
    }
    else if (d == "Babakanmadang")
    {
        document.getElementById("dest").innerHTML = "-6.561322199999999,106.8579398";
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
        // a = document.getElementById('origin').value;
        // b = document.getElementById('destination1').value;

        calculateAndDisplayRoute(directionsService, directionsDisplay);
      };
      document.getElementById('inputbtn').addEventListener('click', onChangeHandler);
    //   document.getElementById('end').addEventListener('change', onChangeHandler);
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var getlatlogORG = document.getElementById("org").innerHTML;
        var latLngORG =  getlatlogORG.split(",");
        var latitudeORG = parseFloat(latLngORG[0]);
        var longitudeORG = parseFloat(latLngORG[1]);

        var getlatlogDEST = document.getElementById("dest").innerHTML;
        var latLngDEST =  getlatlogDEST.split(",");
        var latitudDEST = parseFloat(latLngDEST[0]);
        var longitudeDEST = parseFloat(latLngDEST[1]);

        // var orgg = document.getElementById('org').innerHTML;
        // var Strorg = orgg.toString();
        // var destt = document.getElementById('dest').innerHTML;
        // var StrDest = destt.toString();
        // console.log(allDestination);
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
                if (items[i] == "Pabrik")
                {
                    items[i] = "-7.013085699999999,107.6455816";
                    console.log(items[i]);
                }
                else if (items[i] == "Cibitung")
                {
                    items[i] = "-6.2447368,107.0893353";
                    console.log(items[i]);
                }
                else if (items[i] == "Kranji")
                {
                    items[i] = "-6.2402719,106.9698461";
                    console.log(items[i]);
                }
                else if (items[i] == "Bintara")
                {
                    items[i] = "-6.2320719,106.962546";
                    console.log(items[i]);
                }
                else if (items[i] == "Jatijajar")
                {
                    items[i] = "-6.414000199999999,106.8704251";
                    console.log(items[i]);
                }
                else if (items[i] == "Cakung")
                {
                    items[i] = "-6.1676666,106.9483334";
                    console.log(items[i]);
                }
                else if (items[i] == "TanjungPriok")
                {
                    items[i] = "-6.1269396,106.8573167";
                    console.log(items[i]);
                }
                else if (items[i] == "Tebet")
                {
                    items[i] = "-6.227895900000001,106.8586937";
                    console.log(items[i]);
                }
                else if (items[i] == "Jatikramat")
                {
                    items[i] = "-6.2860957,106.9410857";
                    console.log(items[i]);
                }
                else if (items[i] == "Handoyo")
                {
                    items[i] = "-6.3105664,106.9847585";
                    console.log(items[i]);
                }
                else if (items[i] == "CileungsiIndah")
                {
                    items[i] = "-6.4076092,106.9658947";
                    console.log(items[i]);
                }
                else if (items[i] == "Jatijajar")
                {
                    items[i] = "-6.414000199999999,106.8704251";
                    console.log(items[i]);
                }
                else if (items[i] == "Cilodong")
                {
                    items[i] = "-6.4235896,106.8357255";
                    console.log(items[i]);
                }
                else if (items[i] == "DarnoBogor")
                {
                    items[i] = "-6.4252892,106.9481792";
                    console.log(items[i]);
                }
                else if (items[i] == "Cikaret")
                {
                    items[i] = "-6.468566,106.8417005";
                    console.log(items[i]);
                }
                else if (items[i] == "Cibinong")
                {
                    items[i] = "-6.455612399999999,106.8264144";
                    console.log(items[i]);
                }
                else if (items[i] == "Citayam")
                {
                    items[i] = "-6.4673531,106.8032647";
                    console.log(items[i]);
                }
                else if (items[i] == "Karadenan")
                {
                    items[i] = "-6.522043999999999,106.8131834";
                    console.log(items[i]);
                }
                else if (items[i] == "Babakanmadang")
                {
                    items[i] = "-6.561322199999999,106.8579398";
                    console.log(items[i]);
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
    console.log(myroute);
    for (i = 0; i < myroute.legs.length; i++) {
        totalDist += myroute.legs[i].distance.value;
        totalTime += myroute.legs[i].duration.value;
        
    console.log( myroute.legs[i].duration.value);
    }
    totalDist = totalDist / 1000.
    document.getElementById("dvDistance").innerHTML = "total distance is: " + totalDist + " km<br>total time is: " + (totalTime / 60).toFixed(2) + " minutes";
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
