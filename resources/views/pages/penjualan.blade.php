@extends('layouts.default')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')

    <div class="container-fluid spark-screen">
        @if (session()->has('flash_notification.message'))
            <div class="alert alert-{{ session('flash_notification.level') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                <strong>{!! session('flash_notification.message') !!}</strong>
            </div>
        @endif
        <div class="row">

            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">Tambah Transaksi</div>
                    <div class="box-body">
                        <form action="{{ route('addPenjualan') }}" method="POST" role="form">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal_penjualan" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Konsumen</label>
                                <input type="text" class="form-control text-capitalize" name="nama_konsumen" required>
                            </div>
                            <div class="form-group">
                                <label for="">Paketan</label>
                                <input type="text" class="form-control text-capitalize" name="paketan" required>
                            </div>
                            <div class="form-group">
                                <label for="">Harga</label>
                                <input type="text" class="form-control input_number" name="harga_paketan" required>
                            </div>
                            <button type="submit" id="submit_tambah_transaksi" class="btn btn-primary pull-right btn-flat">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">Transaksi Penjualan</div>
                    <div class="box-body">
                        @if($penjualans->isEmpty())
                        <div class="h4 text-center">Tidak Ada Data</div>
                        @else
                        <table id="penjualan" class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Konsumen</th>
                                    <th>Paketan</th>
                                    <th class="text-centert">Harga</th>
                                    <th class="text-center col-md-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penjualans as $no => $penjualan )
                                <tr id="{{ $no }}">
                                    <td>{{ (($penjualans->currentPage() - 1 ) * $penjualans->perPage() ) + $no + 1 }}</td>
                                    <td>{{ date_format(date_create($penjualan->tanggal_penjualan),'d/m/Y') }}</td>
                                    <td class="text-capitalize">{{ $penjualan->nama_konsumen }}</td>
                                    <td class="text-capitalize">{{ $penjualan->paketan }}</td>
                                    <td class="text-right number">{{ $penjualan->harga_paketan }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('editPenjualan', $penjualan->id) }}" class="btn btn-default btn-flat btn-sm">Edit</a>
                                            <a href="{{ route('deletePenjualan', $penjualan->id) }}" class="btn btn-default btn-flat btn-sm">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right">{{ $penjualans->links() }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('css')
<style type="text/css">
    .modal-backdrop {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: -1;
        background-color: #000;
    }
</style>
@endpush
@push('script')
<script type="text/javascript" src="{{ asset('plugins/autoNumeric/autoNumeric.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.4/numeral.min.js"></script>
{{-- Untuk Number Separator --}}
<script type="text/javascript">
    // $('body').on('focus change blur keyup','.number',function(){
        $('.input_number').autoNumeric("init", { aSep: '.', aDec: ',', vMin: '0', vMax: '99999999'});
        $('.number').autoNumeric("init", { aSep: '.', aDec: ',', vMin: '0', vMax: '99999999'});
        $('#submit_tambah_transaksi').click(function(){
            val = $('.input_number').autoNumeric('get');
            $('.input_number').val(val);
        });
    // });    
</script>
{{-- <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('body').on('click','.edit', function(){
        id = this.value;
        id_barang = $(this).attr('id');
        var table = $("#barang tbody")[0];
        var row = table.rows[id]; 
        $('#myModal').modal('show');
        $('#id_barang').val(id_barang);
        $('#nama_barang').val($(row.cells[1]).text());
        $('#stok_akhir').val($(row.cells[2]).text());
    });
    $('body').on('click','.delete_barang',function(){
        var id = this.value;
        $('#konfirmasi_hapus_barang').modal('show');
        $('#btn_konfirmasi_hapus_barang').click(function(){
            $.ajax({
                url : '{{route('deleteBarang')}}',
                type : 'POST',
                data : {'id':id},
                success : function (response){
                    if (response == 'success') {
                        location.reload();
                    }
                }
            });
        });
    });
</script> --}}
@endpush