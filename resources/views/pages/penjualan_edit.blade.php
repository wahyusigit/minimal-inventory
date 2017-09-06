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
            <div class="col-md-4 col-md-offset-4">
                <div class="box">
                    <div class="box-header with-border">Edit Transaksi</div>
                    <div class="box-body">
                        <form action="{{ route('updatePenjualan') }}" method="POST" role="form">
                        {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $penjualan->id }}">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal_penjualan" value="{{ $penjualan -> tanggal_penjualan}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Konsumen</label>
                                <input type="text" class="form-control text-capitalize" name="nama_konsumen" value="{{ $penjualan -> nama_konsumen }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Paketan</label>
                                <input type="text" class="form-control text-capitalize" name="paketan" value="{{ $penjualan -> paketan}}"required>
                            </div>
                            <div class="form-group">
                                <label for="">Harga</label>
                                <input type="text" class="form-control input_number" name="harga_paketan"value="{{ $penjualan -> harga_paketan}}" required>
                            </div>
                            <button type="submit" id="submit_tambah_transaksi" class="btn btn-primary pull-right btn-flat">Simpan</button>
                        </form>
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