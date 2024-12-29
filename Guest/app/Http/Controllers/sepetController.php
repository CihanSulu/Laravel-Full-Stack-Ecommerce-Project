<?php

namespace App\Http\Controllers;

use App\Models\siparisler;
use App\Models\Urunler;
use App\Models\siparisUrun;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use CanAvci\Shopier\Shopier;
use CanAvci\Shopier\BillingAddress;
use CanAvci\Shopier\ShippingAddress;
use CanAvci\Shopier\Person;
use Illuminate\Routing\Route;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Mail;
use App\Mail\siparisMail;
use Illuminate\Support\Facades\Http;

class sepetController extends Controller
{
    public function index(){
        return view('cart');
    }
    public function checkout(){
        if(Cart::count() == 0)
            return redirect()->route('sepet');

        return view('checkout');
    }

    public function checkoutForm(Request $request)
    {
        $this->validate(request(),[
            'phone'=>'numeric|min:10',
            'adress'=>'min:10'
        ]);

        $agent = new Agent();
        $cihaz = "";
        if($agent->isMobile())
            $cihaz = "Mobile";
        else if($agent->isTablet())
            $cihaz = "Tablet";
        else if($agent->isDesktop())
            $cihaz = "Desktop";
        else
            $cihaz = "Unknown";

        $siparis = new siparisler();
        $siparis->ad = request('name');
        $siparis->soyad = request('surname');
        $siparis->tel = request('phone');
        $siparis->sehir = request('sehir');
        $siparis->ilce = request('ilce');
        $siparis->adres = request('adress');
        $siparis->fiyat = Cart::subtotal();
        $siparis->odeme = request('odemetipi');
        $siparis->siparis_not = request('note');
        $siparis->kategori = 11;
        $siparis->website = $_SERVER['SERVER_NAME'];
        $siparis->cihaz = $cihaz;
        $siparis->save();

        $lastId = $siparis->id;


        foreach(Cart::content() as $item){
            $siparis_urun = new siparisUrun();
            $siparis_urun->siparis_id = $siparis->id;
            $siparis_urun->urun_id = $item->options->id;
            $siparis_urun->siparis_adet = $item->qty;
            $siparis_urun->save();
        }

        //Cart::destroy();

        $merchant_id = '481974';
        $merchant_key = 'ymNXya33RLSQuHFs';
        $merchant_salt = '6o8nWrHoTPKoaJQK';
        
        $email = $request->input('email');
        $payment_amount = Cart::subtotal() * 100; 
        $merchant_oid = $lastId; 
        $user_name = $request->input('name') . ' ' . $request->input('surname');
        $user_address = $request->input('adress');
        $user_phone = $request->input('phone');
        $merchant_ok_url = route('payment.success');
        $merchant_fail_url = route('payment.fail');

        $user_basket = [];
        foreach (Cart::content() as $item) {
            $user_basket[] = [
                $item->name, 
                $item->price, 
                $item->qty
            ];
        }
        $user_basket = base64_encode(json_encode($user_basket));

        $user_ip = $request->ip();
        $timeout_limit = "30";
        $debug_on = 1;
        $test_mode = 0;
        $no_installment = 0;
        $max_installment = 0;
        $currency = "TL";

        $hash_str = $merchant_id . $user_ip . $merchant_oid . $email . $payment_amount . $user_basket . $no_installment . $max_installment . $currency . $test_mode;
        $paytr_token = base64_encode(hash_hmac('sha256', $hash_str . $merchant_salt, $merchant_key, true));

        $post_vals = [
            'merchant_id' => $merchant_id,
            'user_ip' => $user_ip,
            'merchant_oid' => $merchant_oid,
            'email' => $email,
            'payment_amount' => $payment_amount,
            'paytr_token' => $paytr_token,
            'user_basket' => $user_basket,
            'debug_on' => $debug_on,
            'no_installment' => $no_installment,
            'max_installment' => $max_installment,
            'user_name' => $user_name,
            'user_address' => $user_address,
            'user_phone' => $user_phone,
            'merchant_ok_url' => $merchant_ok_url,
            'merchant_fail_url' => $merchant_fail_url,
            'timeout_limit' => $timeout_limit,
            'currency' => $currency,
            'test_mode' => $test_mode
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/api/get-token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // sadece geliştirme aşamasında

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            // Hata detaylarını gösterir
            die("PAYTR IFRAME connection error. err: " . curl_error($ch));
        }

        curl_close($ch);

        $result = json_decode($result, true);

        if ($result['status'] === 'success') {
            $token = $result['token'];
            return view('paytr', compact('token'));
        } else {
            return redirect()->back()->with('error', 'PAYTR IFRAME failed. reason:' . $result['reason']);
        }
    }

