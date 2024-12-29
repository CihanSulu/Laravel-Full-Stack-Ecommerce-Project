@extends('layouts.master')
@section('title','Sliderlar')

@section('header')
    <style>
        .sliderResim{
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
                    <h1>Sliderlar</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Sliderlar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Sliderlar</h2>
                        <ul class="header-dropdown dropdown">

                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('sliderEkle')}}">Yeni Slider Ekle</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>Slider</th>
                                    <th>Slider Başlık</th>
                                    <th>Slider Açıklama</th>
                                    <th>Kategori Düzenle</th>
                                    <th>Kategori Sil</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Slider</th>
                                    <th>Slider Başlık</th>
                                    <th>Slider Açıklama</th>
                                    <th>Kategori Düzenle</th>
                                    <th>Kategori Sil</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($sliderlar as $slider)
                                    <tr>
                                        <td><img src="/assets/images/slider/{{$slider->resim_path}}" alt="asd" class="sliderResim"></td></td>
                                        <td>{{$slider->baslik}}</td>
                                        <td>{{$slider->aciklama}}</td>
                                        <td><a href="{{route('sliderDuzenle',$slider->id)}}" style="color:#77797c;"><i class="fas fa-edit"></i> Düzenle</a></td>
                                        <td><a href="#" style="color:#77797c;" data-toggle="modal" data-target="#exampleModal{{$slider->id}}"><i class="fas fa-trash"></i> Sil</a></td>
                                    </tr>

                                    <!-- Modal with btn -->
                                    <div class="modal fade" id="exampleModal{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Silmek İstediğinize Emin Misiniz ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Seçili sliderı silmek istediğinize emin misiniz ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Kapat</button>
                                                    <a href="{{route('sliderSil',$slider->id)}}" class="btn btn-round btn-primary">Sil</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
        $("#slider").addClass('active');
        $("#sliderall").addClass('active');
    </script>
@endsection
