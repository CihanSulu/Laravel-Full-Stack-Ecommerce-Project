@extends('layouts.master')
@section('title','Ürünler')
@section('header')
    <style>
        .urunResim{
            height: 75px;
            width:100px;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Tüm Ürünler</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Ürünler</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Tüm Ürünler</h2>
                        <ul class="header-dropdown dropdown">

                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another Action</a></li>
                                    <li><a href="javascript:void(0);">Something else</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>Ürün Resimi</th>
                                    <th>Ürün Adı</th>
                                    <th>Ürün Fiyat</th>
                                    <th>Ürün Kategorisi</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Ürün Resimi</th>
                                    <th>Ürün Adı</th>
                                    <th>Ürün Fiyat</th>
                                    <th>Ürün Kategorisi</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($urunler as $urun)
                                    @php
                                        $resim = \App\Models\Urunler::find($urun->id)->Resimler()->first();
                                        $kategoriler = \App\Models\Urunler::find($urun->id)->Kategoriler()->get();
                                    @endphp
                                    <tr>
                                        <td><img src="{{(stripos(strtolower($resim->resim_path), 'hepsiburada') !== false) ? ' ':'/assets/images/urunler/'}}{{$resim->resim_path}}" alt="{{$urun->urun_adi}}" class="urunResim"></td>
                                        <td>{{$urun->urun_adi}}</td>
                                        <td>{{$urun->urun_fiyat}} ₺</td>
                                        <td>
                                            <ul>
                                                @foreach($kategoriler as $kategori)
                                                    <li>{{$kategori->kategori_adi}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td><a href="{{route('urunDuzenle',$urun->id)}}" style="color:#77797c;"><i class="fas fa-edit"></i> Düzenle</a></td>
                                        <td><a href="#" style="color:#77797c;" data-toggle="modal" data-target="#exampleModal{{$urun->id}}"><i class="fas fa-trash"></i> Sil</a></td>

                                        <!-- Modal with btn -->
                                        <div class="modal fade" id="exampleModal{{$urun->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Silmek İstediğinize Emin Misiniz ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Seçili ürünü silmek istediğinize emin misiniz ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Kapat</button>
                                                        <a href="{{route('urunSil',$urun->id)}}" class="btn btn-round btn-primary">Sil</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
        $("#urunler").addClass('active');
        $("#urunlerall").addClass('active');
    </script>
@endsection
