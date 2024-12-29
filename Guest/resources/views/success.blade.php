@extends('layouts.master')
@php 
    $title = "Siparişiniz Alındı";
@endphp
@section('title',$title.' | '.$site)


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
                                <li class="axil-breadcrumb-item active" aria-current="page">{{$title}}</li>
                            </ul>
                            <h1 class="title">{{$title}}</h1>
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

        <!-- Start Privacy Policy Area  -->
        <div class="axil-privacy-area axil-section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="axil-privacy-policy">
                            <h1 class="title text-success">Siparişiniz Alındı 🥰</h1>
                            <p>{{$site}} olarak bizi tercih ettiğiniz için teşekkür ederiz.<br>
                                Kargonunuzu özenle hazırlayıp tarafınıza en kısa sürede dönüş yapacağız.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Privacy Policy Area  -->

@endsection