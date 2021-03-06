@extends('adminlte::page')

@section('title', 'CREATE DISTANCE MATRIX')
@section('content_header')
    <div class="card-header">
        <h3>Tambah Distance Matrix</h3>
    </div><br>
@stop
@section('content')
    <section class="content">
        <div class="box-header">
            <p>
                <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i>
                    Refresh</button>
                    <a href="{{route('distancematrix.index')}}" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-backward"></i>
                        Back</a>
            </p>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="http://127.0.0.1:8000/api/distance" method="post">
                        {{ csrf_field() }}
                        {{-- <div class="container"> --}}
                            <div class="row">
                                <div class="col-sm">
                                    <div class="card-body"><a><b>Kode Origin</b></a><br>
                                        <select name="Kode_Origin" id="Kode_Origin" required>
                                            <option>Pilih Origin</option>
                                            @foreach ($datas as $item)
                                                <option value="{{ $item->id }}">{{ $item->Kode_Cabang }} -
                                                    {{ $item->Nama_Cabang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="card-body"><a><b>ID Cabang</b></a><br>
                                        <input type="text" name="ID1" id="ID1" value="" readonly required>
                                        @if ($errors->has('ID1'))
                                        <span class="text-danger">{{ $errors->first('ID1') }}</span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="card-body"><a><b>Alamat</b></a><br>
                                        <input type="text" name="origin" id="origin" value="" readonly required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="card-body"><a><b>Latitude</b></a><br>
                                        <input type="text" name="lat1" id="lat1" value="" readonly required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="card-body"><a><b>Longitude</b></a><br>
                                        <input type="text" name="long1" id="long1" value="" readonly required>
                                    </div>
                                </div>
                            </div>
                        {{-- </div> --}}
                        <div class="row">
                            <div class="col-sm">
                                <div class="card-body"><a><b>Kode Destination</b></a><br>
                                    <select name="Kode_Destination" id="Kode_Destination" required>
                                        <option>Pilih Destination</option>
                                        @foreach ($datas as $item)
                                            <option value="{{ $item->id }}">{{ $item->Kode_Cabang }} -
                                                {{ $item->Nama_Cabang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="card-body"><a><b>ID Cabang</b></a><br>
                                    <input type="text" name="ID2" id="ID2" readonly required>
                                    @if ($errors->has('ID2'))
                                        <span class="text-danger">{{ $errors->first('ID2') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="card-body"><a><b>Alamat</b></a><br>
                                    <input type="text" name="destination" id="destination" readonly required>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="card-body"><a><b>Latitude</b></a><br>
                                    <input type="text" name="lat2" id="lat2" readonly required>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="card-body"><a><b>Longitude</b></a><br>
                                    <input type="text" name="long2" id="long2" readonly required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="card-body">
                                    <button style="btn-success" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
@stop
@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
    
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous"></script>
        <script>
            var onChangeHandler1 = function() {
                var id = document.getElementById('Kode_Origin').value;
                var url = "{{ url('distancematrix/ajax')}}" + '/' + id;
                console.log(id);
                var _this = $
                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    url:url,
                    success: function(data){
                        document.getElementById('ID1').value = data.data.id;
                        document.getElementById('origin').value = data.data.Alamat;
                        document.getElementById('lat1').value = data.data.Latitude;
                        document.getElementById('long1').value = data.data.Longitude;
                    }
                })
            }
            var onChangeHandler2 = function() {
                var id = document.getElementById('Kode_Destination').value;
                var url = "{{ url('distancematrix/ajax')}}" + '/' + id;
                console.log(id);
                var _this = $
                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    url:url,
                    success: function(data){
                        document.getElementById('ID2').value = data.data.id;
                        document.getElementById('destination').value = data.data.Alamat;
                        document.getElementById('lat2').value = data.data.Latitude;
                        document.getElementById('long2').value = data.data.Longitude;
                    }
                })
            }
            document.getElementById('Kode_Origin').addEventListener('change',onChangeHandler1);
            document.getElementById('Kode_Destination').addEventListener('change',onChangeHandler2);
        </script>
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
