@extends('layouts.master')
@section('title','Sipariş Pdfleri')

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
                                        <th>İsim Soyisim</th>
                                        <th>Telefon</th>
                                        <th>Adres</th>
                                        <th>Ödeme</th>
                                        <th>Ürünler</th>
                                        <th>Fiyat</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>İsim Soyisim</th>
                                        <th>Telefon</th>
                                        <th>Adres</th>
                                        <th>Ödeme</th>
                                        <th>Ürünler</th>
                                        <th>Fiyat</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($onayliSiparisler as $siparis)
                                        @php
                                            $urunler = \App\Models\siparisler::find($siparis->id)->Urunler()->get();
                                        @endphp
                                        <tr>
                                            <td>{{$siparis->ad}} {{$siparis->soyad}}</td>
                                            <td>{{$siparis->tel}}</td>
                                            <td>{{$siparis->adres}} <br> {{$siparis->sehir}} / {{$siparis->ilce}}</td>
                                            <td>{{$siparis->odeme}}</td>
                                            <td>
                                                <ul>
                                                @foreach($urunler as $index=>$urun)
                                                        @php
                                                            $adet = \App\Models\siparisUrun::where('siparis_id',$siparis->id)->where('urun_id',$urun->id)->first();
                                                        @endphp
                                                    <li>{{$urun->urun_adi}} [{{$adet->siparis_adet}} Adet] {{($index!=count($urunler)-1) ? '/':''}}</li>
                                                @endforeach
                                                </ul>
                                            </td>
                                            <td>{{$siparis->fiyat}} ₺</td>
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
            $('.buttons-print').click();
            setTimeout(function(){ window.close(); }, 1000);
        });
    </script>
@endsection
