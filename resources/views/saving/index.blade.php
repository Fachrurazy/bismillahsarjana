@extends('adminlte::page')

@section('title', 'DATA SAVING MATRIX')
@section('content_header')
    <div class="card-header">
        <h3>Saving Matrix</h3>
    </div><br>
    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-block btn-warning" href="{{ route('saving.create') }}"><b>+</b> CREATE SAVING MATRIX</a>
        </div>
    </div>
@stop
@section('content')
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
                                    <th>ID</th>
                                    <th>Kode Origin</th>
                                    <th>Kode Destination</th>
                                    <th>Saving List</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $saving)
                                    <tr>
                                        <td>{{ $saving->id }}</td>
                                        <td>{{ $saving->Kode_Origin }}</td>
                                        <td>{{ $saving->Kode_Destination }}</td>
                                        <td>{{ $saving->Saving }}</td>
                                        <td>
                                            {{-- <a data-id="{{ $saving['id'] }}" data-Nama_saving="{{ $saving['Nama_saving'] }}"
                                                    data-pemilik="{{ $saving['Pemilik'] }}"
                                                    data-telepon="{{ $saving['Telepon'] }}"
                                                    data-alamat="{{ $saving['Alamat'] }}"
                                                    data-latitude="{{ $saving['Latitude'] }}"
                                                    data-longitude="{{ $saving['Longitude'] }}" type="button" class="btn btn-warning"
                                                    data-toggle="modal" data-target="#modal-edit">EDIT</a> --}}
                                            <form method="POST" action="{{ route('saving.destroy', $saving->id) }}"
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
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt_cq6yHgOOa8aUgC5_owypFYl32wSWjk&libraries=places&language=id"
        defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
{{-- <script>
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

</script> --}}
@stop
