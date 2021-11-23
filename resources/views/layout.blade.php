<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/logo6.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    @stack('styles')
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css"
    integrity="sha256-pODNVtK3uOhL8FUNWWvFQK0QoQoV3YA9wGGng6mbZ0E=" crossorigin="anonymous" />
    <title>@yield('title')</title>
</head>
<body>
    @if (session('validation_login') || session('fail_login'))
    <script>
        $(document).ready(function(){
            $(".login-modal").modal('show');
        });
    </script>
    @elseif (session('validation_register') || session('validation_token'))
    <script>
        $(document).ready(function(){
            $(".login-modal").modal('show');
            $(".login-content").addClass('sign-up-mode')
        });
    </script>
    @elseif (session('register_with_google'))
    <input type="hidden" name="email_with_google" id="email_with_google" value="{{session('email')}}">
    <input type="hidden" name="nama_with_google" id="nama_with_google" value="{{session('nama')}}">
    <script>
        $(document).ready(function(){
            var email = $('#email_with_google').val();
            var nama = $('#nama_with_google').val();
            $(".login-modal").modal('show');
            $(".login-content").addClass('sign-up-mode');
            $("#email").val(email);
            $("#nama").val(nama);
        });
    </script>
    @endif
    <nav class="navbar navbar-light" style="background-color: #12372A;">
        <div class="container-nav">
            <a class="navbar-brand" href="/">
                <span class="navbar-toogle-icon">
                    <img class="btn-logo-home" src="{{ asset('images/logo6.png') }}" alt="logo" width="140" height="140">
                </span>
            </a>
            <ul class="nav-menu">
                <span class="nav-item">
                    <a class="nav-link" href="/home">Home</a>
                </span>
                <span class="nav-item">
                    <a class="nav-link" href="/sewa">Sewa</a>
                </span>
                <span class="nav-item" id="navSplit"></span>
                @if (Auth::check())
                <div class="dropdown1">
                    @if(count($nama) > 1 )
                    <button onclick="myFunction()" class="btn dropbtn nav-item">{{ $nama[1]; }}</button>
                    @else
                    <button onclick="myFunction()" class="btn dropbtn nav-item">{{ $nama[0]; }}</button>
                    @endif
                    <div id="myDropdown" class="dropdown-content">
                        <a class="first-menu" href="#home"><i class="fas fa-user"></i> Profile</a>
                        @if(Auth::user()->role == 2)
                        <a href="{{route('pesanan')}}"><i class="fas fa-shopping-cart"></i> Pesanan</a>
                        <a href="{{route('admin.detail.toko')}}"><i class="fas fa-shopping-cart"></i> Toko Ku</a>
                        @elseif(Auth::user()->role == 3)
                        <a href="{{route('index.admin.gunung')}}"><i class="fas fa-campground"></i> Basecamp</a>
                        @endif
                        <a class="last-menu" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
                @else
                <span class="nav-item">
                    <form class="d-flex">
                        <button type="button" class="btn btn-login nav-link" data-toggle="modal" data-target=".login-modal">Login</button>
                    </form>
                </span>
                @endif
            </ul>
        </div>
        <div class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </nav>
    <div class="modal fade bd-example-modal-lg login-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-login" style="border-radius: 20px;">
                <div class="login-content" style="border-radius: 20px;">
                    <div class="forms-container">
                        <div class="signin-signup">
                            <form action="{{ route('login')}}" method="post" class="login-form sign-in-form" enctype="multipart/form-data">
                                @csrf
                                <h2 class="title">Masuk akun</h2>
                                @if (session('fail_login'))
                                <div class="alert" role="alert">
                                    {{ session('fail_login') }}
                                </div>
                                @endif
                                <div class="input-field">
                                    <i class="fas fa-user"></i>
                                    <input type="email" name="email" placeholder="Email" value="{{old('email')}}" required />
                                </div>
                                @if (session('validation_login'))
                                @error('email')
                                <div class="alert" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                @endif
                                <div class="input-field">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" name="password" placeholder="Password" value="{{old('password')}}" required/>
                                </div>
                                @if (session('validation_login'))
                                @error('password')
                                <div class="alert" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                @endif
                                <div class="me-4 d-flex align-items-center remember-me">
                                    <input type="checkbox" name="remember" id="remember" class="me-2">
                                    <label for="remember-me">Remember Me</label>
                                </div>
                                <input type="submit" value="Masuk" class="btn btn-login-modal solid" />
                            </form>
                            <form action="{{ route('register') }}" method="POST" class="login-form sign-up-form" enctype="multipart/form-data">
                                @csrf
                                <h2 class="title">Daftar akun</h2>
                                <div class="input-field">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" name="email" id="email" placeholder="Email" value="{{old('email')}}" required/>
                                </div>
                                @if (session('validation_register'))
                                @error('email')
                                <div class="alert" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                @endif
                                <div class="input-field">
                                    <i class="fas fa-user-circle"></i>
                                    <input type="text" name="nama" id="nama" placeholder="Nama" value="{{old('nama')}}" required/>
                                </div>
                                @if (session('validation_register'))
                                @error('nama')
                                <div class="alert" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                @endif
                                <div class="input-field">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" name="password" placeholder="Password" value="{{old('password')}}" required/>
                                </div>
                                @if (session('validation_register'))
                                @error('password')
                                <div class="alert" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                @endif
                                <div class="input-field">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" name="confirm_password" placeholder="Konfirmasi Password" value="{{old('confirm_password')}}" required/>
                                </div>
                                @if (session('validation_register'))
                                @error('confirm_password')
                                <div class="alert" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                @endif
                                <div class="form-group d-flex">
                                    <label class="custom-switch">
                                        <input type="checkbox" name="role" id="role" value="1" class="custom-switch-input" >   
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">@lang('Pendaki')</span>
                                    </label>
                                    <label class="custom-switch">
                                        <input type="checkbox" name="role" id="role" value="2" class="custom-switch-input" > 
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">@lang('Pemilik Toko')</span>
                                    </label>
                                    <label class="custom-switch">
                                        <input type="checkbox" name="role" id="role" value="3" class="custom-switch-input" @if(session('validation_token')) checked @endif>   
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">@lang('Pengelola Basecamp')</span>
                                    </label>
                                </div>
                                <div class="input-field" id="token_field" style="display: none"  >
                                    <i class="fas fa-key"></i>
                                    <input type="password" name="token" placeholder="Masukkan Token" value="{{old('Token')}}"/>
                                </div>
                                @if (session('validation_token'))
                                <script>$('#token_field').show()</script>
                                <div class="alert" role="alert">
                                    Token Invalid
                                </div>
                                @endif
                                <input type="submit" class="btn btn-login-modal" value="Daftar" />
                            </form>
                        </div>
                    </div>
                    <div class="panels-container">
                        <div class="panel left-panel">
                            <div class="content">
                                <h3>Belum memiliki akun?</h3>
                                <p>Daftar dulu!</p>
                                <button class="btn btn-login-modal transparent" id="sign-up-btn">
                                Daftar
                                </button>
                                <p style="margin-top:2% !important;margin-bottom:0%;">atau</p>
                                <a href="{{ route('google.login') }}" class="text-decoration-none" style="color:white;">
                                <button class="btn btn-login-google-modal">
                                        <i class="fab fa-google"></i>
                                    </button>
                                </a>
                            </div>
                            <img src="{{asset('images/log.svg') }}" class="image" alt="" />
                        </div>
                        <div class="panel right-panel">
                            <div class="content">
                                <h3>Sudah punya akun?</h3>
                                <p>
                                Masuk akun untuk menjadi pendaki sejati!
                                </p>
                                <button class="btn btn-login-modal transparent" id="sign-in-btn">
                                Masuk
                                </button>
                            </div>
                            <img src="{{asset('images/register.svg') }}" class="image" alt="" />
                        </div>
                    </div>
                </div>
            <!-- End Of Content -->
            </div>
        </div>
    </div>
    @yield('main')
    <footer class="footer">
        <div class="container">
            <h1 class="title-footer">Dasbor Pendaki</h1>
            <p class="desc-title">Platform untuk para pendaki sejati yang ingin menentukan destinasi pendakian dengan tepat.</p>

            <p class="email-footer"><i class="far fa-envelope"></i> : DaKi@gmail.com</p>
            <div class="socmed">
                <h2>Reach Us</h2>
                <a href="https://facebook.com/DaKi"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com/daki"><i class="fab fa-instagram"></i></a>
            </div>
            <p class="copyright-footer">DaKi Company &copy;2021</p>
        </div>
    </footer>
    <script src="/js/layout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="{{asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
    integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script>
      AOS.init();
    </script> 
    <script>
    $("input:checkbox").on('click', function() {
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        }else {
            $box.prop("checked", false);
        }
        if ($box.val() == "3") {
            $('#token_field').show();
        }else{
            $('#token_field').hide();
        }
        if(!$box.is(":checked")){
            $('#token_field').hide();
        }
    });
    </script> 
    @stack('scripts')
</body>
</html>