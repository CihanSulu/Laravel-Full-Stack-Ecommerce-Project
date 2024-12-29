@extends("layouts.master")
@section('title','Yeni Kullanıcı Oluştur')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Kullanıcı Oluştur</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Kullanıcı Oluştur</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="javascript:history.go(-1)" class="btn btn-sm btn-primary btn-round" title=""><i class="fa fa-arrow-left"></i> Geri Dön</a>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Yeni Kullanıcı Oluştur</h2>
                        </div>
                        <div class="body">
                            <form action="{{route('kullaniciEkle')}}" method="post">
                                {{csrf_field()}}
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="isim" placeholder="İsim"  value="{{old('isim')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="soyisim" placeholder="Soyisim" value="{{old('soyisim')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <hr>
                                        <h6>Şifre</h6>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="yeni" placeholder="Şifre" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="yeni_confirmation" placeholder="Şifre Tekrar" required>
                                        </div>
                                    </div>
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-round btn-primary float-right">Yeni Kullanıcı Oluştur</button>
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
        $("#kullanici").addClass("active");
        $("#kullaniciekle").addClass("active");
    </script>
@endsection
