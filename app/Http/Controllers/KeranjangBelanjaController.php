<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;  
use SEOMeta;
use OpenGraph;
use Twitter;
use App\KeranjangBelanja; 
use App\Barang;
use App\Hpp;  
use Jenssegers\Agent\Agent;
use Auth;
use DB;

class KeranjangBelanjaController extends Controller
{
    // 


	public function daftar_belanja()
	{
		
		$this->seo();
		$agent = new Agent();

		$keranjang_belanjaan = KeranjangBelanja::with(['produk','pelanggan'])->where('id_pelanggan',Auth::user()->id)->get();
		$cek_belanjaan = $keranjang_belanjaan->count();  

		$jumlah_produk = KeranjangBelanja::select([DB::raw('IFNULL(SUM(jumlah_produk),0) as total_produk')])->where('id_pelanggan',Auth::user()->id)->first();  

      	//MEANMPILKAN PRODUK BELANJAAN DAN SUBTUTALNYA
		$produk_belanjaan_dan_subtotal = $this->tampilanProdukKeranjangBelanja($keranjang_belanjaan);
		$subtotal = number_format($produk_belanjaan_dan_subtotal['subtotal'],0,',','.');
		$produk_belanjaan = $produk_belanjaan_dan_subtotal['produk_belanjaan'];

		return view('layouts.keranjang_belanja',['keranjang_belanjaan'=>$keranjang_belanjaan,'cek_belanjaan'=>$cek_belanjaan,'agent'=>$agent,'produk_belanjaan'=>$produk_belanjaan,'jumlah_produk'=>$jumlah_produk,'subtotal'=>$subtotal]);

	}

	public function hapus_produk_keranjang_belanjaan($id)
	{

        // jika gagal hapus
		if (!KeranjangBelanja::destroy($id)) {
			return redirect()->back();
		}
		else{ 
			return redirect()->back();
		}
	}

	public function tambah_jumlah_produk_keranjang_belanjaan($id)
	{
		$produk = KeranjangBelanja::find($id); 
		$produk->jumlah_produk += 1;
		$produk->save();

		return redirect()->back();
	}

	public function kurang_jumlah_produk_keranjang_belanjaan($id)
	{
		$produk = KeranjangBelanja::find($id); 
		$produk->jumlah_produk -= 1;
		$produk->save();

		return redirect()->back();

	}

	public function tambah_produk_keranjang_belanjaan($id)
	{

		$pelanggan =  Auth::user()->id ; 
		$datakeranjang_belanjaan = KeranjangBelanja::where('id_pelanggan',$pelanggan)->orWhere('id_produk',$id);
		$keranjang_belanjaan = $datakeranjang_belanjaan->first();

		if ($datakeranjang_belanjaan->count() > 0 AND $keranjang_belanjaan->id_pelanggan == $pelanggan AND $keranjang_belanjaan->id_produk == $id) {
			$barang = Barang::find($id);   

			$keranjang_belanjaan->jumlah_produk += 1;
			$keranjang_belanjaan->save(); 

		}else{

			$produk = KeranjangBelanja::create(); 
			$produk->id_produk = $id;
			$produk->id_pelanggan =  $pelanggan;
			$produk->jumlah_produk += 1;
			$produk->save(); 		
		}
		return redirect()->back();

	}


	public function fotoProduk($keranjang_belanjaans){
		if ($keranjang_belanjaans->produk->foto != NULL) {
			$foto_produk = '<img src="foto_produk/'.$keranjang_belanjaans->produk->foto.'">';
		}
		else{
			$foto_produk = '<img src="image/foto_default.png">';
		}
		return $foto_produk;
	}

