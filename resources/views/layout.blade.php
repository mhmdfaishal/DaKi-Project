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
    @stack('styles')
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous" ></script>
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-light" style="background-color: #12372A">
        <div class="container">
            <a class="navbar-brand" href="/">
                <span class="navbar-toogle-icon">
                    <img class="btn-logo-home" src="{{ asset('images/logo6.png') }}" alt="logo" width="140" height="140">
                </span>
            </a>
            <span>
                <a class="nav-link" href="/home">Home</a>
            </span>
            <span>
                <a class="nav-link" href="/sewa">Sewa</a>
            </span>
            <span id="nav">|</span>
            @if (Auth::check())
            <span>
                <a class="nav-link" href="{{ route('logout') }}">{{Auth::user()->nama}}</a>
            </span>
            @else
            <span>
                <form class="d-flex">
                    <button type="button" class="btn btn-login" data-toggle="modal" data-target=".login-modal">Login</button>
                </form>
            </span>
            @endif
        </div>
    </nav>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="{{asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>  
    @stack('scripts')
</body>
</html>