@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto">

    <div class="bg-white rounded-3xl border border-[#E5E0D7] shadow-sm p-8">

        <div class="text-center mb-8">

            <p class="text-sm uppercase tracking-[0.3em] font-semibold text-[#B58A5A]">
                Join DevNext
            </p>

            <h1 class="text-3xl font-bold text-[#29483D] mt-2">
                Create Account
            </h1>

            <p class="text-[#587067] mt-3">
                Create your DevNext account.
            </p>

        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-700 rounded-xl p-4 mb-6">
                <ul class="text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-5">

            @csrf

            <div>
                <label class="block text-sm font-semibold text-[#29483D] mb-2">
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Enter your name"
                    class="w-full px-4 py-3 rounded-xl border border-[#D9D3C7]
                           focus:outline-none focus:ring-2 focus:ring-[#B8CEC5]"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#29483D] mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    placeholder="Enter your email"
                    class="w-full px-4 py-3 rounded-xl border border-[#D9D3C7]
                           focus:outline-none focus:ring-2 focus:ring-[#B8CEC5]"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#29483D] mb-2">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    minlength="12"
                    autocomplete="new-password"
                    placeholder="Create a password"
                    class="w-full px-4 py-3 rounded-xl border border-[#D9D3C7]
                           focus:outline-none focus:ring-2 focus:ring-[#B8CEC5]"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#29483D] mb-2">
                    Confirm Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm your password"
                    class="w-full px-4 py-3 rounded-xl border border-[#D9D3C7]
                           focus:outline-none focus:ring-2 focus:ring-[#B8CEC5]"
                >
            </div>

            <button
                type="submit"
                class="w-full py-3 rounded-xl bg-[#4F806D] text-white
                       font-semibold hover:bg-[#3F6D5B] transition"
            >
                Create Account
            </button>

        </form>

        {{-- Divider --}}
        <div class="flex items-center gap-4 my-6">

            <div class="flex-1 h-px bg-[#E5E0D7]"></div>

            <span class="text-sm text-[#8A9A93]">
                OR
            </span>

            <div class="flex-1 h-px bg-[#E5E0D7]"></div>

        </div>

        {{-- Google Registration --}}
        <button
            type="button"
            onclick="openGoogleRegister()"
            class="w-full py-3 rounded-xl border border-[#D9D3C7]
                   bg-white text-[#29483D] font-semibold
                   flex items-center justify-center gap-3
                   hover:bg-[#F8F6F1] transition"
        >

            {{-- Google Logo --}}
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                class="w-5 h-5"
                aria-hidden="true"
            >
                <path
                    fill="#4285F4"
                    d="M21.35 12.27c0-.79-.07-1.54-.22-2.27H12v4.3h5.22a4.46 4.46 0 0 1-1.94 2.93v2.44h3.14c1.84-1.7 2.93-4.2 2.93-7.4Z"
                />

                <path
                    fill="#34A853"
                    d="M12 21.6c2.63 0 4.84-.87 6.45-2.37l-3.14-2.44c-.87.58-1.98.93-3.31.93-2.54 0-4.69-1.72-5.46-4.03H3.3v2.52A9.74 9.74 0 0 0 12 21.6Z"
                />

                <path
                    fill="#FBBC05"
                    d="M6.54 13.69A5.86 5.86 0 0 1 6.23 12c0-.59.11-1.16.31-1.69V7.79H3.3A9.72 9.72 0 0 0 2.27 12c0 1.57.38 3.05 1.03 4.21l3.24-2.52Z"
                />

                <path
                    fill="#EA4335"
                    d="M12 6.28c1.43 0 2.71.49 3.72 1.45l2.79-2.79C16.84 3.35 14.63 2.4 12 2.4a9.74 9.74 0 0 0-8.7 5.39l3.24 2.52c.77-2.31 2.92-4.03 5.46-4.03Z"
                />
            </svg>

            Continue with Google

        </button>

        <p class="text-center text-sm text-[#587067] mt-6">

            Already have an account?

            <a
                href="{{ route('login') }}"
                class="font-semibold text-[#4F806D] hover:underline"
            >
                Login
            </a>

        </p>

    </div>

</div>

<script>
    function openGoogleRegister() {

        const width = 500;
        const height = 650;

        const left = (window.screen.width - width) / 2;
        const top = (window.screen.height - height) / 2;

        const googlePopup = window.open(
            "{{ route('google.redirect') }}",
            "googleRegister",
            "width=" + width +
            ",height=" + height +
            ",left=" + left +
            ",top=" + top +
            ",resizable=yes,scrollbars=yes"
        );

        if (!googlePopup) {
            alert('Please allow pop-ups for DevNext to continue with Google.');
            return;
        }

        googlePopup.focus();

        const checkPopup = setInterval(function () {

            if (googlePopup.closed) {
                clearInterval(checkPopup);
            }

        }, 500);
    }

    window.addEventListener('message', function (event) {

        if (event.origin !== window.location.origin) {
            return;
        }

        if (event.data === 'google-login-success') {
            window.location.href = "{{ route('dashboard') }}";
        }

        if (event.data === 'google-login-error') {
            window.location.reload();
        }

    });
</script>

@endsection