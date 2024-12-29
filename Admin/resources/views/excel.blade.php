@extends('layouts.master')
@section('title','Sipariş Excelleri')

@section('header')
    <style>
        table{width:100% !important;}
        .table tr td, .table tr th{white-space: none !important;max-width:500px !important;}
    </style>
@endsection

@section('content')

    <div id="main-content">
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table js-exportable">
                                    <thead>
                                    <tr>
                                        <th>Isim</th>
                                        <th>İlce</th>
                                        <th>Il</th>
                                        <th>Adres</th>
                                        <th>Telefon</th>
                                        <th>Kurye</th>
                                        <th>Mus_Barkod</th>
                                        <th>Fiyat</th>
                                        <th>Urun</th>
                                        <th>Adet</th>
                                        <th>Desi</th>
                                        <th>Ambalaj</th>
                                        <th>Tahsilat</th>
                                        <th>Odeme</th>
                                        <th>KDV</th>
                                        <th>Siparis_No</th>
                                        <th>Ptt veya ups veya aras barkod</th>
                                        <th>Plasiyer</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Isim</th>
                                        <th>İlce</th>
                                        <th>Il</th>
                                        <th>Adres</th>
                                        <th>Telefon</th>
                                        <th>Kurye</th>
                                        <th>Mus_Barkod</th>
                                        <th>Fiyat</th>
                                        <th>Urun</th>
                                        <th>Adet</th>
                                        <th>Desi</th>
                                        <th>Ambalaj</th>
                                        <th>Tahsilat</th>
                                        <th>Odeme</th>
                                        <th>KDV</th>
                                        <th>Siparis_No</th>
                                        <th>Ptt veya ups veya aras barkod</th>
                                        <th>Plasiyer</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($onayliSiparisler as $siparis)
                                        @php
                                            $urunler = \App\Models\siparisler::find($siparis->id)->Urunler()->get();
                                            $urunlistesi = "";
                                            foreach($urunler as $index=>$urun){
                                                $adet = \App\Models\siparisUrun::where('siparis_id',$siparis->id)->where('urun_id',$urun->id)->first();
                                                $urunlistesi .= $urun->urun_adi." [".$adet->siparis_adet." Adet]";
                                                if($index!=count($urunler)-1)
                                                    $urunlistesi .=" / "."\n";
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{$siparis->ad}} {{$siparis->soyad}}</td>
                                            <td>{{$siparis->sehir}}</td>
                                            <td>{{$siparis->ilce}}</td>
                                            <td>{{$siparis->adres}}</td>
                                            <td>{{$siparis->tel}}</td>
                                            <td>BEY</td>
                                            <td></td>
                                            <td>{{$siparis->fiyat}}</td>
                                            <td>{{$urunlistesi}}</td>
                                            <td>1</td>
                                            <td></td>
                                            <td>2</td>
                                            <td>6</td>
                                            <td></td>
                                            <td>8</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('footer')
    <script>
        $(document).ready(function(){
            $('.buttons-excel').click();
            setTimeout(function(){ window.close(); }, 500);
        });
    </script>
@endsection
