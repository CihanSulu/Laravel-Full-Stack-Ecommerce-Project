<!--====== preloader Start ======-->

<div class="preloader" style="display:none;">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>

<!--====== preloader Ends ======-->

<!--====== Header Start ======-->

<header class="header-area position-fixed shadow w-100 bg-white" style="z-index:9999;">

    <div class="header-navbar2">
        <div class="container-fluid custom-container">
            <div class="header-wrapper d-flex justify-content-between align-items-center" style="padding:15px 0;">

                <div class="header-logo">
                    <a href="{{route('index')}}">
                        <h1 class="mylogo"><img src="/assets/images/logo.svg" alt="Ürün Satın Al" height="40px" width="40px"> {{$site}}</h1>
                    </a>
                </div>

                <div class="header-menu site-nav d-none d-lg-block">
                    <ul class="main-menu">
                        <li><a href="{{route('index')}}">Anasayfa</a></li>
                        @php
                            $category = \App\Models\Kategori::get();
                        @endphp
                        @foreach($category as $item )
                            <li><a href="{{route('category',$item->slug)}}">{{$item->kategori_adi}}</a></li>
                        @endforeach
                        <li><a href="{{route('contact')}}">İletişim</a></li>
                    </ul>
                </div>

                <div class="header-meta">
                    <ul class="meta">
                        <li><span class="noa cart-toggle"><i class="far fa-Shopping-cart"></i><span>{{Cart::count()}}</span></span></li>
                        <li><span class="noa search-toggle"><i class="far fa-search"></i></span></li>
                        <li><span class="noa sidebar-toggle"><i class="fal fa-bars"></i></span></li>
                    </ul>
                </div>

            </div>
        </div>

        <div id="dl-menu" class="dl-menuwrapper d-lg-none">
            <button class="dl-trigger" aria-label="Menü"></button>

            <ul class="dl-menu">
                <li><a href="{{route('index')}}">Anasayfa</a></li>
                @php
                    $category = \App\Models\Kategori::get();
                @endphp
                @foreach($category as $item )
                    <li><a href="{{route('category',$item->slug)}}">{{$item->kategori_adi}}</a></li>
                @endforeach
                <li><a href="{{route('contact')}}">İletişim</a></li>
            </ul>
        </div>
    </div>

</header>

<!--====== Header Ends ======-->


<!--====== Search Start ======-->

<div class="search-wrapper">
    <div class="search-box">
        <span class="cursor search-close"><i class="fal fa-times"></i></span>
        <div class="search-form">
            <label>Tüm Ürünlerde Arama Yapın</label>
            <div class="search-input">
                <form action="{{route('search')}}" method="get">
                    {{csrf_field()}}
                    <input type="text" placeholder="ARAMA YAPIN…" name="e">
                    <button><i class="far fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--====== Search Ends ======-->

<!--====== Off Canvas Cart Start ======-->

<div class="off-canvas-cart-wrapper">
    <div class="off-canvas-cart-box">
        <span class="cursor cart-close"><i class="fal fa-times"></i></span>
        <div class="off-canvas-cart-content">
            <div class="cart-title">
                <p class="title">Alışveriş Sepetim</p>
            </div>
            <div class="cart-product-widget">
                <ul>
                    @foreach(Cart::content() as $item)
                        <li>
                            <div class="cart-product d-flex">
                                <div class="cart-product-image">
                                    <a href="{{route('product',[$item->options->slug,$item->options->slug2])}}"><img src="{{$url}}/assets/images/urunler/{{$item->options->image}}" alt="{{$item->name}}"></a>
                                </div>
                                <div class="cart-product-content media-body">
                                    <h6 class="title"><a href="{{route('product',[$item->options->slug,$item->options->slug2])}}">{{$item->name}}</a></h6>
                                    <span class="price">{{$item->qty}}x <span>{{$item->price}} ₺</span></span>
                                </div>
                                <a href="{{route('sepet.sil',$item->rowId)}}" class="product-cancel"><i class="fal fa-times"></i></a>
                            </div>
                        </li>
                    @endforeach

                </ul>
                <div class="cart-product-total">
                    <p class="value">Toplam</p>
                    <p class="price">{{Cart::subtotal()}} ₺</p>
                </div>
                <div class="cart-product-btn">
                    <a href="{{route('sepet')}}" class="main-btn btn-block">Sepete Git</a>
                    @if(Cart::count()%2 != 1 && Cart::count()!=0)
                        <a href="{{route('checkout')}}" class="main-btn btn-block">ÖDEMEYE GEÇ</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!--====== Off Canvas Cart Ends ======-->

<!--====== Off Canvas Sidebar Start ======-->

<div class="off-canvas-sidebar">
    <div class="off-canvas-sidebar-wrapper">
        <span class="cursor sidebar-close"><i class="fal fa-times"></i></span>
        <div class="off-canvas-sidebar-box">
            <a class="logo" href="{{route('index')}}">
                <h1 class="mylogo"><img src="/assets/images/logo.svg" alt="Ürün Satın Al" height="40px" width="40px"> {{$site}}</h1>
            </a>
            <p class="text">
                @php
                    $panel = \App\Models\Ayarlar::first();
                @endphp
                {!! $panel->site_hakkinda !!}
            </p>
            <ul class="sidebar-social">
                <li><a href="#" name="Facebook" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#" name="Twitter" aria-label="Twitter"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#" name="Instagram" aria-label="Instagram"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#" name="Youtube" aria-label="Youtube"><i class="fab fa-youtube"></i></a></li>
            </ul>
            <ul class="sidebar-info">
                @if(!is_null($tel))
                <li>
                    <div class="single-info">
                        <div class="info-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="info-content">
                            <p><a href="https://api.whatsapp.com/send?phone={{ (isset($tel[0])) ? ($tel[0] == '9') ? str_replace([' ','(',')'],'',$tel) : '9'.str_replace([' ','(',')'],'',$tel) : '' }}&amp;text= Ürün Siparişi Vermek İstiyorum." target="_blank">{{$tel}}</a></p>
                        </div>
                    </div>
                </li>
                @endif
                <li>
                    <div class="single-info">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            @php $mail = strtolower(str_replace(array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' '),array('c','c','g','g','i','i','o','o','s','s','u','u',''),$site).'.com'); @endphp
                            <p><a href="mailto://info{{'@'.$mail}}">info{{ '@'.$mail }}</a></p>
                        </div>
                    </div>
                </li>
            </ul>
            <p class="copyright" style="color:#000 !important";>&copy; Copyright 2020  <a href="{{route('index')}}">{{$site}}</a></p>
        </div>
    </div>
</div>

<!--====== Off Canvas Sidebar Ends ======-->
