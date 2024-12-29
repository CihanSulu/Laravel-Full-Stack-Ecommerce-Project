<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Urunler;
use App\Models\Yorumlar;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class urunController extends Controller
{
    public function category($slug){
        $category = Kategori::where('slug',$slug)->firstOrFail();
        $categories = Kategori::get();
        $popular = Urunler::inRandomOrder()->where('urun_onecikan',1)->orderBy('id','desc')->limit(5)->get();
        $products = Kategori::find($category->id)->Urunler()->paginate(24);
        $total_products = count(Kategori::find($category->id)->Urunler()->get());
        return view('shop',compact('category','categories','popular','products','total_products'));
    }
    public function all(){
        $categories = Kategori::get();
        $popular = Urunler::inRandomOrder()->where('urun_onecikan',1)->orderBy('id','desc')->limit(5)->get();
        $products = Urunler::orderBy('id','desc')->paginate(24);
        $total_products = count(Urunler::orderBy('id','desc')->get());
        return view('shop',compact('categories','popular','products','total_products'));
    }
    public function hediye($id){
        $urun = Urunler::where('id',$id)->firstOrFail();
        $categories = Kategori::get();
        $popular = Urunler::inRandomOrder()->where('urun_onecikan',1)->orderBy('id','desc')->limit(5)->get();
        $products = Urunler::orderBy('id','desc')->paginate(24);
        $total_products = count(Urunler::orderBy('id','desc')->get());
        return view('gift',compact('categories','popular','products','total_products','id'));
    }
    public function search(){
        $slug = strtolower(request('e'));
        $categories = Kategori::get();
        $popular = Urunler::inRandomOrder()->where('urun_onecikan',1)->orderBy('id','desc')->limit(5)->get();
        $products = Urunler::where('urun_adi','LIKE',"%$slug%")->orWhere('urun_aciklama','LIKE',"%$slug%")->orderBy('id','desc')->paginate(24);
        $total_products = count(Urunler::where('urun_adi','LIKE',"%$slug%")->orWhere('urun_aciklama','LIKE',"%$slug%")->orderBy('id','desc')->get());
        return view('shop',compact('categories','popular','products','total_products'));
    }
    public function product($slug,$slug2){
        $category = Kategori::where('slug',$slug)->firstOrFail();
        $product = Urunler::where('slug',$slug2)->firstOrFail();
        $images = Urunler::find($product->id)->Resimler()->get();
        $popular = Urunler::inRandomOrder()->where('urun_onecikan',1)->where('id','!=',$product->id)->orderBy('id','desc')->limit(4)->get();
        $comments = Yorumlar::where('urun_id',$product->id)->where('yorum_onay',1)->orderBy('yorum_date','desc')->get();
        return view('product',compact('category','product','images','popular','comments'));
    }
    public function commentForm(){
        $add_comment = new Yorumlar();
        $add_comment->urun_id = request('product_id');
        $add_comment->yorum = request('comment');
        $add_comment->yorum_star = request('star');
        $add_comment->save();
        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Yorumunuz başarıyla gönderildi onaylandıktan sonra yayınlanacaktır.']);
    }

}
