<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <div class="bar4"></div>
        <div class="bar5"></div>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<div id="wrapper">

    <nav class="navbar top-navbar">
        <div class="container-fluid">

            <div class="navbar-left">
                <div class="navbar-btn">
                    <a href="index.html"><img src="/assets/images/icon.svg" alt="Oculux Logo" class="img-fluid logo"></a>
                    <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
                </div>
                <ul class="nav navbar-nav">
                    @php
                        $mailler = \App\Models\Mailler::where('okundu',0)->get();
                    @endphp
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                            <i class="icon-envelope"></i>
                            <span class="notification-dot bg-green">{{count($mailler)}}</span>
                        </a>
                        <ul class="dropdown-menu right_chat email vivify fadeIn">
                            <li class="header green">{{count($mailler)}} Yeni Mail Var</li>
                            @if(count($mailler)==0)
                                <p class="text-center mb-1">Yeni bir mail yok.</p>
                            @endif
                            @foreach($mailler as $mail)
                                <li>
                                    <a href="{{route('mailler')}}">
                                        <div class="media">
                                            <div class="avtar-pic w35 bg-red"><span>{{substr($mail->mail_ad,0,1).substr($mail->mail_soyad,0,1)}}</span></div>
                                            <div class="media-body">
                                                <span class="name">{{$mail->mail_ad}} <small class="float-right text-muted">{{substr($mail->tarih,10,20)}}</small></span>
                                                <span class="message">1 yeni mail</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @php
                        $yorumlar = \App\Models\Yorumlar::where('yorum_onay',0)->get();
                    @endphp
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                            <i class="fa fa-comments" aria-hidden="true"></i>
                            <span class="notification-dot bg-warning">{{count($yorumlar)}}</span>
                        </a>
                        <ul class="dropdown-menu right_chat email vivify fadeIn">
                            <li class="header orange">{{count($yorumlar)}} Yeni Yorum Var</li>
                            @if(count($yorumlar)==0)
                                <p class="text-center mb-1">Yeni bir yorum yok.</p>
                            @endif
                            @foreach($yorumlar as $yorum)
                                <li>
                                    <a href="{{route('yorumlar')}}">
                                        <div class="media">
                                            <div class="media-body">
                                                <span class="name">{{substr($yorum->yorum,0,70)}}... <small class="float-right text-muted">{{substr($yorum->yorum_date,10,20)}}</small></span>
                                                <span class="message">1 yeni yorum</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown">
                        @php
                            $yenisiparisCount = count(\App\Models\siparisler::orderBy('id','desc')
                                ->where('kategori',1)->get());
                            $yeni_siparisler = \App\Models\siparisler::orderBy('id','desc')
                                ->where('kategori',1)
                                ->limit(5)
                                ->get();
                        @endphp
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                            <i class="icon-bell"></i>
                            <span class="notification-dot bg-azura">{{$yenisiparisCount}}</span>
                        </a>
                        <ul class="dropdown-menu feeds_widget vivify fadeIn">
                            <li class="header blue">{{$yenisiparisCount}} Yeni Sipariş Var</li>
                            @if(count($yeni_siparisler)==0)
                                <p class="text-center mb-1">Yeni bir sipariş yok.</p>
                            @endif
                            @foreach($yeni_siparisler as $ysiparis)
                                <li>
                                    <a href="{{route('siparisKategoriDetay',1)}}">
                                        <div class="feeds-left bg-green"><i class="fa fa-check"></i></div>
                                        <div class="feeds-body">
                                            <h4 class="title text-success">Yeni Sipariş Geldi <small class="float-right text-muted">{{substr($ysiparis->tarih,10,20)}}</small></h4>
                                            <small>{{$ysiparis->sehir}} / {{$ysiparis->ilce}} şehrinden yeni sipariş</small>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="navbar-right">
                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li><a href="{{route('cikis')}}"" class="icon-menu"><i class="icon-power"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="progress-container"><div class="progress-bar" id="myBar"></div></div>
    </nav>

    <div id="left-sidebar" class="sidebar">
        <div class="navbar-brand">
            <a href="/"><img src="/assets/images/icon.svg" alt="Oculux Logo" class="img-fluid logo"><span>Oculux</span></a>
            <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i class="lnr lnr-menu icon-close"></i></button>
        </div>
        <div class="sidebar-scroll">
            <div class="user-account">
                <div class="user_div d-none">
                    <img src="/assets/images/user.png" class="user-photo" alt="User Profile Picture" style="visibility: visible;">
                </div>
                <div class="dropdown">
                    <span>Hoşgeldin,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{session('ad').' '.session('soyad')}}</strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account vivify flipInY" style="right:-70px !important;">
                        <li><a href="{{route('profil')}}"><i class="icon-user"></i>Profilim</a></li>
                        <li><a href="{{route('mailler')}}"><i class="icon-envelope-open"></i>Mailler</a></li>
                        <li><a href="javascript:void(0);"><i class="icon-settings"></i>Ayarlar</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('cikis')}}"><i class="icon-power"></i>Çıkış Yap</a></li>
                    </ul>
                </div>
            </div>
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">
                    <li class="header">Panel</li>
                    <li id="home"><a href="/"><i class="fas fa-tachometer-alt"></i><span>Panel</span></a></li>
                    <li id="siparisler">
                        <a href="#myPage" class="has-arrow"><i class="fas fa-shopping-basket"></i><span>Siparişler</span></a>
                        <ul>
                            @php
                                $kategoriler = \App\Models\siparisKategori::all();
                            @endphp
                            <li id="manuel"><a href="{{route('siparisManuel')}}">Sipariş Oluştur</a></li>
                            <li id="all"><a href="{{route('siparisKategori')}}">Tüm Siparişler</a></li>
                            @foreach($kategoriler as $kategori)
                                @php
                                    $adet = count(\App\Models\siparisler::where('kategori',$kategori->id)->get());
                                @endphp
                                <li id="kategori{{$kategori->id}}"><a href="{{route('siparisKategoriDetay',$kategori->id)}}">{{$kategori->siparis_adi}} <span>({{$adet}})</span></a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li id="urunler">
                        <a href="#myPage" class="has-arrow"><i class="fas fa-shopping-cart"></i><span>Ürünler</span></a>
                        <ul>
                            <li id="urunlerall"><a href="{{route('urunler')}}">Tüm Ürünler</a></li>
                            <li id="urunekle"><a href="{{route('urunEkle')}}">Yeni Ürün Ekle</a></li>
                        </ul>
                    </li>
                    <li id="kategoriler">
                        <a href="#myPage" class="has-arrow"><i class="fas fa-stream"></i><span>Kategoriler</span></a>
                        <ul>
                            <li id="kategoriall"><a href="{{route('kategoriler')}}">Tüm Kategoriler</a></li>
                            <li id="kategoriekle"><a href="{{route('kategoriEkle')}}">Yeni Kategori Ekle</a></li>
                        </ul>
                    </li>
                    <li id="entegrasyonlar">
                        <a href="#myPage" class="has-arrow"><i class="fas fa-code"></i><span>Entegrasyonlar</span></a>
                        <ul>
                            <li id="hepsiburada"><a href="{{route('hepsiburada')}}">Hepsiburada</a></li>
                        </ul>
                    </li>
                    <li id="slider">
                        <a href="#myPage" class="has-arrow"><i class="fas fa-images"></i><span>Sliderlar</span></a>
                        <ul>
                            <li id="sliderall"><a href="{{route('slider')}}">Tüm Sliderlar</a></li>
                            <li id="sliderekle"><a href="{{route('sliderEkle')}}">Yeni Slider Ekle</a></li>
                        </ul>
                    </li>
                    <li id="kullanici">
                        <a href="#myPage" class="has-arrow"><i class="fas fa-users-cog"></i><span>Kullanıcılar</span></a>
                        <ul>
                            <li id="kullaniciall"><a href="{{route('kullanici')}}">Tüm Kullanıcılar</a></li>
                            <li id="kullaniciekle"><a href="{{route('kullaniciEkle')}}">Yeni Kullanıcı Ekle</a></li>
                        </ul>
                    </li>
                    <li id="yorumlar">
                        <a href="{{route('yorumlar')}}"><i class="fas fa-comments"></i><span>Yorumlar</span></a>
                    </li>
                    <li id="mailler">
                        <a href="{{route('mailler')}}"><i class="fas fa-envelope"></i><span>Mailler</span></a>
                    </li>
                    <li id="profil">
                        <a href="{{route('profil')}}"><i class="fas fa-user-cog"></i><span>Profil Ayarları</span></a>
                    </li>
                    <li id="ayarlar">
                        <a href="{{route('ayarlar')}}"><i class="fas fa-cog"></i><span>Site Ayarları</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
