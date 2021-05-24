@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')

    <h1>Dashboard</h1>
@stop

@section('content')
    <!--The div element for the map -->
    <div id="map"></div>

    <div class="card-body">
        <table id="tableTransaction" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>tujuan</th>
                    <th>Jarak</th>
                    <th>Estimasi Waktu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $koordinat)
                    <tr>
                        <td>{{ $koordinat['id'] }}</td>
                        <td>{{ $koordinat['nama_koordinat'] }}</td>
                        <td>{{ $koordinat['lat'] }}</td>
                        <td>{{ $koordinat['long'] }}</td>
                        <td>
                            <a type="button" class="btn btn-warning"
                                href="{{ route('maps.show', $koordinat->id) }}">Show</a>
                            <form method="POST" action="{{ route('maps.destroy', $koordinat->id) }}"
                                class="pull-left">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button class="btn btn-danger"
                                    onclick="return confirm('Data ingin dihapus?')">HAPUS
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tbody class="barang-ajax">
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary btn-lg btn-block">submit</button>

</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 600px;
            /* The height is 400 pixels */
            width: 1400px;
            /* The width is 600 pixels */
        }

    </style>
    {{-- <script>
        // Initialize and add the map
        let map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 6,
                center: {
                    lat: 41,
                    lng: -86
                }
            });

            const cities = [{
                    lat: -6.1291,
                    lng: 106.8334
                }, // ancol
                {
                    lat: -6.098726,
                    lng: 105.881699
                }, // anyer
                {
                    lat: -6.360768,
                    lng: 106.831724
                }, // ui
                {
                    lat: -6.598005,
                    lng: 106.797467
                }, // istana bogor
                {
                    lat: -6.246694,
                    lng: 106.991138
                } // bekasi
            ];

            // Loop through cities, adding markers
            for (let i = 0; i < cities.length; i++) {
                let position = cities[i]; // location of one city
                // create marker for a city
                let mk = new google.maps.Marker({
                    position: position,
                    map: map
                });
            }

            const service = new google.maps.DistanceMatrixService(); // instantiate Distance Matrix service
            const matrixOptions = {
                origins: ["-6.1291,106.8334", "-6.360768,106.831724",
                    "-6.598005,106.797467", "-6.098726,105.881699"
                ], // technician locations
                destinations: ["cyber park, bekasi"], // customer address
                travelMode: 'DRIVING',
                unitSystem: google.maps.UnitSystem.IMPERIAL
            };
            // Call Distance Matrix service
            service.getDistanceMatrix(matrixOptions, callback);

            // Callback function used to process Distance Matrix response
            function callback(response, status) {
                if (status !== "OK") {
                    alert("Error with distance matrix");
                    return;
                }
                console.log(response);
            }
        }

    </script> --}}
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt_cq6yHgOOa8aUgC5_owypFYl32wSWjk&callback=initMap">
    </script>

@stop

@section('js')

    <script type="text/javascript">
        $(document).ready(function() {
            //select getbarang
            $("select[name='cari_produk']").change(function(e) {
                e.preventDefault();
                var kode = $(this).val();
                var url = "{{ url('transaction/ajax') }}" + '/' + kode;
                var _this = $(this);

                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    url: url,
                    success: function(data) {
                        console.log(data);
                        _this.val('');

                        var nilai = '';
                        nilai += '<tr>';

                        nilai += '<td>';
                        nilai += data.data.kd_brg;
                        nilai +=
                            '<input type="hidden" class="form-control" name="barang[]" value="' +
                            data.data.id + '">';
                        nilai += '</td>';
                        nilai += '<td>';
                        nilai += data.data.nama_barang;
                        nilai += '</td>';
                        nilai += '<td>';
                        nilai += data.data.kategori;
                        nilai += '</td>';
                        nilai += '<td>';
                        nilai += data.data.sub_golongan;
                        nilai += '</td>';
                        nilai += '<td>';
                        nilai +=
                            '<input type="number" class="form-control" name="qty[]" value="1">';
                        nilai += '</td>';

                        nilai += '<td>';
                        nilai +=
                            '<button class="btn btn-xs btn-danger hapus"><i class="fa fa-trash"></i></button>';
                        nilai += '</td>';

                        nilai += '</tr>';

                        $('.barang-ajax').append(nilai);
                    }
                })
            })
        })

    </script>
@stop
