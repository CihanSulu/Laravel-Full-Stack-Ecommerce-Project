@extends("layouts.master")
@section('title','Profil Ayarları')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Profil Ayarları</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Profil Ayarları</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="javascript:history.go(-1)" class="btn btn-sm btn-primary btn-round" title=""><i class="fa fa-arrow-left"></i> Geri Dön</a>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card social">
                        <div class="profile-header d-flex justify-content-between justify-content-center">
                            <div class="d-flex">
                                <div class="details">
                                    <h5 class="mb-0">{{session('ad')}} {{session('soyad')}}</h5>
                                    <span class="text-light">Yönetici</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Profil Bilgileri</h2>
                        </div>
                        <div class="body">
                            <form action="{{route('profil')}}" method="post">
                                {{csrf_field()}}
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="isim" placeholder="İsim" value="{{session('ad')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="soyisim" placeholder="Soyisim" value="{{session('soyad')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" placeholder="email" value="{{session('email')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <hr>
                                        <h6>Şifreyi Değiştir</h6>
                                        <div class="form-group">
                                                <input type="password" class="form-control" name="eski" placeholder="Şuanki Şifreniz">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="yeni" placeholder="Yeni Şifreniz">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="yeni_confirmation" placeholder="Yeni Şifreniz Tekrar">
                                        </div>
                                    </div>
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-round btn-primary float-right">Profili Güncelle</button>
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
        $("#profil").addClass("active");
    </script>
@endsection