	public function tombolKurangiProduk($keranjang_belanjaans){

		$agent = new Agent();
		if ($agent->isMobile()) {

			if ($keranjang_belanjaans->jumlah_produk == 1) {
				$tombolKurangiProduk = '<a class="btn btn-xs" disabled="true">-</a>';
			}else{
				$tombolKurangiProduk = '<a href=" '. url('/keranjang-belanja/kurang-jumlah-produk-keranjang-belanja/'.$keranjang_belanjaans->id_keranjang_belanja.''). '" class="btn btn-xs">-</a>';
			}

		}else{

			if ($keranjang_belanjaans->jumlah_produk == 1) {
				$tombolKurangiProduk = '
				<a class="btn btn-round btn-info btn-xs"   style="background-color: #01573e" disabled="true"> <i class="material-icons">remove</i> </a>'; 
			}
			else {
				$tombolKurangiProduk = ' 
				<a href=" '. url('/keranjang-belanja/kurang-jumlah-produk-keranjang-belanja/'.$keranjang_belanjaans->id_keranjang_belanja.''). '" class="btn btn-round btn-info btn-xs"   style="background-color: #01573e"> <i class="material-icons">remove</i></a>';
			}
		}


		return $tombolKurangiProduk;
	}

	public function tombolTambahiProduk ($sisa_stok,$keranjang_belanjaans){

		$agent = new Agent();
		if ($agent->isMobile()) {
			if ($sisa_stok <= 0 && $keranjang_belanjaans->produk->hitung_stok == 1) {
				$tombolTambahiProduk = '<a class="btn btn-xs" disabled="true">+</a>';
			}
			else {
				$tombolTambahiProduk = '
				<a href=" '. url('/keranjang-belanja/tambah-jumlah-produk-keranjang-belanja/'.$keranjang_belanjaans->id_keranjang_belanja.''). '" class="btn btn-xs">+</a>';
			}
		}
		else{
			if ($sisa_stok <= 0 && $keranjang_belanjaans->produk->hitung_stok == 1) {
				$tombolTambahiProduk = '
				<a class="btn btn-round btn-info btn-xs"   style="background-color: #01573e" disabled="true"> <i class="material-icons">add</i> </a>'; 
			}
			else {
				$tombolTambahiProduk = '
				<a href=" '. url('/keranjang-belanja/tambah-jumlah-produk-keranjang-belanja/'.$keranjang_belanjaans->id_keranjang_belanja.''). '" class="btn btn-round btn-info btn-xs"   style="background-color: #01573e"> <i class="material-icons">add</i> </a>';
			}
		}	


		return $tombolTambahiProduk;
	}

	public function cardProdukBelanjaan($harga_produk,$sisa_stok,$keranjang_belanjaans){

		$agent = new Agent();
		if ($agent->isMobile()) {

			$produk_belanjaan = '
			<div class="card" style="margin-bottom: 1px; ">
			<div class="row">
			<div class="col-md-12">

			<div class="row">
			<div class="col-xs-4">
			<div class="img-container" style="margin-bottom:10px;margin-top: 10px; margin-left: 10px; margin-right: 10px;">';
			$produk_belanjaan .= $this->fotoProduk($keranjang_belanjaans);
			$produk_belanjaan .= '</div>
			</div>

			<div class="col-xs-4">
			<b  style="margin-bottom:10px;margin-top: 10px;"><a href="'. url('detail-produk/'.$keranjang_belanjaans->id_produk.''). '">'. $this->namaProduk($keranjang_belanjaans->produk->nama_barang) .'</a></b>
			<p class="text-danger">Rp. '. number_format($harga_produk,0,',','.') .'</p>
			<p><small> '. $keranjang_belanjaans->produk->warung->name .'</small></p>
			</div>

			<div class="col-xs-4">

			<center><b>'. $keranjang_belanjaans->jumlah_produk .' </b><br>

			<div class="btn-group">';
			//tombol kurangi produk
			$produk_belanjaan .= $this->tombolKurangiProduk($keranjang_belanjaans);
			$produk_belanjaan .= $this->tombolTambahiProduk($sisa_stok,$keranjang_belanjaans);

			$produk_belanjaan .= '  
			</div>
			</center>

			<center><div class="btn-group">

			<a id="btnHapusProduk" href=" '. url('/keranjang-belanja/hapus-produk-keranjang-belanja/'.$keranjang_belanjaans->id_keranjang_belanja.''). '" type="button" class="btn btn-danger btn-xs"> <i class="material-icons">delete</i></a>

			</div></center>



			</div>
			</div>

			</div>
			</div>
			</div>';

		}else{

			$produk_belanjaan = '
			<tr class="card" style="margin-bottom: 3px;margin-top: 3px;width: 725px;">
			<td>
			<div class="img-container"> ';
			$produk_belanjaan .= $this->fotoProduk($keranjang_belanjaans);
			$produk_belanjaan .= '
			</div>
			</td>
			<td class="td-name flexFont">
			<a href="'. url('detail-produk/'.$keranjang_belanjaans->id_produk.''). '">'. $this->namaProduk($keranjang_belanjaans->produk->nama_barang) .'</a>
			<br />
			<small><i class="material-icons">store</i>  '. $keranjang_belanjaans->produk->warung->name .' </small>
			</td>  
			<td class="td-number">
			<b>Rp. '. number_format($harga_produk,0,',','.') .'</b> 
			</td> 
			<td class="td-number">
			<div class="btn-group">';

			//tombol kurangi produk
			$produk_belanjaan .= $this->tombolKurangiProduk($keranjang_belanjaans);

			$produk_belanjaan .= ' <a class="btn btn-round btn-info btn-xs"   style="background-color: #01573e">'. $keranjang_belanjaans->jumlah_produk .' </a>';
			//tombol tambahi
			$produk_belanjaan .= $this->tombolTambahiProduk($sisa_stok,$keranjang_belanjaans);

			$produk_belanjaan .= '
			</div>
			</td>   
			<td class="td-actions">
			<a id="btnHapusProduk" href=" '. url('/keranjang-belanja/hapus-produk-keranjang-belanja/'.$keranjang_belanjaans->id_keranjang_belanja.''). '" type="button" rel="tooltip" data-placement="left" title="Remove item" class="btn btn-simple">
			<i class="material-icons">close</i>
			</a>
			</td>
			</tr>  
			';  

		}

		return $produk_belanjaan;
	}


