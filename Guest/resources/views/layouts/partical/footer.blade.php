<div class="service-area">
        <div class="container">
            <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1 row--20 pt-5">
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="/assets/images/icons/service1.png" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Ücretsiz &amp; Kargo</h6>
                            <p>Türkiye’nin her yerine ücretsiz olarak gönderim yapıyoruz. Kargonuz 1-3 gün içersinde belirtmiş olduğunuz adreste olacaktır.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="/assets/images/icons/service2.png" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Kapıda Ödeme</h6>
                            <p>Tüm siparişlerinizi Kapıda Nakit Ödeme veya Kapıda Kredi Kartı seçeneği ile yolluyoruz.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="/assets/images/icons/service3.png" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">70% Varan İndirimler</h6>
                            <p>Sitemizde yer alan tüm ürünlerimiz kaliteli olup %70'e varan büyük sezon indirimi ile sizinle.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="/assets/images/icons/service4.png" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">İade Garantisi</h6>
                            <p>Ürünlerimizin arkasında duruyoruz. 14 Gün içerisinde iade alıyoruz. Detaylı bilgi için Whatsapp destek hattımızdan 7/24 bilgi alabilirsiniz.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Footer Area  -->
    <footer class="axil-footer-area footer-style-2">
        <!-- Start Footer Top Area  -->
        <div class="footer-top separator-top">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Start Single Widget  -->
                    <div class="col-lg-5 col-sm-6">
                        <div class="axil-footer-widget">
                            <div class="logo mb--30">
                                <a href="index.html">
                                    <img class="light-logo" src="/assets/images/logo/logo.png" alt="Logo Images">
                                </a>
                            </div>
                            <div class="inner">
                                @php
                                    $hakkinda = \App\Models\Ayarlar::get()->first();
                                @endphp
                                <p style="font-size:14px;color:#fff;">{{strip_tags($hakkinda->site_hakkinda)}}</p>
                                <ul class="quick-link">
                                    <li>© COPYRİGHT 2020 <a href="{{route('index')}}" style="font-size:12px">{{$site}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget  -->
                    <!-- Start Single Widget  -->
                    <div class="col-lg-7 col-sm-6">
                        <div class="footer-menu text-center mt-30">
                            <ul class="menu">
                                <li class="mb-2"><a href="http://localhost:3000">Anasayfa</a></li>
                                @php
                                    $category = \App\Models\Kategori::get();
                                @endphp
                                @foreach($category as $item )
                                    <li class="mb-2"><a href="{{route('category',$item->slug)}}">{{$item->kategori_adi}}</a></li>
                                @endforeach
                                <li class="mb-2"><a href="{{route('contact')}}">İletişim</a></li>
                                <!--<li class="mb-2 d-none"><a href="#" name="sozlesme" aria-label="Satın Alma Sözleşmesi">Satın Alma Sözleşmesi</a></li>
                                <li class="mb-2 d-none"><a href="#" name="gizlilik" aria-label="Gizlilik Sözleşmesi">Gizlilik Anlaşması</a></li>-->
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Widget  -->
                </div>
            </div>
        </div>
        <!-- End Footer Top Area  -->
    </footer>
<!-- End Footer Area  -->

    <!-- Header Search Modal End -->
    <div class="header-search-modal" id="header-search-modal">
        <button class="card-close sidebar-close"><i class="fas fa-times"></i></button>
        <div class="header-search-wrap">
            <div class="card-header">
                <form action="{{route('search')}}" method="get" style="padding-bottom:0px !important;">
                    {{csrf_field()}}
                    <div class="input-group">
                        <input type="search" class="form-control" name="e" id="prod-search" placeholder="Arama Yapın">
                        <button type="button" class="axil-btn btn-bg-primary"><i class="far fa-search"></i></button>
                    </div>
                    <div class="input-group mt-3">
                        <button type="submit" class="axil-btn btn-bg-primary searchbtn">Arama Yapın</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Header Search Modal End -->



    <div class="cart-dropdown" id="cart-dropdown">
        <div class="cart-content-wrap">
            <div class="cart-header">
                <h2 class="header-title">Alışveriş Sepetim</h2>
                <button class="cart-close sidebar-close"><i class="fas fa-times"></i></button>
            </div>
            <div class="cart-body">
                <ul class="cart-item-list">

                    @if(Cart::count() == 0)
                        <h4>Sepetinizde Ürün Bulunamadı.</h4>
                    @endif

                    @foreach(Cart::content() as $item)
                        <li class="cart-item">
                            <div class="item-img">
                                <a href="{{route('product',[$item->options->slug,$item->options->slug2])}}"><img src="{{$url}}/assets/images/urunler/{{$item->options->image}}" alt="{{$item->name}}"></a>
                                <a href="{{route('sepet.sil',$item->rowId)}}" class="close-btn" style="text-align:center;padding-top:4px;"><i class="fas fa-times"></i></a>
                            </div>
                            <div class="item-content">
                                <h3 class="item-title"><a href="{{route('product',[$item->options->slug,$item->options->slug2])}}">{{$item->name}}</a></h3>
                                <div class="item-price">{{$item->price}} ₺</div>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
            <div class="cart-footer">
                <h3 class="cart-subtotal">
                    <span class="subtotal-title">Toplam:</span>
                    <span class="subtotal-amount">{{Cart::subtotal()}} ₺</span>
                </h3>
                <div class="group-btn {{ (Cart::count()%2 != 1 && Cart::count()!=0) ? '':'d-block'}}">
                    @if(Cart::count()%2 != 1 && Cart::count()!=0)
                        <a href="{{route('sepet')}}" class="axil-btn btn-bg-primary viewcart-btn w-100">Sepete Git</a>
                    @else
                        <a href="{{route('sepet')}}" class="axil-btn btn-bg-primary viewcart-btn w-100">Sepete Git</a>
                    @endif
                    @if(Cart::count()%2 != 1 && Cart::count()!=0)
                        <a href="{{route('checkout')}}" class="axil-btn btn-bg-secondary checkout-btn">Siparişi Tamamla</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Whatsapp Icon Start -->
    @if(!is_null($tel))
    <div class="container-fluid custom-whatsapp">
        <div class="row">
            <div class="col pb-2">
                <div class="wsk-float">
                    <a href="https://api.whatsapp.com/send?phone={{ (isset($tel[0])) ? ($tel[0] == '9') ? str_replace([' ','(',')'],'',$tel) : '9'.str_replace([' ','(',')'],'',$tel) : '' }}&amp;text= Ürün Siparişi Vermek İstiyorum." class="pulse-button" target="_blank"></a>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Whatsapp Icon End -->

    <!-- JS
============================================ -->
    <!-- Modernizer JS -->
    <script src="/assets/js/vendor/modernizr.min.js"></script>
    <!-- jQuery JS -->
    <script src="/assets/js/vendor/jquery.js"></script>
    <!-- Bootstrap JS -->
    <script src="/assets/js/vendor/popper.min.js"></script>
    <script src="/assets/js/vendor/bootstrap.min.js"></script>
    <script src="/assets/js/vendor/slick.min.js"></script>
    <script src="/assets/js/vendor/js.cookie.js"></script>
    <!-- <script src="/assets/js/vendor/jquery.style.switcher.js"></script> -->
    <script src="/assets/js/vendor/jquery-ui.min.js"></script>
    <script src="/assets/js/vendor/jquery.ui.touch-punch.min.js"></script>
    <script src="/assets/js/vendor/jquery.countdown.min.js"></script>
    <script src="/assets/js/vendor/sal.js"></script>
    <script src="/assets/js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/vendor/imagesloaded.pkgd.min.js"></script>
    <script src="/assets/js/vendor/isotope.pkgd.min.js"></script>
    <script src="/assets/js/vendor/counterup.js"></script>
    <script src="/assets/js/vendor/waypoints.min.js"></script>

    <!-- Main JS -->
    <script src="/assets/js/main.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script>
        @if(session()->has('tur'))
            iziToast.{{session('tur')}}({
                title: '{{session('title')}}',
                message: '{{session('message')}}',
                position:'topLeft',
            });
        @endif

        @if($errors->any()){
            @foreach($errors->all() as $error)
            iziToast.error({
                title: 'Hata',
                message: '{{$error}}',
                position:'topLeft',
            });
            @endforeach
        }
        @endif

    </script>
    <script>

        setInterval(function(){
            var random1 = Math.floor((Math.random() * 81) + 0);
            var random2 = data[random1]['ilceleri'].length;
            var randomSehir = data[random1]['il'];
            var randomIlce = data[random1]['ilceleri'][Math.floor((Math.random() * random2) + 0)];

            iziToast.success({
                title: 'Yeni Sipariş',
                message: randomSehir + " / " + randomIlce + " 1 Sipariş Verildi",
                position:'bottomRight',
                icon:'far fa-Shopping-cart',
                balloon:true,
            });
        }, {{rand(60000,180000)}});
    </script>
    
    
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="b9bc8876-d100-452e-b50a-1f6f41f89e8a";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>