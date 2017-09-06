<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Penjualan;

class PenjualanController extends Controller
{
    public function index(){
    	$penjualans = Penjualan::orderBy('tanggal_penjualan','desc')->paginate(20);
    	return view('pages.penjualan',compact('penjualans'));
    }

    public function addPenjualan(Request $req){
    	
    	$penjualan = new Penjualan();    	
    	$penjualan -> tanggal_penjualan = $req -> tanggal_penjualan;
		$penjualan -> nama_konsumen = $req -> nama_konsumen;
		$penjualan -> paketan = $req -> paketan;
		$penjualan -> harga_paketan = $req -> harga_paketan;
		$penjualan -> save();

		return redirect()->back();
    }

    public function editPenjualan($id){
    	$penjualan = Penjualan::find($id);    	
		return view('pages.penjualan_edit', compact('penjualan'));
    }

    public function updatePenjualan(Request $req){
    	
    	$penjualan = Penjualan::find($req->id);    	
    	$penjualan -> tanggal_penjualan = $req -> tanggal_penjualan;
		$penjualan -> nama_konsumen = $req -> nama_konsumen;
		$penjualan -> paketan = $req -> paketan;
		$penjualan -> harga_paketan = $req -> harga_paketan;
		$penjualan -> save();

		return redirect(route('indexPenjualan'));
    }

    public function deletePenjualan($id){
    	$penjualan = Penjualan::find($id)->delete();
    	return redirect()->back();
    }
}
