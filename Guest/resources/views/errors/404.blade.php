@extends('layouts.master')
@section('title','Aradığınız Sayfa Bulunamadı - '.$site)


@section('top')
    @include("layouts.partical.header-top2")
@endsection
@section('content')

    <section class="error-page onepage-screen-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="content" data-sal="slide-up" data-sal-duration="800" data-sal-delay="400">
                        <span class="title-highlighter highlighter-secondary"> <i class="fal fa-exclamation-circle"></i> Oops!</span>
                        <h1 class="title">Aradığınız Sayfa Bulunamadı :(</h1>
                        <p>Üzgünüz, aradığınız sayfayı bulamadık. Sayfa kaldırılmış veya güncellenmiş olabilir lütfen aradığınız sayfayı arama bölümden tekrar aratın.</p>
                        <a href="{{route('index')}}" class="axil-btn btn-bg-secondary right-icon">Anasayfaya Dön <i class="fal fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="thumbnail" data-sal="zoom-in" data-sal-duration="800" data-sal-delay="400">
                        <img src="/assets/images/others/404.png" alt="404">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection