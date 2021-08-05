@extends('adminlte::page')

@section('title', 'CREATE RUTE')

@section('content_header')
    <h1>PENENTUAN RUTE</h1>
@stop

@section('content')
<!-- Modals Create -->
<div class="modal fade" id="modal-create" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h4 class="modal-title">SAVING LIST</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="datakoordinat" class="table table-bordered table-striped tablesaving" style="color:black;">
                                    <thead>
                                        <tr>
                                            {{-- <th>Select</th> --}}
                                            <th>ID</th>
                                            <th>Asal</th>
                                            <th>Tujuan</th>
                                            <th>Nilai Saving</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $saving)
                                            <tr>
                                                <td>{{ $saving->id }}</td>
                                                <td>{{ $saving->Nama_Origin }}</td>
                                                <td>{{ $saving->Nama_Destination }}</td>
                                                <td>{{ $saving->Saving }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- <input type="button" value="select" class="select"> --}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.End modal Create -->
    <div class="box-header">
        <p>
            <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i>
                Refresh</button>
                <a href="{{route('rute.index')}}" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-backward"></i>
                    Back</a>
        </p>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-10">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <form role="form">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Masukan Nama Cabang</label>
                                        <input type="text" class="form-control" autocomplete="off" name="kode_barang"
                                            id="kode_barang">
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                        <div class="col-md-3">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nilai Penghematan</label><br>
                                    <button class="btn btn-sm btn-flat btn-success" data-toggle="modal" data-target="#modal-create">CARI</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <form method="POST" action="{{ route('rute.store') }}">
                        {{ csrf_field() }}
                    <div class="card-body">
                            <table id="tableTransaction" class="table table-bordered table-striped tablekelompok">
                                <thead>
                                    <tr>
                                        <th>Kode Cabang</th>
                                        <th>Nama Cabang</th>
                                        <th>Alamat</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody class="barang-ajax">
                                    
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt_cq6yHgOOa8aUgC5_owypFYl32wSWjk&libraries=places&language=id"
        defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(function(){
            $(document).on("click", ".select", function(){
                var getselectedvalues=$(".tablesaving input:checked").parents("tr").clone().appendTo($(".tablekelompok tbody").add())
            })
        })
    </script>
@stop
@section('js')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous"></script>
        
    <script type="text/javascript">
        $(document).ready(function() {

            $("input[name='kode_Cabang']").focus();

            //input kode barang
            $("input[name='kode_barang']").keypress(function(e) {
                if (e.which == 13) {
                    e.preventDefault();
                    var Kode_Cabang = $(this).val();
                    var url = "{{ url('rute/ajax') }}" + '/' + Kode_Cabang;
                    var _this = $(this);

                    $.ajax({
                        type: 'get',
                        dataType: 'json',
                        url: url,
                        success: function(data) {
                            console.log(data);
                            _this.val('');

                            // cart
                            var nilai = '';
                            nilai += '<tr>';

                            nilai += '<td>';
                            nilai += data.data.Kode_Cabang;
                            nilai +=
                                '<input type="hidden" class="form-control" name="cabang[]" value="' +
                                data.data.id + '">';
                            nilai += '</td>';
                            nilai += '<td>';
                            nilai += data.data.Nama_Cabang;
                            nilai += '</td>';
                            nilai += '<td>';
                            nilai += data.data.Alamat;
                            nilai += '</td>';
                            nilai += '<td>';
                            nilai += data.data.Latitude;
                            nilai += '</td>';
                            nilai += '<td>';
                            nilai += data.data.Longitude;
                            nilai += '</td>';
                            nilai += '<td>';
                            nilai +=
                                '<button class="btn btn-xs btn-danger hapus"><i class="fa fa-trash"></i></button>';
                            nilai += '</td>';

                            nilai += '</tr>';

                            $('.barang-ajax').append(nilai);
                        }
                    })
                }
            })

            //button delete
            $('body').on('click', '.hapus', function(e) {
                e.preventDefault();
                $(this).closest('tr').remove();
            })

            // btn refresh
            $('.btn-refresh').click(function(e) {
                e.preventDefault();
                $('.preloader').fadeIn();
                location.reload();
            })

        })

    </script>
    <script>
        $(function() {
            $("#datakoordinat").DataTable({})
        });
    
    </script>

    @if (Session::has('success'))
        <script type="text/javascript">
            Swal.fire({
                type: 'success',
                text: '{{ Session::get('
                success ') }}',
                showConfirmButton: false,
                timer: 1500
            });

        </script>
        <?php Session::forget('success'); ?>
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
@endsection
