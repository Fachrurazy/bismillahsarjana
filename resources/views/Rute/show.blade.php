@extends('adminlte::page')

@section('title', 'Pembelian Barang')
@section('content_header')
    <div class="card-header">
        <h3>DATA INVOICE</h3>
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
                                    <div class="col-md-4">
                                        <div class="card-body">
                                            <i class="fa fa-truck"></i>
                                            <label for="exampleInputEmail1">KELOMPOK</label>
                                            <input type="text" readonly class="form-control float-right" name="kelompok"
                                                value="{{ $dt->Kelompok }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="tableTransaction" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Kode_Cabang</th>
                                                    <th>Alamat</th>
                                                    <th>Latitude</th>
                                                    <th>Longitude</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dt->getdetail as $show)
                                                    <tr>
                                                        <td>{{ $show->cabangs->Kode_Cabang }}</td>
                                                        <td>{{ $show->cabangs->Alamat }}</td>
                                                        <td>{{ $show->cabangs->Latitude }}</td>
                                                        <td>{{ $show->cabangs->Longitude }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-header">
                        <h2> Euclidean Distance </h2>
                    </div>
                    <div class="card">
                        <?php
// $origin = [-7.013085699999999, 107.6455816];
// $cabang1 = [-6.2447368, 107.0893353];
// $cabang2 = [-6.2320719, 106.962546];
// $cabang3 = [-6.2402719, 106.9698461];

$cabang = [
        [
            'lat' => -6.2320719,
            'long' => 107.962546,
        ],
        [
            'lat' => -6.2447368,
            'long' => 107.0893353,
        ],
        [
            'lat' => -6.2402719,
            'long' => 107.9698461,
        ]
    ];

    $latAsal = -7.013085699999999;
    $lonAsal = 107.6455816;

    for ($i=0; $i < count($cabang); $i++) { 

        $latTujuan = $cabang[$i]['lat'];
        $lonTujuan = $cabang[$i]['long'];

        $calcLatAsalTujuan = $latTujuan - $latAsal;
        $calcLonAsalTujuan = $lonTujuan - $lonAsal;

        $calc = (sqrt(pow($calcLatAsalTujuan, 2) + pow($calcLonAsalTujuan, 2))) * 111.319;

        print('Latitude ' . $i . ' : ' . $cabang[$i]['lat']);
        print("</br>");
        print('Longitude ' . $i . ' : ' . $cabang[$i]['long']);
        print("</br>");
        print('Hasil Perhitungan ' . $calc);
        print("</br>");
        print("</br>");
    }
?>
                    </div>
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
                a = document.getElementById('origin').value;
                b = document.getElementById('destination').value;
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            };
            document.getElementById('inputbtn').addEventListener('click', onChangeHandler);;
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            directionsService.route({
                origin: document.getElementById('origin').value,
                destination: document.getElementById('destination1').value,
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
