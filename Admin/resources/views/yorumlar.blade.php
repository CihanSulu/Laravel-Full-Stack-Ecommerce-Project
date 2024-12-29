@extends('layouts.master')
@section('title','Yorumlar')

@php
if(isset($_GET["page"]))
    $page = $_GET["page"];
else
    $page = 1;
@endphp

@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Gelen Yorumlar</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Yorumlar</a></li>
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
                        <div class="mobile-left">
                            <a href="javascript:void(0);" class="btn btn-primary toggle-email-nav"><i class="fa fa-bars"></i></a>
                        </div>
                        <div class="body mail-left">
                            <div class="mail-side">
                                <ul class="nav">
                                    <li class="tabli active" id="yeni"><a href="javascript:void(0);"><i class="icon-drawer"></i>Yeni Yorumlar<span class="badge badge-primary float-right">{{$countYeni}}</span></a></li>
                                    <li class="tabli" id="onayli"><a href="javascript:void(0);"><i class="icon-envelope-open"></i>Onaylı Yorumlar<span class="badge badge-success float-right">{{$countOnayli}}</span></a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Yeni Yorumlar -->
                        <div class="body mail-right check-all-parent yeni">
                            <div class="mail-action clearfix m-l-15">
                                <div class="pull-left">
                                    <div class="fancy-checkbox d-inline-block">
                                        <label>
                                            @if(count($yeniYorumlar) != 0)
                                                <input class="check-all" type="checkbox" name="checkbox">
                                            @endif
                                            <span></span>
                                        </label>
                                    </div>
                                    @if(count($yeniYorumlar) != 0)
                                        <a href="javascript:void(0);" data-href="formGelen" class="btn btn-danger btn-sm topluSilme"><i class="icon-trash"></i></a>
                                        <a href="javascript:void(0);" data-href="formGelen" class="btn btn-success btn-sm topluOnay"><i class="icon-check"></i></a>
                                    @endif
                                    <a href="{{route('yorumlar')}}" class="btn btn-light btn-sm hidden-sm"><i class="icon-refresh"></i></a>
                                </div>
                                @if($countYeni > 24)
                                <div class="pull-right ml-auto">
                                    <div class="pagination-email d-flex">
                                        <p>{{$page*24}}-{{($page+1)*24}}/{{$countYeni}}</p>
                                        <div class="btn-group m-l-20">
                                            @if($page>1)
                                                <a href="{{request()->fullUrlWithQuery(['page' => $page-1,'type'=>'yeni'])}}" class="btn btn-default btn-sm"><i class="fa fa-angle-left"></i></a>
                                            @endif
                                            @if($page < ceil($countYeni))
                                                <a href="{{request()->fullUrlWithQuery(['page' => $page+1,'type'=>'yeni'])}}" class="btn btn-default btn-sm"><i class="fa fa-angle-right"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="mail-list">
                                <ul class="list-unstyled">
                                    <form action="{{route('yorumlar')}}" method="post" id="formGelen">
                                        {{csrf_field()}}
                                        @foreach($yeniYorumlar as $okunmamis)
                                            <li class="clearfix unread">
                                                <div class="md-left">
                                                    <label class="fancy-checkbox">
                                                        <input type="checkbox" name="checkbox[]" class="checkbox-tick" value="{{$okunmamis->id}}">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <input type="hidden" name="type" id="topluIslem" value="">
                                                <div class="md-right">
                                                    <img class="rounded" src="../assets/images/xs/avatar.jpg" alt="">
                                                    <p class="sub"><a href="{{route('yorumDetay',$okunmamis->id)}}" class="mail-detail-expand">Yeni Yorum! </a></p>
                                                    <p class="dep">{{$okunmamis->yorum}}</p>
                                                    <span class="time"><i class="fa fa-paperclip"></i> {{$okunmamis->yorum_date}}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </form>
                                </ul>
                                <div class="text-center">{{(count($yeniYorumlar)==0) ? 'Burası şimdilik boş gözüküyor.' : ''}}</div>
                            </div>
                            @if($countYeni > 24)
                                <div class="pull-right ml-auto">
                                    <div class="pagination-email d-flex">
                                        <p>{{$page*24}}-{{($page+1)*24}}/{{$countYeni}}</p>
                                        <div class="btn-group m-l-20">
                                            @if($page>1)
                                                <a href="{{request()->fullUrlWithQuery(['page' => $page-1,'type'=>'yeni'])}}" class="btn btn-default btn-sm"><i class="fa fa-angle-left"></i></a>
                                            @endif
                                            @if($page < ceil($countYeni))
                                                <a href="{{request()->fullUrlWithQuery(['page' => $page+1,'type'=>'yeni'])}}" class="btn btn-default btn-sm"><i class="fa fa-angle-right"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Onaylı Yorumlar -->
                        <div class="body mail-right check-all-parent onayli" style="display: none;">
                            <div class="mail-action clearfix m-l-15">
                                <div class="pull-left">
                                    <div class="fancy-checkbox d-inline-block">
                                        <label>
                                            @if(count($onayliYorumlar) != 0)
                                                <input class="check-all" type="checkbox" name="checkbox">
                                            @endif
                                            <span></span>
                                        </label>
                                    </div>
                                    @if(count($onayliYorumlar) != 0)
                                        <a href="javascript:void(0);" data-href="formOkunmus" class="btn btn-danger btn-sm topluSilme"><i class="icon-trash"></i></a>
                                    @endif
                                    <a href="{{route('yorumlar')}}" class="btn btn-light btn-sm hidden-sm"><i class="icon-refresh"></i></a>
                                </div>
                                @if($countOnayli > 24)
                                <div class="pull-right ml-auto">
                                    <div class="pagination-email d-flex">
                                        <p>{{$page*24}}-{{($page+1)*24}}/{{$countOnayli}}</p>
                                        <div class="btn-group m-l-20">
                                            @if($page>1)
                                                <a href="{{request()->fullUrlWithQuery(['page' => $page-1,'type'=>'onayli'])}}" class="btn btn-default btn-sm"><i class="fa fa-angle-left"></i></a>
                                            @endif
                                            @if($page < ceil($countOnayli))
                                                <a href="{{request()->fullUrlWithQuery(['page' => $page+1,'type'=>'onayli'])}}" class="btn btn-default btn-sm"><i class="fa fa-angle-right"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="mail-list">
                                <ul class="list-unstyled">
                                    <form action="{{route('yorumlar')}}" method="post" id="formOkunmus">
                                        {{csrf_field()}}
                                        @foreach($onayliYorumlar as $onayliYorumlar_mesaj)
                                            <li class="clearfix">
                                                <div class="md-left">
                                                    <label class="fancy-checkbox">
                                                        <input type="checkbox" name="checkbox[]" class="checkbox-tick" value="{{$onayliYorumlar_mesaj->id}}">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <input type="hidden" name="type" id="topluIslem" value="">
                                                <div class="md-right">
                                                    <img class="rounded" src="../assets/images/xs/avatar.jpg" alt="">
                                                    <p class="sub"><a href="{{route('yorumDetay',$onayliYorumlar_mesaj->id)}}" class="mail-detail-expand">Onaylanmış Yorum!</a></p>
                                                    <p class="dep">{{$onayliYorumlar_mesaj->yorum}}</p>
                                                    <span class="time"><i class="fa fa-paperclip"></i> {{$onayliYorumlar_mesaj->yorum_date}}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </form>
                                </ul>
                                <div class="text-center">{{(count($onayliYorumlar)==0) ? 'Burası şimdilik boş gözüküyor.' : ''}}</div>
                            </div>
                            @if($countOnayli > 24)
                                <div class="pull-right ml-auto">
                                    <div class="pagination-email d-flex">
                                        <p>{{$page*24}}-{{($page+1)*24}}/{{$countOnayli}}</p>
                                        <div class="btn-group m-l-20">
                                            @if($page>1)
                                                <a href="{{request()->fullUrlWithQuery(['page' => $page-1,'type'=>'onayli'])}}" class="btn btn-default btn-sm"><i class="fa fa-angle-left"></i></a>
                                            @endif
                                            @if($page < ceil($countOnayli))
                                                <a href="{{request()->fullUrlWithQuery(['page' => $page+1,'type'=>'onayli'])}}" class="btn btn-default btn-sm"><i class="fa fa-angle-right"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        $('#yorumlar').addClass('active');
        $(".tabli").click(function(){
            id = $(this).attr("id");
            $(".tabli").removeClass("active");
            $(this).addClass("active");
            $(".mail-right").hide();
            $("."+id).fadeIn();
        });
    </script>
    <script>
        $('.toggle-email-nav').on('click', function() {
            $('.mail-left').toggleClass('open');
        });
    </script>
    <script>
        $(".topluSilme").click(function(){
            var href = $(this).attr("data-href");
            $("#topluIslem").val("1");
            $("#"+href).submit();
        });
        $(".topluOnay").click(function(){
            var href = $(this).attr("data-href");
            $("#topluIslem").val("2");
            $("#"+href).submit();
        });
    </script>
    @if(isset($_GET["type"]))
    <script>
        $(".tabli").removeClass("active");
        $(".mail-right").hide();
        $("{{ ".".$_GET["type"] }}").fadeIn();
    </script>
    @endif

@endsection
