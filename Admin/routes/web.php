<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

Route::group(['middleware'=>'guest'],function(){
    Route::get('/','App\Http\Controllers\anasayfaController@giris')->name('giris');
    Route::post('/','App\Http\Controllers\anasayfaController@girisForm');
    Route::get("/dalgamigeciyorsuncanim",'App\Http\Controllers\anasayfaController@anil')->name('anil');
});

Route::group(["middleware"=>'auth'],function(){
    Route::get('/home','App\Http\Controllers\anasayfaController@index')->name('anasayfa');
    Route::get("/ayarlar",'App\Http\Controllers\anasayfaController@ayarlar')->name('ayarlar');
    Route::post("/ayarlar",'App\Http\Controllers\anasayfaController@ayarlarForm');
    Route::get("/profil",'App\Http\Controllers\kullaniciController@profil')->name('profil');
    Route::post("/profil",'App\Http\Controllers\kullaniciController@profilForm');
    Route::get('/cikis','App\Http\Controllers\anasayfaController@cikis')->name('cikis');
    Route::group(["prefix"=>"siparisler"],function(){
        Route::get('/','App\Http\Controllers\siparislerController@siparisKategori')->name('siparisKategori');
        Route::get('/toplu-onay','App\Http\Controllers\siparislerController@siparisTopluOnay')->name('topluOnay');
        Route::get('/toplu-arsiv','App\Http\Controllers\siparislerController@siparisTopluArsiv')->name('topluArsiv');
        Route::get('/pdf','App\Http\Controllers\siparislerController@siparisPdf')->name('siparisPdf');
        Route::get('/excel','App\Http\Controllers\siparislerController@siparisExcel')->name('siparisExcel');
        Route::get('/siparis-olustur','App\Http\Controllers\siparislerController@siparisManuel')->name('siparisManuel');
        Route::post('/siparis-olustur','App\Http\Controllers\siparislerController@siparisManuelForm');
        Route::get('/{id}','App\Http\Controllers\siparislerController@siparisKategoriDetay')->name('siparisKategoriDetay');
        Route::get('/detay/{id}','App\Http\Controllers\siparislerController@siparisDetay')->name('siparisDetay');
        Route::post('/detay/{id}','App\Http\Controllers\siparislerController@siparisDetayForm');
    });
    Route::group(["prefix"=>"kategori"],function(){
        Route::get("/",'App\Http\Controllers\kategoriController@index')->name('kategoriler');
        Route::get("/duzenle/{id}",'App\Http\Controllers\kategoriController@duzenle')->name('kategoriDuzenle');
        Route::post("/duzenle/{id}",'App\Http\Controllers\kategoriController@duzenleForm');
        Route::get("/ekle",'App\Http\Controllers\kategoriController@ekle')->name('kategoriEkle');
        Route::post("/ekle",'App\Http\Controllers\kategoriController@ekleForm');
        Route::get("/sil/{id}",'App\Http\Controllers\kategoriController@sil')->name('kategoriSil');
    });
    Route::group(["prefix"=>"urun"],function(){
        Route::get("/",'App\Http\Controllers\urunController@index')->name('urunler');
        Route::get("/duzenle/{id}",'App\Http\Controllers\urunController@duzenle')->name('urunDuzenle');
        Route::post("/duzenle/{id}",'App\Http\Controllers\urunController@duzenleForm');
        Route::get("/ekle",'App\Http\Controllers\urunController@ekle')->name('urunEkle');
        Route::post("/ekle",'App\Http\Controllers\urunController@ekleForm');
        Route::get("/sil/{id}",'App\Http\Controllers\urunController@sil')->name('urunSil');
        Route::get("/resim-sil/{id}",'App\Http\Controllers\urunController@resimSil')->name('resimSil');
    });
    Route::group(["prefix"=>'yorum'],function(){
        Route::get("/",'App\Http\Controllers\urunController@yorumlar')->name('yorumlar');
        Route::post("/",'App\Http\Controllers\urunController@Toplu');
        Route::get("/detay/{id}",'App\Http\Controllers\urunController@yorumDetay')->name('yorumDetay');
        Route::post("/detay/{id}",'App\Http\Controllers\urunController@yorumDetayForm');
        Route::get("/sil/{id}",'App\Http\Controllers\urunController@yorumSil')->name('yorumSil');
        Route::get("/onay/{id}",'App\Http\Controllers\urunController@yorumOnay')->name('yorumOnay');
    });
    Route::group(["prefix"=>'mail'],function(){
        Route::get("/",'App\Http\Controllers\mailController@index')->name('mailler');
        Route::post("/",'App\Http\Controllers\mailController@topluSil');
        Route::get("/detay/{id}",'App\Http\Controllers\mailController@detay')->name('mailDetay');
        Route::get("/sil/{id}",'App\Http\Controllers\mailController@sil')->name('mailSil');
    });
    Route::group(["prefix"=>'slider'],function(){
        Route::get("/",'App\Http\Controllers\sliderController@index')->name('slider');
        Route::get("/duzenle/{id}",'App\Http\Controllers\sliderController@duzenle')->name('sliderDuzenle');
        Route::post("/duzenle/{id}",'App\Http\Controllers\sliderController@duzenleForm');
        Route::get("/ekle",'App\Http\Controllers\sliderController@ekle')->name('sliderEkle');
        Route::post("/ekle",'App\Http\Controllers\sliderController@ekleForm');
        Route::get("/sil/{id}",'App\Http\Controllers\sliderController@sil')->name('sliderSil');
    });
    Route::group(["prefix"=>'kullanicilar'],function(){
        Route::get("/",'App\Http\Controllers\kullaniciController@index')->name('kullanici');
        Route::get("/ekle",'App\Http\Controllers\kullaniciController@kullaniciEkle')->name('kullaniciEkle');
        Route::post("/ekle",'App\Http\Controllers\kullaniciController@kullaniciEkleForm');
        Route::get("/duzenle/{id}",'App\Http\Controllers\kullaniciController@kullaniciDuzenle')->name('kullaniciDuzenle');
        Route::post("/duzenle/{id}",'App\Http\Controllers\kullaniciController@kullaniciDuzenleForm');
        Route::get("/sil/{id}",'App\Http\Controllers\kullaniciController@kullaniciSil')->name('kullaniciSil');
    });
    Route::group(["prefix"=>'entegrasyonlar'],function(){
        Route::get("/",'App\Http\Controllers\urunController@hepsiburada')->name('hepsiburada');
        Route::post("/",'App\Http\Controllers\urunController@hepsiburadaForm');
    });
});
