@extends('layouts.master')
@section('title','Mail İçerik - '.$mail->mail_ad.' '.$mail->mail_soyad)

@php
    if($mail->okundu == 0){
        $mail->okundu = 1;
        $mail->save();
    }
@endphp

@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Inbox</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('mailler')}}">Mailler</a></li>
                            <li class="breadcrumb-item active">{{$mail->mail_ad}} {{$mail->mail_soyad}}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="javascript:history.go(-1)" class="btn btn-sm btn-primary btn-round" title=""><i class="fa fa-arrow-left"></i> Geri Dön</a>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="mail-inbox">
                        <div class="body mail-right check-all-parent" style="width:100% !important;">
                            <div class="mail-detail-full">
                                <div class="mail-action clearfix">
                                    <a href="javascript:history.go(-1)" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    <a href="{{route('mailSil',$mail->id)}}" class="btn btn-danger btn-sm"><i class="icon-trash"></i></a>
                                    <a href="{{route('mailDetay',$mail->id)}}" class="btn btn-light btn-sm hidden-sm"><i class="icon-refresh"></i></a>
                                </div>
                                <div class="detail-header">
                                    <div class="media">
                                        <div class="float-left">
                                            <div class="m-r-20"><img src="../assets/images/sm/avatar.jpg" class="rounded" alt=""></div>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0"><strong class="text-muted m-r-5">Ad Soyad :</strong><a class="text-default" href="javascript:void(0);">{{$mail->mail_ad}} {{$mail->mail_soyad}}</a><span class="text-muted text-sm float-right">{{$mail->tarih}}</span></p>
                                            <p class="mb-0"><strong class="text-muted m-r-5">Telefon :</strong>{{$mail->mail_tel}} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mail-cnt">
                                    <p>{{$mail->mail_mesaj}}</p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer');
<script>
    $('#mailler').addClass('active');
    $('.toggle-email-nav').on('click', function() {
        $('.mail-left').toggleClass('open');
    });
</script>
@endsection
