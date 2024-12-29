@extends('layouts.master')
@section('title','Sipariş Oluştur')
@section('header')
    <link rel="stylesheet" href="/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css">
    <link rel="stylesheet" href="/assets/vendor/multi-select/css/multi-select.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="/assets/vendor/nouislider/nouislider.min.css">
@endsection

@section('content')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Yeni Sipariş Oluştur</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('siparisKategori')}}">Siparişler</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sipariş Oluştur</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="javascript:history.go(-1)" class="btn btn-sm btn-primary btn-round" title=""><i class="fa fa-arrow-left"></i> Geri Dön</a>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <!-- Düzenleme -->
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="body">
                            <form action="{{route('siparisManuel')}}" class="w-100" method="post">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 mb-3">
                                        <label for="ad" class="font-weight-bold">İsim</label>
                                        <input type="text" name="ad" id="ad" placeholder="İsim" value="{{old('ad')}}" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-3">
                                        <label for="soyad" class="font-weight-bold">Soyisim</label>
                                        <input type="text" name="soyad" id="soyad" placeholder="Soyisim" value="{{old('soyad')}}" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-3">
                                        <label for="tel" class="font-weight-bold">Telefon</label>
                                        <input type="tel" name="tel" id="tel" placeholder="Telefon" value="{{old('tel')}}" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-3">
                                        <label for="fiyat" class="font-weight-bold">Fiyat</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-lira-sign"></i></span>
                                            </div>
                                            <input type="text" name="fiyat" value="{{old('fiyat')}}" class="form-control money-dollar" placeholder="Fiyat" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-3">
                                        <label for="Iller" class="font-weight-bold">Şehir</label>
                                        <select class="custom-select" id="Iller" name="iller" required="">
                                            <option value="">İl *</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-3">
                                        <label for="Ilceler" class="font-weight-bold">İlçe</label>
                                        <select class="custom-select" id="Ilceler" disabled="disabled" name="ilce" required="">
                                            <option value="">İlçe *</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="adres" class="font-weight-bold">Adres</label>
                                        <textarea id="adres" name="adres" placeholder="Adres" class="form-control" required rows="4">{{old('adres')}}</textarea>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="not" class="font-weight-bold">Sipariş Notu</label>
                                        <textarea id="not" name="siparis_not" placeholder="Sipariş Notu" class="form-control" rows="2">{{old('siparis_not')}}</textarea>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-3">
                                        <label for="odeme" class="font-weight-bold">Ödeme Türü</label>
                                        <select name="odeme" id="odeme" class="custom-select">
                                            <option value="Kapıda Nakit Ödeme" {{(old('odeme') == "Kapıda Nakit Ödeme") ? 'selected':''}}>Kapıda Nakit Ödeme</option>
                                            <option value="Kapıda Kredi Kartı" {{(old('odeme') == "Kapıda Kredi Kartı") ? 'selected':''}}>Kapıda Kredi Kartı</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-3">
                                        <label for="kategori" class="font-weight-bold">Kategori</label>
                                        <select name="kategori" id="kategori" class="custom-select">
                                            @php
                                              $kategoriler = \App\Models\siparisKategori::get();
                                            @endphp
                                            @foreach($kategoriler as $kategori)
                                                <option value="{{$kategori->id}}" {{(old('kategori') == $kategori->id) ? 'selected':''}}>{{$kategori->siparis_adi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="urunler" class="font-weight-bold">Ürünler</label>
                                        <div class="multiselect_div">
                                            <div class="row mt-3 multiurun">
                                                <div class="col-md-6 sol">
                                                    <small class="font-weight-bold">Tüm Ürünler</small>
                                                    <div class="card h-100 p-2">
                                                        <ul>
                                                            @foreach($tum_urunler as $all)
                                                                <li id="{{$all->id}}" data-name="{{$all->urun_adi}}">{{$all->urun_adi}}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 sag">
                                                    <small class="font-weight-bold">Seçilen Ürünler</small>
                                                    <div class="card h-100 p-2">
                                                        <select name="urunler[]" id="multiurunler" class="multiselect multiselect-custom w-100 h-100" multiple="multiple">

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 mt-2 text-right">
                                        <input type="hidden" name="sehir" value="{{old('sehir')}}" id="formsehir">
                                        <button type="submit" class="btn btn-primary">Siparişi Oluştur</button>
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
    <script src="/assets/js/sehir.js"></script>
    <script>
        $('#siparisler').addClass('active');
        $('#manuel').addClass('active');
    </script>

    <script>
        $( document ).ready(function() {
            $.each(data, function( index, value ) {
                var sehir = "{{old('sehir')}}";
                if(value.il != sehir){
                    $('#Iller').append($('<option>', {
                        value: value.plaka,
                        text:  value.il
                    }));
                }
                else{
                    $('#Iller').append($('<option>', {
                        value: value.plaka,
                        text:  value.il,
                        selected: "selected"
                    }));
                }
            });

            var valueSelected = this.value;
            var sehir = $(this).children("option:selected").html();
            if($('#Iller').val() > 0) {
                $('#Ilceler').html('');
                $('#Ilceler').append($('<option>', {
                    value: "",
                    text:  'Lütfen Bir İlçe seçiniz'
                }));
                $('#Ilceler').prop("disabled", false);
                var resultObject = search($('#Iller').val(), data);
                $.each(resultObject.ilceleri, function( index, value ) {
                    var ilce = "{{old('ilce')}}";
                    if(value!=ilce){
                        $('#Ilceler').append($('<option>', {
                            value: value,
                            text:  value
                        }));
                    }
                    else{
                        $('#Ilceler').append($('<option>', {
                            value: value,
                            text:  value,
                            selected: "selected"
                        }));
                    }

                });
            }

            $("#Iller").change(function(){
                var valueSelected = this.value;
                var sehir = $(this).children("option:selected").html();
                $("#formsehir").val(sehir);
                if($('#Iller').val() > 0) {
                    $('#Ilceler').html('');
                    $('#Ilceler').append($('<option>', {
                        value: "",
                        text:  'Lütfen Bir İlçe seçiniz'
                    }));
                    $('#Ilceler').prop("disabled", false);
                    var resultObject = search($('#Iller').val(), data);
                    $.each(resultObject.ilceleri, function( index, value ) {
                        $('#Ilceler').append($('<option>', {
                            value: value,
                            text:  value
                        }));
                    });
                    return false;
                }
                $('#Ilceler').prop("disabled", true);
            });
        });
    </script>
    <script src="/assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script><!-- Bootstrap Colorpicker Js -->
    <script src="/assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script><!-- Input Mask Plugin Js -->
    <script src="/assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>
    <script src="/assets/vendor/multi-select/js/jquery.multi-select.js"></script><!-- Multi Select Plugin Js -->
    <script src="/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
    <script src="/assets/vendor/nouislider/nouislider.js"></script><!-- noUISlider Plugin Js -->
    <script src="/assets/js/pages/forms/advanced-form-elements.js"></script>
    <script src="/assets/js/app.js"></script>
@endsection
