@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#F5F1E8] py-12 px-6">

    <div class="max-w-5xl mx-auto">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <div class="mb-10">

            <p class="text-sm tracking-[0.3em] text-[#B87945] uppercase">
                Account
            </p>

            <h1 class="text-4xl font-bold text-[#0F3F4A] mt-2">
                Dashboard
            </h1>

            <p class="text-[#315F6D] mt-2">
                Welcome back, {{ auth()->user()->name }}.
            </p>

        </div>


        {{-- ===================================================== --}}
        {{-- SUCCESS MESSAGE --}}
        {{-- ===================================================== --}}

        @if(session('success'))

            <div class="mb-6 p-4 rounded-xl
                        bg-[#DCEAE4]
                        border border-[#BFD8CE]
                        text-[#3E735F]">

                {{ session('success') }}

            </div>

        @endif


        {{-- ===================================================== --}}
        {{-- ERROR MESSAGE --}}
        {{-- ===================================================== --}}

        @if(session('error'))

            <div class="mb-6 p-4 rounded-xl
                        bg-[#F5E6D8]
                        border border-[#E5CDB8]
                        text-[#A45F2C]">

                {{ session('error') }}

            </div>

        @endif


        {{-- ===================================================== --}}
        {{-- VALIDATION ERRORS --}}
        {{-- ===================================================== --}}

        @if ($errors->any())

            <div class="mb-6 p-4 rounded-xl
                        bg-[#F5E6D8]
                        border border-[#E5CDB8]
                        text-[#A45F2C]">

                <ul class="list-disc ml-5">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif



        {{-- ===================================================== --}}
        {{-- ACCOUNT INFORMATION --}}
        {{-- ===================================================== --}}

        <div class="bg-white rounded-2xl
                    border border-[#D5DDD8]
                    shadow-sm p-8">

            <div class="mb-6">

                <p class="text-sm tracking-[0.3em]
                          text-[#B87945] uppercase">

                    Account

                </p>

                <h2 class="text-2xl font-bold
                           text-[#0F3F4A] mt-2">

                    Account Information

                </h2>

                <p class="text-[#315F6D] mt-1">

                    Manage your account information and password.

                </p>

            </div>


            <div class="space-y-4">


                {{-- ================================================= --}}
                {{-- NAME --}}
                {{-- ================================================= --}}

                <div class="flex flex-col sm:flex-row
                            sm:items-center sm:justify-between
                            gap-4 p-5 rounded-xl
                            border border-[#D5DDD8]
                            bg-[#FAF9F5]">

                    <div>

                        <p class="text-xs uppercase
                                  tracking-wider
                                  text-[#B87945]">

                            Name

                        </p>

                        <p class="text-lg font-semibold
                                  text-[#0F3F4A] mt-1">

                            {{ auth()->user()->name }}

                        </p>

                    </div>


                    <button
                        type="button"
                        onclick="openAccountModal('name')"
                        class="px-5 py-2.5 rounded-xl
                               bg-[#4F806D]
                               text-white
                               font-medium
                               hover:bg-[#3E735F]
                               transition">

                        Edit

                    </button>

                </div>



                {{-- ================================================= --}}
                {{-- EMAIL --}}
                {{-- ================================================= --}}

                <div class="flex flex-col sm:flex-row
                            sm:items-center sm:justify-between
                            gap-4 p-5 rounded-xl
                            border border-[#D5DDD8]
                            bg-[#FAF9F5]">

                    <div>

                        <p class="text-xs uppercase
                                  tracking-wider
                                  text-[#B87945]">

                            Email

                        </p>

                        <p class="text-lg font-semibold
                                  text-[#0F3F4A] mt-1">

                            {{ auth()->user()->email }}

                        </p>

                        <p class="text-sm text-gray-500 mt-1">

                            This email is used to log in and cannot be changed.

                        </p>

                    </div>


                    <span
                        class="px-4 py-2 rounded-xl
                               bg-gray-100
                               text-gray-500
                               text-sm font-medium">

                        Not Editable

                    </span>

                </div>



                {{-- ================================================= --}}
                {{-- PASSWORD --}}
                {{-- ================================================= --}}

                <div class="flex flex-col sm:flex-row
                            sm:items-center sm:justify-between
                            gap-4 p-5 rounded-xl
                            border border-[#D5DDD8]
                            bg-[#FAF9F5]">

                    <div>

                        <p class="text-xs uppercase
                                  tracking-wider
                                  text-[#B87945]">

                            Password

                        </p>

                        <p class="text-lg font-semibold
                                  text-[#0F3F4A] mt-1">

                            ••••••••••••

                        </p>

                        <p class="text-sm text-gray-500 mt-1">

                            Your current password is required before changing it.

                        </p>

                    </div>


                    <button
                        type="button"
                        onclick="openAccountModal('password')"
                        class="px-5 py-2.5 rounded-xl
                               bg-[#0F3F4A]
                               text-white
                               font-medium
                               hover:opacity-90
                               transition">

                        Edit

                    </button>

                </div>

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- SUBSCRIPTION --}}
        {{-- ===================================================== --}}

        @php

            $subscription = auth()->user()->subscription;

            $isAdmin = auth()->user()->is_admin;

        @endphp


        <div class="bg-white rounded-2xl
                    border border-[#D5DDD8]
                    shadow-sm p-8 mt-8">

            <h2 class="text-2xl font-bold text-[#0F3F4A]">

                Subscription

            </h2>



            {{-- ================================================= --}}
            {{-- ADMIN --}}
            {{-- ================================================= --}}

            @if($isAdmin)

                <div class="mt-6 p-6 rounded-2xl
                            bg-[#E5EEF0]
                            border border-[#C7DADD]">

                    <div class="flex items-center gap-3">

                        <span class="text-2xl">
                            ✓
                        </span>

                        <div>

                            <h3 class="font-bold text-[#0F3F4A]">

                                Administrator Access

                            </h3>

                            <p class="text-sm text-[#315F6D] mt-1">

                                Your administrator account has permanent
                                access to all DevNext projects and resources.

                            </p>

                        </div>

                    </div>


                    {{-- ADMIN ACCESS DETAILS --}}

                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">


                        {{-- STATUS --}}

                        <div class="p-5 rounded-xl bg-white
                                    border border-[#C7DADD]">

                            <p class="text-xs uppercase
                                      tracking-wider
                                      text-[#B87945]">

                                Status

                            </p>

                            <p class="font-semibold
                                      text-[#0F3F4A] mt-1">

                                Permanent ✓

                            </p>

                        </div>


                        {{-- INFINITE ACCESS --}}

                        <div class="p-5 rounded-xl bg-white
                                    border border-[#C7DADD]">

                            <p class="text-xs uppercase
                                      tracking-wider
                                      text-[#B87945]">

                                Access

                            </p>

                            <div class="flex items-center gap-2 mt-1">

                                <span class="text-3xl font-bold
                                             text-[#0F3F4A]">

                                    ∞

                                </span>

                                <span class="font-semibold
                                             text-[#0F3F4A]">

                                    Infinite Access

                                </span>

                            </div>

                        </div>

                    </div>

                </div>



            {{-- ================================================= --}}
            {{-- NORMAL USER - ACTIVE --}}
            {{-- ================================================= --}}

            @elseif($subscription && $subscription->isActive())

                <div class="mt-6 p-6 rounded-2xl
                            bg-[#DCEAE4]
                            border border-[#BFD8CE]">

                    <div class="flex items-center gap-3">

                        <span class="text-2xl">
                            ✓
                        </span>

                        <div>

                            <h3 class="font-bold text-[#3E735F]">

                                Active Subscription

                            </h3>

                            <p class="text-sm text-[#315F6D] mt-1">

                                You currently have full access to premium
                                projects and downloadable resources.

                            </p>

                        </div>

                    </div>


                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">


                        {{-- STATUS --}}

                        <div class="p-4 rounded-xl bg-white
                                    border border-[#BFD8CE]">

                            <p class="text-xs uppercase
                                      tracking-wider
                                      text-[#B87945]">

                                Status

                            </p>

                            <p class="font-semibold
                                      text-[#3E735F] mt-1">

                                Active ✓

                            </p>

                        </div>


                        {{-- START DATE --}}

                        <div class="p-4 rounded-xl bg-white
                                    border border-[#BFD8CE]">

                            <p class="text-xs uppercase
                                      tracking-wider
                                      text-[#B87945]">

                                Started

                            </p>

                            <p class="font-semibold
                                      text-[#0F3F4A] mt-1">

                                @if($subscription->starts_at)

                                    {{ $subscription->starts_at->format('F d, Y') }}

                                @else

                                    —

                                @endif

                            </p>

                        </div>


                        {{-- EXPIRATION --}}

                        <div class="p-4 rounded-xl bg-white
                                    border border-[#BFD8CE]">

                            <p class="text-xs uppercase
                                      tracking-wider
                                      text-[#B87945]">

                                Expires

                            </p>

                            <p class="font-semibold
                                      text-[#0F3F4A] mt-1">

                                @if($subscription->ends_at)

                                    {{ $subscription->ends_at->format('F d, Y') }}

                                @else

                                    —

                                @endif

                            </p>

                        </div>

                    </div>


                    @if($subscription->ends_at)

                        <div class="mt-5">

                            @php

                                $daysRemaining = (int) now()->diffInDays(
                                    $subscription->ends_at,
                                    false
                                );

                            @endphp

                            <p class="text-sm text-[#315F6D]">

                                Premium access remaining:

                                <strong>

                                    {{ $daysRemaining }}

                                    {{ $daysRemaining === 1 ? 'day' : 'days' }}

                                </strong>

                            </p>

                        </div>

                    @endif

                </div>



            {{-- ================================================= --}}
            {{-- PENDING --}}
            {{-- ================================================= --}}

            @elseif($subscription && $subscription->status === 'pending')

                <div class="mt-6 p-6 rounded-2xl
                            bg-[#FFF4D6]
                            border border-[#E8D49A]">

                    <div class="flex items-center gap-3">

                        <span class="text-2xl">
                            ⏳
                        </span>

                        <div>

                            <h3 class="font-bold text-[#8A6A20]">

                                Payment Pending

                            </h3>

                            <p class="text-sm text-[#6F5A2A] mt-1">

                                We're waiting for PayMongo to confirm your payment.

                            </p>

                        </div>

                    </div>

                    <p class="text-sm text-[#6F5A2A] mt-4">

                        Your premium access will automatically activate
                        once the payment has been successfully confirmed.

                    </p>

                </div>



            {{-- ================================================= --}}
            {{-- EXPIRED --}}
            {{-- ================================================= --}}

            @elseif($subscription && $subscription->status === 'expired')

                <div class="mt-6 p-6 rounded-2xl
                            bg-[#F5E6D8]
                            border border-[#E5CDB8]">

                    <div class="flex items-center gap-3">

                        <span class="text-2xl">
                            ✕
                        </span>

                        <div>

                            <h3 class="text-xl font-bold text-[#A45F2C]">

                                Subscription Expired

                            </h3>

                            <p class="text-[#7A5538] mt-1">

                                Your subscription has expired.

                            </p>

                        </div>

                    </div>


                    @if($subscription->ends_at)

                        <p class="text-sm text-[#7A5538] mt-4">

                            Expired on:

                            <strong>

                                {{ $subscription->ends_at->format('F d, Y') }}

                            </strong>

                        </p>

                    @endif


                    <p class="text-sm text-[#7A5538] mt-2">

                        Renew your subscription to regain access
                        to premium projects and resources.

                    </p>

                </div>



            {{-- ================================================= --}}
            {{-- NO SUBSCRIPTION --}}
            {{-- ================================================= --}}

            @else

                <div class="mt-6 p-6 rounded-2xl
                            bg-[#F5E6D8]
                            border border-[#E5CDB8]">

                    <h3 class="text-xl font-bold text-[#A45F2C]">

                        No Active Subscription

                    </h3>

                    <p class="text-[#7A5538] mt-2">

                        Subscribe to access premium projects,
                        source code, and project resources.

                    </p>

                </div>

            @endif



            {{-- ================================================= --}}
            {{-- SUBSCRIPTION PLAN --}}
            {{-- ================================================= --}}

            @if(!$isAdmin && (!$subscription || !$subscription->isActive()))

                <div class="mt-8 border border-[#D5DDD8]
                            rounded-2xl p-6">

                    <p class="text-sm tracking-widest uppercase
                              text-[#B87945]">

                        Premium Access

                    </p>


                    <h3 class="text-3xl font-bold
                               text-[#0F3F4A] mt-2">

                        Monthly Subscription

                    </h3>


                    <p class="text-[#315F6D] mt-2">

                        Get access to all premium DevNext projects
                        and downloadable resources.

                    </p>


                    <div class="mt-6">

                        <span class="text-4xl font-bold
                                     text-[#0F3F4A]">

                            ₱99

                        </span>

                        <span class="text-[#315F6D]">

                            / month

                        </span>

                    </div>


                    @if(!$subscription || $subscription->status !== 'pending')

                        <form
                            action="{{ route('subscription.checkout') }}"
                            method="POST"
                            class="mt-6">

                            @csrf

                            <button
                                type="submit"
                                class="px-6 py-3 rounded-xl
                                       bg-[#4F806D]
                                       text-white
                                       font-medium
                                       hover:bg-[#3E735F]
                                       transition">

                                Subscribe Now

                            </button>

                        </form>

                    @else

                        <p class="mt-6 text-sm text-[#6F5A2A]">

                            Please wait while we confirm your payment.

                        </p>

                    @endif

                </div>

            @endif

        </div>



        {{-- ===================================================== --}}
        {{-- PROJECTS --}}
        {{-- ===================================================== --}}

        <div class="mt-8">

            <a
                href="{{ route('projects.index') }}"
                class="inline-block px-6 py-3 rounded-xl
                       bg-[#0F3F4A]
                       text-white
                       hover:opacity-90
                       transition">

                Browse Projects →

            </a>

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- NAME MODAL --}}
{{-- ========================================================= --}}

<div
    id="name-modal"
    class="hidden fixed inset-0 z-50
           items-center justify-center
           bg-black/50 px-6">

    <div class="w-full max-w-md bg-white
                rounded-2xl shadow-xl p-8">

        <h2 class="text-2xl font-bold text-[#0F3F4A]">

            Edit Name

        </h2>

        <p class="text-gray-500 mt-2">

            Update the name displayed on your account.

        </p>


        <form
            action="{{ route('user-profile-information.update') }}"
            method="POST"
            class="mt-6">

            @csrf

            @method('PUT')


            <label
                for="name"
                class="block text-sm font-medium
                       text-[#0F3F4A] mb-2">

                Name

            </label>


            <input
                id="name"
                type="text"
                name="name"
                value="{{ auth()->user()->name }}"
                required
                autocomplete="name"
                class="w-full px-4 py-3 rounded-xl
                       border border-[#D5DDD8]
                       focus:outline-none
                       focus:ring-2
                       focus:ring-[#4F806D]">


            <div class="flex justify-end gap-3 mt-6">

                <button
                    type="button"
                    onclick="closeAccountModal('name')"
                    class="px-5 py-2.5 rounded-xl
                           border border-gray-300
                           text-gray-700
                           hover:bg-gray-100
                           transition">

                    Cancel

                </button>


                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-xl
                           bg-[#4F806D]
                           text-white
                           hover:bg-[#3E735F]
                           transition">

                    Save Changes

                </button>

            </div>

        </form>

    </div>

</div>



{{-- ========================================================= --}}
{{-- PASSWORD MODAL --}}
{{-- ========================================================= --}}

<div
    id="password-modal"
    class="hidden fixed inset-0 z-50
           items-center justify-center
           bg-black/50 px-6">

    <div class="w-full max-w-md bg-white
                rounded-2xl shadow-xl p-8">


        {{-- ================================================= --}}
        {{-- STEP 1 --}}
        {{-- ================================================= --}}

        <div id="password-step-1">

            <div class="flex justify-center mb-5">

                <div
                    class="w-14 h-14 rounded-full
                           bg-[#E5EEF0]
                           flex items-center justify-center">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7 text-[#0F3F4A]"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>

                    </svg>

                </div>

            </div>


            <h2 class="text-2xl font-bold
                       text-[#0F3F4A] text-center">

                Verify Your Password

            </h2>


            <p class="text-gray-500 text-center mt-2">

                Enter your current password before changing it.

            </p>


            {{-- SERVER-SIDE VERIFICATION FORM --}}

            <form
                action="{{ route('profile.verify-password') }}"
                method="POST"
                class="mt-6">

                @csrf


                <label
                    for="verify_current_password"
                    class="block text-sm font-medium
                           text-[#0F3F4A] mb-2">

                    Current Password

                </label>


                <input
                    id="verify_current_password"
                    type="password"
                    name="current_password"
                    required
                    autocomplete="current-password"
                    class="w-full px-4 py-3 rounded-xl
                           border border-[#D5DDD8]
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#4F806D]">


                {{-- Verification Error --}}

                @if($errors->passwordVerification->has('current_password'))

                    <p class="mt-2 text-sm text-[#A45F2C]">

                        {{ $errors->passwordVerification->first('current_password') }}

                    </p>

                @endif


                <div class="flex justify-end gap-3 mt-6">

                    <button
                        type="button"
                        onclick="closeAccountModal('password')"
                        class="px-5 py-2.5 rounded-xl
                               border border-gray-300
                               text-gray-700
                               hover:bg-gray-100
                               transition">

                        Cancel

                    </button>


                    <button
                        type="submit"
                        class="px-5 py-2.5 rounded-xl
                               bg-[#0F3F4A]
                               text-white
                               hover:opacity-90
                               transition">

                        Verify Password

                    </button>

                </div>

            </form>

        </div>



        {{-- ================================================= --}}
        {{-- STEP 2 --}}
        {{-- ================================================= --}}

        <div
            id="password-step-2"
            class="hidden">

            <h2 class="text-2xl font-bold
                       text-[#0F3F4A]">

                Create New Password

            </h2>


            <p class="text-gray-500 mt-2">

                Enter your new password below.

            </p>


            <form
                action="{{ route('user-password.update') }}"
                method="POST"
                class="mt-6">

                @csrf

                @method('PUT')


                {{-- CURRENT PASSWORD --}}

                <input
                    id="confirmed_current_password"
                    type="hidden"
                    name="current_password"
                    value="{{ old('current_password') }}">


                {{-- NEW PASSWORD --}}

                <div>

                    <label
                        for="password"
                        class="block text-sm font-medium
                               text-[#0F3F4A] mb-2">

                        New Password

                    </label>


                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        class="w-full px-4 py-3 rounded-xl
                               border border-[#D5DDD8]
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#4F806D]">

                </div>


                {{-- CONFIRM PASSWORD --}}

                <div class="mt-4">

                    <label
                        for="password_confirmation"
                        class="block text-sm font-medium
                               text-[#0F3F4A] mb-2">

                        Confirm New Password

                    </label>


                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        class="w-full px-4 py-3 rounded-xl
                               border border-[#D5DDD8]
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#4F806D]">

                </div>


                <div class="flex justify-end gap-3 mt-6">

                    <button
                        type="button"
                        onclick="showCurrentPasswordStep()"
                        class="px-5 py-2.5 rounded-xl
                               border border-gray-300
                               text-gray-700
                               hover:bg-gray-100
                               transition">

                        Back

                    </button>


                    <button
                        type="submit"
                        class="px-5 py-2.5 rounded-xl
                               bg-[#0F3F4A]
                               text-white
                               hover:opacity-90
                               transition">

                        Update Password

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

    function openAccountModal(type) {

        const modal = document.getElementById(type + '-modal');

        if (!modal) {
            return;
        }

        modal.classList.remove('hidden');

        modal.classList.add('flex');

        document.body.classList.add('overflow-hidden');


        if (type === 'password') {

            showCurrentPasswordStep();

        }

    }


    function closeAccountModal(type) {

        const modal = document.getElementById(type + '-modal');

        if (!modal) {
            return;
        }

        modal.classList.add('hidden');

        modal.classList.remove('flex');

        document.body.classList.remove('overflow-hidden');

    }


    function showCurrentPasswordStep() {

        document
            .getElementById('password-step-2')
            .classList.add('hidden');


        document
            .getElementById('password-step-1')
            .classList.remove('hidden');

    }


    // Close when clicking dark background

    document.addEventListener('click', function(event) {

        if (event.target.classList.contains('bg-black/50')) {

            event.target.classList.add('hidden');

            event.target.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');

        }

    });


    // Close with Escape

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            document
                .querySelectorAll('#name-modal, #password-modal')
                .forEach(function(modal) {

                    modal.classList.add('hidden');

                    modal.classList.remove('flex');

                });

            document.body.classList.remove('overflow-hidden');

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Automatically open password Step 2 after successful verification
    |--------------------------------------------------------------------------
    */

    @if(session('password_verified'))

        document.addEventListener('DOMContentLoaded', function() {

            openAccountModal('password');

            document
                .getElementById('password-step-1')
                .classList.add('hidden');

            document
                .getElementById('password-step-2')
                .classList.remove('hidden');

        });

    @endif


    /*
    |--------------------------------------------------------------------------
    | Restore password Step 1 when verification fails
    |--------------------------------------------------------------------------
    */

    @if($errors->passwordVerification->has('current_password'))

        document.addEventListener('DOMContentLoaded', function() {

            openAccountModal('password');

            document
                .getElementById('password-step-1')
                .classList.remove('hidden');

            document
                .getElementById('password-step-2')
                .classList.add('hidden');

        });

    @endif

</script>

@endsection