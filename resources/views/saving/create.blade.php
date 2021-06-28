@extends('adminlte::page')

@section('title', 'DATA SAVING MATRIX')
@section('content_header')
    <div class="card-header">
        <h1>Tambah Saving Matrix</h1><br>
        <h3>Rumus Saving Matrix:</h3> 
        <p><h4>Sij = Doi + Doj - Dij</h4></p>
        <p><h6>Sij = jarak titik awal dan tujuan<br>
            Doi = jarak depot ke tujuan awal<br>
            Doj = jarak depot ke tujuan akhir</h6>

    </div><br>
@stop
@section('content')
    <section class="content">
        <div class="box-header">
            <p>
                <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i>
                    Refresh</button>
                <a href="{{route('saving.index')}}" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-backward"></i>
                    Back</a>
            </p>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{route('saving.store')}}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                                <div class="col-sm">
                                    <div class="card-body"><a><b>Rincian Depot ke Destinasi 1</b></a><br>
                                        <select name="doi" id="doi">
                                            @foreach ($datas as $item)
                                                <option value="{{ $item->id }}">{{ $item->id }} -
                                                    ({{ $item->Kode_Origin }} - {{ $item->Kode_Destination }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="card-body"><a><b>Kode Cabang 1</b></a><br>
                                        <input type="text" name="origin1" id="origin1" value="" readonly required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="card-body"><a><b>Kode Cabang 2</b></a><br>
                                        <input type="text" name="destination1" id="destination1" value="" readonly required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="card-body"><a><b>Distance</b></a><br>
                                        <input type="text" name="distance1" id="distance1" value="" readonly required>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="card-body"><a><b>Rincian Depot ke Destinasi 2</b></a><br>
                                    <select name="doj" id="doj">
                                        @foreach ($datas as $item)
                                        <option value="{{ $item->id }}">{{ $item->id }} -
                                            ({{ $item->Kode_Origin }} - {{ $item->Kode_Destination }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="card-body"><a><b>Kode Cabang 1</b></a><br>
                                    <input type="text" name="origin2" id="origin2" readonly required>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="card-body"><a><b>Kode Cabang 2</b></a><br>
                                    <input type="text" name="destination2" id="destination2" readonly required>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="card-body"><a><b>Distance</b></a><br>
                                    <input type="text" name="distance2" id="distance2" readonly required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="card-body"><a><b>Rincian Destinasi 1 ke Destinasi 2</b></a><br>
                                    <select name="dij" id="dij">
                                        @foreach ($datas as $item)
                                        <option value="{{ $item->id }}">{{ $item->id }} -
                                            ({{ $item->Kode_Origin }} - {{ $item->Kode_Destination }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="card-body"><a><b>Kode Cabang 1</b></a><br>
                                    <input type="text" name="origin3" id="origin3" readonly required>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="card-body"><a><b>Kode Cabang 2</b></a><br>
                                    <input type="text" name="destination3" id="destination3" readonly required>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="card-body"><a><b>Distance</b></a><br>
                                    <input type="text" name="distance3" id="distance3" readonly required>
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
    
@stop
@section('js')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous"></script>
        <script>
            var onChangeHandler1 = function() {
                var id = document.getElementById('doi').value;
                var url = "{{ url('saving/ajax')}}" + '/' + id;
                // console.log(id);
                var _this = $
                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    url:url,
                    success: function(data){
                        document.getElementById('origin1').value = data.data.Kode_Origin;
                        document.getElementById('destination1').value = data.data.Kode_Destination;
                        document.getElementById('distance1').value = data.data.Distance;
                    }
                })
            }
            var onChangeHandler2 = function() {
                var id = document.getElementById('doj').value;
                var url = "{{ url('saving/ajax')}}" + '/' + id;
                console.log(id);
                var _this = $
                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    url:url,
                    success: function(data){
                        document.getElementById('origin2').value = data.data.Kode_Origin;
                        document.getElementById('destination2').value = data.data.Kode_Destination;
                        document.getElementById('distance2').value = data.data.Distance;
                    }
                })
            }
            var onChangeHandler3 = function() {
                var id = document.getElementById('dij').value;
                var url = "{{ url('saving/ajax')}}" + '/' + id;
                console.log(id);
                var _this = $
                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    url:url,
                    success: function(data){
                        document.getElementById('origin3').value = data.data.Kode_Origin;
                        document.getElementById('destination3').value = data.data.Kode_Destination;
                        document.getElementById('distance3').value = data.data.Distance;
                    }
                })
            }
            document.getElementById('doi').addEventListener('change',onChangeHandler1);
            document.getElementById('doj').addEventListener('change',onChangeHandler2);
            document.getElementById('dij').addEventListener('change',onChangeHandler3);
        </script>
    @if (Session::has('success'))
        <script>
            swal("Berhasil!", "{!! Session::get('success') !!}", "success", {
                button: "OK",
            })

        </script>

    @endif
    <script>

        $('.btn-refresh').click(function(e) {
                e.preventDefault();
                $('.preloader').fadeIn();
                location.reload();
            })

    </script>

@stop
