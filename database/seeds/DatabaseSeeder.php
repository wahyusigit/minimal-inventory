<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Barang;
use App\MutasiBarang;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        
        $user -> name = 'admin123';
		$user -> email = 'admin123@gmail.com';
		$user -> password = bcrypt('admin123');
		$user -> save();


		$nama_barang = [['nama_barang'=>'TABUNG FRP 1054'],
						['nama_barang'=>'TABUNG FRP 1354'],
						['nama_barang'=>'TABUNG STAINLESS'],
						['nama_barang'=>'HANDLE TABUNG'],
						['nama_barang'=>'HOUSING BIRU'],
						['nama_barang'=>'HOUSING BENING'],
						['nama_barang'=>'KARBON BDG'],
						['nama_barang'=>'KARBON SOLO'],
						['nama_barang'=>'KARBON JKT'],
						['nama_barang'=>'FEROLITE (FE)'],
						['nama_barang'=>'PA. SAK SEMEN'],
						['nama_barang'=>'MGS SAK SEMEN'],
						['nama_barang'=>'MGS SAK PLASTIK'],
						['nama_barang'=>'MGS BIASA'],
						['nama_barang'=>'SLIKA'],
						['nama_barang'=>'SIKAT GALON'],
						['nama_barang'=>'ULTRA VIOLET IMPORT'],
						['nama_barang'=>'ULTRA VIOLET LOKAL'],
						['nama_barang'=>'LAMPU UV'],
						['nama_barang'=>'SELENOIT 1/2'],
						['nama_barang'=>'ISI GALON STAINLESS'],
						['nama_barang'=>'SIDMENT'],
						['nama_barang'=>'CTO'],
						['nama_barang'=>'GAC'],
						['nama_barang'=>'FILTER AV'],
						['nama_barang'=>'BIO CERAMIK'],
						['nama_barang'=>'BIO ENERGY'],
						['nama_barang'=>'POST CARBON'],
						['nama_barang'=>'MEMBRAN 500 GPD'],
						['nama_barang'=>'HOUSING MEMBRAN'],
						['nama_barang'=>'POMPA RO'],
						['nama_barang'=>'RO RUMAH TANGGA'],
						['nama_barang'=>'KENI 3/4'],
						['nama_barang'=>'SDL WMUR 1" KE 3/4'],
						['nama_barang'=>'ISOLATIP'],
						['nama_barang'=>'PIPA PARALON 3/4']];

		DB::table('barangs')->insert($nama_barang);
    }
}
