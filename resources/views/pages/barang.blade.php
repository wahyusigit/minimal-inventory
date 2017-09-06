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
                    <div class="box-header with-border">Tambah Barang</div>
                    <div class="box-body">
                        <form action="{{ route('addBarang') }}" method="POST" role="form">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" required>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right btn-flat">Tambah</button>
                        </form>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">Tambah Mutasi Barang</div>
                    <div class="box-body">
                        <form action="{{ route('addMutasiBarang') }}" method="POST" role="form">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="">Nama Barang</label>
                                <select class="form-control" name="id_barang" required>
                                    @foreach($barang_all as $barang)
                                    <option value="{{ $barang -> id }}">{{ $barang -> nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Mutasi</label>
                                <select class="form-control" name="jenis_mutasi" required>
                                    <option value="masuk">Barang Masuk</option>
                                    <option value="keluar">Barang Keluar</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Qty</label>
                                        <input type="number" class="form-control" name="qty" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right btn-flat">Tambah</button>
                        </form>
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
                        <div class="pull-right">{{ $barangs->links() }}</div>
                        @endif
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">Barang Masuk</div>
                    <div class="box-body">
                        @if($barangMasuk->isEmpty())
                        <div class="h4 text-center">Tidak Ada Data</div>
                        @else
                        <table class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($barangMasuk as $no => $barang )
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $barang->barang->nama_barang }}</td>
                                    <td>{{ $barang->tanggal }}</td>
                                    <td>{{ $barang->qty }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">Barang Keluar</div>
                    <div class="box-body">
                        @if($barangKeluar->isEmpty())
                        <div class="h4 text-center">Tidak Ada Data</div>
                        @else
                        <table class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Tanggal Keluar</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($barangKeluar as $no => $barang )
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $barang->barang->nama_barang }}</td>
                                    <td>{{ $barang->tanggal }}</td>
                                    <td>{{ $barang->qty }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
    <form id="form_barang" action="{{ route('updateBarang') }}" method="POST" role="form">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Barang</h4>
      </div>
      <div class="modal-body">
        
        {{ csrf_field() }}
            <div class="form-group">
                <label for="">Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang" id="nama_barang">
            </div>
            <div class="form-group">
                <label for="">Qty</label>
                <input type="text" class="form-control" name="stok_akhir" id="stok_akhir">
            </div>
            <input type="hidden" name="id_barang" id="id_barang" value="">
            
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success pull-right btn-flat">Simpan</button>
      </div>
    </form>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="konfirmasi_hapus_barang" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin menghapus data ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <button id="btn_konfirmasi_hapus_barang" type="button" class="btn btn-primary pull-right">Ya</button>
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
<script type="text/javascript">
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
</script>
@endpush