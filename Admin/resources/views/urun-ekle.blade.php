@extends('layouts.master')
@section('title','Yeni Ürün Ekle')
@section('header')
    <!-- Select -->
    <link rel="stylesheet" href="/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css">
    <link rel="stylesheet" href="/assets/vendor/multi-select/css/multi-select.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="/assets/vendor/nouislider/nouislider.min.css">

    <!-- Image Upload-->
    <link type="text/css" rel="stylesheet" href="/assets/css/image-uploader.min.css">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
@endsection

@section('content')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Yeni Ürün Ekle</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('urunler')}}">Ürünler</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Yeni Ürün Ekle</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="javascript:history.go(-1)" class="btn btn-sm btn-primary btn-round" title=""><i class="fa fa-arrow-left"></i> Geri Dön</a>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <!-- Ekleme -->

                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="body">
                            <form action="{{route('urunEkle')}}" class="w-100" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label for="ad" class="font-weight-bold">Ürün Adı</label>
                                        <input type="text" name="ad" id="ad" value="{{old('ad')}}" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="ad" class="font-weight-bold">Ürün Seo Başlığı</label>
                                        <input type="text" name="seobaslik" id="seobaslik" value="{{old('seobaslik')}}" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="ad" class="font-weight-bold">Ürün Seo Anahtar Kelimeler</label>
                                        <input type="text" name="seoanahtar" id="seoanahtar" value="{{old('seoanahtar')}}" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="fiyat" class="font-weight-bold">Ürün Eski Fiyatı</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-lira-sign"></i></span>
                                            </div>
                                            <input type="text" name="fiyateski" value="{{old('fiyateski')}}" class="form-control money-dollar" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="fiyat" class="font-weight-bold">Ürün Fiyatı</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-lira-sign"></i></span>
                                            </div>
                                            <input type="text" name="fiyat" value="{{old('fiyat')}}" class="form-control money-dollar" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="aciklama" class="font-weight-bold">Ürün Açıklaması</label>
                                        <textarea class="summernote" rows="5">{{old('aciklama')}}</textarea>
                                        <input type="hidden" name="aciklama" id="aciklama">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="varyantlar" class="font-weight-bold deactiveTab" id="varyantBtn" style="cursor: pointer">Ürün Varyantları</label>
                                        <table class="table table-striped shadow" id="varyantlar" style="display: inline-table;">
                                            <thead class="font-weight-bold">
                                                <tr>
                                                    <td>Varyant Rengi</td>
                                                    <td>Varyant Boyutu</td>
                                                    <td>Varyant Fiyatı</td>
                                                    <td>Varyant Resmi</td>
                                                    <td>Varyantı Sil</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(old('varyantFiyat', null) != null)
                                                    @foreach(old('varyantFiyat') as $key=>$item)
                                                    <tr>
                                                        <td><input type="text" value="{{old('varyantRenk')[$key]}}" class="form-control" name="varyantRenk[]"></td>
                                                        <td><input type="text" value="{{old('varyantBoyut')[$key]}}" class="form-control" name="varyantBoyut[]"></td>
                                                        <td><input type="text" value="{{old('varyantFiyat')[$key]}}" class="form-control" name="varyantFiyat[]" required></td>
                                                        <td>
                                                            <img id="image" style="" />
                                                            <input accept="image/*" type="file" name="varyantResim[]" class="imagefiles"/>
                                                        </td>
                                                        <td><a href="javascript:void(0);" class="varyantSil">Varyantı Sil</a></td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            <tr>
                                                <td colspan="5" class="text-center" id="novariant">Ürüne Ait Varyant Bulunamadı...</td>
                                            </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" class="text-right"><a href="javascript:void(0);" class="btn btn-primary" id="varyantEkle">Varyant Ekle</a></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="onecikan" class="font-weight-bold">Ürün Öne Çıkarılsın Mı ?</label>
                                        <select name="onecikan" id="oncecikan" class="custom-select" style="font-size: 15px;">
                                            <option value="0">Öne Çıkarma</option>
                                            <option value="1">Öne Çıkar</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="onecikansira" class="font-weight-bold">Öne Çıkarılma Sırası</label>
                                        <select name="onecikansira" id="onecikansira" class="custom-select" style="font-size: 15px;">
                                            @for ($i = 1; $i<=$sira; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                            <option value="{{$sira+1}}" selected>{{$sira+1}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="kategoriler" class="font-weight-bold">Kategoriler</label>
                                        <div class="multiselect_div">
                                            <select id="multiselect4-filter" name="kategoriler[]" id="kategoriler" class="multiselect multiselect-custom" multiple="multiple">
                                                {{$kategoriler = \App\Models\Kategori::orderBy('id','desc')->get()}}
                                                @foreach($kategoriler as $kategori)
                                                    <option value="{{$kategori->id}}">{{$kategori->kategori_adi}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="input-field">
                                            <label for="kategoriler" class="font-weight-bold">Ürün Resimleri</label>
                                            <div class="input-images-1" style="padding-top: .5rem;"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 mt-2 text-right">
                                        <button type="submit" id="btnurun" class="btn btn-primary">Yeni Ürün Ekle</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row clearfix d-none">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <p><b>Basic Example</b></p>
                                    <div id="nouislider_basic_example"></div>
                                    <div class="m-t-20 font-12"><b>Value: </b><span class="js-nouislider-value"></span></div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <p><b>Range Example</b></p>
                                    <div id="nouislider_range_example"></div>
                                    <div class="m-t-20 font-12"><b>Value: </b><span class="js-nouislider-value"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <!-- Active Menü-->
    <script>
        $('#urunler').addClass('active');
        $('#urunekle').addClass('active');
    </script>

    <!-- Kategori -->
    <script src="/assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script><!-- Bootstrap Colorpicker Js -->
    <script src="/assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script><!-- Input Mask Plugin Js -->
    <script src="/assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>
    <script src="/assets/vendor/multi-select/js/jquery.multi-select.js"></script><!-- Multi Select Plugin Js -->
    <script src="/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
    <script src="/assets/vendor/nouislider/nouislider.js"></script><!-- noUISlider Plugin Js -->
    <script src="/assets/js/pages/forms/advanced-form-elements.js"></script>

    <!-- SummerNote-->
    <script>
        $("#btnurun").click(function(){
            var summerText = $(".summernote").summernote("code");
            $("#aciklama").val(summerText);
        });
    </script>

    <!-- Image -->
    <script type="text/javascript" src="/assets/js/image-uploader.js"></script>
    <script type="text/javascript">
        $('.input-images-1').imageUploader();
    </script>
@endsection
