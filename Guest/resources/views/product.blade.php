@extends('layouts.master')
@section('title',$product->urun_adi.' | '.$site)
@section('description','En Uygun Fiyatlı '.$product->urun_adi.', '.$product->urun_adi.' Satın Al')
@section('keywords',$product->urun_adi.' Satın Al, '.$product->urun_adi.' Tester Satın Al, En Ucuz '.$product->urun_adi)


@section('top')
    @include("layouts.partical.header-top2")
@endsection
@section('content')
    <!-- Start Shop Area  -->
        <div class="axil-single-product-area axil-section-gap pb--0 bg-color-white">
            <div class="single-product-thumb mb--40">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 mb--40">
                            <div class="row">
                                <div class="col-lg-10 order-lg-2">
                                    <div class="single-product-thumbnail-wrap zoom-gallery">

                                        <div class="single-product-thumbnail product-large-thumbnail-3 axil-product">

                                            @foreach($images as $index=>$item)
                                                <div class="thumbnail">
                                                    <a href="{{$url}}/assets/images/urunler/{{$item->resim_path}}" class="popup-zoom">
                                                        <img src="{{$url}}/assets/images/urunler/{{$item->resim_path}}" alt="{{$product->urun_adi}}">
                                                    </a>
                                                </div>
                                            @endforeach
        
                                        </div>
                                        
                                        <div class="label-block single-badget d-none">
                                            <div class="product-badget">Ücretsiz Kargo</div>
                                            <div class="product-badget">Kapıda Ödeme</div>
                                        </div>
                                        <div class="product-quick-view position-view">
                                            <a href="{{$url}}/assets/images/urunler/{{$item->resim_path}}" class="popup-zoom">
                                                <i class="far fa-search-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 order-lg-1">
                                    <div class="product-small-thumb-3 small-thumb-wrapper">

                                        @foreach($images as $index=>$item)
                                            <div class="small-thumb-img">
                                                <img src="{{$url}}/assets/images/urunler/{{$item->resim_path}}" alt="{{$product->urun_adi}}">
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb--40">
                            <div class="single-product-content">
                                <div class="inner">
                                    <h2 class="product-title">{{$product->urun_adi}}</h2>

                                    <span class="price-amount"><sup><del>{{$product->urun_eskifiyat}} ₺</del></sup>  <span class="text-success mprice"> {{$product->urun_fiyat}} ₺</span></span>
                                    <div class="product-rating">
                                        <div class="star-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="review-link">
                                            <a href="javascript:void(0);" id="targetComments">(<span>{{count($comments)}}</span> Yorum yapıldı)</a>
                                        </div>
                                    </div>
                                    <ul class="product-meta">
                                        <li><i class="fal fa-check"></i>💯 Orjinal Ürün</li>
                                        <li><i class="fal fa-check"></i>💰 10 Yıllık Deneyim</li>
                                        <li><i class="fal fa-check"></i>🚛 Ücretsiz Kargo</li>
                                        <li><i class="fal fa-check"></i>♻️ Değişim Mevcuttur</li>
                                    </ul>
                                    <h6 class="mt-4 text-dark shadow p-3 rounded font-weight-bold text-center" style="border:1px dashed #e74c3c;">
                                        <img src="/assets/images/custom/patpat.png" class="d-inline-block" style="margin-top:-15px;height:30px;" alt="%70 İndirimli Ürün Kampanyası Hemen Al" title="%70 İndirimli Ürün Kampanyası Hemen Al">
                                        <span class="text-danger">BÜYÜK KAMPANYADA SON GÜNLER</span>
                                        <img src="/assets/images/custom/patpat.png" class="d-inline-block" style="margin-top:-15px;height:30px;" alt="%70 İndirimli Ürün Kampanyası Hemen Al" title="%70 İndirimli Ürün Kampanyası Hemen Al">
                                        <br>
                                        <br>Bu üründe %80e varan indirim devam etmektedir. Yararlanmak için ürünü sepetinize ekleyin.
                                    </h6>

                                    <!-- Start Product Action Wrapper  -->
                                    <div class="product-action-wrapper d-flex-center">
                                        <ul class="product-action product-change d-flex-center mb--0">
                                            <form action="{{route('sepet.ekle',$product->id)}}" method="get" class="w-50 d-none">
                                                {{csrf_field()}}
                                                <input type="hidden" value="{{$product->id}}" name="id">
                                                <input type="hidden" value="evet" name="hediye">
                                                <li class="add-to-cart"><button class="axil-btn btn-bg-primary">EVET</button></li>
                                            </form>
                                            <form action="{{route('sepet.ekle',$product->id)}}" method="get" class="w-100">
                                                {{csrf_field()}}
                                                <input type="hidden" value="{{$product->id}}" name="id">
                                                <input type="hidden" value="hayir" name="hediye">
                                                <li class="add-to-cart"><button class="axil-btn btn-bg-primary">SEPETE EKLE</button></li>
                                            </form>
                                        </ul>
                                    </div>
                                    <!-- End Product Action Wrapper  -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End .single-product-thumb -->

            <div class="woocommerce-tabs wc-tabs-wrapper bg-vista-white">
                <div class="container">
                    <ul class="nav tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="active" id="description-tab" data-bs-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Ürün Açıklaması</a>
                        </li>
                        <li class="nav-item" role="presentation" id="reviews-tab-btn">
                            <a id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Yorumlar ({{count($comments)}})</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            <div class="product-desc-wrapper">
                                <div class="row">
                                    <div class="col-lg-6 mb--30">
                                        <div class="single-desc">
                                            <h5 class="title">Türkiye'nin lider <b>alışveriş</b> sitesinden kaçırılmayacak fırsat ile <b><u>{{$product->urun_adi}}</u></b></h5>
                                            {!! substr($product->urun_aciklama,strpos($product->urun_aciklama,'<div class="container contain-lg-5 contain-md-4 contain-sm-5">')) !!}
                                        </div>
                                    </div>
                                    <!-- End .col-lg-6 -->
                                    <div class="col-lg-6 mb--30">
                                    <img src="{{$url}}/assets/images/urunler/{{$images->first()->resim_path}}" alt="{{$product->urun_adi}}" class="img-fluid">
                                    </div>
                                    <!-- End .col-lg-6 -->
                                </div>
                                <!-- End .row -->
                            </div>
                            <!-- End .product-desc-wrapper -->
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="reviews-wrapper">
                                <div class="row">
                                    <div class="col-lg-6 mb--40">
                                        <div class="axil-comment-area pro-desc-commnet-area">
                                            <h5 class="title">Ürün İçin {{count($comments)}} Yorum Yapıldı</h5>
                                            <ul class="comment-list">

                                            @foreach($comments as $item)
                                                <!-- Start Single Comment  -->
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <div class="single-comment">
                                                            <div class="comment-img">
                                                                <img src="/assets/images/custom/auhtor-2.png" alt="Author Images">
                                                            </div>
                                                            <div class="comment-inner">
                                                                <h6 class="commenter">
                                                                    <span class="hover-flip-item-wrapper" >
                                                                        <span class="hover-flip-item">
                                                                            <span data-text="Cameron Williamson"></span>
                                                                        </span>
                                                                    </span>
                                                                    <span class="commenter-rating ratiing-four-star">
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                    </span>
                                                                </h6>
                                                                <small class="mdate">{{date('d-m-Y - H:i:s', strtotime($item->yorum_date))}}</small>
                                                                <div class="comment-text">
                                                                    <p>“{{$item->yorum}}” </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- End Single Comment  -->
                                                @endforeach

                                            </ul>
                                        </div>
                                        <!-- End .axil-commnet-area -->
                                    </div>
                                    <!-- End .col -->
                                    <div class="col-lg-6 mb--40">
                                        <!-- Start Comment Respond  -->
                                        <div class="comment-respond pro-des-commend-respond mt--0">
                                            <h5 class="title mb--30">Ürünü Puanla Ve Yorum Yap</h5>
                                            <div class="rating-wrapper d-flex-center mb--40">
                                                Puanınız <span class="require">*</span>
                                                <div class="reating-inner ml--20">
                                                    <a href="javascript:void(0);" data-id="1" class="starclick"><i class="fas fa-star text-warning"></i></a>
                                                    <a href="javascript:void(0);" data-id="2" class="starclick"><i class="fas fa-star text-warning"></i></a>
                                                    <a href="javascript:void(0);" data-id="3" class="starclick"><i class="fas fa-star text-warning"></i></a>
                                                    <a href="javascript:void(0);" data-id="4" class="starclick"><i class="fas fa-star text-warning"></i></a>
                                                    <a href="javascript:void(0);" data-id="5" class="starclick"><i class="fas fa-star text-warning"></i></a>
                                                </div>
                                            </div>

                                            <form action="{{route('comment')}}" method="post">
                                                {{csrf_field()}}
                                                <input type="hidden" name="star" value="5" id="star">
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Yorumunuz</label>
                                                            <textarea name="comment" placeholder="Yorum Yapın" required=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label>İsim <span class="require">*</span></label>
                                                            <input id="name" type="text" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label>Soyisim <span class="require">*</span> </label>
                                                            <input id="email" type="text" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-submit">
                                                            <button type="submit" id="submit" class="axil-btn btn-bg-primary w-auto">Yorum Yap</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- End Comment Respond  -->
                                    </div>
                                    <!-- End .col -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- woocommerce-tabs -->

        </div>
        <!-- End Shop Area  -->

        <!-- Start Recently Viewed Product Area  -->
        <div class="axil-product-area bg-color-white axil-section-gap pb--50 pb_sm--30">
            <div class="container">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i> Aynı Kategoride</span>
                    <h2 class="title">Benzer Çok Satanlar</h2>
                </div>
                <div class="recent-product-activation slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">

                    @foreach($popular as $item)
                        @php
                            $image = \App\Models\urunResim::where('urun_id',$item->id)->orderBy('id','desc')->first();
                            $product_category = \App\Models\Urunler::find($item->id)->Kategoriler()->first();
                        @endphp
                        <div class="slick-single-layout">
                            <div class="axil-product">
                                <div class="thumbnail">
                                    <a href="{{route('product',[$product_category->slug,$item->slug])}}">
                                        <img data-sal="fade" data-sal-delay="100" data-sal-duration="1500" src="{{$url}}/assets/images/urunler/{{$image->resim_path}}" alt="{{$item->urun_adi}}">
                                    </a>
                                    <div class="label-block label-left">
                                        <img src="/assets/images/layer1.png" class="layer layer1" alt="" title="">
                                    </div>
                                    <div class="label-block label-right">
                                        <img src="/assets/images/layer2.png" class="layer layer1" alt="" title="">
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
                        <!-- End .slick-single-layout -->
                    @endforeach

                </div>
            </div>
        </div>
    <!-- End Recently Viewed Product Area  -->
@endsection