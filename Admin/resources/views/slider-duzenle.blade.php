@extends('layouts.master')
@section('title','Slider Düzenle')

@section('header')
    <link rel="stylesheet" href="/assets/vendor/dropify/css/dropify.min.css">
    <style>
        .dropify-wrapper{
            background-color: #22252a;
            color:#b9b9b9;
            border:1px solid #2f3338;
            border-radius: 3px;
        }
        .dropify-wrapper:hover{
        background-image:linear-gradient(-45deg, #2f3338 20%, transparent 25%, transparent 50%, #2f3338 45%, #2f3338 70%, transparent 75%, transparent);
        }
    </style>
@endsection

@section('content')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Slider Düzenle</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('slider')}}">Sliderlar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Slider Düzenle</li>
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
                            <form action="{{route('sliderDuzenle',$slider->id)}}" class="w-100" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label for="baslik" class="font-weight-bold">Slider Başlık(Zorunlu Değil)</label>
                                        <input type="text" name="baslik" id="baslik" placeholder="Slider Başlığı" class="form-control" value="{{$slider->baslik}}">
                                    </div>
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label for="aciklama" class="font-weight-bold">Slider Açıklama(Zorunlu Değil)</label>
                                        <input type="text" name="aciklama" id="aciklama" placeholder="Slider Açıklaması" class="form-control" value="{{$slider->aciklama}}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="gorsel" class="font-weight-bold">Slider Görseli</label>
                                        <input type="hidden" name="imageSelected" id="imageSelected">
                                        <input type="file" id="dropify-event" name="image" data-default-file="/assets/images/slider/{{$slider->resim_path}}">
                                    </div>
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <button type="submit" id="sliderBtn" class="btn btn-primary float-right">Slider Güncellle</button>
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
        $("#slider").addClass('active');
        $("#sliderall").addClass('active');
    </script>
    <script src="/assets/vendor/dropify/js/dropify.js"></script>
    <script src="/assets/bundles/mainscripts.bundle.js"></script>
    <script src="/assets/js/pages/forms/dropify.js"></script>
@endsection
