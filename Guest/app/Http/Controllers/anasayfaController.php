<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Mailler;
use App\Models\Slider;
use App\Models\urunKategori;
use App\Models\Urunler;
use Illuminate\Http\Request;
use Carbon\Carbon;

class anasayfaController extends Controller
{
    public function index(){
        $slider = Slider::orderBy('id','desc')->get();
        $popular = Urunler::where('urun_onecikan',1)->orderBy('urun_onecikansira','asc')->get();
        $category = Kategori::get();
        $products = Urunler::orderBy('id','desc')->limit(20)->get();
        
        $imgCategories = Kategori::whereNotNull('category_image')->get();
        
        return view('index',compact('slider','popular','category','products','imgCategories'));
    }
    public function contact(){
        return view('contact');
    }
    public function contactForm(){
        $mail = new Mailler();
        $mail->mail_ad = request('name');
        $mail->mail_soyad = request('surname');
        $mail->mail_tel = request('tel');
        $mail->mail_mesaj = request('message');
        $mail->save();
        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Mesajınız başarıyla gönderildi en yakın zamanda iletişime geçilecektir.']);
    }
    public function sitemap(){
        $posts = Urunler::orderBy('id', 'DESC')->get();
        $categories = Kategori::get();
        $now = Carbon::now()->toAtomString();
        $content = view('sitemap', compact('posts','categories','now'));
        return response($content)->header('Content-Type', 'application/xml');
    }
    public function merchant(){
        $posts = Urunler::orderBy('id', 'DESC')->get();
        $now = Carbon::now()->toAtomString();
        $content = view('google-merchant', compact('posts','now'));
        return response($content)->header('Content-Type', 'application/xml');
    }
}
