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
            <div class="col-md-4 hidden-print">
                <div class="box">
                    <div class="box-body">
                        <button onclick="cetak()" type="button" class="btn btn-default btn-block btn-flat">Cetak Laporan</button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">Stok Barang - {{ date("d/m/Y") }}</div>
                    <div class="box-body">
                        @if($barangs->isEmpty())
                        <div class="h4 text-center">Tidak Ada Data</div>
                        @else
                        <table id="barang" class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th class="col-md-1">No</th>
                                    <th>Nama Barang</th>
                                    <th class="text-center col-md-1">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($barangs as $no => $barang )
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td class="text-center">{{ $barang->stok_akhir }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                    <div class="box-footer">
                        {{-- <div class="pull-right">{{ $barangs->links() }}</div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script type="text/javascript">
    function cetak() {
         // var printContents = document.getElementById('barang').innerHTML;
         // var originalContents = document.body.innerHTML;

         // document.body.innerHTML = printContents;

         window.print();

         // document.body.innerHTML = originalContents;
    }
</script>
@endpush