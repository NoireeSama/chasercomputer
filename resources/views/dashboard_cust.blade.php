<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    ini halaman dashboard untuk customer
    {{ auth()->user()->username }}
    {{ auth()->user()->role->nama }}
    <form method="POST" action="{{ route('logout') }}" class="logout-btn-wrapper">
        @csrf
        <button type="submit" class="glass-pill logout-btn" style="border:none; background:none; padding:0;">
            Keluar
        </button>
    </form>
</body>
</html>