    public function orderSuccess(){
        return "ok";
    }

    public function orderFail(){
        return "no";
    }


    public function ccc(){
        $siparis = siparisler::where('id',request('platform_order_id'))->firstOrFail();
        if($siparis->kategori !=11)
            return redirect()->route('index');
        if(request('status')=="success"){
            $siparis->kategori = 1;
            $siparis->save();
            Cart::destroy();
        }
        else{
            $siparis->delete();
        }
        return view('success');
    }
    public function ekle($id){
        $hediye = "";

        if(is_null(request('hediye')))
            $hediye = "evet"; //boş
        else
            $hediye = request('hediye'); //dolu

        $count = Cart::count();
        $urun = Urunler::where('id',$id)->firstorFail();
        $kategori = Urunler::find($urun->id)->Kategoriler()->first();
        $resim = Urunler::find($urun->id)->Resimler()->first();
        $fiyat = $urun->urun_fiyat;

        Cart::add($count+1,$urun->urun_adi,1,$fiyat,1,['slug'=>$kategori->slug,'slug2'=>$urun->slug,'image'=>$resim->resim_path,'id'=>$urun->id]);
        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Ürün Sepete Başarıyla Eklendi.']);

        /*if($count%2 == 1)
            $fiyat = 0;
        else
            $fiyat = $urun->urun_fiyat;

        if($hediye=="evet"){
            return redirect()->route('gift',$id)->with(['tur'=>'success','title'=>'Başarılı','message'=>'Lütfen HEDİYE Ürününüzü Seçin.']);
        }
        else{
            Cart::add($count+1,$urun->urun_adi,1,$fiyat,1,['slug'=>$kategori->slug,'slug2'=>$urun->slug,'image'=>$resim->resim_path,'id'=>$urun->id]);
            //Cart::add($count+2,$urun->urun_adi,1,0,1,['slug'=>$kategori->slug,'slug2'=>$urun->slug,'image'=>$resim->resim_path,'id'=>$urun->id]);
            return redirect()->route('sepet')->with(['tur'=>'success','title'=>'Başarılı','message'=>'Ürün Sepete Başarıyla Eklendi.']);
        }*/
    }
    public function ekleHediye($id,$id2){
        $count = Cart::count();
        $urun = Urunler::where('id',$id)->firstorFail();
        $urun2 = Urunler::where('id',$id2)->firstorFail();
        $kategori = Urunler::find($urun->id)->Kategoriler()->first();
        $kategori2 = Urunler::find($urun2->id)->Kategoriler()->first();
        $resim = Urunler::find($urun->id)->Resimler()->first();
        $resim2 = Urunler::find($urun2->id)->Resimler()->first();

        Cart::add($count+1,$urun->urun_adi,1,$urun->urun_fiyat,1,['slug'=>$kategori->slug,'slug2'=>$urun->slug,'image'=>$resim->resim_path,'id'=>$urun->id]);
        Cart::add($count+2,$urun2->urun_adi,1,0,1,['slug'=>$kategori2->slug,'slug2'=>$urun2->slug,'image'=>$resim2->resim_path,'id'=>$urun2->id]);
        return redirect()->route('sepet')->with(['tur'=>'success','title'=>'Başarılı','message'=>'Ürün Sepete Başarıyla Eklendi.']);
    }
    public function sil($id){
        $cart = Cart::get($id);
        /*if($cart->id % 2 == 0) // hediye ise
            $family = Cart::content()->where('id', $cart->id-1);
        else // hediye değilse
            $family = Cart::content()->where('id', $cart->id+1);*/

        /*if(count($family) != 0)
            Cart::remove($family->first()->rowId);*/

        Cart::remove($id);
        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Ürün Sepetten Başarıyla Silindi.']);
    }
    public function bosalt(){
        Cart::destroy();
        return redirect()->back()->with(['tur'=>'success','title'=>'Başarılı','message'=>'Sepet Başarıyla Temizlendi.']);
    }
}
