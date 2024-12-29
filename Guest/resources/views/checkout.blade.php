@extends('layouts.master')
@section('title','Alışverişi Tamamla | '.$site)

@section('top')
    @include("layouts.partical.header-top2")
@endsection
@section('content')

<!-- Start Checkout Area  -->
        <div class="axil-checkout-area axil-section-gap">
            <div class="container">
                <form action="{{route('checkoutForm')}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="axil-checkout-billing">
                                
                                <div class="axil-checkout-notice">
                                    @if($errors->any())
                                        @foreach($errors->all() as $error)
                                            <div class="axil-toggle-box">
                                                <div class="toggle-bar bg-danger text-white"><i class="fas fa-times"></i> <strong>HATA:</strong> {{$error}} </a></div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <h4 class="title mb--40">Adres Bilgileri</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Ödeme Şekli <span>*</span></label>
                                            <select name="odemetipi">
                                                <option value="Kapıda Kredi Kartı">Kapıda Kredi Kartı</option>
                                                <option value="Kapıda Nakit Ödeme">Kapıda Nakit Ödeme</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>İsim <span>*</span></label>
                                            <input type="text" id="first-name" name="name" value="{{old('name')}}" required="" placeholder="İsminiz">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Soyisim <span>*</span></label>
                                            <input type="text" id="last-name" name="surname" value="{{old('surname')}}" required="" placeholder="Soyisminiz">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Telefon Numarası <span>*</span></label>
                                            <input type="text" name="phone" id="company-name" value="{{old('phone')}}" required="" placeholder="Telefon Numaranız">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Email Adresiniz <span>*</span></label>
                                            <input type="email" name="email" id="company-name" value="{{old('email')}}" required="" placeholder="Email Adresiniz">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Şehir <span>*</span></label>
                                            <select id="Iller" name="iller" required="">
                                                <option value="">İl *</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" id="formsehir" value="" name="sehir">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>İlçe <span>*</span></label>
                                            <select id="Ilceler" disabled="disabled" name="ilce" required="">
                                                <option value="">İlçe *</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Açık Adres <span>*</span></label>
                                            <textarea name="adress" rows="2" placeholder="Adresiniz" required="">{{old('adress')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Sipariş Notu</label>
                                            <textarea name="note" rows="1" style="min-height:100px;background-color:#f7f7f7;" placeholder="Bize iletmek istediğiniz sipariş notunuz.">{{old('note')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="axil-order-summery order-checkout-summery">
                                <h5 class="title mb--20">Sipariş Özeti</h5>
                                <div class="summery-table-wrap">
                                    <table class="table summery-table">
                                        <thead>
                                            <tr>
                                                <th>Ürün</th>
                                                <th>Fiyat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(Cart::content() as $item)
                                                <tr class="order-product">
                                                    <td><a href="{{route('product',[$item->options->slug,$item->options->slug2])}}" target="_blank">{{$item->name}}</a></td>
                                                    <td>{{$item->price}} ₺</td>
                                                </tr>
                                            @endforeach
                                            <tr class="order-shipping">
                                                <td colspan="2">
                                                    <div class="shipping-amount">
                                                        <span class="title">Kargo</span>
                                                        <span class="amount">0.00 ₺</span>
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="radio" id="radio1" name="shipping" checked>
                                                        <label for="radio1">Ücretsiz Kargo</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <td>Toplam</td>
                                                <td class="order-total-amount">{{Cart::subtotal()}} ₺</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="axil-btn btn-bg-primary checkout-btn">ÖDEMEYİ TAMAMLA</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Checkout Area  -->

@endsection