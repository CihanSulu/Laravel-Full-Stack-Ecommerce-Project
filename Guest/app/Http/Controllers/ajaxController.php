<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\urunResim;
use App\Models\Urunler;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Session;

class ajaxController extends Controller
{
    public function ajaxCategory(){
        $categoryID = request('categoryID');
        if($categoryID==0)
            $products = Urunler::orderBy('id','desc')->limit(20)->get();
        else{
            $products = Kategori::find($categoryID)->Urunler()->limit(20)->get();
            $categoryInfo = Kategori::where('id',$categoryID)->first();
            if(substr($categoryInfo->kategori_adi,-1) == "i")
                $str = 'ni';
            else
                $str = 'i';
        }
        $url = session('url');
            

        $content = "";
        foreach($products as $item){
            $image = urunResim::where('urun_id',$item->id)->orderBy('id','desc')->first();
            $product_category = Urunler::find($item->id)->Kategoriler()->first();

            $content .= '<div class="col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="single-product mt-50">
                <div class="product-image">
                    <div class="image">
                        <img class="product-1 lazy" src="'.$url.'/assets/images/urunler/nophoto.png" data-src="'.$url.'/assets/images/urunler/'.$image->resim_path.'" alt="'.$item->urun_adi.'" height="350px" width="100%" style="object-fit: cover;">
                        <a class="link" href="'.route('product',[$product_category->slug,$item->slug]).'" name="'.$item->urun_adi.'" aria-label="'.$item->urun_adi.'"></a>
                    </div>
                    <ul class="product-meta text-center">
                        <li class="d-none"><a data-tooltip="tooltip" data-placement="top" title="Sepete Ekle" href="'.route('sepet.ekle',$item->id).'"><i class="fal fa-Shopping-cart"></i></a></li>
                        <li><a data-tooltip="tooltip" data-placement="top" title="Ürünü İncele" href="'.route('product',[$product_category->slug,$item->slug]).'"><i class="fal fa-search-plus"></i></a></li>
                    </ul>
                    <img src="/assets/images/layer1.png" class="layer layer1" alt="Tester Parfüm 2 Al 1 Öde Kapıda Ödeme" title="Tester Parfüm 2 Al 1 Öde Kapıda Ödeme">
                    <img src="/assets/images/layer2.png" class="layer layer2" alt="Tester Parfüm 2 Al 1 Öde Kapıda Ödeme" title="Tester Parfüm 2 Al 1 Öde Kapıda Ödeme">
                </div>
                <div class="product-content">
                    <a href="'.route('product',[$product_category->slug,$item->slug]).'" class="main-btn btn-block d-block text-dark buybtn shadow-sm">Satın Al <i class="far fa-Shopping-cart"></i></a>
                    <div class="product-title">
                        <h1 class="title"><a href="'.route('product',[$product_category->slug,$item->slug]).'">'.$item->urun_adi.'</a></h1>
                    </div>
                    <div class="product-price">
                        <span class="sale-price" style="font-size:16px;"><sup class="text-dark"><del>'.$item->urun_eskifiyat.' ₺</del></sup> '.$item->urun_fiyat.' ₺</span>
                    </div>
                </div>
            </div>
        </div>';
        }

        if($categoryID != 0){
            $content .= '<div class="text-center w-100 mt-3">
                <div class="product-btn text-center mt-50">
                    <a href="'.route('category',$categoryInfo->slug).'" class="view-product-2 font-weight-bold f16">Tüm '.$categoryInfo->kategori_adi.$str.' Görüntüle</a>
                </div>
            </div>';
        }

        $content .= '<div class="text-center w-100 mt-3">
            <div class="product-btn text-center mt-50">
                <a href="'.route('products').'" class="view-product-2 font-weight-bold">Tüm Ürünleri Görüntüle</a>
            </div>
        </div>';

        return $content;
    }
}
