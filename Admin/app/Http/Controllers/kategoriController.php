<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Cocur\Slugify\Slugify;
use Illuminate\Support\Str;

class kategoriController extends Controller
{
    public function index(){
        $kategoriler = Kategori::orderBy('id','desc')->get();
        return view('kategori',compact('kategoriler'));
    }
    public function duzenle($id){
        $kategoriler = Kategori::orderBy('id','desc')->get();
        $kategori = Kategori::where('id',$id)->firstOrFail();
        return view('kategori-duzenle',compact('kategori','kategoriler'));
    }
    public function duzenleForm(Request $request){
        $id = $request->input('id');
        $this->validate($request, [
            'ad' => 'unique:App\Models\Kategori,kategori_adi,'.$id,
            'kategori_resmi' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Resim dosyasını kontrol et
        ]);
        
        $slugify = new Slugify();
        $kategori = Kategori::find($id);
        $kategori->kategori_adi = $request->input('ad');
        $kategori->category_sub = $request->input('categorySub');
        $kategori->slug = $slugify->slugify($request->input('ad'));
    
        if ($request->hasFile('kategori_resmi')) {
            $image = $request->file('kategori_resmi');
            $imageName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('assets/images/categories'), $imageName);
            $kategori->category_image = $imageName;
        }
    
        if ($kategori->save()) {
            return redirect()->back()->with(['tur' => 'success', 'title' => 'Başarılı', 'message' => 'Güncelleme Başarılı']);
        } else {
            return redirect()->back()->with(['tur' => 'error', 'title' => 'Hata', 'message' => 'Güncelleme Başarısız']);
        }
    }
    public function ekle(){
        $kategoriler = Kategori::orderBy('id','desc')->get();
        return view('kategori-ekle',compact('kategoriler'));
    }
    public function ekleForm(){
        $this->validate(request(),[
            'ad' => 'unique:App\Models\Kategori,kategori_adi',
            'kategori_resmi' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Dosya validasyonu
        ]);
    
        $slugify = new Slugify();
        $yeniKategori = new Kategori();
        $yeniKategori->kategori_adi = request('ad');
        $yeniKategori->category_sub = request('categorySub');
        $yeniKategori->slug = $slugify->slugify(request('ad'));
    
        if(request()->hasFile('kategori_resmi')) {
            $image = request()->file('kategori_resmi');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/categories'), $imageName);
            $yeniKategori->category_image = $imageName;
        }
    
        if($yeniKategori->save())
            return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Kategori Ekleme Başarılı']);
        else
            return redirect()->back()->with(['tur'=>'error','title'=>'Hata','message'=>'Kategori Ekleme Başarısız']);
    }
    public function sil($id){
        $delete = Kategori::where('id',$id)->delete();
        if($delete)
            return redirect()->route('kategoriler')->with(['tur'=>'success','title'=>'Başarılı','message'=>'Kategori Silme Başarılı']);
        else
            return redirect()->back()->with(['tur'=>'error','title'=>'Hata','message'=>'Kategori Silme Başarısız']);
    }
}
