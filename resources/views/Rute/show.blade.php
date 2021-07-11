@extends('adminlte::page')

@section('title', 'Pembelian Barang')
@section('content_header')
    <div class="card-header">
        <h3>DATA RUTE DETAIL</h3>
    </div><br>
@stop
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box box-warning">
                    <div class="box-header">
                        <p>
                            <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i>
                                Refresh</button>
                            <a href="{{ route('rute.index') }}" class="btn btn-sm btn-flat btn-danger"><i
                                    class="fa fa-backward"></i>
                                Back</a>
                        </p>
                    </div>
                    <div class="card">
                        <div class="box-body">
                            <div class="col-12">
                                <div class="form-group">
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Kode Cabang</th>
                                                    <th>Nama Cabang</th>
                                                    <th>Alamat</th>
                                                    <th>Latitude</th>
                                                    <th>Longitude</th>
                                                </tr>
                                            </thead>
                                            @php
                                                $no = 1;
                                            @endphp
                                            <tbody>
                                                @foreach ($dt->getdetail as $show)
                                                    <tr>
                                                        <td>{{ $show->cabangs->Kode_Cabang }}</td>
                                                        <td>{{ $show->cabangs->Nama_Cabang }}</td>
                                                        <td>{{ $show->cabangs->Alamat }}</td>
                                                        <td>{{ $show->cabangs->Latitude }}</td>
                                                        <td>{{ $show->cabangs->Longitude }}</td>
                                                        <input type="hidden" value="{{ $show->cabangs->Latitude }}"
                                                            id="lat-{{ $no }}" readonly>
                                                        <input type="hidden" value="{{ $show->cabangs->Longitude }}"
                                                            id="long-{{ $no }}" readonly>
                                                    </tr>

                                                    @php
                                                        $no++;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-header">
                        <h2> Rute Detail </h2>
                    </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Tujuan Rute</th>
                                                        <td scope="col"> {{ $dt->Kelompok }}</td>
                                                    </tr>
                                                </thead>
                                                @php
                                                    $jml = 1;
                                                @endphp
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
                                                        <th scope="row">Biaya Bahan Bakar</th>
                                                        <td scope="col" id="dvEst"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Rute</th>
                                                        <td scope="col" id="lbl">
                                                            @foreach ($result as $item)
                                                                ({{ $cabang[$jml - 1]['kc'] }} {{ $cabang[$jml - 1]['nc'] }} - {{ $item }})
                                                                @php
                                                                    $jml++;
                                                                @endphp
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Action</th>
                                                        <td scope="col"><button type="submit" id="inputbtn" class="btn btn-info">show polyline</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                </div>
            </div>
    </section>
    <div class="card">
        <div class="col-12">
            <div class="box box-warning">
                <div class="box-header">
                </div>
            </div>
            <div class="box-body">
                <h3>Google Maps</h3>
                <!--The div element for the map -->
                <div id="map"></div>
            </div>
        </div>
    </div>


@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style type="text/css">
        /* Set the size of the div element that contains the map */
        #map {
            height: 500px;
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

            var renderOptions = {
                draggable: true
            };

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
                center: {
                    lat: -0.789275,
                    lng: 113.921327
                }
            });
            directionsDisplay.setMap(map);

            var onChangeHandler = function() {
                // a = document.getElementById('Alamat-1').value;
                // b = document.getElementById('Alamat-2').value;
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            };
            console.log(document.getElementById('lat-1').value);
            document.getElementById('inputbtn').addEventListener('click', onChangeHandler);
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            var latlong = <?php echo json_encode($dt->getdetail); ?>;

            // console.log(latlong);

            var waypoints = [];
            for (i in latlong) {
                // console.log(latlong[i]['cabangs']['Latitude']);
                waypoints.push({
                    location: new google.maps.LatLng(latlong[i]['cabangs']['Latitude'], latlong[i]['cabangs'][
                        'Longitude'
                    ]),
                    stopover: true
                });
            }
            var originA = document.getElementById('lat-1').value + "," + document.getElementById('long-1').value;
            var destinationA = document.getElementById('lat-1').value + "," + document.getElementById('long-1').value;
            directionsService.route({
                origin: originA,
                destination: originA,
                waypoints: waypoints,
                optimizeWaypoints: true,
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

                console.log(myroute.legs[i].duration.text);
            }
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
            document.getElementById("dvEst").innerHTML = "Rp. " + rupiah;
        }
    </script>
@endsection

@section('js')
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
    @if (Session::has('error'))
        <script type="text/javascript">
            Swal.fire({
                type: 'error',
                text: '{{ Session::get('
                error ') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        <?php Session::forget('error'); ?>
    @endif
    <script>
        $(function() {
            $("#tableTransaction").DataTable({})
        });

        // btn refresh
        $('.btn-refresh').click(function(e) {
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
    </script>

@endsection
