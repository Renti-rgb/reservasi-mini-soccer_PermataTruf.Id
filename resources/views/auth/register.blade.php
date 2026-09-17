<x-guest-layout>

    <h2 class="auth-title">Daftar Akun Baru</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input
            id="name"
            type="text"
            name="name"
            value="{{ old('name') }}"
            placeholder="Nama Lengkap"
            required
            autofocus
            autocomplete="name"
        >
        <x-input-error :messages="$errors->get('name')" class="mt-1 mb-2" />

        <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="Email"
            required
            autocomplete="username"
        >
        <x-input-error :messages="$errors->get('email')" class="mt-1 mb-2" />

        <input
            id="password"
            type="password"
            name="password"
            placeholder="Password"
            required
            autocomplete="new-password"
        >
        <x-input-error :messages="$errors->get('password')" class="mt-1 mb-2" />

        <input
            id="password_confirmation"
            type="password"
            name="password_confirmation"
            placeholder="Konfirmasi Password"
            required
            autocomplete="new-password"
        >
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 mb-2" />

        <button type="submit" style="margin-top: 10px;">
            Daftar
        </button>

        <p style="text-align:center; margin-top: 20px; font-size: 13px; color:#627084;">
            Sudah punya akun?
            <a href="{{ route('login') }}">Masuk di sini</a>
        </p>

    </form>

</x-guest-layout>