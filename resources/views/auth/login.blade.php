@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto">

    <div class="bg-white rounded-3xl border border-[#E5E0D7] shadow-sm p-8">

        <div class="text-center mb-8">

            <p class="text-sm uppercase tracking-[0.3em] font-semibold text-[#B58A5A]">
                Welcome Back
            </p>

            <h1 class="text-3xl font-bold text-[#29483D] mt-2">
                Login
            </h1>

            <p class="text-[#587067] mt-3">
                Sign in to your DevNext account.
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

        <form method="POST" action="{{ route('login') }}" class="space-y-5">

            @csrf

            <div>
                <label class="block text-sm font-semibold text-[#29483D] mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
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
                    autocomplete="current-password"
                    placeholder="Enter your password"
                    class="w-full px-4 py-3 rounded-xl border border-[#D9D3C7]
                           focus:outline-none focus:ring-2 focus:ring-[#B8CEC5]"
                >
            </div>

            <div class="flex items-center justify-between">

                <label class="flex items-center gap-2 text-sm text-[#587067]">

                    <input
                        type="checkbox"
                        name="remember"
                        class="rounded border-gray-300"
                    >

                    Remember me

                </label>

                <a
                    href="{{ route('password.request') }}"
                    class="text-sm font-semibold text-[#4F806D] hover:underline"
                >
                    Forgot password?
                </a>

            </div>

            <button
                type="submit"
                class="w-full py-3 rounded-xl bg-[#4F806D] text-white
                       font-semibold hover:bg-[#3F6D5B] transition"
            >
                Login
            </button>

        </form>

        <p class="text-center text-sm text-[#587067] mt-6">

            Don't have an account?

            <a
                href="{{ route('register') }}"
                class="font-semibold text-[#4F806D] hover:underline"
            >
                Sign up
            </a>

        </p>

    </div>

</div>

@endsection