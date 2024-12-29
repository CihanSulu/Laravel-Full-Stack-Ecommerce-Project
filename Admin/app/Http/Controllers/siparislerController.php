<?php

namespace App\Http\Controllers;

use App\Models\siparisKategori;
use App\Models\siparisler;
use App\Models\siparisUrun;
use App\Models\Urunler;
use Illuminate\Http\Request;

class siparislerController extends Controller
{
    public function siparisKategori(){
        $siparisler = siparisler::where('kategori','!=',11)->get();

        return view('siparis',compact('siparisler'));
    }
    public function siparisKategoriDetay($id){
        $kategoriler = siparisKategori::where('id',$id)->firstOrFail();
        $siparisler = siparisler::where('kategori',$id)->get();

        return view('siparis',compact('kategoriler','siparisler'));
    }
    public function siparisDetay($id){
        $siparis = siparisler::where('id',$id)->firstOrFail();
        $kategorisi = siparisler::find($siparis->id)->kategorisi()->first();
        $urunler = siparisler::find($id)->Urunler()->get();
        $tum_urunler = Urunler::orderBy('id','desc')->get();

        return view('siparis-detay',compact('siparis','kategorisi','urunler','tum_urunler'));
    }
    public function siparisDetayForm(){
        $id = request('id');
        $siparis = siparisler::where('id',$id)->first();

        $siparis->ad = request('ad');
        $siparis->soyad = request('soyad');
        $siparis->tel = request('tel');
        $siparis->sehir = request('sehir');
        $siparis->ilce = request('ilce');
        $siparis->adres = request('adres');
        $siparis->fiyat = request('fiyat');
        $siparis->odeme = request('odeme');
        $siparis->siparis_not = request('siparis_not');
        $siparis->kategori = request('kategori');

        $urunler = request('urunler');

        if(empty($urunler))
            return redirect()->back()->with(['tur'=>'error','title'=>'Hatalı','message'=>'Ürün Kısmı Boş Olamaz']);
        else{
            siparisUrun::where('siparis_id',$id)->delete();
            foreach($urunler as $urun){
                $parcalama = explode("_",$urun);
                $siparis_urun = new siparisUrun();
                $siparis_urun->siparis_id = $id;
                $siparis_urun->urun_id = $parcalama[0];
                $siparis_urun->siparis_adet = $parcalama[1];
                $siparis_urun->save();
            }
        }

        if($siparis->save())
            return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Güncelleme İşlemi Başarılı']);
        else
            return redirect()->back()->with(['tur'=>'error','title'=>'Hatalı','message'=>'Güncelleme İşlemi Başarısız']);

    }
    public function siparisManuel(){
        $tum_urunler = Urunler::orderBy('id','desc')->get();
        return view('siparis-olustur',compact('tum_urunler'));
    }
    public function siparisManuelForm(){
        //Manuel Sipariş
        $siparis = new siparisler();
        $siparis->ad = request('ad');
        $siparis->soyad = request('soyad');
        $siparis->tel = request('tel');
        $siparis->sehir = request('sehir');
        $siparis->ilce = request('ilce');
        $siparis->adres = request('adres');
        $siparis->fiyat = request('fiyat');
        $siparis->odeme = request('odeme');
        $siparis->siparis_not = request('siparis_not');
        $siparis->kategori = request('kategori');
        $siparis->website = "Manuel";
        $siparis->save();

        $urunler = request('urunler');
        if(empty($urunler)){
            $siparis->delete();
            return redirect()->back()->withInput()->with(['tur'=>'error','title'=>'Hatalı','message'=>'Ürün Kısmı Boş Olamaz']);
        }
        else{
            foreach($urunler as $urun){
                $parcalama = explode("_",$urun);
                $siparis_urun = new siparisUrun();
                $siparis_urun->siparis_id = $siparis->id;
                $siparis_urun->urun_id = $parcalama[0];
                $siparis_urun->siparis_adet = $parcalama[1];
                $siparis_urun->save();
            }
        }

        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Sipariş Başarıyla Oluşturuldu']);
    }
    public function siparisTopluOnay(){
        $yeniSiparler = siparisler::where('kategori',1)->get();
        foreach($yeniSiparler as $siparis){
            $siparis->kategori = 2;
            $siparis->save();
        }
        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Yeni Siparişler Başarıyla Onaylandı']);
    }
    public function siparisTopluArsiv(){
        $yeniSiparler = siparisler::where('kategori',2)->get();
        foreach($yeniSiparler as $siparis){
            $siparis->kategori = 9;
            $siparis->save();
        }
        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Onaylı Siparişler Başarıyla Arşivlendi']);
    }
    public function siparisPdf(){
        $onayliSiparisler = siparisler::where('kategori',2)->get();
        return view('pdf',compact('onayliSiparisler'));
    }
    public function siparisExcel(){
        $onayliSiparisler = siparisler::where('kategori',2)->get();
        return view('excel',compact('onayliSiparisler'));
    }
}
