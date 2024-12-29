@extends('layouts.master')
@section('title','Yorum İçerik')


@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Yorum Düzenle</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('mailler')}}">Yorumlar</a></li>
                            <li class="breadcrumb-item active">Yorum Detayı</li>
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
                                    <a href="{{route('yorumSil',$yorum->id)}}" class="btn btn-danger btn-sm"><i class="icon-trash"></i></a>
                                    @if($yorum->yorum_onay == 0)
                                        <a href="{{route('yorumOnay',$yorum->id)}}" class="btn btn-success btn-sm"><i class="icon-check"></i></a>
                                    @endif
                                    <a href="{{route('yorumDetay',$yorum->id)}}" class="btn btn-light btn-sm hidden-sm"><i class="icon-refresh"></i></a>
                                </div>
                                <div class="detail-header">
                                    <div class="media">
                                        <div class="float-left">
                                            <div class="m-r-20"><img src="../assets/images/sm/avatar.jpg" class="rounded" alt=""></div>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0">{{$yorum->yorum_date}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mail-cnt">
                                    <form action="{{route('yorumDetay',$yorum->id)}}" method="post">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <textarea name="yorum" class="form-control" rows="4">{{$yorum->yorum}}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary float-right">Kaydet</button>
                                    </form>
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
    $('#yorumlar').addClass('active');
    $('.toggle-email-nav').on('click', function() {
        $('.mail-left').toggleClass('open');
    });
</script>
@endsection
