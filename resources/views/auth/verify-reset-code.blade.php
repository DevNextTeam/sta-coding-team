<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Verify Reset Code - DevNext</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="min-h-screen flex items-center justify-center bg-[#F5F1E8] px-4"
>

    <div class="w-full max-w-md">

        <!-- Brand -->
        <div class="text-center mb-8">

            <h1
                class="text-3xl font-bold tracking-wide text-[#0F3F4A]"
            >
                DEVNEXT
            </h1>

            <p class="mt-1 text-sm text-[#6B7C76]">
                S.T.A Coding Team
            </p>

        </div>


        <!-- Card -->
        <div
            class="rounded-3xl bg-white p-7 sm:p-9 shadow-xl"
        >

            <div class="text-center mb-7">

                <div
                    class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-[#E6EFEA] text-2xl"
                >
                    🔐
                </div>

                <h2
                    class="text-2xl font-bold text-[#29483D]"
                >
                    Verify your code
                </h2>

                <p
                    class="mt-2 text-sm leading-6 text-[#6B7C76]"
                >
                    Enter the 6-digit verification code
                    we sent to your email.
                </p>

            </div>


            @if (session('success'))

                <div
                    class="mb-5 rounded-xl bg-green-50 px-4 py-3 text-sm text-green-700"
                >
                    {{ session('success') }}
                </div>

            @endif


            @if (session('error'))

                <div
                    class="mb-5 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700"
                >
                    {{ session('error') }}
                </div>

            @endif


            @if ($errors->any())

                <div
                    class="mb-5 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700"
                >
                    {{ $errors->first() }}
                </div>

            @endif


            <form
                method="POST"
                action="{{ route('password.reset.code.verify') }}"
                class="space-y-5"
            >

                @csrf


                <!-- Email -->
                <div>

                    <label
                        for="email"
                        class="mb-2 block text-sm font-semibold text-[#29483D]"
                    >
                        Email address
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $email) }}"
                        required
                        autocomplete="email"
                        placeholder="you@example.com"
                        class="w-full rounded-xl border border-[#D8DED9] bg-[#FAFAF7] px-4 py-3 outline-none transition focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                    >

                </div>


                <!-- Code -->
                <div>

                    <label
                        for="code"
                        class="mb-2 block text-sm font-semibold text-[#29483D]"
                    >
                        Verification code
                    </label>

                    <input
                        id="code"
                        type="text"
                        name="code"
                        inputmode="numeric"
                        autocomplete="one-time-code"
                        maxlength="6"
                        pattern="[0-9]{6}"
                        required
                        placeholder="000000"
                        class="w-full rounded-xl border border-[#D8DED9] bg-[#FAFAF7] px-4 py-3 text-center text-2xl font-bold tracking-[0.5em] text-[#0F3F4A] outline-none transition focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                    >

                    <p class="mt-2 text-xs text-[#7A8580]">
                        The code expires after 10 minutes.
                    </p>

                </div>


                <!-- Submit -->
                <button
                    type="submit"
                    class="w-full rounded-xl bg-[#4F806D] px-5 py-3.5 font-semibold text-white transition hover:bg-[#3E735F] active:scale-[0.99]"
                >
                    Verify Code
                </button>

            </form>


            <!-- Alternative -->
            <div class="mt-7 text-center">

                <p class="text-sm text-[#7A8580]">
                    Prefer using the reset link?
                </p>

                <a
                    href="{{ route('password.request') }}"
                    class="mt-2 inline-block text-sm font-semibold text-[#4F806D] hover:text-[#3E735F]"
                >
                    Request a new reset email
                </a>

            </div>

        </div>


        <p class="mt-6 text-center text-xs text-[#8A948F]">
            © {{ date('Y') }} DevNext · S.T.A Coding Team
        </p>

    </div>

</body>

</html>
