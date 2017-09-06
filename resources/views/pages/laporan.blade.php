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
                    <div class="box-header with-border">Laporan Bulan: </div>
                    <div class="box-body">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">Stok Barang</div>
                    <div class="box-body">
                        @if($barangs->isEmpty())
                        <div class="h4 text-center">Tidak Ada Data</div>
                        @else
                        <table id="barang" class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center col-md-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($barangs as $no => $barang )
                                <tr id="{{ $no }}">
                                    <td>{{ (($barangs->currentPage() - 1 ) * $barangs->perPage() ) + $no + 1 }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td class="text-center">{{ $barang->stok_akhir }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button id="{{$barang->id}}" value="{{$no}}" type="button" class="btn btn-default btn-flat btn-sm edit">Edit</button>
                                            <button value="{{ $barang -> id }}" type="button" class="btn btn-default btn-flat btn-sm delete_barang">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pull-left">
                            <button type="button" class="btn btn-default">Lihat Semua</button>
                            <button type="button" class="btn btn-default">Cetak</button>
                        </div>
                        <div class="pull-right">{{ $barangs->links() }}</div>
                        
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
@endpush