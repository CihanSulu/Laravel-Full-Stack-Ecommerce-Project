<!doctype html>
<html lang="en">
  <head>
    <title>Giriş Yapın</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
  </head>
  <body>
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="wrap d-md-flex">
              <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                <div class="text w-100">
                  <h2>Hoşgeldin !</h2>
                  <p>Kayıtlı Bir Hesabın Yok Mu?</p><a href="#" class="btn btn-white btn-outline-white">Kayıt Ol</a>
                </div>
              </div>
              <div class="login-wrap p-4 p-lg-5">
                <div class="d-flex">
                  <div class="w-100">
                    <h3 class="mb-4">Giris Yap</h3>
                  </div>
                  <div class="w-100">
                    <p class="social-media d-flex justify-content-end"><a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a><a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a></p>
                  </div>
                </div>
                <form class="form-auth-small m-t-20" action="{{ route('giris') }}" method="post">
                  {{csrf_field()}}
                  <div class="form-group mb-3"><label class="label" for="name">Kullanıcı Adı</label><input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Kullanıcı Adı" required></div>
                  <div class="form-group mb-3"><label class="label" for="password">Şifre</label><input type="password" name="password" class="form-control" placeholder="Şifre" required></div>
                  <div class="form-group"><button type="submit" class="form-control btn btn-primary submit px-3">Giriş Yap</button></div>
                  <div class="form-group d-md-flex">
                    <div class="w-50 text-left"><label class="checkbox-wrap checkbox-primary mb-0">Beni Hatırla <input type="checkbox" name="hatirla" checked><span class="checkmark"></span></label></div>
                    <div class="w-50 text-md-right"><a href="#">Şifremi Unuttum</a></div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
  
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
  <script>
      @if(session()->has('tur'))
          iziToast.{{session('tur')}}({
              title: '{{session('title')}}',
              message: '{{session('message')}}',
          });
      @endif
  </script>
</html>