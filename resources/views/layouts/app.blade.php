<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Pemerintah Desa Jalatrang">
    <meta name="description" content="Kumpulan berita dan informasi terkini dari Desa Jalatrang">
    <title>@yield('title', 'Berita Desa') — Jalatrang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Teko:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --hijau: #0e1a3a;
            --hijau2: #12307a;
            --emas: #f5b301;
            --abu: #f3f5f7;
        }

        body {
            background: #fff;
            font-family: 'Inter', system-ui, sans-serif;
            color: #1f2937;
        }

        .teko {
            font-family: 'Teko', sans-serif;
        }

        #loader {
            position: fixed;
            inset: 0;
            background: #0e1a3a;
            color: #fff;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity .4s;
        }

        #loader.hide {
            opacity: 0;
            pointer-events: none;
        }

        .topbar {
            background: #0e1a3a;
            color: #e5e9f5;
            font-size: .85rem;
            padding: 8px 14px;
            display: flex;
            align-items: center;
            gap: 14px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .topbar .label {
            background: linear-gradient(90deg, #ff7a18, #f5501e);
            color: #fff;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 20px;
            white-space: nowrap;
        }

        .marquee {
            overflow: hidden;
            white-space: nowrap;
            flex: 1;
        }

        .marquee span {
            display: inline-block;
            padding-left: 100%;
            animation: geser 45s linear infinite;
        }

        .marquee i.dot {
            display: inline-block;
            width: 9px;
            height: 9px;
            border: 2px solid var(--emas);
            border-radius: 50%;
            margin: 0 10px 0 28px;
        }

        @keyframes geser {
            to {
                transform: translateX(-100%);
            }
        }

        .header-desa {
            background: #0e1a3a;
            padding: 10px 0 14px;
        }

        .brand-box {
            border: 1px solid rgba(255, 255, 255, .18);
            background: rgba(255, 255, 255, .04);
            border-radius: 16px;
            padding: 8px 18px 8px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-box img {
            height: 52px;
        }

        .brand-box .t1 {
            font-family: 'Teko', sans-serif;
            font-weight: 700;
            font-size: 1.7rem;
            line-height: 1;
            color: #fff;
            letter-spacing: .3px;
        }

        .brand-box .t2 {
            font-size: .72rem;
            color: #aab4d4;
            letter-spacing: .6px;
        }

        .nav-desa {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .nav-desa a.nl {
            font-family: 'Teko', sans-serif;
            font-size: 1.35rem;
            font-weight: 500;
            color: #fff;
            text-decoration: none;
            padding: 2px 14px;
            border-radius: 20px;
            border: 1px solid transparent;
            line-height: 1.6;
        }

        .nav-desa a.nl:hover {
            color: var(--emas);
        }

        .nav-desa a.nl.active {
            color: var(--emas);
            border-color: #d9822b;
            background: rgba(245, 179, 1, .08);
        }

        .nav-desa a.home {
            background: #4a1f2e;
            color: #fff;
            border-radius: 20px;
            padding: 6px 16px;
            font-size: 1.4rem;
        }

        .btn-grid {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: 2px solid var(--emas);
            background: #17244a;
            color: var(--emas);
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero {
            background: linear-gradient(135deg, #0b1f5c 0%, #12307a 60%, #0e2a6b 100%);
            color: #fff;
            padding: 70px 0 80px;
        }

        .hero .breadcrumb {
            --bs-breadcrumb-divider-color: #8fa0cf;
            font-size: 1.15rem;
        }

        .hero .breadcrumb a {
            color: var(--emas);
            text-decoration: none;
        }

        .hero .breadcrumb .active {
            color: #fff;
        }

        .hero h1 {
            font-family: 'Teko', sans-serif;
            font-weight: 700;
            font-size: 4rem;
            line-height: 1;
            margin: 18px 0 8px;
        }

        .hero p {
            color: #cdd6f0;
            font-size: 1.2rem;
            margin: 0;
        }

        .judul-halaman {
            color: #0e1a3a;
            font-weight: 800;
        }

        .filter-box {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 27, 61, .1);
            overflow: hidden;
        }

        .filter-header {
            background: #12307a;
            color: #fff;
            padding: 14px 22px;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .btn-success,
        .btn-success:hover {
            background: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-outline-success {
            color: #12307a;
            border-color: #12307a;
        }

        .btn-outline-success:hover {
            background: #12307a;
            border-color: #12307a;
        }

        .text-success {
            color: #12307a !important;
        }

        .card-berita {
            border: 0;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(15, 27, 61, .1);
        }

        .card-berita img.thumb {
            height: 270px;
            object-fit: cover;
        }

        .badge-kat {
            background: #12307a;
            border-radius: 8px;
            padding: 6px 10px;
            font-weight: 600;
        }

        .card-berita .judul {
            font-weight: 700;
            font-size: 1.3rem;
            line-height: 1.3;
            color: #111;
            text-decoration: none;
        }

        .tag-pill {
            border: 1px solid #e1e5ec;
            background: #f6f7f9;
            color: #555;
            border-radius: 8px;
            padding: 5px 12px;
            font-size: .82rem;
            text-decoration: none;
            display: inline-block;
            margin: 0 6px 6px 0;
        }

        .tag-pill:hover {
            background: #12307a;
            color: #fff;
        }

        .btn-baca {
            border: 1px solid #0d6efd;
            color: #0d6efd;
            border-radius: 8px;
            padding: 5px 18px;
        }

        .btn-baca:hover {
            background: #0d6efd;
            color: #fff;
        }

        .isi-berita {
            line-height: 1.8;
            font-size: 1.02rem;
        }

        .isi-berita h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-top: 1.4rem;
            color: #12307a;
        }

        footer.footer-desa {
            background: #0e1a3a;
            color: #cdd6f0;
        }

        footer.footer-desa a {
            color: #cdd6f0;
            text-decoration: none;
        }

        footer.footer-desa a:hover {
            color: var(--emas);
        }

        footer.footer-desa h6 {
            color: #fff;
            font-weight: 700;
            border-bottom: 2px solid var(--emas);
            display: inline-block;
            padding-bottom: 4px;
        }

        .page-link {
            color: #12307a;
        }

        .active>.page-link {
            background: #12307a;
            border-color: #12307a;
        }

        /* ===== Header meniru website asli ===== */
        .topbar {
            background: #0f1630;
            border-bottom: 0;
            padding: 12px 24px;
        }

        .topbar .label {
            background: linear-gradient(90deg, #ff8a1f, #ee4b2b);
            border-radius: 22px;
            padding: 7px 18px;
            font-size: 1rem;
            letter-spacing: .3px;
        }

        .header-desa {
            background: #232a42;
            border-bottom: 1px solid #343c5a;
            padding: 12px 0;
        }

        .brand-box {
            background: rgba(255, 255, 255, .06);
            border: 1px solid #454d6b;
            border-radius: 18px;
            padding: 10px 22px 10px 16px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .05);
        }

        .brand-box img {
            height: 62px;
        }

        .brand-box .t1 {
            font-size: 2rem;
        }

        .brand-box .t2 {
            font-size: .82rem;
            color: #b3bbd6;
            letter-spacing: .8px;
        }

        .nav-desa {
            gap: 10px;
        }

        .nav-desa a.nl {
            font-size: 1.55rem;
            padding: 4px 18px;
            border: 2px solid transparent;
            border-radius: 22px;
            color: #f1f3fa;
        }

        .nav-desa a.nl.home {
            background: #4b2230;
            border-radius: 22px;
            padding: 8px 22px;
            font-size: 1.7rem;
            color: #fff;
        }

        .nav-desa a.nl.active,
        .nav-desa .dd:hover>a.nl,
        .nav-desa .dd.open>a.nl {
            color: #ffc21a;
            border-color: #c9822b;
            background: rgba(245, 160, 40, .16);
            box-shadow: 0 0 18px rgba(245, 160, 40, .28);
        }

        .dd {
            position: relative;
        }

        .dd-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            margin-top: 6px;
            min-width: 290px;
            z-index: 1000;
            background: #10182f;
            border: 1px solid #2c3556;
            border-radius: 20px;
            padding: 14px 10px;
            box-shadow: 0 18px 40px rgba(0, 0, 0, .45);
        }

        .dd:hover .dd-menu,
        .dd.open .dd-menu {
            display: block;
        }

        .dd::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 100%;
            height: 8px;
        }

        .dd-menu a {
            display: block;
            font-family: 'Inter', sans-serif;
            font-size: 1.2rem;
            color: #fff;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 12px;
        }

        .dd-menu a::before {
            content: "\F285";
            font-family: "bootstrap-icons";
            color: #ffc21a;
            font-size: .9rem;
            margin-right: 12px;
        }

        .dd-menu a:hover {
            background: rgba(255, 255, 255, .07);
            color: #ffc21a;
        }

        .btn-grid {
            width: 60px;
            height: 60px;
            border: 2px solid #d9962b;
            background: #2a2f45;
            color: #ffc21a;
            margin-left: 14px !important;
        }

        .hero {
            background: linear-gradient(100deg, #0f3175 0%, #122a6e 45%, #17187f 100%);
            padding: 80px 0 90px;
        }

        .hero .container-xl,
        .topbar,
        .header-desa .container-xl {
            max-width: none;
            padding-left: 48px;
            padding-right: 48px;
        }

        .hero h1 {
            font-size: 4.6rem;
        }

        /* ===== Header menempel + transparan saat scroll ===== */
        .header-desa {
            position: sticky;
            top: 0;
            z-index: 1030;
            transition: background .3s, box-shadow .3s, padding .3s;
        }

        .header-desa.scrolled {
            background: rgba(22, 29, 56, .78);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, .35);
            padding: 8px 0;
        }

        .sticky-side {
            position: sticky;
            top: 130px;
        }

        /* ===== Kartu, pagination, footer ===== */
        .btn-baca {
            padding: 6px 16px;
        }

        .pagination {
            border-radius: 10px;
            overflow: hidden;
        }

        .page-link {
            color: #0d6efd;
            padding: 12px 20px;
            font-size: 1.1rem;
        }

        .active>.page-link {
            background: #0d6efd;
            border-color: #0d6efd;
        }

        footer.footer-desa {
            background: #0b1230;
        }

        footer.footer-desa h6 {
            color: var(--emas);
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 0;
            font-size: 1.25rem;
            padding-bottom: 0;
        }

        footer.footer-desa ul li a::before {
            content: "\F285";
            font-family: "bootstrap-icons";
            margin-right: 10px;
            font-size: .8rem;
        }

        #topBtn {
            position: fixed;
            right: 28px;
            bottom: 28px;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            border: 0;
            background: #12307a;
            color: #ffc21a;
            font-size: 1.6rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .35);
            z-index: 1040;
            display: none;
        }

        #topBtn.show {
            display: block;
        }

        /* ===== Ukuran disamakan dengan website asli (hasil ukur screenshot) ===== */
        .wrap {
            width: 100%;
            padding-left: 4.5vw;
            padding-right: 4.5vw;
        }

        .topbar {
            padding: 8px 2vw;
            font-size: .8rem;
        }

        .topbar .label {
            padding: 4px 14px;
            font-size: .82rem;
        }

        .header-desa,
        .header-desa.scrolled {
            padding: 7px 0;
        }

        .header-desa .container-xl {
            max-width: none;
            padding-left: 2vw;
            padding-right: 2vw;
        }

        .brand-box {
            padding: 6px 16px 6px 12px;
            border-radius: 14px;
            gap: 10px;
        }

        .brand-box img {
            height: 40px;
        }

        .brand-box .t1 {
            font-size: 1.6rem;
        }

        .brand-box .t2 {
            font-size: .7rem;
            letter-spacing: .5px;
        }

        .nav-desa {
            gap: 8px;
        }

        .nav-desa a.nl {
            font-size: 1.3rem;
            height: 39px;
            padding: 0 14px;
            display: inline-flex;
            align-items: center;
            line-height: 1;
            border-width: 1.5px;
        }

        .nav-desa a.nl.home {
            padding: 0 18px;
            border-radius: 20px;
            font-size: 1.2rem;
        }

        .btn-grid {
            width: 39px;
            height: 39px;
            font-size: 1.05rem;
            margin-left: 10px !important;
            border-width: 1.5px;
        }

        .hero {
            padding: 56px 0;
        }

        .hero .breadcrumb {
            font-size: 1rem;
            margin: 0;
        }

        .hero h1 {
            font-size: 2.5rem;
            line-height: 1;
            margin: 16px 0 8px;
        }

        .hero p {
            font-size: .95rem;
        }

        @media (min-width:992px) {
            .side-col {
                position: sticky;
                top: 90px;
                align-self: flex-start;
                z-index: 2;
            }
        }

        .sticky-side {
            position: static;
        }

        .filter-header {
            padding: 10px 16px;
            font-size: 1rem;
        }

        .side-col form {
            padding: 16px !important;
        }

        .side-col label {
            font-size: .9rem;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .side-col .form-control {
            height: 47px;
            font-size: .9rem;
        }

        .side-col .form-select {
            height: 31px;
            font-size: .875rem;
            padding: .2rem 2rem .2rem .6rem;
        }

        .side-col .btn {
            font-size: .875rem;
            padding: .25rem .5rem;
        }

        .card-berita {
            border-radius: 12px;
        }

        .card-berita img.thumb {
            height: auto;
            aspect-ratio: 1.92;
        }

        .card-berita .card-body {
            padding: 1rem;
        }

        .badge-kat {
            font-size: .72rem;
            padding: 4px 9px;
            border-radius: 6px;
        }

        .card-berita .dt {
            font-size: .8rem;
        }

        .card-berita .judul {
            font-size: 1rem;
            line-height: 1.35;
        }

        .card-berita p {
            font-size: .875rem;
            line-height: 1.55;
        }

        .tag-pill {
            font-size: .75rem;
            padding: 4px 10px;
            border-radius: 6px;
            margin: 0 6px 6px 0;
        }

        .card-berita .border-top small {
            font-size: 1rem;
        }

        .btn-baca {
            font-size: .8rem;
            padding: 4px 10px;
            border-radius: 6px;
        }

        /* ===== PERBAIKAN: header ringkas + filter tidak tertutup header ===== */
        :root {
            --header-h: 52px;
        }

        html {
            scroll-padding-top: calc(var(--header-h) + 12px);
        }

        /* info bar tipis */
        .topbar {
            padding: 4px 2vw;
            font-size: .75rem;
            gap: 10px;
        }

        .topbar .label {
            padding: 2px 10px;
            font-size: .72rem;
        }

        /* navbar ringkas, satu baris, tinggi tetap (tidak berubah saat scroll) */
        .header-desa,
        .header-desa.scrolled {
            padding: 5px 0;
            transition: background .3s, box-shadow .3s;
        }

        .header-desa .container-xl {
            flex-wrap: nowrap !important;
            gap: 12px !important;
        }

        .brand-box {
            padding: 3px 12px 3px 8px;
            border-radius: 12px;
            gap: 8px;
            flex-shrink: 0;
        }

        .brand-box img {
            height: 32px;
        }

        .brand-box .t1 {
            font-size: 1.25rem;
        }

        .brand-box .t2 {
            font-size: .6rem;
            letter-spacing: .4px;
        }

        .nav-desa {
            flex-wrap: nowrap;
            gap: 2px;
            min-width: 0;
        }

        .nav-desa a.nl {
            font-size: clamp(1rem, .9vw + .35rem, 1.2rem);
            height: 32px;
            padding: 0 clamp(7px, .8vw, 12px);
            white-space: nowrap;
        }

        .nav-desa a.nl.home {
            padding: 0 14px;
            font-size: 1.05rem;
        }

        .btn-grid {
            width: 32px;
            height: 32px;
            font-size: .9rem;
            margin-left: 6px !important;
            flex-shrink: 0;
        }

        /* hero (Berita & Informasi) jauh lebih pendek */
        .hero {
            padding: 20px 0 22px;
        }

        .hero .breadcrumb {
            font-size: .85rem;
        }

        .hero h1 {
            font-size: 2rem;
            margin: 6px 0 2px;
        }

        .hero p {
            font-size: .85rem;
        }

        .wrap.my-5 {
            margin-top: 1.5rem !important;
            margin-bottom: 2.5rem !important;
        }

        /* layar sempit: navbar boleh turun baris, tinggi header diukur otomatis lewat JS */
        @media (max-width:1199.98px) {
            .header-desa .container-xl {
                flex-wrap: wrap !important;
            }

            .brand-box .t2 {
                display: none;
            }

            .nav-desa {
                flex-wrap: wrap;
                margin-left: 0 !important;
                width: 100%;
            }
        }

        /* Filter Berita: menempel di bawah header (tinggi header dibaca dari JS), tidak pernah tertutup */
        @media (min-width:992px) {
            .side-col {
                position: sticky;
                top: calc(var(--header-h) + 16px);
                align-self: flex-start;
                z-index: 2;
                max-height: calc(100vh - var(--header-h) - 32px);
                overflow-y: auto;
                scrollbar-width: none;
                padding-top: 4px;
                padding-bottom: 20px;
            }

            .side-col::-webkit-scrollbar {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div id="loader">
        <img src="https://jalatrang.id/assets/images/info_desa/logo.png" alt="Logo Jalatrang" height="80" class="mb-2">
        <strong class="text-success">PEMERINTAH DESA JALATRANG</strong>
        <small class="text-muted">Sedang memuat data...</small>
    </div>

    <div class="topbar">
        <div class="label"><i class="bi bi-megaphone-fill"></i> INFO TERKINI</div>
        <div class="marquee"><span><i class="dot" style="margin-left:0"></i>Sekarang Anda dapat belanja langsung di Warung Desa yang merupakan Warung Online Masyarakat Desa Jalatrang.<i class="dot"></i>Kini Hadir Perpustakaan Desa Selaras dengan wajah baru dan manjamen yang lebih baik<i class="dot"></i>Warga bisa memeriksa langsung untuk memeriksa pembayaran PBB pada website<i class="dot"></i>Desa Jalatrang akan membuka layanan public untuk mempermudah akses informasi dan pelayanan masyarakat</span></div>
        <div class="d-none d-md-block text-nowrap"><i class="bi bi-clock" style="color:var(--emas)"></i> <span id="tanggal"></span></div>
    </div>

    <div class="header-desa" id="header">
        <div class="container-xl d-flex align-items-center gap-3 flex-wrap">
            <a href="{{ route('berita.index') }}" class="brand-box">
                <img src="https://jalatrang.id/assets/images/info_desa/logo.png" alt="Logo Desa">
                <div>
                    <div class="t1">PEMERINTAH DESA JALATRANG</div>
                    <div class="t2">KECAMATAN CIPAKU KABUPATEN CIAMIS</div>
                </div>
            </a>
            <div class="nav-desa ms-auto">
                <a class="nl home" href="{{ route('berita.index') }}"><i class="bi bi-house-fill"></i></a>
                <div class="dd"><a class="nl" href="#">Profil</a>
                    <div class="dd-menu"><a href="#">VISI</a><a href="#">MISI</a><a href="#">Sejarah</a><a href="#">Struktural</a></div>
                </div>
                <a class="nl" href="#">Kependudukan</a>
                <a class="nl active" href="{{ route('berita.index') }}">Berita</a>
                <a class="nl" href="#">Potensi Wisata</a>
                <div class="dd"><a class="nl" href="#">IDM & SDGs</a>
                    <div class="dd-menu"><a href="#">IDM</a><a href="#">SDGs</a></div>
                </div>
                <div class="dd"><a class="nl" href="#">Ketahanan Pangan</a>
                    <div class="dd-menu"><a href="#">Statistik</a><a href="#">Galeri</a><a href="#">Top 10</a></div>
                </div>
                <div class="dd"><a class="nl" href="#">Keuangan</a>
                    <div class="dd-menu"><a href="#">APBdes</a><a href="#">PBB</a><a href="#">Kegiatan</a></div>
                </div>
                <div class="dd"><a class="nl" href="#">Download</a>
                    <div class="dd-menu"><a href="#">Regulasi</a><a href="#">Materi</a></div>
                </div>
                <button class="btn-grid" data-bs-toggle="offcanvas" data-bs-target="#layanan" title="Layanan & Toko Desa"><i class="bi bi-grid-3x3-gap-fill"></i></button>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" id="layanan">
        <div class="offcanvas-header text-white" style="background:#0e1a3a">
            <div>
                <h6 class="mb-0">Layanan & Toko Desa</h6><small>Portal Digital Desa Jalatrang</small>
            </div>
            <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body small">
            <p class="fw-bold text-success mb-2">Ekonomi & Belanja Warga</p>
            <a href="#" class="d-block mb-2 text-decoration-none"><strong>Warung Desa</strong> <span class="badge bg-success">PASAR</span><br><span class="text-muted">Katalog produk UMKM & hasil tani warga</span></a>
            <a href="#" class="d-block mb-2 text-decoration-none"><strong>Keranjang Belanja</strong> <span class="badge bg-secondary">0 Item</span><br><span class="text-muted">Periksa daftar belanjaan & checkout</span></a>
            <a href="#" class="d-block mb-3 text-decoration-none"><strong>Kopdes Merah Putih</strong> <span class="badge bg-danger">KOPDES</span><br><span class="text-muted">Layanan simpan pinjam & ekonomi warga</span></a>
            <p class="fw-bold text-success mb-2">Literasi & Prestasi</p>
            <a href="#" class="d-block mb-2 text-decoration-none"><strong>Perpustakaan Desa</strong> <span class="badge bg-info">LITERASI</span><br><span class="text-muted">Katalog buku fisik, e-library & pustaka</span></a>
            <a href="#" class="d-block mb-3 text-decoration-none"><strong>Prestasi Desa</strong> <span class="badge bg-warning text-dark">PRESTASI</span><br><span class="text-muted">Piagam, penghargaan & prestasi kebanggaan</span></a>
            <p class="fw-bold text-success mb-2">Layanan Mandiri & Admin</p>
            <a href="#" class="d-block mb-2 text-decoration-none"><strong>Warga Desa</strong> <span class="badge bg-primary">PORTAL</span><br><span class="text-muted">Layanan surat, belanjaan saya & profil</span></a>
            <a href="{{ route('berita.create') }}" class="d-block text-decoration-none"><strong>Admin Desa</strong> <span class="badge bg-dark">ADMIN</span><br><span class="text-muted">Panel administrasi & tata kelola desa</span></a>
        </div>
    </div>

    <section class="hero">
        <div class="wrap">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                    @yield('breadcrumb')
                </ol>
            </nav>
            <h1>@yield('judul', 'Berita & Informasi')</h1>
            <p>@yield('subjudul', 'Informasi terkini dari Desa Jalatrang')</p>
        </div>
    </section>

    <div class="wrap my-5">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @yield('content')
    </div>

    <footer class="footer-desa pt-5 pb-3">
        <div class="wrap">
            <div class="row g-4">
                <div class="col-md-4">
                    <img src="https://jalatrang.id/assets/images/info_desa/logo.png" alt="Logo" height="60" class="mb-2">
                    <h6 class="d-block border-0">PEMERINTAH DESA JALATRANG</h6>
                    <p class="small mb-1">Jalan Raya Cipaku Nomor 181<br>Desa Jalatrang, Kecamatan Cipaku<br>Kabupaten Ciamis<br>08</p>
                    <a href="https://www.google.com/maps/place/Jalatrang" class="btn btn-sm btn-outline-light mt-1"><i class="bi bi-geo-alt"></i> Lihat Peta</a>
                </div>
                <div class="col-6 col-md-2">
                    <h6>Menu</h6>
                    <ul class="list-unstyled small mt-2">
                        <li><a href="#">Beranda</a></li>
                        <li><a href="{{ route('berita.index') }}">Berita</a></li>
                        <li><a href="#">Struktural</a></li>
                        <li><a href="#">APBDes</a></li>
                        <li><a href="#">Prestasi</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3">
                    <h6>Link Terkait</h6>
                    <ul class="list-unstyled small mt-2">
                        <li><a href="https://kemendesa.go.id">Kemendesa</a></li>
                        <li><a href="https://ciamis.go.id">Kab. Ciamis</a></li>
                        <li><a href="https://jabar.go.id">Pemprov Jabar</a></li>
                        <li><a href="{{ route('berita.create') }}">Panel Admin</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Media Sosial</h6>
                    <div class="mt-2 fs-4">
                        <a href="https://x.com" class="me-2"><i class="bi bi-twitter-x"></i></a><a href="https://facebook.com" class="me-2"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.youtube.com/@jalatrangTV" class="me-2"><i class="bi bi-youtube"></i></a><a href="https://instagram.com/pemerintahdesajalatrang"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-light opacity-25 mt-4">
            <div class="text-center small">© 2026 Pemerintah Desa Jalatrang — Semua hak dilindungi.</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('load', () => setTimeout(() => document.getElementById('loader').classList.add('hide'), 300));
        const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const n = new Date();
        document.getElementById('tanggal').textContent = `${hari[n.getDay()]}, ${n.getDate()} ${bulan[n.getMonth()]} ${n.getFullYear()}`;
        document.querySelectorAll('.dd > a').forEach(a => a.addEventListener('click', e => {
            e.preventDefault();
            const d = a.parentElement,
                buka = d.classList.contains('open');
            document.querySelectorAll('.dd.open').forEach(x => x.classList.remove('open'));
            if (!buka) d.classList.add('open');
        }));
        document.addEventListener('click', e => {
            if (!e.target.closest('.dd')) document.querySelectorAll('.dd.open').forEach(x => x.classList.remove('open'));
        });
    </script>
    <button id="topBtn" title="Ke atas"><i class="bi bi-chevron-up"></i></button>
    <script>
        const hd = document.getElementById('header'),
            tb = document.getElementById('topBtn');
        const atur = () => {
            hd.classList.toggle('scrolled', scrollY > 40);
            tb.classList.toggle('show', scrollY > 300);
        };
        addEventListener('scroll', atur, {
            passive: true
        });
        atur();
        // simpan tinggi header asli ke --header-h supaya filter selalu muncul di bawahnya
        const setHeaderH = () => document.documentElement.style.setProperty('--header-h', hd.offsetHeight + 'px');
        setHeaderH();
        addEventListener('resize', setHeaderH);
        addEventListener('load', setHeaderH);
        if (window.ResizeObserver) new ResizeObserver(setHeaderH).observe(hd);
        tb.addEventListener('click', () => scrollTo({
            top: 0,
            behavior: 'smooth'
        }));
    </script>
    @stack('scripts')
</body>

</html>