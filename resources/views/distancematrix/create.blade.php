@extends('adminlte::page')

@section('title', 'DATA SAVING MATRIX')
@section('content_header')
    <div class="card-header">
        <h3>Distance Matrix</h3>
    </div><br>
@stop
@section('content')
    <section class="content">
        <section class="content">
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="row">
                            <form action="{{ route('distancematrix.store') }}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <div class="card-body">
                                            <select name="Kode_Origin" id="Kode_Origin">
                                                @foreach ($datas as $item)
                                                    <option value="{{ $item->Kode_Cabang }}">{{ $item->Kode_Cabang }} -
                                                        {{ $item->Nama_Cabang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <div class="card-body">
                                            <select name="Kode_Destination" id="Kode_Destination">
                                                @foreach ($datas as $item)
                                                    <option value="{{ $item->Kode_Cabang }}">{{ $item->Kode_Cabang }} -
                                                        {{ $item->Nama_Cabang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <div class="card-body">
                                            <label>Distance</label><br>
                                            <input type="text" name="Distance" id="Distance" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-body">
                                    <button type="submit">Simpan</button>
                                    </div>
                                    </div>
                                </div>
                                

                            </form>
                        </div>
                    </div>
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
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt_cq6yHgOOa8aUgC5_owypFYl32wSWjk&callback=initMap&libraries=places&language=id"
        defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
    <script>
        $(function() {
            $("#datakoordinat").DataTable({})
        });

    </script>

@stop
