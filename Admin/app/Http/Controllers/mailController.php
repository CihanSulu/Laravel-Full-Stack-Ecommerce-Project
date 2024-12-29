<?php

namespace App\Http\Controllers;

use App\Models\Mailler;
use Illuminate\Http\Request;

class mailController extends Controller
{
    public function index(){
        $gelen = Mailler::orderBy('id','desc')->where('okundu',0)->get();
        $okunmus = Mailler::orderBy('id','desc')->where('okundu',1)->get();
        $silinen = Mailler::orderBy('id','desc')->where('okundu',2)->get();
        return view('iletisim',compact('gelen','okunmus','silinen'));
    }
    public function detay($id){
        $mail = Mailler::where('id',$id)->firstOrFail();
        return view('iletisim-detay',compact('mail'));
    }
    public function sil($id){
        $mail = Mailler::where('id',$id)->firstOrFail();
        $mail->okundu = 2;
        $mail->save();
        return redirect()->route('mailler')->with(['tur'=>'success','title'=>'Başarılı','message'=>'Mail başarıyla silindi']);
    }
    public function topluSil(){
        foreach (request('checkbox') as $id){
            $mail = Mailler::where('id',$id)->first();
            $mail->okundu = 2;
            $mail->save();
        }
        return redirect()->route('mailler')->with(['tur'=>'success','title'=>'Başarılı','message'=>'Mailler başarıyla silindi']);
    }
}
