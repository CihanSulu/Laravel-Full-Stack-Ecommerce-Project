@extends('layouts.master')
@section('title','Kategoriler')
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
                    <h1>Kategoriler</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Kategoriler</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Kategoriler</h2>
                        <ul class="header-dropdown dropdown">

                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('kategoriEkle')}}">Yeni Kategori Ekle</a></li>
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
                                    <th>Kategori Resmi</th>
                                    <th>Kategori Adı</th>
                                    <th>Alt Kategori</th>
                                    <th>Kategori Düzenle</th>
                                    <th>Kategori Sil</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Kategori Resmi</th>
                                    <th>Kategori Adı</th>
                                    <th>Alt Kategori</th>
                                    <th>Kategori Düzenle</th>
                                    <th>Kategori Sil</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($kategoriler as $index=>$kategori)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>
                                            @if(empty($kategori->category_image))
                                                <img height="50px" style="object-fit:contain" src="/assets/images/categories/nophoto.jpg"/>
                                            @else
                                                <img height="50px" style="object-fit:contain" src="/assets/images/categories/{{ $kategori->category_image }}"/>
                                            @endif
                                        
                                        </td>
                                        <td>{{$kategori->kategori_adi}}</td>
                                        
                                        <td>
                                            @if($kategori->category_sub == 0)
                                                Alt kategori yok
                                            @else
                                                {{ $kategori->parentCategory ? $kategori->parentCategory->kategori_adi : 'Kategori bulunamadı' }}
                                            @endif
                                        </td>
                                        
                                        <td><a href="{{route('kategoriDuzenle',$kategori->id)}}" style="color:#77797c;"><i class="fas fa-edit"></i> Düzenle</a></td>
                                        <td><a href="#" style="color:#77797c;" data-toggle="modal" data-target="#exampleModal{{$kategori->id}}"><i class="fas fa-trash"></i> Sil</a></td>
                                    </tr>

                                    <!-- Modal with btn -->
                                    <div class="modal fade" id="exampleModal{{$kategori->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Silmek İstediğinize Emin Misiniz ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Kategori silinirse, ona bağlı ürünler boşa düşer yinede silinsin mi ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Kapat</button>
                                                    <a href="{{route('kategoriSil',$kategori->id)}}" class="btn btn-round btn-primary">Sil</a>
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
        $("#kategoriler").addClass('active');
        $("#kategoriall").addClass('active');
    </script>
@endsection
