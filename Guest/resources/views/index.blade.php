@extends('layouts.master')
@section('title',"Türkiye'nin Lider Pet Sitesi | Tüm ürünlerde %80'e Varan İndirim | Kanmaz Pet")

@section('top')
    @include("layouts.partical.header-top3")
@endsection

@section('content')
            

        <!-- Start Slider Area -->
        <div class="axil-best-seller-product-area bg-color-white axil-section-gap pb--0" style="padding:0px !important">
            <div class="container-fluid">
                <div class="product-area">
                    <div class="slider-content-activation-one slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide product-slide-mobile" style="padding-bottom:10px;">

                        @foreach($slider as $sliderItem)
                        <div class="slick-single-layout text-center p-0">
                            <img src="{{$url}}/assets/images/slider/{{$sliderItem->resim_path}}">
                        </div>
                        @endforeach
 
                        

                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="axil-best-seller-product-area bg-color-white axil-section-gap pb--0">
            <div class="container">
                <div class="product-area">
                    <div class="section-title-wrapper">
                        <h2 class="title">Kategoriler</h2>
                    </div>
                    <div class="new-arrivals-product-activation-3 slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide product-slide-mobile" style="padding-bottom:10px;">

                        @foreach($imgCategories as $imgCat)
                        <div class="slick-single-layout text-center">
                            <a href="/{{$imgCat->slug}}">
                                <div class="card categories">
                                    <div class="card-body categoriesCard">
                                        <img class="img-fluid" src="{{$url}}/assets/images/categories/{{$imgCat->category_image}}" alt="product categorie">
                                        <h6 class="cat-title">{{$imgCat->kategori_adi}}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
 
                        

                    </div>
                </div>
            </div>
        </div>
        <!-- End Slider Area -->

        <!-- Start Axil Product Poster Area  -->
        <div class="axil-poster axil-section-gap pb--0">
            <div class="container">
                <div class="row g-lg-5 g-4">
                    <div class="col-lg-6">
                        <div class="single-poster">
                            <a href="#">
                                <img src="/assets/images/banners/10.png" alt="">
                                <div class="poster-content d-none">
                                    <div class="inner">
                                        <h3 class="title">Premimum <br> Quality.</h3>
                                        <span class="sub-title">Collections <i class="fal fa-long-arrow-right"></i></span>
                                    </div>
                                </div>
                                <!-- End .poster-content -->
                            </a>
                        </div>
                        <!-- End .single-poster -->
                    </div>
                    <div class="col-lg-6">
                        <div class="single-poster">
                            <a href="#">
                                <img src="/assets/images/banners/11.png" alt="">
                                <div class="poster-content content-left d-none">
                                    <div class="inner">
                                        <span class="sub-title">50% Offer In Winter</span>
                                        <h3 class="title">Get Exclusive <br> Diamond</h3>
                                    </div>
                                </div>
                                <!-- End .poster-content -->
                            </a>
                        </div>
                        <!-- End .single-poster -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Axil Product Poster Area  -->


        <!-- Start Best Sellers Product Area  -->
        <div class="axil-best-seller-product-area bg-color-white axil-section-gap pb--0">
            <div class="container">
                <div class="product-area pb--50">
                    <div class="section-title-wrapper">
                        <span class="title-highlighter highlighter-primary"> <i class="far fa-shopping-basket"></i>Popüler Ürünler</span>
                        <h2 class="title">En Çok Satanlar</h2>
                    </div>
                    <div class="new-arrivals-product-activation-2 slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide product-slide-mobile">

                        @foreach($popular as $item)
                            @php
                                $image = \App\Models\urunResim::where('urun_id',$item->id)->orderBy('id','desc')->first();
                                $product_category = \App\Models\Urunler::find($item->id)->Kategoriler()->first();
                            @endphp
                            <div class="slick-single-layout">
                                <div class="axil-product product-style-three">
                                    <div class="thumbnail">
                                        <a href="{{route('product',[$product_category->slug,$item->slug])}}">
                                            <img data-sal="fade" data-sal-delay="100" data-sal-duration="1500" src="{{$url}}/assets/images/urunler/{{$image->resim_path}}" alt="{{$item->urun_adi}}">
                                        </a>
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
                                            <div class="product-rating">
                                                <span class="icon">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            </div>
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
        </div>
        <!-- End  Best Sellers Product Area  -->


        <!-- Start Expolre Product Area  -->
        <div class="axil-product-area bg-color-white axil-section-gap pb--0">
            <div class="container">
                <div class="product-area pb--80">
                    <div class="section-title-wrapper">
                        <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i> Ürünlerimiz</span>
                        <h2 class="title">Tüm Ürünlerimiz</h2>
                    </div>
                    <div class="row row--15">

                        @foreach($products as $item)
                            @php
                                $image = \App\Models\urunResim::where('urun_id',$item->id)->orderBy('id','desc')->first();
                                $product_category = \App\Models\Urunler::find($item->id)->Kategoriler()->first();
                            @endphp
                            <div class="col-xl-3 col-lg-4 col-sm-6 col-6 mb--30">
                                <div class="axil-product product-style-one">
                                    <div class="thumbnail">
                                        <a href="{{route('product',[$product_category->slug,$item->slug])}}">
                                            <img data-sal="fade" data-sal-delay="100" data-sal-duration="1500" src="{{$url}}/assets/images/urunler/{{$image->resim_path}}" alt="{{$item->urun_adi}}">
                                        </a>
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
                        @endforeach

                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center mt--20 mt_sm--0">
                            <a href="{{route('products')}}" class="axil-btn btn-bg-lighter btn-load-more">Tüm Ürünleri Görüntüle</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Expolre Product Area  -->


         <!-- Start Testimonila Area  -->
         <div class="axil-testimoial-area axil-section-gap bg-vista-white d-none">
            <div class="container">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-secondary"> <i class="fal fa-quote-left"></i>Testimonials</span>
                    <h2 class="title">Users Feedback</h2>
                </div>
                <!-- End .section-title -->
                <div class="testimonial-slick-activation testimonial-style-one-wrapper slick-layout-wrapper--20 axil-slick-arrow arrow-top-slide">
                    <div class="slick-single-layout testimonial-style-one">
                        <div class="review-speech">
                            <p>“ It’s amazing how much easier it has been to
                                meet new people and create instantly non
                                connections. I have the exact same personal
                                the only thing that has changed is my mind
                                set and a few behaviors. “</p>
                        </div>
                        <div class="media">
                            <div class="thumbnail">
                                <img src="/assets/images/testimonial/image-1.png" alt="testimonial image">
                            </div>
                            <div class="media-body">
                                <span class="designation">Head Of Idea</span>
                                <h6 class="title">James C. Anderson</h6>
                            </div>
                        </div>
                        <!-- End .thumbnail -->
                    </div>
                    <!-- End .slick-single-layout -->
                    <div class="slick-single-layout testimonial-style-one">
                        <div class="review-speech">
                            <p>“ It’s amazing how much easier it has been to
                                meet new people and create instantly non
                                connections. I have the exact same personal
                                the only thing that has changed is my mind
                                set and a few behaviors. “</p>
                        </div>
                        <div class="media">
                            <div class="thumbnail">
                                <img src="/assets/images/testimonial/image-2.png" alt="testimonial image">
                            </div>
                            <div class="media-body">
                                <span class="designation">Head Of Idea</span>
                                <h6 class="title">James C. Anderson</h6>
                            </div>
                        </div>
                        <!-- End .thumbnail -->
                    </div>
                    <!-- End .slick-single-layout -->
                    <div class="slick-single-layout testimonial-style-one">
                        <div class="review-speech">
                            <p>“ It’s amazing how much easier it has been to
                                meet new people and create instantly non
                                connections. I have the exact same personal
                                the only thing that has changed is my mind
                                set and a few behaviors. “</p>
                        </div>
                        <div class="media">
                            <div class="thumbnail">
                                <img src="/assets/images/testimonial/image-3.png" alt="testimonial image">
                            </div>
                            <div class="media-body">
                                <span class="designation">Head Of Idea</span>
                                <h6 class="title">James C. Anderson</h6>
                            </div>
                        </div>
                        <!-- End .thumbnail -->
                    </div>
                    <!-- End .slick-single-layout -->
                    <div class="slick-single-layout testimonial-style-one">
                        <div class="review-speech">
                            <p>“ It’s amazing how much easier it has been to
                                meet new people and create instantly non
                                connections. I have the exact same personal
                                the only thing that has changed is my mind
                                set and a few behaviors. “</p>
                        </div>
                        <div class="media">
                            <div class="thumbnail">
                                <img src="/assets/images/testimonial/image-2.png" alt="testimonial image">
                            </div>
                            <div class="media-body">
                                <span class="designation">Head Of Idea</span>
                                <h6 class="title">James C. Anderson</h6>
                            </div>
                        </div>
                        <!-- End .thumbnail -->
                    </div>
                    <!-- End .slick-single-layout -->

                </div>
            </div>
        </div>
        <!-- End Testimonila Area  -->

@endsection