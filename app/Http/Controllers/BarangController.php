<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Barang;
use App\MutasiBarang;

class BarangController extends Controller
{
    public function index(){
    	$barangs = Barang::paginate(10);
    	$barang_all = Barang::all();
    	$barangMasuk = MutasiBarang::where('jenis_mutasi','masuk')->orderBy('created_at','
    		asc')->paginate(10);
    	$barangKeluar = MutasiBarang::where('jenis_mutasi','keluar')->orderBy('created_at','asc')->paginate(10);

    	return view('pages.barang', compact('barangs','barang_all','barangMasuk','barangKeluar'));
    }

    public function addBarang(Request $req){
    	$check = Barang::where('nama_barang',$req->nama_barang)->first();
    	if (is_null($check)) {
    		$barang = new Barang();
	    	$barang -> nama_barang = $req -> nama_barang;
	    	$barang -> save();	
    	} else {
    		$message = "Maaf, Nama Barang sudah ada";
    		flash($message, 'danger');	
    	}
    	return redirect()->back();
    }

    public function updateBarang(Request $req){
    	$barang = Barang::find($req->id_barang);
    	$barang -> nama_barang = $req -> nama_barang;
    	$barang -> stok_akhir = $req -> stok_akhir;
    	$barang -> save();
    	return redirect()->back();
    }

    public function deleteBarang(Request $req){
    	if ($req->ajax()) {
    		$barang = Barang::find($req->id);
	    	$barang -> delete();
	    	return "success";
    	}
    }

    public function addMutasiBarang(Request $req){
		$mutasi = new MutasiBarang();
		$mutasi -> id_barang = $req -> id_barang;
		$mutasi -> jenis_mutasi = $req -> jenis_mutasi;
		$mutasi -> tanggal = $req -> tanggal;
		$mutasi -> qty = $req -> qty;
		$mutasi -> save();

		$barang = Barang::find($req->id_barang);
		if ($req->jenis_mutasi == 'masuk') {
			$barang -> stok_akhir = $barang -> stok_akhir + $req -> qty;
		} elseif ($req->jenis_mutasi == 'keluar') {
			$barang -> stok_akhir = $barang -> stok_akhir - $req -> qty;
		}
		$barang->save();
		
    	return redirect()->back();
    }

    public function updateMutasiBarang(Request $req){
		$mutasi = MutasiBarang::find($req->id);
		$mutasi -> jenis_mutasi = $req -> jenis_mutasi;
		$mutasi -> tanggal = $req -> tanggal;
		$mutasi -> qty = $req -> qty;
		$mutasi -> save();

		$barang = Barang::find($req->id_barang);
		if ($req->jenis_mutasi == 'masuk') {
			$barang -> stok_akhir = $barang -> stok_akhir + $req -> qty;
		} elseif ($req->jenis_mutasi == 'keluar') {
			$barang -> stok_akhir = $barang -> stok_akhir - $req -> qty;
		}
		$barang->save();
		
    	return redirect()->back();
    }
}
