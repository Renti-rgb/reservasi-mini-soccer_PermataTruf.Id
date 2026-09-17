<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lapangan - PermataTruf.Id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: #20302a;
            min-height: 100vh;
            background:
                radial-gradient(circle at 10% 10%, rgba(111, 207, 151, 0.20), transparent 32%),
                radial-gradient(circle at 90% 20%, rgba(74, 160, 112, 0.14), transparent 30%),
                radial-gradient(circle at 50% 100%, rgba(143, 196, 161, 0.18), transparent 35%),
                linear-gradient(135deg, #edf8f4 0%, #e6f2ed 45%, #f4faf7 100%);
        }

        /* ===== ADMIN WRAPPER ===== */
        .admin-wrapper { min-height: 100vh; display: flex; gap: 22px; padding: 16px; }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 285px;
            min-height: calc(100vh - 32px);
            position: fixed;
            left: 16px; top: 16px; bottom: 16px;
            z-index: 20;
            padding: 24px 16px;
            border-radius: 30px;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.64), rgba(236, 248, 243, 0.48));
            border: 1px solid rgba(255, 255, 255, 0.86);
            box-shadow: 0 18px 45px rgba(43, 92, 73, 0.10), inset 0 1px 0 rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            overflow-y: auto;
        }

        .brand { display: flex; align-items: center; gap: 14px; padding: 12px 14px 28px; }
        .brand-logo {
            width: 62px; height: 62px;
            border-radius: 50%;
            padding: 5px;
            background: rgba(255, 255, 255, 0.68);
            border: 1px solid rgba(255, 255, 255, 0.90);
            box-shadow: 0 8px 22px rgba(43, 92, 73, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.85);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
        }
        .brand-logo img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
        .brand-text { font-size: 22px; font-weight: 800; color: #26362f; letter-spacing: -0.4px; }
        .brand-text span { color: #2b9a67; }

        .admin-label {
            padding: 4px 20px 14px;
            font-size: 13px; font-weight: 800;
            color: #81928a;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        .menu { display: flex; flex-direction: column; gap: 7px; }
        .menu a {
            position: relative;
            text-decoration: none;
            color: #667970;
            padding: 14px 16px;
            border-radius: 17px;
            display: flex; align-items: center; gap: 14px;
            font-size: 15px; font-weight: 700;
            border: 1px solid transparent;
            transition: background 0.25s ease, color 0.25s ease, border 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
        }
        .menu a:hover {
            color: #16875a;
            background: rgba(255, 255, 255, 0.50);
            border-color: rgba(255, 255, 255, 0.80);
            box-shadow: 0 8px 22px rgba(43, 92, 73, 0.07);
            transform: translateX(2px);
        }
        .menu a.active {
            color: #20382d;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.72), rgba(223, 244, 233, 0.48));
            border: 1px solid rgba(106, 170, 136, 0.38);
            box-shadow: 0 10px 25px rgba(44, 109, 77, 0.10), inset 0 1px 0 rgba(255, 255, 255, 0.80);
        }
        .menu a.active::before {
            content: "";
            position: absolute;
            left: -1px; top: 18%; bottom: 18%;
            width: 4px;
            border-radius: 10px;
            background: linear-gradient(180deg, #57b985, #23885d);
            box-shadow: 0 0 10px rgba(46, 148, 96, 0.30);
        }
        .menu-icon {
            width: 38px; height: 38px;
            border-radius: 13px;
            display: flex; align-items: center; justify-content: center;
            font-size: 17px;
            background: rgba(255, 255, 255, 0.52);
            border: 1px solid rgba(255, 255, 255, 0.72);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.75);
            flex-shrink: 0;
        }
        .menu a.active .menu-icon {
            background: rgba(214, 242, 226, 0.72);
            border-color: rgba(93, 169, 124, 0.25);
            color: #16875a;
        }

        .sidebar-bottom { margin-top: 18px; padding-top: 15px; border-top: 1px solid rgba(255, 255, 255, 0.65); }
        .logout-button {
            width: 100%;
            border: 1px solid rgba(255, 150, 150, 0.35);
            background: rgba(255, 239, 239, 0.55);
            color: #c64b4b;
            padding: 13px;
            border-radius: 16px;
            cursor: pointer;
            font-size: 14px; font-weight: 800;
            box-shadow: 0 8px 22px rgba(185, 74, 74, 0.06), inset 0 1px 0 rgba(255, 255, 255, 0.70);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            transition: 0.25s ease;
        }
        .logout-button:hover {
            background: rgba(255, 226, 226, 0.72);
            border-color: rgba(214, 115, 115, 0.40);
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(185, 74, 74, 0.10);
        }

        /* ===== MAIN ===== */
        .main { margin-left: 307px; width: calc(100% - 307px); min-height: calc(100vh - 32px); padding-bottom: 30px; }

        .topbar {
            min-height: 120px;
            margin-bottom: 25px;
            padding: 22px 34px;
            border-radius: 30px;
            display: flex; align-items: center; justify-content: space-between; gap: 20px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.66), rgba(255, 255, 255, 0.42));
            border: 1px solid rgba(255, 255, 255, 0.84);
            box-shadow: 0 14px 35px rgba(43, 92, 73, 0.07), inset 0 1px 0 rgba(255, 255, 255, 0.80);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            position: sticky;
            top: 16px;
            z-index: 10;
        }
        .page-title { font-size: 36px; font-weight: 800; margin: 0; color: #20342b; letter-spacing: -1px; }
        .page-subtitle { font-size: 16px; color: #7d9087; margin-top: 7px; }

        .back-link {
            display: inline-flex;
            align-items: center; gap: 8px;
            padding: 12px 20px;
            border-radius: 16px;
            text-decoration: none;
            color: #40554b;
            font-size: 14px; font-weight: 800;
            background: rgba(255, 255, 255, 0.50);
            border: 1px solid rgba(255, 255, 255, 0.78);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.80);
            transition: 0.25s ease;
        }
        .back-link:hover {
            background: rgba(255, 255, 255, 0.75);
            border-color: rgba(106, 170, 136, 0.38);
            transform: translateY(-2px);
        }

        /* ===== ALERT ===== */
        .alert {
            padding: 16px 20px;
            border-radius: 18px;
            margin-bottom: 22px;
            font-size: 14px; font-weight: 700;
        }
        .alert-success {
            color: #16875a;
            background: rgba(214, 242, 226, 0.65);
            border: 1px solid rgba(93, 169, 124, 0.35);
        }
        .alert-error {
            color: #b5453d;
            background: rgba(255, 231, 228, 0.70);
            border: 1px solid rgba(220, 120, 108, 0.35);
        }
        .alert-error ul { margin: 6px 0 0; padding-left: 18px; }

        /* ===== FORM CARD ===== */
        .form-card {
            padding: 30px;
            border-radius: 28px;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.67), rgba(245, 251, 248, 0.44));
            border: 1px solid rgba(255, 255, 255, 0.86);
            box-shadow: 0 15px 38px rgba(43, 92, 73, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }
        .form-grid .full-width { grid-column: 1 / -1; }

        .form-group { display: flex; flex-direction: column; gap: 8px; }
        .form-label { font-size: 13px; font-weight: 800; color: #40554b; }
        .form-label .required { color: #c64b4b; }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 13px 16px;
            border-radius: 14px;
            font-size: 14px;
            font-family: inherit;
            color: #20302a;
            background: rgba(255, 255, 255, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.85);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.75);
            transition: border 0.2s ease, box-shadow 0.2s ease;
        }
        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: rgba(93, 169, 124, 0.55);
            box-shadow: 0 0 0 4px rgba(93, 169, 124, 0.15);
        }
        .form-textarea { resize: vertical; min-height: 100px; }

        .input-prefix {
            display: flex;
            align-items: center;
        }
        .input-prefix span {
            padding: 13px 14px;
            border-radius: 14px 0 0 14px;
            background: rgba(214, 242, 226, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.85);
            border-right: none;
            font-weight: 800;
            color: #16875a;
            font-size: 14px;
        }
        .input-prefix .form-input { border-radius: 0 14px 14px 0; }

        .form-error {
            font-size: 12px;
            font-weight: 700;
            color: #c64b4b;
        }

        /* ===== IMAGE UPLOAD ===== */
        .image-upload-row {
            display: grid;
            grid-template-columns: 160px 1fr;
            gap: 18px;
            align-items: center;
        }
        .current-image {
            width: 160px;
            height: 110px;
            border-radius: 16px;
            overflow: hidden;
            background: linear-gradient(135deg, #dceee5, #edf7f2);
            border: 1px solid rgba(255, 255, 255, 0.80);
            flex-shrink: 0;
        }
        .current-image img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .current-image .no-image {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
            color: #96a49e;
            font-size: 12px; font-weight: 700;
        }
        .file-hint { font-size: 12px; color: #8b9b94; margin-top: 4px; }

        /* ===== ACTIONS ===== */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid rgba(255, 255, 255, 0.65);
        }
        .btn {
            display: inline-flex;
            align-items: center; justify-content: center;
            gap: 8px;
            min-height: 50px;
            padding: 0 26px;
            border-radius: 16px;
            font-size: 14px; font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: 0.25s ease;
        }
        .btn-cancel {
            color: #5c7067;
            background: rgba(255, 255, 255, 0.46);
            border-color: rgba(255, 255, 255, 0.78);
        }
        .btn-cancel:hover { background: rgba(255, 255, 255, 0.70); transform: translateY(-2px); }
        .btn-save {
            color: #14734e;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.72), rgba(220, 244, 231, 0.48));
            border-color: rgba(255, 255, 255, 0.88);
            box-shadow: 0 10px 28px rgba(43, 92, 73, 0.09);
        }
        .btn-save:hover {
            color: #0d6845;
            transform: translateY(-2px);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.86), rgba(214, 242, 226, 0.65));
            border-color: rgba(108, 180, 139, 0.42);
        }

        @media (max-width: 1200px) {
            .sidebar { width: 255px; }
            .main { margin-left: 277px; width: calc(100% - 277px); }
        }
        @media (max-width: 900px) {
            .admin-wrapper { display: block; padding: 12px; }
            .sidebar { position: relative; left: auto; top: auto; bottom: auto; width: 100%; min-height: auto; margin-bottom: 15px; }
            .main { margin-left: 0; width: 100%; }
            .form-grid { grid-template-columns: 1fr; }
            .image-upload-row { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>
<div class="admin-wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-logo">
                <img src="{{ asset('images/logo.1.png') }}" alt="Logo PermataTruf.Id">
            </div>
            <div class="brand-text">PermataTruf<span>.Id</span></div>
        </div>

        <div class="admin-label">Admin Panel</div>

        <nav class="menu">
            <a href="{{ route('admin.dashboard') }}">
                <span class="menu-icon">▣</span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.pembayaran.index') }}">
                <span class="menu-icon">💳</span>
                <span>Validasi Pembayaran</span>
            </a>
            <a href="{{ route('admin.reservasi.index') }}">
                <span class="menu-icon">📋</span>
                <span>Kelola Reservasi</span>
            </a>
            <a href="{{ route('admin.lapangan.index') }}" class="active">
                <span class="menu-icon">⚽</span>
                <span>Kelola Lapangan</span>
            </a>
            <a href="#">
                <span class="menu-icon">🗓</span>
                <span>Kelola Jadwal</span>
            </a>
            <a href="#">
                <span class="menu-icon">💰</span>
                <span>Kelola Harga</span>
            </a>
            <a href="#">
                <span class="menu-icon">➕</span>
                <span>Kelola Add-on</span>
            </a>
            <a href="#">
                <span class="menu-icon">📄</span>
                <span>Laporan PDF</span>
            </a>
            <a href="#">
                <span class="menu-icon">⏱</span>
                <span>Monitor Auto-Cancel</span>
            </a>
        </nav>

        <div class="sidebar-bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="main">

        <!-- TOPBAR -->
        <header class="topbar">
            <div>
                <h1 class="page-title">Edit Lapangan</h1>
                <div class="page-subtitle">Ubah data dan foto untuk {{ $lapangan->nama }}.</div>
            </div>

            <a href="{{ route('admin.lapangan.index') }}" class="back-link">
                ← Kembali ke Daftar
            </a>
        </header>

        <!-- CONTENT -->
        <section class="content">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    Ada kesalahan pada input Anda:
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-card">
                <form
                    action="{{ route('admin.lapangan.update', $lapangan->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')

                    <div class="form-grid">

                        <!-- NAMA -->
                        <div class="form-group full-width">
                            <label class="form-label" for="nama">
                                Nama Lapangan <span class="required">*</span>
                            </label>
                            <input
                                type="text"
                                name="nama"
                                id="nama"
                                class="form-input"
                                value="{{ old('nama', $lapangan->nama) }}"
                                placeholder="Contoh: Lapangan A - Premium"
                                required
                            >
                            @error('nama')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="form-group full-width">
                            <label class="form-label" for="deskripsi">
                                Deskripsi
                            </label>
                            <textarea
                                name="deskripsi"
                                id="deskripsi"
                                class="form-textarea"
                                placeholder="Deskripsi singkat mengenai lapangan ini"
                            >{{ old('deskripsi', $lapangan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- JENIS -->
                        <div class="form-group">
                            <label class="form-label" for="jenis">
                                Jenis <span class="required">*</span>
                            </label>
                            <input
                                type="text"
                                name="jenis"
                                id="jenis"
                                class="form-input"
                                value="{{ old('jenis', $lapangan->jenis) }}"
                                placeholder="Contoh: Sintetis / Rumput Asli"
                                required
                            >
                            @error('jenis')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- UKURAN -->
                        <div class="form-group">
                            <label class="form-label" for="ukuran">
                                Ukuran <span class="required">*</span>
                            </label>
                            <input
                                type="text"
                                name="ukuran"
                                id="ukuran"
                                class="form-input"
                                value="{{ old('ukuran', $lapangan->ukuran) }}"
                                placeholder="Contoh: Mini / Standar"
                                required
                            >
                            @error('ukuran')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- HARGA PER JAM -->
                        <div class="form-group">
                            <label class="form-label" for="harga_per_jam">
                                Harga / Jam <span class="required">*</span>
                            </label>
                            <div class="input-prefix">
                                <span>Rp</span>
                                <input
                                    type="number"
                                    name="harga_per_jam"
                                    id="harga_per_jam"
                                    class="form-input"
                                    value="{{ old('harga_per_jam', $lapangan->harga_per_jam) }}"
                                    placeholder="150000"
                                    min="0"
                                    step="1000"
                                    required
                                >
                            </div>
                            @error('harga_per_jam')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- STATUS -->
                        <div class="form-group">
                            <label class="form-label" for="status">
                                Status <span class="required">*</span>
                            </label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="aktif" {{ old('status', $lapangan->status) === 'aktif' ? 'selected' : '' }}>
                                    Aktif
                                </option>
                                <option value="nonaktif" {{ old('status', $lapangan->status) === 'nonaktif' ? 'selected' : '' }}>
                                    Nonaktif
                                </option>
                            </select>
                            @error('status')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- KETERSEDIAAN -->
                        <div class="form-group">
                            <label class="form-label" for="ketersediaan">
                                Ketersediaan <span class="required">*</span>
                            </label>
                            <select name="ketersediaan" id="ketersediaan" class="form-select" required>
                                <option value="tersedia" {{ old('ketersediaan', $lapangan->ketersediaan) === 'tersedia' ? 'selected' : '' }}>
                                    Tersedia
                                </option>
                                <option value="tidak_tersedia" {{ old('ketersediaan', $lapangan->ketersediaan) === 'tidak_tersedia' ? 'selected' : '' }}>
                                    Tidak Tersedia
                                </option>
                            </select>
                            @error('ketersediaan')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- GAMBAR -->
                        <div class="form-group full-width">
                            <label class="form-label" for="gambar">
                                Foto Lapangan
                            </label>

                            <div class="image-upload-row">
                                <div class="current-image">
                                    @if (!empty($lapangan->gambar))
                                        <img
                                            src="{{ asset('storage/' . $lapangan->gambar) }}"
                                            alt="{{ $lapangan->nama }}"
                                        >
                                    @else
                                        <div class="no-image">Belum ada foto</div>
                                    @endif
                                </div>

                                <div>
                                    <input
                                        type="file"
                                        name="gambar"
                                        id="gambar"
                                        class="form-input"
                                        accept="image/*"
                                    >
                                    <div class="file-hint">
                                        Format JPG/JPEG/PNG/WEBP, maksimal 2MB. Kosongkan jika tidak ingin mengganti foto.
                                    </div>
                                    @error('gambar')
                                        <span class="form-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.lapangan.index') }}" class="btn btn-cancel">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-save">
                            💾 Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>

        </section>

    </main>

</div>
</body>
</html>