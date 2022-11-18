<!doctype html>
<html lang="en">
<head>
    <title>Mam Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/login/css/style.css">

    <link rel="shortcut icon" type="image/x-icon" href="/images/Logo.png">

</head>
<body class="img js-fullheight" style="background-image: url(/login/images/bg.jpg);">
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Manh Mam</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Quan Ly Website</h3>
                    @if($errors->any())
                        <p class="w-100 text-center" style="color: #E5F01F">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{$errors->first()}}
                        </p>
                    @endif
                    <form action="{{ route('admin.postLogin') }}" class="signin-form" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Tên đăng nhập" >
                        </div>
                        <div class="form-group">
                            <input id="password-field" type="password" class="form-control" name="password" id="password" placeholder="Mật Khẩu" >
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Đăng Nhập</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50">
                                <label class="checkbox-wrap checkbox-primary">Nhớ Mật Khẩu
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="w-50 text-md-right">
                                <a href="#" name="remember" value="1" style="color: #fff">Quên Mật Khẩu</a>
                            </div>
                        </div>
                    </form>
                    <p class="w-100 text-center">&mdash; Đăng Nhập Với &mdash;</p>
                    <div class="social d-flex text-center">
                        <a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Facebook</a>
                        <a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Google</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="/login/js/jquery.min.js"></script>
<script src="/login/js/popper.js"></script>
<script src="/login/js/bootstrap.min.js"></script>
<script src="/login/js/main.js"></script>

</body>
</html>

