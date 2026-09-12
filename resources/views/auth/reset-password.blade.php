<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Reset Password - DevNext</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>


<body class="min-h-screen bg-[#F5F1E8] text-[#29483D]">

    <div class="flex min-h-screen items-center justify-center px-4 py-10">

        <div class="w-full max-w-md">

            {{-- LOGO --}}
            <div class="mb-8 flex justify-center">

                <a href="/">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="S.T.A Coding Team Logo"
                        class="h-20 w-auto object-contain transition duration-300 hover:scale-105"
                    >
                </a>

            </div>


            {{-- CARD --}}
            <div class="rounded-3xl border border-[#D8D0C3] bg-white/70 p-6 shadow-[0_15px_40px_rgba(41,72,61,0.10)] backdrop-blur-sm sm:p-8">

                {{-- HEADER --}}
                <div class="mb-7 text-center">

                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-[#DDEAE3] text-[#4F806D]">

                        <i class="bi bi-shield-lock text-2xl"></i>

                    </div>

                    <h1 class="text-2xl font-bold text-[#29483D]">
                        Reset Your Password
                    </h1>

                    <p class="mt-2 text-sm leading-6 text-[#6B756F]">
                        Create a new password for your DevNext account.
                    </p>

                </div>


                {{-- VALIDATION ERRORS --}}
                @if ($errors->any())

                    <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3">

                        <div class="flex gap-3">

                            <i class="bi bi-exclamation-circle text-red-500"></i>

                            <div class="space-y-1">

                                @foreach ($errors->all() as $error)

                                    <p class="text-sm text-red-700">
                                        {{ $error }}
                                    </p>

                                @endforeach

                            </div>

                        </div>

                    </div>

                @endif


                {{-- RESET FORM --}}
                <form
                    method="POST"
                    action="{{ route('password.update') }}"
                    class="space-y-5"
                >

                    @csrf


                    {{-- TOKEN --}}
                    <input
                        type="hidden"
                        name="token"
                        value="{{ $request->route('token') }}"
                    >


                    {{-- EMAIL --}}
                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-semibold text-[#29483D]"
                        >
                            Email Address
                        </label>

                        <div class="relative">

                            <i class="bi bi-envelope absolute left-4 top-1/2 -translate-y-1/2 text-[#7A827D]"></i>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email', $request->email) }}"
                                required
                                autofocus
                                autocomplete="email"
                                class="w-full rounded-xl border border-[#D8D0C3] bg-[#F9F7F2] py-3 pl-11 pr-4 text-sm text-[#29483D] outline-none transition placeholder:text-[#9AA29D] focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                                placeholder="Enter your email"
                            >

                        </div>

                    </div>


                    {{-- PASSWORD --}}
                    <div>

                        <label
                            for="password"
                            class="mb-2 block text-sm font-semibold text-[#29483D]"
                        >
                            New Password
                        </label>

                        <div class="relative">

                            <i class="bi bi-lock absolute left-4 top-1/2 -translate-y-1/2 text-[#7A827D]"></i>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                class="w-full rounded-xl border border-[#D8D0C3] bg-[#F9F7F2] py-3 pl-11 pr-4 text-sm text-[#29483D] outline-none transition placeholder:text-[#9AA29D] focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                                placeholder="Enter your new password"
                            >

                        </div>

                    </div>


                    {{-- CONFIRM PASSWORD --}}
                    <div>

                        <label
                            for="password_confirmation"
                            class="mb-2 block text-sm font-semibold text-[#29483D]"
                        >
                            Confirm New Password
                        </label>

                        <div class="relative">

                            <i class="bi bi-lock-fill absolute left-4 top-1/2 -translate-y-1/2 text-[#7A827D]"></i>

                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                class="w-full rounded-xl border border-[#D8D0C3] bg-[#F9F7F2] py-3 pl-11 pr-4 text-sm text-[#29483D] outline-none transition placeholder:text-[#9AA29D] focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                                placeholder="Confirm your new password"
                            >

                        </div>

                    </div>


                    {{-- SUBMIT --}}
                    <button
                        type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#4F806D] px-5 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:bg-[#3E735F] hover:shadow-md active:scale-[0.98]"
                    >

                        <i class="bi bi-check2-circle"></i>

                        Reset Password

                    </button>

                </form>


                {{-- BACK TO LOGIN --}}
                <div class="mt-6 text-center">

                    <a
                        href="{{ route('login') }}"
                        class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#4F806D] transition hover:text-[#29483D]"
                    >

                        <i class="bi bi-arrow-left text-xs"></i>

                        Back to Login

                    </a>

                </div>

            </div>


            {{-- FOOTER --}}
            <p class="mt-6 text-center text-xs text-[#7A827D]">
                © {{ date('Y') }} DevNext. All rights reserved.
            </p>

        </div>

    </div>

</body>

</html>
