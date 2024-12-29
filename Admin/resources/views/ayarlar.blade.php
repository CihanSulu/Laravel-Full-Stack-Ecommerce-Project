@extends('layouts.master')
@section('title','Ayarlar')

@section('content')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Ayarlar</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Ayarlar</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="javascript:history.go(-1)" class="btn btn-sm btn-primary btn-round" title=""><i class="fa fa-arrow-left"></i> Geri Dön</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Düzenleme -->
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="body">
                            <form action="{{route('ayarlar')}}" class="w-100" method="post">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label for="ad" class="font-weight-bold">Panel Adı</label>
                                        <input type="text" name="ad" id="ad" value="{{$ayarlar->panel_adi}}" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label for="url" class="font-weight-bold">Panel Url</label>
                                        <input type="text" name="url" id="url" value="{{$ayarlar->panel_url}}" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="aciklama" class="font-weight-bold">Hakkımızda</label>
                                        <textarea class="summernote" rows="5">{{$ayarlar->site_hakkinda}}</textarea>
                                        <input type="hidden" name="aciklama" id="aciklama">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="tel1" class="font-weight-bold">Telefon 1</label>
                                        <input type="text" name="tel1" id="tel1" class="form-control" value="{{$ayarlar->site_tel1}}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="tel2" class="font-weight-bold">Telefon 2</label>
                                        <input type="text" name="tel2" id="tel2" class="form-control" value="{{$ayarlar->site_tel2}}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="adres" class="font-weight-bold">Adres</label>
                                        <textarea name="adres" id="adres" rows="3" class="form-control">{{$ayarlar->site_adres}}</textarea>
                                    </div>
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <button type="submit" class="btn btn-primary float-right" id="btnurun">Site Ayarlarını Güncelle</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('footer')
    <script>
        $("#ayarlar").addClass('active');
    </script>

    <!-- SummerNote-->
    <script>
        $("#btnurun").click(function(){
            var summerText = $(".summernote").summernote("code");
            $("#aciklama").val(summerText);
        });
    </script>
@endsection
