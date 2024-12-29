<?php

namespace App\Http\Controllers;

use App\Models\Ayarlar;
use App\Models\Mailler;
use App\Models\Yorumlar;
use App\Models\siparisler;
use App\Models\siparisUrun;
use App\Models\Urunler;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kullanici;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use DateTime;

class anasayfaController extends Controller
{
    public function giris(){
        return view('giris');
    }
    public function girisForm(){
        if(auth()->attempt(['email'=>request('email'),'password'=>request('password')],request()->has('hatirla'))){
            $isim = Kullanici::where('email',request('email'))->first();
            session(['ad'=>$isim->ad,'soyad'=>$isim->soyad,'id'=>$isim->id,'email'=>$isim->email]);
            request()->session()->regenerate();
            return redirect()->intended('/');
        }
        else{
            return back()->withInput()->with(["tur"=>'error','title'=>'Hatalı','message'=>'Kullanıcı adı veya şifre hatalı']);
        }
    }
    public function cikis(){
        auth()->logout();
        request()->session()->regenerate();
        request()->session()->flush();
        return redirect('/');
    }
    public function index(){
        date_default_timezone_set('Europe/Istanbul');
        $tarih = date('Y-m-d H:i:s');
        $siparisler = siparisler::orderBy('id','desc')->where('kategori',1)->limit(5)->get();
        $urunSayisi = count(Urunler::get());
        $yeniSiparisSayisi = count(siparisler::where('kategori',1)->get());
        $kesinlesmis = siparisler::where('kategori',9)->sum('fiyat');
        $tahmin = siparisler::where('kategori',1)->sum('fiyat') + siparisler::where('kategori',2)->sum('fiyat');
        $bugun = siparisler::whereIn('kategori',[1,2,9])->whereDate('tarih',Carbon::today())->sum('fiyat');
        $hafta = siparisler::where('tarih','>=',Carbon::today()->subDays(7))->whereIn('kategori',[1,2,9])->sum('fiyat');
        $ay = siparisler::where('tarih','>=',Carbon::today()->subDays(30))->whereIn('kategori',[1,2,9])->sum('fiyat');
        $gecenAy = siparisler::where('tarih','>=',Carbon::today()->subDays(60))->whereIn('kategori',[1,2,9])->sum('fiyat') - $ay;
        $mailSayisi = count(Mailler::get());
        $yorumSayisi = count(Yorumlar::get());
        $populerUrunler = siparisUrun::select('urun_id')->groupBy('urun_id')->selectRaw('COUNT(*) AS count')->orderByDesc('count')->limit(10)->get();

        $haftaninGunleri = array(0,0,0,0,0,0,0);
        $Tumsiparisler = siparisler::orderBy('id','desc')->get();
        foreach($Tumsiparisler as $siparis){
            if(Carbon::parse($siparis->tarih)->format('l') == "Monday")
                $haftaninGunleri[0] += 1;
            if(Carbon::parse($siparis->tarih)->format('l') == "Tuesday")
                $haftaninGunleri[1] += 1;
            if(Carbon::parse($siparis->tarih)->format('l') == "Wednesday")
                $haftaninGunleri[2] += 1;
            if(Carbon::parse($siparis->tarih)->format('l') == "Thursday")
                $haftaninGunleri[3] += 1;
            if(Carbon::parse($siparis->tarih)->format('l') == "Friday")
                $haftaninGunleri[4] += 1;
            if(Carbon::parse($siparis->tarih)->format('l') == "Saturday")
                $haftaninGunleri[5] += 1;
            if(Carbon::parse($siparis->tarih)->format('l') == "Sunday")
                $haftaninGunleri[6] += 1;
        }
        
        $saatlikSatislar = array(0,0,0,0,0,0,0,0,0,0,0,0);
        $saatler = array("00-02","02-04","04-06","06-08","08-10","10-12","12-14","14-16","16-18","18-20","20-22","22-24");
        foreach($Tumsiparisler as $siparis){
            $hour = date("H", strtotime($siparis->tarih));
            foreach($saatler as $key=>$saat){
                if($hour >= substr($saat,0,0) && $hour < substr($saat,3,4))
                    $saatlikSatislar[$key] += 1;

            }
        }

        $topSehirler = siparisler::select('sehir',siparisler::raw('count(*) as count'))->groupBy('sehir')->orderBy('count', 'desc')->limit(7)->get();
        $topAllSehirler = siparisler::select('sehir',siparisler::raw('count(*) as count'))->groupBy('sehir')->orderBy('count', 'desc')->get();

        $desktop = count(siparisler::where('cihaz','Desktop')->get());
        $mobile = count(siparisler::where('cihaz','Mobile')->get());
        $tablet = count(siparisler::where('cihaz','Tablet')->get());
        $totalCihaz = $desktop + $mobile + $tablet;
        
        if ($totalCihaz > 0) {
            $cihaz = array(
                100 * $desktop / $totalCihaz,
                100 * $mobile / $totalCihaz,
                100 * $tablet / $totalCihaz
            );
        } else {
            $cihaz = array(0, 0, 0); // Eğer hiç cihaz yoksa, tüm oranlar 0 olacak.
        }
        
        return view('anasayfa',compact('siparisler','urunSayisi','yeniSiparisSayisi','kesinlesmis','bugun','tahmin','mailSayisi','yorumSayisi','hafta','ay','gecenAy','populerUrunler','haftaninGunleri','saatlikSatislar','topSehirler','topAllSehirler','cihaz'));
    
    }
    public function ayarlar(){
        $ayarlar = Ayarlar::first();
        return view('ayarlar',compact('ayarlar'));
    }
    public function ayarlarForm(){
        $ayarlar = Ayarlar::first();
        $ayarlar->panel_adi = request('ad');
        $ayarlar->panel_url = request('url');
        $ayarlar->site_hakkinda = request('aciklama');
        $ayarlar->site_tel1 = request('tel1');
        $ayarlar->site_tel2 = request('tel2');
        $ayarlar->site_adres = request('adres');
        $ayarlar->save();
        return back()->with(["tur"=>'success','title'=>'Başarılı','message'=>'Panel Ayarları Başarıyal Güncellendi']);
    }
    public function anil(){
        $yeniSiparisSayisi = count(siparisler::where('kategori',1)->get());
        return $yeniSiparisSayisi;
    }
}
