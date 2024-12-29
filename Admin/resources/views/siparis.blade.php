@extends('layouts.master')
@if(isset($kategoriler))
    @section('title',$kategoriler->siparis_adi)
@else
    @section('title','Siparişler')
@endif

@section('header')
    <style>
        td.details-control {
            background: url('../assets/images/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('../assets/images/details_close.png') no-repeat center center;
        }
    </style>
@endsection

@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>@if(isset($kategoriler)){{$kategoriler->siparis_adi}} @else Tüm Siparişler @endif</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('siparisKategori')}}">Siparişler</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@if(isset($kategoriler)){{$kategoriler->siparis_adi}} @else Tüm Siparişler @endif</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>@if(isset($kategoriler)){{$kategoriler->siparis_adi}} @else Tüm Siparişler @endif</h2>
                    </div>
                    <div class="body">
                        <!-- Üst Butonlar -->
                        @if(isset($kategoriler) && $kategoriler->id == 1)
                            <a type="button" class="btn btn-dark text-white mb-2" data-toggle="modal" data-target="#topluonay"><i class="fas fa-check-double"></i> Siparişleri Toplu Onayla</a>
                            <!-- Modal with btn -->
                            <div class="modal fade" style="color:#a5a8ad;" id="topluonay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Toplu Onaylamak İstediğinize Emin Misiniz ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Tüm yeni siparişler toplu olarak onaylanacak. Siparişler toplu olarak onaylansın mı ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Kapat</button>
                                            <a href="{{route('topluOnay')}}" class="btn btn-round btn-primary">Toplu Onayla</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(isset($kategoriler) && $kategoriler->id == 2)
                            <a type="button" class="btn btn-dark text-white mb-2" data-toggle="modal" data-target="#topluarsiv"><i class="fas fa-archive"></i> Siparişleri Toplu Arşivle</a>
                            <a href="{{route('siparisPdf')}}" type="button" class="btn btn-dark text-white mb-2" target="_blank"><i class="fas fa-file-pdf"></i> PDF Oluştur</a>
                            <a href="{{route('siparisExcel')}}" type="button" class="btn btn-dark text-white mb-2" target="_blank"><i class="fas fa-file-excel"></i> Excel Oluştur</a>
                            <!-- Modal with btn -->
                            <div class="modal fade" style="color:#a5a8ad;" id="topluarsiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Toplu Arşivlemek İstediğinize Emin Misiniz ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Tüm onaylı siparişler toplu olarak arşivlenecek. Siparişler toplu olarak arşivlensin mi ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Kapat</button>
                                            <a href="{{route('topluArsiv')}}" class="btn btn-round btn-primary">Toplu Arşivle</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>İsim</th>
                                    <th>Soyisim</th>
                                    <th>Telefon</th>
                                    <th>Şehir/İlçe</th>
                                    <th>Fiyat</th>
                                    <th>Site</th>
                                    <th>Tarih</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>İsim</th>
                                    <th>Soyisim</th>
                                    <th>Telefon</th>
                                    <th>Şehir/İlçe</th>
                                    <th>Fiyat</th>
                                    <th>Site</th>
                                    <th>Tarih</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @if(isset($kategoriler) && count($siparisler)==0)
                                    <tr>
                                        <td colspan="7" class="text-center">Sipariş bulunamadı.</td>
                                    </tr>
                                @endif
                                @foreach($siparisler as $siparis)
                                    <tr>
                                        <td><a href="{{route('siparisDetay',$siparis->id)}}" style="color:#77797c;"><i class="fas fa-edit"></i></a> {{$siparis->ad}}</td>
                                        <td>{{$siparis->soyad}}</td>
                                        <td>{{$siparis->tel}}</td>
                                        <td>{{$siparis->sehir}} / {{$siparis->ilce}}</td>
                                        <td>{{$siparis->fiyat}} ₺</td>
                                        <td>{{$siparis->website}}</td>
                                        <td>{{$siparis->tarih}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
        $("#siparisler").addClass('active');
        @if(isset($kategoriler))
            $("#kategori{{$kategoriler->id}}").addClass('active');
        @else
            $("#all").addClass('active');
        @endif
    </script>
@endsection