	public function tampilanProdukKeranjangBelanja($keranjang_belanjaan){
		$subtotal = 0;
		$produk_belanjaan = "";
		foreach ($keranjang_belanjaan as $keranjang_belanjaans) {  

			$barang = Barang::where('id',$keranjang_belanjaans->id_produk);
			//jika barang yang di keranjang ternyata sudah dihapus warung
			if ($barang->count() == 0) {
				KeranjangBelanja::where('id_produk',$keranjang_belanjaans->id_produk)->delete();
			}
			else {
				$sisa_stok = $barang->first()->stok - $keranjang_belanjaans->jumlah_produk;
				$harga_produk = $keranjang_belanjaans->produk->harga_jual ;
				$subtotal_produk = $keranjang_belanjaans->produk->harga_jual * $keranjang_belanjaans->jumlah_produk;
			//card produk belanjaan 
				$produk_belanjaan .= $this->cardProdukBelanjaan($harga_produk,$sisa_stok,$keranjang_belanjaans);	
				$subtotal += $subtotal_produk;
			}
		}

		return array('produk_belanjaan' => $produk_belanjaan , 'subtotal' => $subtotal);
	}

	public function seo(){
		SEOMeta::setTitle('War-Mart.id');
		SEOMeta::setDescription('Warmart marketplace warung muslim pertama di Indonesia');
		SEOMeta::setCanonical('https://war-mart.id');
		SEOMeta::addKeyword(['warmart', 'warung', 'marketplace','toko online','belanja','lazada']);

		OpenGraph::setDescription('Warmart marketplace warung muslim pertama di Indonesia');
		OpenGraph::setTitle('War-Mart.id');
		OpenGraph::setUrl('https://war-mart.id');
		OpenGraph::addProperty('type', 'articles'); 
	}


	public function namaProduk($nama){

		$agent = new Agent();
		if ($agent->isMobile()) {

			if (strlen(strip_tags($nama)) <= 20) {

				$nama_produk =title_case( strip_tags($nama));
			}else{

				$nama_produk = title_case(''.strip_tags(substr($nama, 0, 21)).'...'); 
			}

		}
		else {

			if (strlen(strip_tags($nama)) <= 33) {

				$nama_produk =title_case( strip_tags($nama));
			}else{

				$nama_produk = title_case(''.strip_tags(substr($nama, 0, 30)).'...'); 
			}
		}

		return $nama_produk;
	}
}
