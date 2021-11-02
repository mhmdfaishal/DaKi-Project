<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('images/logo6.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}" /> --}}
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous" ></script>
    <title>DaKi | Dasbor Pendaki</title>
  </head>
  <body>
    <nav class="navbar navbar-light" style="background-color: #12372A">
        <div class="container">
            <a class="navbar-brand" href="/">
                <span class="navbar-toogle-icon">
                    <img src="{{ asset('images/logo6.png') }}" alt="logo" width="140" height="140">
                </span>
            </a>
            <span>
                <a class="nav-link" href="#">Home</a>
            </span>
            <span>
                <a class="nav-link" href="#">Sewa</a>
            </span>
            <span id="nav">|</span>
            <span>
                <form class="d-flex">
                    <button type="button" class="btn" data-toggle="modal" data-target=".login-modal">Login</button>
                </form>
            </span>
            <span>
                <a class="nav-link" href="#" id="navDaftar">Daftar</a>
            </span>
        </div>
    </nav>
    <div class="modal fade bd-example-modal-lg login-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="login-content">
                    <div class="forms-container">
                        <div class="signin-signup">
                            <form action="#" class="login-form sign-in-form">
                                <h2 class="title">Sign in</h2>
                                <div class="input-field">
                                    <i class="fas fa-user"></i>
                                    <input type="text" placeholder="Username" />
                                </div>
                                <div class="input-field">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" placeholder="Password" />
                                </div>
                                <input type="submit" value="Login" class="btn btn-login-modal solid" />
                            </form>
                            <form action="#" class="login-form sign-up-form">
                                <h2 class="title">Sign up</h2>
                                <div class="input-field">
                                    <i class="fas fa-user"></i>
                                    <input type="text" placeholder="Username" />
                                </div>
                                <div class="input-field">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" placeholder="Email" />
                                </div>
                                <div class="input-field">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" placeholder="Password" />
                                </div>
                                <input type="submit" class="btn btn-login-modal" value="Sign up" />
                            </form>
                        </div>
                    </div>
                    <div class="panels-container">
                        <div class="panel left-panel">
                            <div class="content">
                                <h3>New here ?</h3>
                                <p>Get Your Account Here!</p>
                                <button class="btn btn-login-modal transparent" id="sign-up-btn">
                                Sign up
                                </button>
                            </div>
                            <img src="{{asset('images/log.svg') }}" class="image" alt="" />
                        </div>
                        <div class="panel right-panel">
                            <div class="content">
                                <h3>Already know you account?</h3>
                                <p>
                                Get In with your account to get excellence experience!
                                </p>
                                <button class="btn btn-login-modal transparent" id="sign-in-btn">
                                Sign in
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

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="h1 display-6">Teman Mendaki Untuk Para<span id="pendaki"> Pendaki&nbsp;</span></h1>
            </div>
            <div class="col">
                <div>
                    <img class="img-fluid" src="{{asset('images/LandingPage.png') }}" alt="LandingPage">
                </div>
            </div>
        </div>
        <div class="row cf" id="scrolldown">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill ="#C9DB43"class="bi bi-chevron-double-down" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
            </svg>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="{{asset('js/app.js') }}"></script>
  </body>
</html>