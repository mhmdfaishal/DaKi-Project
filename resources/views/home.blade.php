<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HOME</title>
</head>
<body>
    <h3>Daftar Gunung</h3>

    <ul>
        @foreach ($data_gunung as $gunung)
            <li><a href="/home/{{ $gunung->nama_gunung }}">{{ $gunung->nama_gunung }}</a></li>
        @endforeach
    </ul>
</body>
</html>