<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\urunKategori;
use App\Models\Urunler;
use App\Models\urunResim;
use App\Models\Varyantlar;
use App\Models\Yorumlar;
use Illuminate\Http\Request;
use File;
use Cocur\Slugify\Slugify;

class urunController extends Controller
{
    public function index(){
        $urunler = Urunler::orderBy('id','desc')->get();
        return view('urunler',compact('urunler'));
    }
    public function ekle(){
        $sira = count(Urunler::where('urun_onecikan',1)->get());
        return view('urun-ekle',compact('sira'));
    }
    public function ekleForm(){
        $kategoriler = request('kategoriler');
        $this->validate(request(),[
            'fiyat' => 'numeric|min:0',
            'fiyateski' => 'numeric|min:0',
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg',
            'ad' => 'unique:App\Models\Urunler,urun_adi'
        ]);
        if(empty($kategoriler))
            return redirect()->back()->withInput()->with(['tur'=>'error','title'=>'Hata','message'=>'Kategori Boş Girilemez']);
        else{

            if(request('onecikan') == 0)
                $sira = null;
            else{
                $sira = request('onecikansira');
                $findsira = Urunler::where('urun_onecikansira',$sira)->first();
                if(!is_null($findsira)){
                    $findsira->urun_onecikansira = count(Urunler::where('urun_onecikan',1)->get())+1;
                    $findsira->save();
                }
            }
                

            $slugify = new Slugify();
            $yeni_urun = new Urunler();
            $yeni_urun->urun_adi = request('ad');
            $yeni_urun->urun_seo_baslik = request('seobaslik');
            $yeni_urun->urun_seo_anahtar = request('seoanahtar');
            $yeni_urun->slug = $slugify->slugify(request('ad'));
            $yeni_urun->urun_aciklama = request('aciklama');
            $yeni_urun->urun_eskifiyat = request('fiyateski');
            $yeni_urun->urun_fiyat = request('fiyat');
            $yeni_urun->urun_onecikan = request('onecikan');
            $yeni_urun->urun_onecikansira = $sira;
            $yeni_urun->save();

            $id = $yeni_urun->id;
            $kategoriler = request('kategoriler');
            foreach ($kategoriler as $kategori){
                $yeni_urun_kategori = new urunKategori();
                $yeni_urun_kategori->urun_id = $id;
                $yeni_urun_kategori->kategori_id = $kategori;
                $yeni_urun_kategori->save();
            }

            if(request()->hasfile('images'))
            {
                foreach(request()->file('images') as $index=>$file)
                {
                    $name = $id.'-'.$index.'.'.$file->extension();
                    $file->move(public_path().'/assets/images/urunler', $name);
                    $resim_ekle = new urunResim();
                    $resim_ekle->urun_id = $id;
                    $resim_ekle->resim_path = $name;
                    $resim_ekle->save();
                }
            }


            //Varyantları Ekle
            $varyantColor = request("varyantRenk");
            $varyantSize = request("varyantBoyut");
            $varyantPrice = request("varyantFiyat");
            $varyantImages = array();
            if(isset($varyantPrice) && count($varyantPrice)>0){
                for($i=0;$i<count($varyantPrice);$i++){
                    $varyant = new Varyantlar();
                    $varyant->urun_id=$id;
                    $varyant->varyant_renk = $varyantColor[$i];
                    $varyant->varyant_boyut = $varyantSize[$i];
                    $varyant->varyant_fiyat = $varyantPrice[$i];
                    
                    if(isset(request()->file('varyantResim')[$i])){
                        $file = request()->file('varyantResim')[$i];
                        $name = "v-".$id."-".$file->getClientOriginalName();
                        $file->move(public_path().'/assets/images/urunler', $name);
                        $varyant->varyant_resim = $name;
                    }
                    $varyant->save();
                }
            }

            return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Ürün Başarıyla Eklendi']);

        }

    }
    public function duzenle($id){
        $urun = Urunler::where('id',$id)->firstOrFail();
        $kategoriler = Kategori::orderBy('id','desc')->get();
        $kategorisi = urunKategori::where('urun_id',$id)->get();
        $resimler = Urunler::find($id)->Resimler()->get();
        $varyantlar = Varyantlar::where("urun_id",$id)->get();
        $sira = count(Urunler::where('urun_onecikan',1)->get());
        return view('urun-duzenle',compact('urun','kategoriler','kategorisi','resimler','varyantlar','sira'));
    }
    public function duzenleForm($id){
        $kategoriler = request('kategoriler');
        $this->validate(request(),[
            'fiyateski' => 'numeric|min:0',
            'fiyat' => 'numeric|min:0',
            'images.*' => 'mimes:jpg,png,jpeg',
            'ad' => 'unique:App\Models\Urunler,urun_adi,'.$id
        ]);
        if(empty($kategoriler))
            return redirect()->back()->withInput()->with(['tur'=>'error','title'=>'Hata','message'=>'Kategori Boş Girilemez']);
        else{

            if(request('onecikan') == 0)
                $sira = null;
            else{
                $sira = request('onecikansira');
                $findsira = Urunler::where('urun_onecikansira',$sira)->first();
                if(!is_null($findsira)){
                    $yedek = Urunler::where('id',$id)->first()->urun_onecikansira;
                    $findsira->urun_onecikansira = $yedek;
                    $findsira->save();
                }
            }

            //Sıra bozuldu eksik sırayı tamamla
            if(Urunler::where('id',$id)->first()->urun_onecikan == 1 && request('onecikan') == 0){
                $yedek = Urunler::where('id',$id)->first()->urun_onecikansira;
                for($i=$yedek+1; $i <= count(Urunler::where('urun_onecikan',1)->get()); $i++){
                    $sirala = Urunler::where('urun_onecikansira',$i)->first();
                    $sirala->urun_onecikansira = $sirala->urun_onecikansira-1;
                    $sirala->save();
                }
            }

            //Ürün güncelle
            $slugify = new Slugify();
            $urun = Urunler::where('id',$id)->first();
            $urun->urun_adi = request('ad');
            $urun->urun_seo_baslik = request('seobaslik');
            $urun->urun_seo_anahtar = request('seoanahtar');
            $urun->slug = $slugify->slugify(request('ad'));
            $urun->urun_aciklama = request('aciklama');
            $urun->urun_fiyat = request('fiyat');
            $urun->urun_eskifiyat = request('fiyateski');
            $urun->urun_onecikan = request('onecikan');
            $urun->urun_onecikansira = $sira;
            $urun->save();

            //Tüm Kategorileri Sil
            $sil = urunKategori::where('urun_id',$id)->delete();

            //kategorileri ekle
            $kategoriler = request('kategoriler');
            foreach ($kategoriler as $kategori){
                $yeni_urun_kategori = new urunKategori();
                $yeni_urun_kategori->urun_id = $id;
                $yeni_urun_kategori->kategori_id = $kategori;
                $yeni_urun_kategori->save();
            }

            //Resim Yükle
            if(is_null(urunResim::orderBy('id','desc')->where('urun_id',$id)->first()))
                $sonResimID = "--1.";
            else
                $sonResimID = urunResim::orderBy('id','desc')->where('urun_id',$id)->first()->resim_path;

            function getStringBetween($str,$from,$to){
                $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
                return substr($sub,0,strpos($sub,$to));
            }
            $sonID = getStringBetween($sonResimID,'-','.');
            if(request()->hasfile('images'))
            {
                foreach(request()->file('images') as $index=>$file)
                {
                    $sonID++;
                    $name = $id.'-'.$sonID.'.'.$file->extension();
                    $file->move(public_path().'/assets/images/urunler', $name);
                    $resim_ekle = new urunResim();
                    $resim_ekle->urun_id = $id;
                    $resim_ekle->resim_path = $name;
                    $resim_ekle->save();
                }
            }

            //Varyantları Güncelle
            $varyantColor = request("varyantRenk");
            $varyantSize = request("varyantBoyut");
            $varyantPrice = request("varyantFiyat");
            $varyantImages = array();
            if(isset($varyantPrice) && count($varyantPrice)>0){
                $getVariants = Varyantlar::where('urun_id',$id)->get();
                foreach($getVariants as $vimg){
                    array_push($varyantImages,$vimg->varyant_resim);
                }
                
                $varyantlar = Varyantlar::where('urun_id',$id)->delete();
                for($i=0;$i<count($varyantPrice);$i++){
                    $varyant = new Varyantlar();
                    $varyant->urun_id=$id;
                    $varyant->varyant_renk = $varyantColor[$i];
                    $varyant->varyant_boyut = $varyantSize[$i];
                    $varyant->varyant_fiyat = $varyantPrice[$i];
                    $varyant->varyant_resim = @$varyantImages[$i];
                    
                    if(isset(request()->file('varyantResim')[$i])){
                        $file = request()->file('varyantResim')[$i];
                        $name = "v-".$id."-".$file->getClientOriginalName();
                        $file->move(public_path().'/assets/images/urunler', $name);
                        $varyant->varyant_resim = $name;
                    }
                    $varyant->save();
                }
            }
            
            return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Ürün Başarıyla Güncellendi']);

        }
    }
    public function resimSil($id){
        $resim = urunResim::where('resim_path',$id)->firstOrFail();
        $image_path = "assets/images/urunler/$resim->resim_path";
        if (file_exists($image_path)) {
            @unlink($image_path);
        }
        $resim->delete();

        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Ürün Başarıyla Güncellendi']);
    }
    public function sil($id){
        $resimler = Urunler::find($id)->Resimler()->get();
        $varyantlar = Varyantlar::where('urun_id',$id)->get();
        foreach($resimler as $resim){
            $image_path = "assets/images/urunler/$resim->resim_path";
            if (file_exists($image_path)) {
                @unlink($image_path);
            }
        }
        foreach($varyantlar as $varyant){
            $image_path = "assets/images/urunler/$varyant->varyant_resim";
            if (file_exists($image_path)) {
                @unlink($image_path);
            }
        }
        $urunsil = Urunler::where('id',$id)->delete();
        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Ürün Başarıyla Silindi']);
    }

