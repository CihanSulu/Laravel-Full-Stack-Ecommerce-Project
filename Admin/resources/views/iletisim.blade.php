@extends('layouts.master')
@section('title','Gelen Mailler')

@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Gelen Mailler</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Mailler</a></li>
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
                                    <li class="tabli active" id="gelen"><a href="#"><i class="icon-drawer"></i>Gelen Mailler<span class="badge badge-primary float-right">{{count($gelen)}}</span></a></li>
                                    <li class="tabli" id="okunmus"><a href="javascript:void(0);"><i class="icon-envelope-open"></i>Okunmuş Mailler<span class="badge badge-success float-right">{{count($okunmus)}}</span></a></li>
                                    <li class="tabli" id="silinen"><a href="javascript:void(0);"><i class="icon-trash"></i>Silinen Mailler<span class="badge badge-danger float-right">{{count($silinen)}}</span></a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Gelen Okunmamış Mailler -->
                        <div class="body mail-right check-all-parent gelen">
                            <div class="mail-action clearfix m-l-15">
                                <div class="pull-left">
                                    <div class="fancy-checkbox d-inline-block">
                                        <label>
                                            @if(count($gelen) != 0)
                                                <input class="check-all" type="checkbox" name="checkbox">
                                            @endif
                                            <span></span>
                                        </label>
                                    </div>
                                    @if(count($gelen) != 0)
                                        <a href="javascript:void(0);" data-href="formGelen" class="btn btn-danger btn-sm topluSilme"><i class="icon-trash"></i></a>
                                    @endif
                                    <a href="{{route('mailler')}}" class="btn btn-light btn-sm hidden-sm"><i class="icon-refresh"></i></a>
                                </div>
                                <div class="pull-right ml-auto">
                                    <div class="pagination-email d-flex">
                                        <p>1-50/295</p>
                                        <div class="btn-group m-l-20">
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-angle-left"></i></button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mail-list">
                                <ul class="list-unstyled">
                                    <form action="{{route('mailler')}}" method="post" id="formGelen">
                                        {{csrf_field()}}
                                        @foreach($gelen as $okunmamis)
                                            <li class="clearfix unread">
                                                <div class="md-left">
                                                    <label class="fancy-checkbox">
                                                        <input type="checkbox" name="checkbox[]" class="checkbox-tick" value="{{$okunmamis->id}}">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="md-right">
                                                    <img class="rounded" src="../assets/images/xs/avatar.jpg" alt="">
                                                    <p class="sub"><a href="{{route('mailDetay',$okunmamis->id)}}" class="mail-detail-expand">{{$okunmamis->mail_ad}} {{$okunmamis->mail_soyad}}</a></p>
                                                    <p class="dep">{{$okunmamis->mail_mesaj}}</p>
                                                    <span class="time"><i class="fa fa-paperclip"></i> {{$okunmamis->tarih}}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </form>
                                </ul>
                                <div class="text-center">{{(count($gelen)==0) ? 'Burası şimdilik boş gözüküyor.' : ''}}</div>
                            </div>
                            <!--<ul class="pagination mb-0">
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                            </ul>-->
                        </div>

                        <!-- Okunmuş Mailler -->
                        <div class="body mail-right check-all-parent okunmus" style="display: none;">
                            <div class="mail-action clearfix m-l-15">
                                <div class="pull-left">
                                    <div class="fancy-checkbox d-inline-block">
                                        <label>
                                            @if(count($okunmus) != 0)
                                                <input class="check-all" type="checkbox" name="checkbox">
                                            @endif
                                            <span></span>
                                        </label>
                                    </div>
                                    @if(count($okunmus) != 0)
                                        <a href="javascript:void(0);" data-href="formOkunmus" class="btn btn-danger btn-sm topluSilme"><i class="icon-trash"></i></a>
                                    @endif
                                    <a href="{{route('mailler')}}" class="btn btn-light btn-sm hidden-sm"><i class="icon-refresh"></i></a>
                                </div>
                                <div class="pull-right ml-auto">
                                    <div class="pagination-email d-flex">
                                        <p>1-50/295</p>
                                        <div class="btn-group m-l-20">
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-angle-left"></i></button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mail-list">
                                <ul class="list-unstyled">
                                    <form action="{{route('mailler')}}" method="post" id="formOkunmus">
                                        {{csrf_field()}}
                                        @foreach($okunmus as $okunmus_mesaj)
                                            <li class="clearfix">
                                                <div class="md-left">
                                                    <label class="fancy-checkbox">
                                                        <input type="checkbox" name="checkbox[]" class="checkbox-tick" value="{{$okunmus_mesaj->id}}">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="md-right">
                                                    <img class="rounded" src="../assets/images/xs/avatar.jpg" alt="">
                                                    <p class="sub"><a href="{{route('mailDetay',$okunmus_mesaj->id)}}" class="mail-detail-expand">{{$okunmus_mesaj->mail_ad}} {{$okunmus_mesaj->mail_soyad}}</a></p>
                                                    <p class="dep">{{$okunmus_mesaj->mail_mesaj}}</p>
                                                    <span class="time"><i class="fa fa-paperclip"></i> {{$okunmus_mesaj->tarih}}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </form>
                                </ul>
                                <div class="text-center">{{(count($okunmus)==0) ? 'Burası şimdilik boş gözüküyor.' : ''}}</div>
                            </div>
                            <!--<ul class="pagination mb-0">
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                            </ul>-->
                        </div>

                        <!-- Silinen Mesajlar Mailler -->
                        <div class="body mail-right check-all-parent silinen" style="display: none;">
                            <div class="mail-action clearfix m-l-15">
                                <div class="pull-left">
                                    <div class="fancy-checkbox d-inline-block">
                                        <label>
                                            @if(count($silinen) != 0)
                                                <input class="check-all" type="checkbox" name="checkbox">
                                            @endif
                                            <span></span>
                                        </label>
                                    </div>
                                    @if(count($silinen) != 0)
                                        <a href="javascript:void(0);" data-href="formSilinen" class="btn btn-danger btn-sm topluSilme"><i class="icon-trash"></i></a>
                                    @endif
                                    <a href="{{route('mailler')}}" class="btn btn-light btn-sm hidden-sm"><i class="icon-refresh"></i></a>
                                </div>
                                <div class="pull-right ml-auto">
                                    <div class="pagination-email d-flex">
                                        <p>1-50/295</p>
                                        <div class="btn-group m-l-20">
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-angle-left"></i></button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mail-list">
                                <ul class="list-unstyled">
                                    <form action="{{route('mailler')}}" method="post" id="formSilinen">
                                        {{csrf_field()}}
                                        @foreach($silinen as $silinen_mesaj)
                                            <li class="clearfix">
                                                <div class="md-left">
                                                    <label class="fancy-checkbox">
                                                        <input type="checkbox" name="checkbox[]" class="checkbox-tick" value="{{$silinen_mesaj->id}}">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="md-right">
                                                    <img class="rounded" src="../assets/images/xs/avatar.jpg" alt="">
                                                    <p class="sub"><a href="{{route('mailDetay',$silinen_mesaj->id)}}" class="mail-detail-expand">{{$silinen_mesaj->mail_ad}} {{$silinen_mesaj->mail_soyad}}</a></p>
                                                    <p class="dep">{{$silinen_mesaj->mail_mesaj}}</p>
                                                    <span class="time"><i class="fa fa-paperclip"></i> {{$silinen_mesaj->tarih}}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </form>
                                </ul>
                                <div class="text-center">{{(count($silinen)==0) ? 'Burası şimdilik boş gözüküyor.' : ''}}</div>
                            </div>
                            <!--<ul class="pagination mb-0">
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                            </ul>-->
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
        $('#mailler').addClass('active');
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
            $("#"+href).submit();
        });
    </script>
@endsection
