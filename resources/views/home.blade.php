<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Desa Melung</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        header {
            background-color: #2c7a4b;
            color: white;
            padding: 30px;
            text-align: center;
        }

        nav {
            background-color: #245f3c;
            padding: 15px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        .button {
            display: inline-block;
            background-color: #2c7a4b;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <header>
        <h1>Desa Melung</h1>
        <p>Kabupaten Banyumas</p>
    </header>

    <nav>
        <a href="/">Beranda</a>
        <a href="/berita">Berita</a>
        <a href="/tentang">Tentang</a>
    </nav>

    <div class="container">

        <h2>Selamat Datang di Desa Melung</h2>

        <p>
            Website sederhana Desa Melung yang dibuat
            menggunakan Laravel dan Blade.
        </p>

        <a href="/berita" class="button">
            Lihat Berita
        </a>

    </div>

</body>
</html>