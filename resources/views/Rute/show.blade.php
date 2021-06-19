@extends('adminlte::page')

@section('title', 'Pembelian Barang')
@section('content_header')
    <div class="card-header">
        <h3>DATA INVOICE</h3>
    </div><br>
@stop
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i>
                        Refresh</button>
                    <a href="{{route('rute.index')}}" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-backward"></i>
                        Back</a>
                        {{-- <a target="blank" href="{{url('transaction/pdf/'.$dt->id)}}" class="btn btn-sm btn-flat btn-success"><i class="fa fa-download"></i>
                            Print</a> --}}
                    {{-- <a target="blank" href="{{url('transaction/export/'.$dt->id)}}" class="btn btn-sm btn-flat btn-success"><i class="fa fa-download"></i>
                        Print</a> --}}
                </p>
            </div>
            <div class="box-body">
                <div class="col-12">
                    <div class="card">
                        <div class="form-group">
                            <div class="col-md-4">
                                <div class="card-body">
                                    <i class="far fa-calendar-alt"></i>
                                    <label for="exampleInputEmail1">KELOMPOK</label>
                                    <input type="text" readonly class="form-control float-right" name="kelompok" value="{{$dt->Kelompok}}">
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
                                            <td>{{$show->cabangs->Kode_Cabang}}</td>
                                            <td>{{$show->cabangs->Alamat}}</td>
                                            <td>{{$show->cabangs->Latitude}}</td>
                                            <td>{{$show->cabangs->Longitude}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <div class="row">
    <div class="box-body">
        <h3>Google Maps</h3>
        <!--The div element for the map -->
        <div id="map"></div>
    </div>
 </div>
@endsection
 
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

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous"></script>
    @if (Session::has('success'))
        <script>
            swal("Berhasil!", "{!!  Session::get('success') !!}", "success", {
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