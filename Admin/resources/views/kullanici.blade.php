@extends('layouts.master')
@section('title','Kullanıcılar')
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
                    <h1>Kullanıcılar</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Kullanıcılar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Kullanıcılar</h2>
                        <ul class="header-dropdown dropdown">

                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('kullaniciEkle')}}">Yeni Kullanıcı Ekle</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kullanıcı Ad</th>
                                    <th>Kullanıcı Soyad</th>
                                    <th>Kullanıcı Email</th>
                                    <th>Kullanıcı Düzenle</th>
                                    <th>Kullanıcı Sil</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Kullanıcı Ad</th>
                                    <th>Kullanıcı Soyad</th>
                                    <th>Kullanıcı Email</th>
                                    <th>Kullanıcı Düzenle</th>
                                    <th>Kullanıcı Sil</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($kullanicilar as $index=>$kullanici)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$kullanici->ad}}</td>
                                        <td>{{$kullanici->soyad}}</td>
                                        <td>{{$kullanici->email}}</td>
                                        <td><a href="{{route('kullaniciDuzenle',$kullanici->id)}}" style="color:#77797c;"><i class="fas fa-edit"></i> Düzenle</a></td>
                                        <td><a href="#" style="color:#77797c;" data-toggle="modal" data-target="#exampleModal{{$kullanici->id}}"><i class="fas fa-trash"></i> Sil</a></td>
                                    </tr>

                                    <!-- Modal with btn -->
                                    <div class="modal fade" id="exampleModal{{$kullanici->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Silmek İstediğinize Emin Misiniz ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Kullanıcı silinecek onaylıyor musunuz ? </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Kapat</button>
                                                    <a href="{{route('kullaniciSil',$kullanici->id)}}" class="btn btn-round btn-primary">Sil</a>
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
        $("#kullanici").addClass('active');
        $("#kullaniciall").addClass('active');
    </script>
@endsection
