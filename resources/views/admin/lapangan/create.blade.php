<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Lapangan - PermataTruf.Id</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            min-height: 100vh;

            background:
                radial-gradient(
                    circle at top left,
                    rgba(90, 180, 130, .28),
                    transparent 35%
                ),
                radial-gradient(
                    circle at bottom right,
                    rgba(120, 210, 180, .20),
                    transparent 35%
                ),
                linear-gradient(
                    135deg,
                    #eefbf4,
                    #dff3e8,
                    #f5faf7
                );

            color: #183c2b;
            padding: 25px;
        }

        .page-wrapper {
            width: 100%;
            max-width: 1150px;
            margin: 0 auto;
        }

        /* =========================
           TOP BAR
        ========================= */

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 20px 25px;
            margin-bottom: 25px;

            border-radius: 24px;

            background: rgba(255, 255, 255, .48);
            border: 1px solid rgba(255, 255, 255, .65);

            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);

            box-shadow:
                0 15px 40px rgba(34, 90, 60, .12);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 48px;
            height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 16px;

            background: rgba(255, 255, 255, .55);

            font-size: 24px;

            box-shadow:
                0 8px 20px rgba(30, 100, 60, .12);
        }

        .brand h1 {
            font-size: 20px;
        }

        .brand p {
            margin-top: 4px;
            font-size: 13px;
            opacity: .65;
        }

        .back-btn {
            text-decoration: none;
            color: #1d6042;

            padding: 12px 18px;

            border-radius: 14px;

            background: rgba(255, 255, 255, .55);
            border: 1px solid rgba(255, 255, 255, .7);

            transition: .25s;
        }

        .back-btn:hover {
            transform: translateY(-2px);

            background: rgba(255, 255, 255, .8);

            box-shadow:
                0 8px 20px rgba(40, 100, 70, .12);
        }

        /* =========================
           FORM CARD
        ========================= */

        .form-card {
            background: rgba(255, 255, 255, .48);

            border: 1px solid rgba(255, 255, 255, .7);

            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);

            border-radius: 30px;

            padding: 35px;

            box-shadow:
                0 20px 50px rgba(34, 90, 60, .12);
        }

        .form-title {
            margin-bottom: 28px;
        }

        .form-title h2 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .form-title p {
            color: #557262;
            font-size: 14px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            margin-bottom: 9px;
            font-weight: 600;
            font-size: 14px;
            color: #214b36;
        }

        label span {
            color: #d9534f;
        }

        input,
        select,
        textarea {
            width: 100%;

            padding: 14px 16px;

            border-radius: 15px;

            border: 1px solid rgba(80, 130, 100, .18);

            outline: none;

            background: rgba(255, 255, 255, .62);

            color: #183c2b;

            font-size: 14px;

            transition: .25s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: rgba(40, 130, 80, .45);

            background: rgba(255, 255, 255, .85);

            box-shadow:
                0 0 0 4px rgba(70, 160, 100, .08);
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        /* =========================
           FILE UPLOAD
        ========================= */

        .file-box {
            padding: 18px;

            border-radius: 18px;

            border: 1.5px dashed rgba(60, 130, 90, .35);

            background: rgba(255, 255, 255, .38);
        }

        .file-box small {
            display: block;
            margin-top: 8px;
            color: #688071;
        }

        .preview {
            display: none;
            margin-top: 15px;
        }

        .preview img {
            width: 230px;
            height: 140px;

            object-fit: cover;

            border-radius: 18px;

            border: 3px solid rgba(255, 255, 255, .75);

            box-shadow:
                0 10px 25px rgba(30, 80, 50, .15);
        }

        /* =========================
           ERROR
        ========================= */

        .error-box {
            margin-bottom: 25px;

            padding: 15px 18px;

            border-radius: 16px;

            background: rgba(255, 100, 100, .10);

            border: 1px solid rgba(220, 70, 70, .20);

            color: #9d3030;

            font-size: 14px;
        }

        .error-box ul {
            margin-left: 20px;
            margin-top: 5px;
        }

        /* =========================
           BUTTON
        ========================= */

        .form-actions {
            grid-column: 1 / -1;

            display: flex;
            justify-content: flex-end;
            gap: 12px;

            margin-top: 8px;
        }

        .btn {
            border: none;

            padding: 14px 22px;

            border-radius: 15px;

            cursor: pointer;

            text-decoration: none;

            font-weight: 600;

            transition: .25s;
        }

        .btn-cancel {
            color: #456252;

            background: rgba(255, 255, 255, .58);

            border: 1px solid rgba(255, 255, 255, .7);
        }

        .btn-save {
            color: white;

            background:
                linear-gradient(
                    135deg,
                    #3e9567,
                    #26724b
                );

            box-shadow:
                0 10px 25px rgba(35, 110, 70, .22);
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 750px) {

            body {
                padding: 15px;
            }

            .topbar {
                align-items: flex-start;
                gap: 15px;
                flex-direction: column;
            }

            .form-card {
                padding: 22px;
                border-radius: 22px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .form-actions {
                grid-column: auto;
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>


<body>

<div class="page-wrapper">

    {{-- =========================
         TOP BAR
    ========================= --}}

    <div class="topbar">

        <div class="brand">

            <div class="brand-icon">
                ⚽
            </div>

            <div>

                <h1>
                    PermataTruf.Id
                </h1>

                <p>
                    Admin Panel • Kelola Lapangan
                </p>

            </div>

        </div>


        <a
            href="{{ route('admin.lapangan.index') }}"
            class="back-btn"
        >
            ← Kembali
        </a>

    </div>


    {{-- =========================
         FORM CARD
    ========================= --}}

    <div class="form-card">

        <div class="form-title">

            <h2>
                Tambah Lapangan
            </h2>

            <p>
                Tambahkan data lapangan mini soccer baru.
            </p>

        </div>


        {{-- =========================
             VALIDATION ERROR
        ========================= --}}

        @if ($errors->any())

            <div class="error-box">

                <strong>
                    Terdapat kesalahan:
                </strong>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- =========================
             FORM
        ========================= --}}

        <form
            action="{{ route('admin.lapangan.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <div class="form-grid">


                {{-- NAMA LAPANGAN --}}

                <div class="form-group">

                    <label>
                        Nama Lapangan <span>*</span>
                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Contoh: Lapangan A - Premium"
                        required
                    >

                </div>


                {{-- HARGA --}}

                <div class="form-group">

                    <label>
                        Harga Per Jam <span>*</span>
                    </label>

                    <input
                        type="number"
                        name="harga_per_jam"
                        value="{{ old('harga_per_jam') }}"
                        placeholder="Contoh: 200000"
                        min="0"
                        required
                    >

                </div>


                {{-- JENIS --}}

                <div class="form-group">

                    <label>
                        Jenis Lapangan <span>*</span>
                    </label>

                    <input
                        type="text"
                        name="jenis"
                        value="{{ old('jenis') }}"
                        placeholder="Contoh: Sintetis"
                        required
                    >

                </div>


                {{-- UKURAN --}}

                <div class="form-group">

                    <label>
                        Ukuran Lapangan <span>*</span>
                    </label>

                    <input
                        type="text"
                        name="ukuran"
                        value="{{ old('ukuran') }}"
                        placeholder="Contoh: Standar"
                        required
                    >

                </div>


                {{-- STATUS --}}

                <div class="form-group">

                    <label>
                        Status <span>*</span>
                    </label>

                    <select
                        name="status"
                        required
                    >

                        <option value="">
                            -- Pilih Status --
                        </option>

                        <option
                            value="aktif"
                            {{ old('status') == 'aktif' ? 'selected' : '' }}
                        >
                            Aktif
                        </option>

                        <option
                            value="nonaktif"
                            {{ old('status') == 'nonaktif' ? 'selected' : '' }}
                        >
                            Nonaktif
                        </option>

                    </select>

                </div>


                {{-- KETERSEDIAAN --}}

                <div class="form-group">

                    <label>
                        Ketersediaan <span>*</span>
                    </label>

                    <select
                        name="ketersediaan"
                        required
                    >

                        <option value="">
                            -- Pilih Ketersediaan --
                        </option>

                        <option
                            value="tersedia"
                            {{ old('ketersediaan') == 'tersedia' ? 'selected' : '' }}
                        >
                            Tersedia
                        </option>

                        <option
                            value="tidak_tersedia"
                            {{ old('ketersediaan') == 'tidak_tersedia' ? 'selected' : '' }}
                        >
                            Tidak Tersedia
                        </option>

                    </select>

                </div>


                {{-- GAMBAR --}}

                <div class="form-group full">

                    <label>
                        Gambar Lapangan <span>*</span>
                    </label>

                    <div class="file-box">

                        <input
                            type="file"
                            name="gambar"
                            id="gambar"
                            accept=".jpg,.jpeg,.png,.webp"
                            required
                        >

                        <small>
                            Format yang diperbolehkan:
                            JPG, JPEG, PNG, WEBP.
                            Maksimal 2 MB.
                        </small>


                        {{-- PREVIEW GAMBAR --}}

                        <div
                            class="preview"
                            id="preview"
                        >

                            <img
                                id="preview-image"
                                src=""
                                alt="Preview gambar lapangan"
                            >

                        </div>

                    </div>

                </div>


                {{-- DESKRIPSI --}}

                <div class="form-group full">

                    <label>
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        placeholder="Masukkan deskripsi lapangan..."
                    >{{ old('deskripsi') }}</textarea>

                </div>


                {{-- BUTTON --}}

                <div class="form-actions">

                    <a
                        href="{{ route('admin.lapangan.index') }}"
                        class="btn btn-cancel"
                    >
                        Batal
                    </a>


                    <button
                        type="submit"
                        class="btn btn-save"
                    >
                        💾 Simpan Lapangan
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


<script>

    /* =========================
       PREVIEW GAMBAR
    ========================= */

    const gambarInput =
        document.getElementById('gambar');

    const preview =
        document.getElementById('preview');

    const previewImage =
        document.getElementById('preview-image');


    gambarInput.addEventListener(
        'change',
        function (event) {

            const file =
                event.target.files[0];


            if (!file) {

                preview.style.display = 'none';

                previewImage.src = '';

                return;
            }


            const reader =
                new FileReader();


            reader.onload =
                function (e) {

                    previewImage.src =
                        e.target.result;

                    preview.style.display =
                        'block';
                };


            reader.readAsDataURL(file);

        }
    );

</script>

</body>

</html>