    public function hepsiburada(){
        return view("hepsiburada");
    }
    public function hepsiburadaForm(){
        $url = request("link");

        function curl_ttHepsi($url){

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_PROXY, "185.255.94.87:1447");
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, "prox2222:BW0c8y34ot");

            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                'accept-language: tr-TR,tr;q=0.9',
                'sec-ch-ua:  Not A;Brand;v=99, Chromium;v=96, Google Chrome;v=96',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: Windows',
                'sec-fetch-dest: document',
                'sec-fetch-mode: navigate',
                'sec-fetch-site: none',
                'sec-fetch-user: ?1',
                'upgrade-insecure-requests: 1',
                'Content-Type:  text/plain',
                'Connection: keep-alive',
            ));
            curl_setopt($ch, CURLOPT_ENCODING , "gzip");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL,$url);
            $data = curl_exec($ch);
            curl_close($ch);

            return $data;
        }
        function curl_tt($url){

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_PROXY, "185.255.94.87:1447");
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, "prox2222:BW0c8y34ot");
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


            $headers = array();
            $headers[] = "Accept: application/json";
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                'accept-language: tr-TR,tr;q=0.9',
                'sec-ch-ua:  Not A;Brand;v=99, Chromium;v=96, Google Chrome;v=96',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: Windows',
                'sec-fetch-dest: document',
                'sec-fetch-mode: navigate',
                'sec-fetch-site: none',
                'sec-fetch-user: ?1',
                'upgrade-insecure-requests: 1',

                'Connection: keep-alive',
            ));

            $data = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close ($ch);

            return $data;
        }
        function myUrlEncode($string) {
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
            return str_replace($entities, $replacements, urlencode($string));
        }
        function clear($text,$id="0"){
            if($id=="1")
                $text = $text;
            else
                $text = trim(strip_tags($text));
            $text = str_replace("'", "", $text);
            return $text;
        }


        $urlcheck = myUrlEncode($url);
        $dataHepsi = curl_ttHepsi(myUrlEncode($url));
        preg_match_all('@<meta itemprop="sku" content="(.*?)"@si',$dataHepsi,$stok);
        $stock = $stok[1][0];


        //Get Product
        $data = curl_tt(myUrlEncode("https://www.hepsiburada.com/product/sku/".$stock));
        $data = json_decode($data);

        $baslik = $data->product->name;
        if(is_null($baslik)){
            return redirect()->back()->withInput()->with(['tur'=>'error','title'=>'Hata','message'=>'Ürün Bulunamadı.']);
            exit;
        }
        $fiyat = str_replace(',', '.', str_replace('.', '', str_replace(' TL', '', $data->product->listings[0]->priceText)));
        $aciklama = $data->product->description;
        $ozellikler = "";
        $resimler = array();
        $kategori = array();
        $variantName2 = array();
        $variantColor2 = array();
        $variantPrice2 = array();
        $variantThumbnail2 = array();
        if(count($data->product->variants) == 0)
            $variant = false;
        else
            $variant = true;

        //Resimler
        foreach ($data->product->allImages as $key => $value) {
            array_push($resimler, str_replace('{size}', '1500', $value->url));
        }

        //Ürün Özellikleri
        foreach ($data->product->techSpec[0]->properties as $key => $value) {
            $ozellikler .= $value->name." : ".$value->property."<br>";
        }

        //Kategoriler
        foreach ($data->product->categories as $key => $value) {
            array_push($kategori, $value->categoryName);
        }

        //Varyantlar
        foreach ($data->product->variants as $key => $fdata) {
            foreach ($fdata->properties as $key => $value) {
                if($value->name != "Renk"){
                    $valV = $value->valueObject->actualValue;
                    $valV = str_replace(' ', '', $valV);
                    $valV = str_replace('Standart', 'One Size', $valV);
                    $valV = str_replace('cmx', 'x', $valV);
                    array_push($variantName2, $valV);
                }
                else
                    array_push($variantColor2, $value->valueObject->actualValue);
            }
            array_push($variantPrice2, $fdata->price->value);
            array_push($variantThumbnail2, str_replace('{size}', '1500', $fdata->thumbnailNotFormatted));
        }

        //Aynı Varyantları Silme
        $variantControl = array();
        $removeVariant = array();
        for ($i=0; $i <max(count($variantName2),count($variantColor2)); $i++) {
            array_push($variantControl, @$variantColor2[$i]."-".@$variantName2[$i]);
        }
        $variantControl = array_unique($variantControl);
        for ($i=0; $i <max(count($variantName2),count($variantColor2)); $i++) {
            if(!isset($variantControl[$i]))
                array_push($removeVariant, $i);
        }
        foreach ($removeVariant as $key => $value) {
            if(isset($variantName2[$value]))
                unset($variantName2[$value]);
            if(isset($variantColor2[$value]))
                unset($variantColor2[$value]);
            if(isset($variantPrice2[$value]))
                unset($variantPrice2[$value]);
            if(isset($variantThumbnail2[$value]))
                unset($variantThumbnail2[$value]);
        }
        $variantName2 = array_values($variantName2);
        $variantColor2 = array_values($variantColor2);
        $variantPrice2 = array_values($variantPrice2);
        $variantThumbnail2 = array_values($variantThumbnail2);

        //Ürün ekle
        $slugify = new Slugify();
        $urun = new Urunler();
        $urun->urun_adi = clear($baslik);
        $urun->slug = $slugify->slugify(clear($baslik));
        $urun->urun_aciklama = trim(clear($aciklama,"1"));
        $urun->urun_eskifiyat = clear($fiyat);
        $urun->urun_fiyat = clear($fiyat);
        $urun->urun_onecikan = 0;
        $urun->urun_pazaryeri = myUrlEncode($url);
        $urun->save();

        $urunid = $urun->id;

        //Ürün Resmi Ekle
        foreach($resimler as $value){
            $urun_resim = new urunResim();
            $urun_resim->urun_id = $urunid;
            $urun_resim->resim_path = $value;
            $urun_resim->save();
        }

        //Varyantları Ekle
        foreach ($variantThumbnail2 as $key => $value) {
            $varyant = new Varyantlar();
            $varyant->urun_id = $urunid;
            $varyant->varyant_renk = @$variantColor2[$key];
            $varyant->varyant_boyut = @$variantName2[$key];
            $varyant->varyant_fiyat = clear(@$variantPrice2[$key]);
            $varyant->varyant_resim = @$variantThumbnail2[$key];
            $varyant->save();
        }

        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Ürün Başarıyla Eklendi']);

    }
    public function yorumlar(){
        $yeniYorumlar = Yorumlar::orderBy("id","desc")->where("yorum_onay",0)->paginate(24);
        $onayliYorumlar = Yorumlar::orderBy("id","desc")->where("yorum_onay",1)->paginate(24);

        $countYeni = count(Yorumlar::orderBy("id","desc")->where("yorum_onay",0)->get());
        $countOnayli = count(Yorumlar::orderBy("id","desc")->where("yorum_onay",1)->get());

        return view("yorumlar",compact("yeniYorumlar","onayliYorumlar","countYeni","countOnayli"));
    }
    public function yorumDetay($id){
        $yorum = Yorumlar::where('id',$id)->firstOrFail();
        return view('yorum-detay',compact('yorum'));
    }
    public function yorumDetayForm($id){
        $yorum = Yorumlar::where("id",$id)->firstOrFail();
        $yorum->yorum = request("yorum");
        $yorum->save();
        return redirect()->route("yorumlar")->with(["tur"=>"success","title"=>"Başarılı","message"=>"Yorum Başarıyla Düzenlendi"]);
    }
    public function yorumSil($id){
        $yorum = Yorumlar::where('id',$id)->firstOrFail();
        $yorum->delete();
        return redirect()->route("yorumlar")->with(['tur'=>'success','title'=>'Başarılı','message'=>'Yorum Başarıyla Silindi']);
    }
    public function yorumOnay($id){
        $yorum = Yorumlar::where('id',$id)->firstOrFail();
        $yorum->yorum_onay = "1";
        $yorum->save();
        return redirect()->route("yorumlar")->with(['tur'=>'success','title'=>'Başarılı','message'=>'Yorum Başarıyla Onaylandı']);
    }
    public function Toplu(){
        $type = request("type");
        
        foreach (request('checkbox') as $id){
            $yorum = Yorumlar::where('id',$id)->first();
            if($type=="1")
                $yorum->delete();
            else{
                $yorum->yorum_onay = "1";
                $yorum->save();
            }
        }
        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Yorumlar Başarıyla İşlendi']);
    }


}
