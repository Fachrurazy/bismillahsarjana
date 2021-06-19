@extends('adminlte::page')

@section('title', 'DATA CABANG')
@section('content_header')
    <div class="card-header">
        <h3>DATA CABANG</h3>
    </div><br>
    <div class="row">
        <div class="col-md-2">
            <a class="btn btn-block btn-success" href="{{ route('cabang.createjarak') }}"><b>+</b> CREATE CABANG</a>
        </div>
    </div>
@stop
@section('content')
<div class="modal fade" id="modal-edit" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-warning">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('cabang.update', 'id') }}">
                {{ csrf_field() }}
                {{ method_field('put') }}
                <div class="modal-body">
                    <div class="card-body">
                        <style>
                            .modal { z-index: 1001 !important;} 
                            .modal-backdrop {z-index: 1000 !important;}
                            .pac-container {z-index: 1055 !important;}
                        </style>
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="exampleInput">Nama Cabang</label>
                            <input type="text" class="form-control" id="nama_cabang" name="Nama_Cabang"
                                placeholder="Masukan Nama Cabang">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Nama Pemilik</label>
                            <input type="text" class="form-control" id="pemilik" name="Pemilik"
                                placeholder="Masukan Nama Pemilik">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="Telepon"
                                placeholder="Masukan Telepon">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="Alamat"
                                placeholder="Masukan Lokasi" autocomplete="on" runat="server" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="Latitude" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="Longitude" readonly>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit" class="btn btn-outline-light">Simpan Perubahan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<section class="content">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="datakoordinat" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    {{-- <th>ID</th> --}}
                                    <th>Kode Cabang</th>
                                    <th>Nama Cabang</th>
                                    <th>Pemilik</th>
                                    <th>Telepon</th>
                                    <th>Alamat</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $cabang)
                                    <tr>
                                        {{-- <td>{{ $cabang['id'] }}</td> --}}
                                        <td>{{ $cabang['Kode_Cabang'] }}</td>
                                        <td>{{ $cabang['Nama_Cabang'] }}</td>
                                        <td>{{ $cabang['Pemilik'] }}</td>
                                        <td>{{ $cabang['Telepon'] }}</td>
                                        <td>{{ $cabang['Alamat'] }}</td>
                                        <td>{{ $cabang['Latitude'] }}</td>
                                        <td>{{ $cabang['Longitude'] }}</td>
                                        <td>
                                            <a data-id="{{ $cabang['id'] }}" data-Nama_Cabang="{{ $cabang['Nama_Cabang'] }}"
                                                    data-pemilik="{{ $cabang['Pemilik'] }}"
                                                    data-telepon="{{ $cabang['Telepon'] }}"
                                                    data-alamat="{{ $cabang['Alamat'] }}"
                                                    data-latitude="{{ $cabang['Latitude'] }}"
                                                    data-longitude="{{ $cabang['Longitude'] }}" type="button" class="btn btn-warning"
                                                    data-toggle="modal" data-target="#modal-edit">EDIT</a>
                                            <form method="POST" action="{{ route('cabang.destroy', $cabang->Kode_Cabang) }}"
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
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
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
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt_cq6yHgOOa8aUgC5_owypFYl32wSWjk&libraries=places&language=id"
        defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
                document.getElementById('latitude').value = near_place.geometry.location.lat();
                document.getElementById('longitude').value = near_place.geometry.location.lng();
                
            });
    
        });
    </script>
@stop
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
<script>
    $(function() {
        $("#datakoordinat").DataTable({})
    });

</script>
<script>
    $('#modal-edit').on('show.bs.modal', function(event) {

        var button = $(event.relatedTarget)
        var id = button.data('id')
        var nama_cabang = button.data('nama_cabang')
        var pemilik = button.data('pemilik')
        var telepon = button.data('telepon')
        var alamat = button.data('alamat')
        var latitude = button.data('latitude')
        var longitude = button.data('longitude')

        var modal = $(this)
        modal.find('.modal-title').text('EDIT DATA BARANG');
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #nama_cabang').val(nama_cabang);
        modal.find('.modal-body #pemilik').val(pemilik);
        modal.find('.modal-body #telepon').val(telepon);
        modal.find('.modal-body #alamat').val(alamat);
        modal.find('.modal-body #latitude').val(latitude);
        modal.find('.modal-body #longitude').val(longitude);
    });

</script>
@stop
