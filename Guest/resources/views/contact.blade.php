@extends('layouts.master')
@section('title',"İletişim | ".$site)


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
                                <li class="axil-breadcrumb-item"><a href="{{route('index')}}">Anasayfa</a></li>
                                <li class="separator"></li>
                                <li class="axil-breadcrumb-item active" aria-current="page">İletişim</li>
                            </ul>
                            <h1 class="title">Bize Ulaşın</h1>
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

        <!-- Start Contact Area  -->
        <div class="axil-contact-page-area axil-section-gap">
            <div class="container">
                <div class="axil-contact-page">
                    <div class="row row--30">
                        <div class="col-lg-12">
                            <div class="contact-form">
                                <h3 class="title mb--10">{{$site}} 7/24 Her Daim Yanınızda.</h3>
                                <p>Tüm soru ve önerileriniz için bizimle iletişime geçin.</p>
                                <form method="POST" action="{{route('contact')}}" >
                                    {{csrf_field()}}
                                    <div class="row row--10">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="contact-name">Adınız <span>*</span></label>
                                                <input type="text" name="name" id="contact-name" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="contact-name">Soyadınız <span>*</span></label>
                                                <input type="text" name="surname" id="contact-name" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="contact-phone">Telefon Numaranız <span>*</span></label>
                                                <input type="text" name="tel" id="contact-phone" required="">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="contact-message">Mesajınız</label>
                                                <textarea name="message" id="contact-message" cols="1" rows="2" required=""></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb--0">
                                                <button  type="submit" class="axil-btn btn-bg-primary">Gönder</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Contact Area  -->

@endsection

