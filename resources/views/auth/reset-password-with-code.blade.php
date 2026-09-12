<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Set New Password - DevNext</title>

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

            <!-- Header -->
            <div class="text-center mb-7">

                <div
                    class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-[#E6EFEA] text-2xl"
                >
                    🔑
                </div>

                <h2
                    class="text-2xl font-bold text-[#29483D]"
                >
                    Create a new password
                </h2>

                <p
                    class="mt-2 text-sm leading-6 text-[#6B7C76]"
                >
                    Your verification code has been confirmed.
                    Choose a new password for your account.
                </p>

            </div>


            @if ($errors->any())

                <div
                    class="mb-5 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700"
                >
                    {{ $errors->first() }}
                </div>

            @endif


            <form
                method="POST"
                action="{{ route('password.reset.code.password') }}"
                class="space-y-5"
            >

                @csrf


                <!-- Password -->
                <div>

                    <label
                        for="password"
                        class="mb-2 block text-sm font-semibold text-[#29483D]"
                    >
                        New password
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Enter your new password"
                        class="w-full rounded-xl border border-[#D8DED9] bg-[#FAFAF7] px-4 py-3 outline-none transition focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                    >

                </div>


                <!-- Confirm Password -->
                <div>

                    <label
                        for="password_confirmation"
                        class="mb-2 block text-sm font-semibold text-[#29483D]"
                    >
                        Confirm new password
                    </label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Re-enter your new password"
                        class="w-full rounded-xl border border-[#D8DED9] bg-[#FAFAF7] px-4 py-3 outline-none transition focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                    >

                </div>


                <!-- Submit -->
                <button
                    type="submit"
                    class="w-full rounded-xl bg-[#4F806D] px-5 py-3.5 font-semibold text-white transition hover:bg-[#3E735F] active:scale-[0.99]"
                >
                    Update Password
                </button>

            </form>


            <!-- Security -->
            <div
                class="mt-6 rounded-xl bg-[#F5F1E8] px-4 py-3 text-xs leading-5 text-[#6B7C76]"
            >
                Your verification code is single-use and expires
                after 10 minutes.
            </div>

        </div>


        <p class="mt-6 text-center text-xs text-[#8A948F]">
            © {{ date('Y') }} DevNext · S.T.A Coding Team
        </p>

    </div>

</body>

</html>
