@extends('adminlte::page')

@section('title', 'DATA KOORDINAT')
@section('content_header')
    <div class="card-header">
        <h3>ROUTE</h3>
    </div><br>
    {{-- <div class="row">
        <div class="col-md-2">
            <a class="btn btn-block btn-success" href="{{ route('maps.create') }}"><b>+</b> CREATE COORDINATE</a>
        </div>
    </div> --}}
    
@stop
@section('content')
<div class="row">
    <form action="{{route('dijkstra.store')}}" method="POST">
        {{ csrf_field() }}
        <div class="container">
            <div class="row">
              <div class="col-md-4">
                <select name="origin" id="origin" required>
                    <option value="">Pilih Origin</option>
                    @foreach ($cabang as $data)
                    <option value="{{$data->id}}">{{$data->Nama_Cabang}}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <select name="destination1" id="destination1" required>
                    <option value="">Pilih Destination</option>
                    @foreach ($cabang as $data)
                    <option value="{{$data->id}}">{{$data->Nama_Cabang}}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <select name="destination2" id="destination2" required>
                    <option value="">Pilih Destination2</option>
                    @foreach ($cabang as $data)
                    <option value="{{$data->id}}">{{$data->Nama_Cabang}}</option>
                    @endforeach
                </select>
              </div>
            </div>
          </div>
          <button type="submit">Simpan</button>
        {{-- <div class="form-group">
            <div class="col-md-6">
                <select name="origin" id="origin">
                    <option value="">Pilih Origin</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <select name="origin" id="origin">
                <option value="">Pilih Origin</option>
            </select>
        </div> --}}
        
        {{-- <div class="col-md-6">
            <select name="origin" id="origin">
                <option value="">Pilih Origin</option>
            </select>
        </div>
        <div class="col-md-6">
            <select name="origin" id="origin">
                <option value="">Pilih Origin</option>
            </select>
        </div> --}}
    </form>
</div>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="datakoordinat" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Detail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($route as $datas)
                                    <tr>
                                        <td>{{ $datas['name'] }}</td>
                                        <td><a href="{{route('dijkstra.show', $datas->id)}}">Get Detail</a></td>
                                        <td>
                                            
                                            {{-- <a type="button" class="btn btn-warning"
                                                href="{{ route('maps.show', $koordinat->id) }}">Show</a>
                                            <form method="POST" action="{{ route('maps.destroy', $koordinat->id) }}"
                                                class="pull-left">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button class="btn btn-danger"
                                                    onclick="return confirm('Data ingin dihapus?')">HAPUS
                                                </button>
                                            </form> --}}
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
