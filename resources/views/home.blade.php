@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-database"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Cabang</span>
                        <span class="info-box-number">
                            <small>=</small>
                            {{ $cbg }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-rocket"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Dijkstra</span>
                        {{-- <span class="info-box-number">{{ $dm }}</span> --}}
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-save"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Saving Matrix</span>
                        <span class="info-box-number">{{ $svg }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-truck"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Rute</span>
                        <span class="info-box-number">{{ $rute }}</span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
    </div>
    <div class="row">
        <!-- DRIVER -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Cabang</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Cabang</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cabang as $i => $c)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $c['Nama_Cabang'] }}</td>
                                        <td><span class="badge badge-warning">{{$c['Latitude']}}</span></td>
                                        <td><span class="badge badge-danger">{{$c['Longitude']}}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                {{-- <div class="card-footer clearfix">
                    <a href="{{ route('cabang.create') }}" class="btn btn-sm btn-primary float-left">Tambah Cabang</a>
                </div> --}}
                <!-- /.card-footer -->
            </div>
        </div>

        <!-- KENEK -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Rute</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kelompok</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rutedetail as $i => $rd)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $rd['Kelompok'] }}</td>
                                        <td><a type="button" class="btn btn-warning" href="{{route('rute.show', $rd->id)}}">Show</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                {{-- <div class="card-footer clearfix">
                    <a href="{{ route('driver.index') }}" class="btn btn-sm btn-primary float-left">Tambah Driver</a>
                </div> --}}
                <!-- /.card-footer -->
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Latest Order -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Latest Orders</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice</th>
                                    <th>Tanggal</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($inv as $i => $invoice)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td><a
                                                href="{{ route('transaction.show', $invoice->id) }}">{{ $invoice['invoice'] }}</a>
                                        </td>
                                        <td><span class="badge badge-success">{{ $invoice['tanggal'] }}</span></td>
                                        <td><span class="badge badge-warning">{{ $invoice['created_at'] }}</span></td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                {{-- <div class="card-footer clearfix">
                    <a href="{{ route('transaction.index') }}" class="btn btn-sm btn-primary float-left">Pembelian</a>
                    <a href="{{ route('transactionout.index') }}"
                        class="btn btn-sm btn-danger float-right">Penjualan</a>
                </div> --}}
                <!-- /.card-footer -->
            </div>
        </div>

        <!-- PRODUK -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Products</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Sub Golongan</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($barang as $barangs)
                                <tr>
                                    <td>{{ $barangs['kd_brg'] }}</td>
                                    <td>{{ $barangs['nama_barang'] }}</td>
                                    <td>{{ $barangs['sub_golongan'] }}</td>
                                    <td>{{ $barangs['qty'] }}</td>
                                </tr> --}}
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!'); 
</script>
@stop