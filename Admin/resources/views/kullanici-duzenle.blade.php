@extends("layouts.master")
@section('title',$kullanici->ad.' Kullanıcısını Düzenle')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Kullanıcı Düzenle</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Kullanıcı Düzenle</li>
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
                            <h2>{{$kullanici->ad}} Kullanıcısını Düzenle</h2>
                        </div>
                        <div class="body">
                            <form action="{{route('kullaniciDuzenle',$kullanici->id)}}" method="post">
                                {{csrf_field()}}
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="isim" placeholder="İsim"  value="{{$kullanici->ad}}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="soyisim" placeholder="Soyisim" value="{{$kullanici->soyad}}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{$kullanici->email}}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <hr>
                                        <h6>Şifre</h6>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="yeni" placeholder="Yeni Şifre">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="yeni_confirmation" placeholder="Yeni Şifre Tekrar">
                                        </div>
                                    </div>
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-round btn-primary float-right">Kullanıcıyı Düzenle</button>
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
        $("#kullaniciall").addClass("active");
    </script>
@endsection
