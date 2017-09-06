<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Barang;
use App\MutasiBarang;
use App\Penjualan;

use Carbon\Carbon;
class LaporanController extends Controller
{
    public function index(){
    	$carbon = new Carbon();
    	$bulan = $carbon->now()->month;
    	$barangs = Barang::paginate(10);
    	$penjualans = Penjualan::whereMonth('created_at',$carbon->now())->paginate(10);

    	return view('pages.laporan', compact('barangs','penjualans','bulan'));
    }

    public function laporanBarang(){
    	$barangs = Barang::orderBy('nama_barang','asc')->get();
    	return view('pages.laporan.barang', compact('barangs'));
    }

    public function laporanPenjualan(){
    	$penjualans = Penjualan::orderBy('tanggal_penjualan','desc')->get();
		$bulan = date("F Y");
    	$total = Penjualan::where('created_at','LIKE','%' . date("Y-m") . '%')->sum('harga_paketan');
    	
    	return view('pages.laporan.penjualan', compact('penjualans','total','bulan'));
    }

    public function showLaporanPenjualan(Request $req){
    	$penjualans = Penjualan::where('created_at','LIKE','%' . $req->bulan . '%')->get();
    	$tanggal = date_format(date_create($req->bulan,'Y-m'), 'F Y');
    	$total = Penjualan::where('created_at','LIKE','%' . $req->bulan . '%')->sum('harga_paketan');
    	return view('pages.laporan.penjualan', compact('penjualans','total','bulan'));
    }
}
