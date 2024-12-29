<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\urunResim;
use Illuminate\Http\Request;
use File;

class sliderController extends Controller
{
    public function index(){
        $sliderlar = Slider::orderBy('id','desc')->get();
        return view('slider',compact('sliderlar'));
    }
    public function ekle(){
        return view('slider-ekle');
    }
    public function ekleForm(){
        $this->validate(request(),[
           'image' => 'required|image',
           'image.*' => 'mimes:jpg,png,jpeg'
        ]);

        $yeni_slider = new Slider();
        $yeni_slider->baslik = request('baslik');
        $yeni_slider->aciklama = request('aciklama');
        $yeni_slider->save();

        $lastID = $yeni_slider->id;
        $file = request()->file('image');
        $name = $lastID.'.'.$file->extension();
        $file->move(public_path().'/assets/images/slider', $name);

        $yeni_slider->resim_path = $name;
        $yeni_slider->save();

        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Slider Başarıyla Eklendi']);

    }
    public function duzenle($id){
        $slider = Slider::where('id',$id)->firstOrFail();
        return view('slider-duzenle',compact('slider'));
    }
    public function duzenleForm($id){
        $this->validate(request(),[
            'image.*' => 'mimes:jpg,png,jpeg'
        ]);

        $slider = Slider::where('id',$id)->firstOrFail();
        //Resim yüklenmişse
        if(!is_null(request('image'))){
            $image_path = "assets/images/slider/$slider->resim_path";
            if (file_exists($image_path)) {
                @unlink($image_path);
            }
            $file = request()->file('image');
            $name = $slider->id.'.'.$file->extension();
            $file->move(public_path().'/assets/images/slider', $name);
            $slider->resim_path = $name;
        }

        $slider->baslik = request('baslik');
        $slider->aciklama = request('aciklama');
        $slider->save();
        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Slider Başarıyla Güncellendi']);

    }
    public function sil($id){
        $slider = Slider::where('id',$id)->firstOrFail();
        $image_path = "assets/images/slider/$slider->resim_path";
        if (file_exists($image_path)) {
            @unlink($image_path);
        }
        $slider->delete();
        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Slider Başarıyla Silindi']);
    }
}
