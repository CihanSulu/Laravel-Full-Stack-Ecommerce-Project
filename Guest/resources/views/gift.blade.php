@extends('layouts.master')
@php
    if(!isset($category)){
        $category = new \App\Models\Kategori();
        if(!is_null(request('e')))
            $category->kategori_adi = "Arama Sonuçları";
        else
            $category->kategori_adi = "Hediye Ürününüzü Seçin";
    }
@endphp
@section('title',$category->kategori_adi.' | '.$site)

@section('top')
    @include("layouts.partical.header-top2")
@endsection
@section('content')

    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="inner">
                            <ul class="axil-breadcrumb">
                                <li class="axil-breadcrumb-item"><a href="{{route('index')}}">Anasyfa</a></li>
                                <li class="separator"></li>
                                <li class="axil-breadcrumb-item active" aria-current="page"><a href="{{ (is_null(request('e')) && isset($category->slug)) ? route('category',$category->slug) : '' }}">{{$category->kategori_adi}}</a></li>
                            </ul>
                            <h1 class="title">{{$category->kategori_adi}}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <div class="inner">
                            <div class="bradcrumb-thumb">
                                <img src="/assets/images/product/product-45.png" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb Area  -->
        <!-- Start Shop Area  -->
        <div class="axil-shop-area axil-section-gap bg-color-white shop-page">
            <div class="container">
                <div class="row row--15">

                    @foreach($products as $item)
                        @php
                            $image = \App\Models\urunResim::where('urun_id',$item->id)->orderBy('id','desc')->first();
                            $product_category = \App\Models\Urunler::find($item->id)->Kategoriler()->first();
                        @endphp
                        @if($category->kategori_adi == "Hediye Ürününüzü Seçin")
                            <div class="col-xl-3 col-lg-4 col-6">
                                <div class="axil-product product-style-one has-color-pick mt--40">
                                    <div class="thumbnail">
                                        <a href="{{route('sepet.ekle.hediye',[$id,$item->id])}}">
                                            <img data-sal="fade" data-sal-delay="100" data-sal-duration="1500" src="{{$url}}/assets/images/urunler/{{$image->resim_path}}" alt="{{$item->urun_adi}}">
                                        </a>
                                        <div class="label-block label-left">
                                            <img src="/assets/images/layer1.png" class="layer layer1" alt="Tester Parfüm 2 Al 1 Öde Kapıda Ödeme" title="Tester Parfüm 2 Al 1 Öde Kapıda Ödeme">
                                        </div>
                                        <div class="label-block label-right">
                                            <img src="/assets/images/layer2.png" class="layer layer1" alt="Tester Parfüm 2 Al 1 Öde Kapıda Ödeme" title="Tester Parfüm 2 Al 1 Öde Kapıda Ödeme">
                                        </div>
                                        <div class="product-hover-action">
                                            <ul class="cart-action">
                                                <li class="wishlist"><a href="{{route('sepet.ekle.hediye',[$id,$item->id])}}"><i class="far fa-heart"></i></a></li>
                                                <li class="select-option"><a href="{{route('sepet.ekle.hediye',[$id,$item->id])}}">Sepete Ekle</a></li>
                                                <li class="quickview"><a href="{{route('sepet.ekle.hediye',[$id,$item->id])}}" data-bs-toggle="modal" data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="inner">
                                            <h5 class="title"><a href="{{route('sepet.ekle.hediye',[$id,$item->id])}}">{{$item->urun_adi}}</a></h5>
                                            <div class="product-price-variant">
                                                
                                                <span class="price current-price">0.00 ₺</span>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product  -->

                        @else
                            <div class="col-xl-3 col-lg-4 col-6">
                                <div class="axil-product product-style-one has-color-pick mt--40">
                                    <div class="thumbnail">
                                        <a href="{{route('product',[$product_category->slug,$item->slug])}}">
                                            <img data-sal="fade" data-sal-delay="100" data-sal-duration="1500" src="{{$url}}/assets/images/urunler/{{$image->resim_path}}" alt="{{$item->urun_adi}}">
                                        </a>
                                        <div class="label-block label-left">
                                            <img src="/assets/images/layer1.png" class="layer layer1" alt="Tester Parfüm 2 Al 1 Öde Kapıda Ödeme" title="Tester Parfüm 2 Al 1 Öde Kapıda Ödeme">
                                        </div>
                                        <div class="label-block label-right">
                                            <img src="/assets/images/layer2.png" class="layer layer1" alt="Tester Parfüm 2 Al 1 Öde Kapıda Ödeme" title="Tester Parfüm 2 Al 1 Öde Kapıda Ödeme">
                                        </div>
                                        <div class="product-hover-action">
                                            <ul class="cart-action">
                                                <li class="wishlist"><a href="{{route('product',[$product_category->slug,$item->slug])}}"><i class="far fa-heart"></i></a></li>
                                                <li class="select-option"><a href="{{route('product',[$product_category->slug,$item->slug])}}">Sepete Ekle</a></li>
                                                <li class="quickview"><a href="{{route('product',[$product_category->slug,$item->slug])}}" data-bs-toggle="modal" data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="inner">
                                            <h5 class="title"><a href="{{route('product',[$product_category->slug,$item->slug])}}">{{$item->urun_adi}}</a></h5>
                                            <div class="product-price-variant">
                                                <span class="price old-price">{{$item->urun_eskifiyat}} ₺</span>
                                                <span class="price current-price">{{$item->urun_fiyat}} ₺</span>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product  -->
                        @endif
                    @endforeach
                    
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="pagination-items {{(!is_null(request('e'))) ? 'd-block':''}}">
                        <ul class="pagination justify-content-center">
                                @php 
                                    if(request()->has('page'))
                                        $page = request('page');
                                    else
                                        $page = 1;

                                    $sonSayfa = ceil($total_products/24);
                                @endphp
                                @if($total_products > 24)
                                    @php $x = 4; @endphp
                                    @if($page > 1)
                                        @php $onceki = $page-1; @endphp
                                        <li><a class="prev" href="{{request('slug')}}?page={{$onceki}}">Önceki</a></li>
                                    @endif
                                    @if($page == 1)
                                        <li><a href="javascript:void(0);" class="active">1</a></li>
                                    @else
                                        <li><a href="{{request('slug')}}?page=1">1</a></li>
                                    @endif

                                    @if($page-$x > 2)
                                        <li><a href="javascript:void(0);">...</a></li>
                                        @php $i = $page-$x; @endphp
                                    @else
                                        @php $i=2; @endphp
                                    @endif


                                    @for($i; $i<=$page+$x; $i++)
                                        @if($i==$page)
                                            <li><a href="javascript:void(0);" class="active">{{$i}}</a></li>
                                        @else
                                            <li><a href="{{request('slug')}}?page={{$i}}">{{$i}}</a></li>
                                        @endif
                                        @if($i == $sonSayfa)
                                            @php break; @endphp
                                        @endif
                                    @endfor

                                    @if($page+$x < $sonSayfa-1)
                                        <li><a href="javascript:void(0);">...</a></li>
                                        <li><a href="{{request('slug')}}?page={{$sonSayfa}}">{{$sonSayfa}}</a></li>
                                    @elseif($page+$x == $sonSayfa-1)
                                        <li><a href="{{request('slug')}}?page={{$sonSayfa}}">{{$sonSayfa}}</a></li>
                                    @endif

                                    @if($page < $sonSayfa)
                                        <li><a class="next" href="{{request('slug')}}?page={{$page+1}}">Sonraki</a></li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End .container -->
        </div>
    <!-- End Shop Area  -->

@endsection