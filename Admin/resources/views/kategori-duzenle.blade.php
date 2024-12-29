@extends('layouts.master')
@section('title','Sipariş Detay')

@section('content')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>{{$kategori->kategori_adi}} Kategorisi</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('kategoriler')}}">Kategoriler</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$kategori->kategori_adi}}</li>
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
                            <form action="{{route('kategoriDuzenle',$kategori->id)}}" class="w-100" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label for="ad" class="font-weight-bold">Kategori Adı</label>
                                        <input type="text" name="ad" id="ad" value="{{$kategori->kategori_adi}}" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        @if($kategori->category_image != "")
                                        <img src="/assets/images/categories/{{$kategori->category_image}}" height="50px" style="object-fit:contain">
                                        @endif
                                        <label for="kategori_resmi" class="font-weight-bold">Kategori Resmi (Değişmeyecekse boş bırakınız)</label>
                                        <input type="file" name="kategori_resmi" id="kategori_resmi" class="form-control">
                                    </div>
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label for="kategori_resmi" class="font-weight-bold">Alt Kategori</label>
                                        <select name="categorySub" class="form-control">
                                            <option value="0">Alt Kategori Yok</option>
                                             @foreach ($kategoriler as $cat)
                                             @if($cat->id != $kategori->id)
                                             <option value="{{ $cat->id }}" @if($cat->id == $kategori->category_sub) selected @endif>{{ $cat->kategori_adi }}</option>
                                             @endif
                                             @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <input type="hidden" name="id" value="{{$kategori->id}}">
                                        <button type="submit" class="btn btn-primary float-right">Güncelle</button>
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
        $("#kategoriall").addClass('active');
    </script>
@endsection
