@extends('layouts.master')
@section('title','Sepetim | '.$site)


@section('top')
    @include("layouts.partical.header-top2")
@endsection
@section('content')
        <!-- Start Cart Area  -->
        <div class="axil-product-cart-area axil-section-gap">
            <div class="container">
                <div class="axil-product-cart-wrap">
                    @if(Cart::count()==0)
                        <div class="nocart">
                            <h4 class="title">Sepetinizde Ürün Bulunmamaktadır.</h4>
                            <a href="{{route('products')}}" class="axil-btn btn-bg-secondary right-icon">Alışverişe Dön <i class="fal fa-long-arrow-right"></i></a>
                        </div>
                    @endif

                    <div class="product-table-heading {{(Cart::count()==0) ? 'd-none':'' }}">
                        <h4 class="title">Sepetim</h4>
                    </div>
                    <div class="table-responsive {{(Cart::count()==0) ? 'd-none':'' }}">
                        <table class="table axil-product-table axil-cart-table mb--40">
                            <thead>
                                <tr>
                                    <th scope="col" class="product-remove"></th>
                                    <th scope="col" class="product-thumbnail">Ürün</th>
                                    <th scope="col" class="product-title"></th>
                                    <th scope="col" class="product-subtotal">Fiyat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Cart::content() as $item)
                                    <tr>
                                        <td class="product-remove"><a href="{{route('sepet.sil',$item->rowId)}}" class="remove-wishlist"><i class="fal fa-times"></i></a></td>
                                        <td class="product-thumbnail"><a href="{{route('product',[$item->options->slug,$item->options->slug2])}}"><img src="{{$url}}/assets/images/urunler/{{$item->options->image}}" alt="{{$item->name}}"></a></td>
                                        <td class="product-title"><a href="{{route('product',[$item->options->slug,$item->options->slug2])}}">{{$item->name}}</a></td>
                                        <td class="product-subtotal" data-title="Subtotal" style="color :#000;">{{$item->price}} ₺</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row {{(Cart::count()==0) ? 'd-none':'' }}">
                        <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
                            <div class="axil-order-summery">
                                <h5 class="title mb--20">Sepet Toplamı</h5>
                                <div class="summery-table-wrap">
                                    <table class="table summery-table mb--30">
                                        <tbody>
                                            <tr class="order-subtotal">
                                                <td>Alışveriş Tutarı</td>
                                                <td>{{Cart::subtotal()}} ₺</td>
                                            </tr>
                                            <tr class="order-shipping">
                                                <td>Kargo</td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="radio" id="radio1" name="shipping" checked>
                                                        <label for="radio1">Ücretsiz Kargo </label>
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
                                <a href="{{route('checkout')}}" class="axil-btn btn-bg-primary checkout-btn">Alışverişi Tamamla</a>
                                <!--@if(Cart::count()%2 != 1 && Cart::count()!=0)
                                    <a href="{{route('checkout')}}" class="axil-btn btn-bg-primary checkout-btn">Alışverişi Tamamla</a>
                                @else
                                    <p class="text-success text-center">Alışverişi tamamlamak için lütfen hediye ürününüzü sepete ekleyin.</p>
                                @endif-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Cart Area  -->

@endsection