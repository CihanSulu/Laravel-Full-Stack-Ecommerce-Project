@extends('layouts.master')
@section('title','Ödemeyi Tamamlayın | '.$site)

@section('top')
    @include("layouts.partical.header-top2")
@endsection
@section('content')

<!-- Start Checkout Area  -->
        <div class="axil-checkout-area axil-section-gap">
            <div class="container">
                
            <iframe src="https://www.paytr.com/odeme/guvenli/{{ $token }}" id="paytriframe" frameborder="0" scrolling="no" style="width: 100%;"></iframe>
            <script src="https://www.paytr.com/js/iframeResizer.min.js"></script>
            <script>iFrameResize({}, '#paytriframe');</script>

            </div>
        </div>
        <!-- End Checkout Area  -->

@endsection