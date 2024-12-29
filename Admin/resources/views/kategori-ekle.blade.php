@extends('layouts.master')
@section('title','Kategori Ekle')

@section('content')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Kategori Ekle</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('kategoriler')}}">Kategoriler</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Yeni Kategori Ekle</li>
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
                            <form action="{{route('kategoriEkle')}}" class="w-100" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label for="ad" class="font-weight-bold">Kategori Adı</label>
                                        <input type="text" name="ad" id="ad" placeholder="Kategori Adı" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label for="kategori_resmi" class="font-weight-bold">Kategori Resmi</label>
                                        <input type="file" name="kategori_resmi" id="kategori_resmi" class="form-control">
                                    </div>
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label for="kategori_resmi" class="font-weight-bold">Alt Kategori</label>
                                        <select name="categorySub" class="form-control">
                                            <option value="0">Alt Kategori Yok</option>
                                             @foreach ($kategoriler as $kategori)
                                             <option value="{{$kategori->id}}">{{$kategori->kategori_adi}}</option>
                                             @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <button type="submit" class="btn btn-primary float-right">Yeni Kategori Ekle</button>
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
        $("#kategoriler").addClass('active');
        $("#kategoriekle").addClass('active');
    </script>
@endsection
