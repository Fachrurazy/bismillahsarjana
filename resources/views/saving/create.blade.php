@extends('adminlte::page')

@section('title', 'PEMBELIAN')

@section('content_header')
    <h1>TRANSAKSI PEMBELIAN</h1>
@stop

@section('content')
    <div class="box-header">
        <p>
            <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i>
                Refresh</button>
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
                                        <label for="exampleInputEmail1">Input Kode Barang</label>
                                        <input type="text" class="form-control" autocomplete="off" name="kode_barang"
                                            id="kode_barang">
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                        <div class="col-md-5">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cari Barang</label>
                                    <select class="form-control select2 cari" name="cari_produk">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <form method="POST" action="{{ route('saving.store') }}">
                        {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-4">
                            <div class="card-body">
                                <i class="far fa-calendar-alt"></i>
                                <label for="exampleInputEmail1">Tanggal</label>
                                <input type="date" class="form-control float-right" name="tanggal">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                            <table id="tableTransaction" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>kode barang</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Sub Golongan</th>
                                        <th>QTY</th>
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

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $("input[name='kode_barang']").focus();

            //input kode barang
            $("input[name='kode_barang']").keypress(function(e) {
                if (e.which == 13) {
                    e.preventDefault();
                    var kd_brg = $(this).val();
                    var url = "{{ url('transaction/ajax') }}" + '/' + kd_brg;
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
                }
            })

            //getbarang
            $('.cari').select2({
                placeholder: 'Cari Barang...',
                ajax: {
                    url: "{{ url('transaction/getbarang/ajax') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nama_barang,
                                    id: item.kd_brg
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

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
