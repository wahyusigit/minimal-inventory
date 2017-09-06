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
                    <div class="box-body">
                        <button type="button" class="btn btn-default btn-block btn-flat">Cetak Laporan</button>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                        Lihat Laporan
                    </div>
                    <div class="box-body">
                    <form action="{{ route('indexShowLaporanPenjualan') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Pilih Bulan</label>
                            <input type="month" name="bulan" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-default btn-block btn-flat">Lihat Laporan</button>
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">Laporan Penjualan Bulan <strong>{{ $bulan }}</strong></div>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penjualans as $no => $penjualan )
                                <tr id="{{ $no }}">
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ date_format(date_create($penjualan->tanggal_penjualan),'d/m/Y') }}</td>
                                    <td class="text-capitalize">{{ $penjualan->nama_konsumen }}</td>
                                    <td class="text-capitalize">{{ $penjualan->paketan }}</td>
                                    <td class="text-right number">{{ $penjualan->harga_paketan }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3"></td>
                                    <th>Total Penjualan</th>
                                    <th class="text-right number">{{$total}}</th>
                                </tr>
                            </tbody>
                        </table>
                        {{-- <div class="pull-right">{{ $penjualans->links() }}</div> --}}
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
