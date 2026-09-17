<x-guest-layout>

    <h2 class="auth-title">Login To Account</h2>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="Email"
            required
            autofocus
            autocomplete="username"
        >
        <x-input-error :messages="$errors->get('email')" class="mt-1 mb-2" />

        <input
            id="password"
            type="password"
            name="password"
            placeholder="Password"
            required
            autocomplete="current-password"
        >
        <x-input-error :messages="$errors->get('password')" class="mt-1 mb-2" />

        <div style="display:flex; align-items:center; margin: 14px 0 20px; font-size: 13px;">
    

    @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" style="margin-left:auto;">
            Lupa password?
        </a>
    @endif
</div>

        <button type="submit">
            Login
        </button>

        <p style="text-align:center; margin-top: 24px; font-size: 13px; color:#627084;">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar di sini</a>
        </p>

    </form>

</x-guest-layout>