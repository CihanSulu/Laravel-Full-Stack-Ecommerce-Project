<!-- Start Header -->
<header class="header axil-header header-style-4">
        <div class="header-top-campaign">
            <div class="container position-relative">
                <div class="campaign-content">
                    <div class="campaign-countdown d-none"></div>
                    <p>TÜM ÜRÜNLERDE  <a href="{{route('products')}}">%80'E VARAN İNDİRİM</a> KAMPANYASINI KAÇIRMAYIN!</p>
                </div>
            </div>
            <button class="remove-campaign"><i class="fal fa-times"></i></button>
        </div>
        <!-- Start Header Top Area  -->
        <div class="axil-header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 col-12 d-md-block d-none">
                        <div class="header-top-dropdown dropdown-box-style">
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    TRY
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">TRY</a></li
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Türkçe
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Türkçe</a></li>
                                    <li class="d-none"><a class="dropdown-item" href="#">English</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-5">
                        <div class="header-brand">
                            <a href="{{route('index')}}" class="logo logo-dark">
                                <img src="/assets/images/logo/logo.png" class="shadow-lg2" alt="Site Logo">
                            </a>
                            <a href="{{route('index')}}" class="logo logo-light">
                                <img src="/assets/images/logo/logo-light.png" alt="Site Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-7">
                        <div class="header-action">
                            <ul class="action-list">
                                <li class="axil-search">
                                    <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                        <i class="flaticon-magnifying-glass"></i>
                                    </a>
                                </li>
                                <li class="shopping-cart d-flex">
                                    <a href="#" class="cart-dropdown-btn">
                                        <span class="cart-count">{{Cart::count()}}</span>
                                        <i class="flaticon-shopping-cart"></i>
                                    </a>
                                    <span class="cart-dropdown-btn" style="margin-left:15px;cursor: pointer;">{{Cart::subtotal()}} ₺</span>
                                </li>
                                <li class="axil-mobile-toggle">
                                    <button class="menu-btn mobile-nav-toggler">
                                        <i class="flaticon-menu-2"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Top Area  -->

        <!-- Start Mainmenu Area  -->
        <div id="axil-sticky-placeholder"></div>
        <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar">
                    <div class="header-main-nav">
                        <!-- Start Mainmanu Nav -->
                        <nav class="mainmenu-nav">
                            <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                            <div class="mobile-nav-brand">
                                <a href="{{route('index')}}" class="logo">
                                    <img src="/assets/images/logo/logo.png" alt="Site Logo">
                                </a>
                            </div>
                            <ul class="mainmenu">
                                <li><a href="{{route('index')}}">Anasayfa</a></li>
                                @php
                                    $category = \App\Models\Kategori::where('category_sub', '0')->get();
                                @endphp
                                @foreach($category as $item )
                                    
                                    @php
                                        $categoryCount = \App\Models\Kategori::where('category_sub', $item->id)->count();
                                    @endphp
                                
                                    <li class="{{ $categoryCount > 1 ? 'menu-item-has-children' : '' }}">
                                        
                                        <a href="{{route('category',$item->slug)}}" class="d-lg-block d-none {{ (Request::is($item->slug)) ? 'active':'' }} ">{{$item->kategori_adi}}</a>
                                        
                                        <a href="#" class="d-lg-none d-inline {{ (Request::is($item->slug)) ? 'active':'' }} ">{{$item->kategori_adi}}</a>
                                    
                                    <ul class="axil-submenu">
                                        @php
                                                    $categorySubs = \App\Models\Kategori::where('category_sub', $item->id)->get();
                                                @endphp
                                                <li class="d-lg-none d-block"><a href="{{$item->slug}}">{{$item->kategori_adi}}</a></li>
                                                @foreach($categorySubs as $sub)
                                                    <li><a href="/{{$sub->slug}}">{{$sub->kategori_adi}}</a></li>
                                                @endforeach
                                        </li>
                                    </ul>
                                    
                                    </li>
                                @endforeach
                                <li><a href="{{route('contact')}}" class=" {{ (Request::is('iletisim')) ? 'active':'' }} ">İletişim</a></li>
                            </ul>
                        </nav>
                        <!-- End Mainmanu Nav -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Mainmenu Area  -->
    </header>