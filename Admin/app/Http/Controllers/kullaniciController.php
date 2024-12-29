<?php

namespace App\Http\Controllers;

use App\Models\Kullanici;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class kullaniciController extends Controller
{
    public function profil(){
        return view("profil");
    }
    public function profilForm(){
        $kullanici = Kullanici::where('id',session('id'))->first();
        $this->validate(request(),[
            'email' => 'unique:tbl_user,email,'.$kullanici->id
        ]);

        $eski = request('eski');
        $yeni = request('yeni');
        $yeni2 = request('yeni_confirmation');
        if($eski != "" || $yeni != "" || $yeni2 != ""){
            $this->validate(request(),[
               'yeni'=>'confirmed|min:6'
            ]);

            if(!Hash::check($eski, $kullanici->password))
                return redirect()->back()->with(['tur'=>'error','title'=>'Hata','message'=>'Eski Şifre Hatalı Girildi']);
            else{
                $kullanici->password = Hash::make($yeni);
                $kullanici->save();
            }
        }

        $kullanici->ad = request('isim');
        $kullanici->soyad = request('soyisim');
        $kullanici->email = request('email');
        $kullanici->save();

        session(['ad'=>$kullanici->ad,'soyad'=>$kullanici->soyad,'id'=>$kullanici->id,'email'=>$kullanici->email]);
        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Profiliniz Başarıyla Güncellendi.']);
    }
    public function index(){
        $kullanicilar = Kullanici::orderBy('id','desc')->get();
        return view("kullanici",compact('kullanicilar'));
    }
    public function kullaniciEkle(){
        return view('kullanici-ekle');
    }
    public function kullaniciEkleForm(){
        $this->validate(request(),[
            'yeni' => 'confirmed|min:6',
            'email' => 'unique:tbl_user,email|email'
        ]);

        $yeni_kullanici = new Kullanici();
        $yeni_kullanici->email = request('email');
        $yeni_kullanici->password = Hash::make(request('yeni'));
        $yeni_kullanici->ad = request('isim');
        $yeni_kullanici->soyad = request('soyisim');
        if($yeni_kullanici->save())
            return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Kullanıcı Başarıyla Eklendi']);
        else
            return redirect()->back()->with(['tur'=>'error','title'=>'Hata','message'=>'Kullanıcı Eklenirken Hata Yaşandı']);

    }
    public function kullaniciSil($id){
        $kullanici = Kullanici::where('id',$id)->firstOrFail();
        $kullanici->delete();
        if($id == session('id'))
            auth()->logout();
        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Kullanıcı Başarıyla Silindi']);

    }
    public function kullaniciDuzenle($id){
        $kullanici = Kullanici::where('id',$id)->firstOrFail();
        return view('kullanici-duzenle',compact('kullanici'));
    }
    public function kullaniciDuzenleForm($id){
        $kullanici = Kullanici::where('id',$id)->first();
        $this->validate(request(),[
            'email' => 'unique:tbl_user,email,'.$kullanici->id
        ]);

        $yeni = request('yeni');
        $yeni2 = request('yeni_confirmation');
        if($yeni != "" || $yeni2 != ""){
            $this->validate(request(),[
                'yeni'=>'confirmed|min:6'
            ]);

            $kullanici->password = Hash::make($yeni);
            $kullanici->save();
        }

        $kullanici->ad = request('isim');
        $kullanici->soyad = request('soyisim');
        $kullanici->email = request('email');
        $kullanici->save();
        if($kullanici->id == session('id'))
            session(['ad'=>$kullanici->ad,'soyad'=>$kullanici->soyad,'id'=>$kullanici->id,'email'=>$kullanici->email]);
        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Kullanıcı Başarıyla Güncellendi.']);
    }
}
