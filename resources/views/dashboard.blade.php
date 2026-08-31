@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#F5F1E8] py-10 sm:py-12 px-4 sm:px-6">

    <div class="max-w-6xl mx-auto">


        {{-- ========================================================= --}}
        {{-- DASHBOARD HEADER --}}
        {{-- ========================================================= --}}

        <div class="relative overflow-hidden rounded-3xl
                    bg-[#0F3F4A]
                    shadow-sm
                    mb-8">

            {{-- Decorative background --}}

            <div class="absolute -right-20 -top-20
                        w-64 h-64
                        rounded-full
                        bg-[#4F806D]/20">
            </div>

            <div class="absolute -right-10 -bottom-32
                        w-72 h-72
                        rounded-full
                        bg-[#B87945]/10">
            </div>


            <div class="relative p-7 sm:p-10">

                <div class="flex flex-col
                            sm:flex-row
                            sm:items-center
                            sm:justify-between
                            gap-6">

                    <div>

                        <p class="text-xs sm:text-sm
                                  tracking-[0.3em]
                                  uppercase
                                  text-[#D9B38C]">

                            Account Dashboard

                        </p>


                        <h1 class="text-3xl sm:text-4xl
                                   lg:text-5xl
                                   font-bold
                                   text-white
                                   mt-2">

                            Welcome back,
                            {{ auth()->user()->name }}

                        </h1>


                        <p class="text-white/70
                                  mt-3
                                  max-w-xl">

                            Manage your account, subscription,
                            and access to your premium projects.

                        </p>

                    </div>


                    {{-- USER AVATAR --}}

                    <div class="shrink-0">

                        <div class="w-16 h-16 sm:w-20 sm:h-20
                                    rounded-2xl
                                    bg-white/10
                                    border border-white/20
                                    flex items-center justify-center
                                    text-white
                                    text-2xl sm:text-3xl
                                    font-bold
                                    backdrop-blur-sm">

                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- FLASH MESSAGES --}}
        {{-- ========================================================= --}}

        @if(session('success'))

            <div class="mb-6 p-4 sm:p-5
                        rounded-2xl
                        bg-[#DCEAE4]
                        border border-[#BFD8CE]
                        text-[#3E735F]">

                <div class="flex items-start gap-3">

                    <span class="w-7 h-7 shrink-0
                                 rounded-full
                                 bg-[#4F806D]
                                 text-white
                                 flex items-center justify-center
                                 text-sm">

                        ✓

                    </span>

                    <p class="pt-1">

                        {{ session('success') }}

                    </p>

                </div>

            </div>

        @endif


        @if(session('error'))

            <div class="mb-6 p-4 sm:p-5
                        rounded-2xl
                        bg-[#F5E6D8]
                        border border-[#E5CDB8]
                        text-[#A45F2C]">

                <div class="flex items-start gap-3">

                    <span class="w-7 h-7 shrink-0
                                 rounded-full
                                 bg-[#A45F2C]
                                 text-white
                                 flex items-center justify-center
                                 text-sm">

                        !

                    </span>

                    <p class="pt-1">

                        {{ session('error') }}

                    </p>

                </div>

            </div>

        @endif


        @if ($errors->any())

            <div class="mb-6 p-4 sm:p-5
                        rounded-2xl
                        bg-[#F5E6D8]
                        border border-[#E5CDB8]
                        text-[#A45F2C]">

                <ul class="list-disc ml-5 space-y-1">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif



        {{-- ========================================================= --}}
        {{-- ACCOUNT + SUBSCRIPTION GRID --}}
        {{-- ========================================================= --}}

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">


            {{-- ===================================================== --}}
            {{-- ACCOUNT INFORMATION --}}
            {{-- ===================================================== --}}

            <div class="xl:col-span-2
                        bg-white
                        rounded-3xl
                        border border-[#D5DDD8]
                        shadow-sm
                        overflow-hidden">

                {{-- HEADER --}}

                <div class="p-6 sm:p-8
                            border-b border-[#D5DDD8]">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12
                                    rounded-2xl
                                    bg-[#E5EEF0]
                                    flex items-center justify-center">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-[#0F3F4A]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.5 20.25a8.25 8.25 0 0115 0"
                                />

                            </svg>

                        </div>


                        <div>

                            <p class="text-xs uppercase
                                      tracking-[0.2em]
                                      text-[#B87945]">

                                Profile

                            </p>

                            <h2 class="text-2xl
                                       font-bold
                                       text-[#0F3F4A]">

                                Account Information

                            </h2>

                        </div>

                    </div>


                    <p class="text-[#315F6D] mt-4">

                        Manage your personal information
                        and account password.

                    </p>

                </div>


                {{-- ACCOUNT ITEMS --}}

                <div class="p-6 sm:p-8 space-y-4">


                    {{-- NAME --}}

                    <div class="group
                                flex flex-col sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-4
                                p-5
                                rounded-2xl
                                border border-[#D5DDD8]
                                bg-[#FAF9F5]
                                hover:border-[#BFD8CE]
                                hover:shadow-sm
                                transition">

                        <div class="min-w-0">

                            <p class="text-xs uppercase
                                      tracking-wider
                                      text-[#B87945]">

                                Name

                            </p>

                            <p class="text-lg font-semibold
                                      text-[#0F3F4A]
                                      mt-1
                                      truncate">

                                {{ auth()->user()->name }}

                            </p>

                        </div>


                        <button
                            type="button"
                            onclick="openAccountModal('name')"
                            class="shrink-0
                                   px-5 py-2.5
                                   rounded-xl
                                   bg-[#4F806D]
                                   text-white
                                   font-medium
                                   hover:bg-[#3E735F]
                                   hover:-translate-y-0.5
                                   transition">

                            Edit Name

                        </button>

                    </div>



                    {{-- EMAIL --}}

                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-4
                                p-5
                                rounded-2xl
                                border border-[#D5DDD8]
                                bg-[#FAF9F5]">

                        <div class="min-w-0">

                            <p class="text-xs uppercase
                                      tracking-wider
                                      text-[#B87945]">

                                Email Address

                            </p>

                            <p class="text-lg font-semibold
                                      text-[#0F3F4A]
                                      mt-1
                                      break-all">

                                {{ auth()->user()->email }}

                            </p>

                            <p class="text-sm text-gray-500 mt-1">

                                Your email is used to log in
                                and cannot be changed.

                            </p>

                        </div>


                        <span
                            class="shrink-0
                                   inline-flex
                                   items-center
                                   justify-center
                                   px-4 py-2
                                   rounded-xl
                                   bg-gray-100
                                   text-gray-500
                                   text-sm
                                   font-medium">

                            Not Editable

                        </span>

                    </div>



                    {{-- PASSWORD --}}

                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-4
                                p-5
                                rounded-2xl
                                border border-[#D5DDD8]
                                bg-[#FAF9F5]">

                        <div>

                            <p class="text-xs uppercase
                                      tracking-wider
                                      text-[#B87945]">

                                Password

                            </p>

                            <p class="text-lg font-semibold
                                      text-[#0F3F4A]
                                      mt-1
                                      tracking-widest">

                                ••••••••••••

                            </p>

                            <p class="text-sm text-gray-500 mt-1">

                                Change your password securely.

                            </p>

                        </div>


                        <button
                            type="button"
                            onclick="openAccountModal('password')"
                            class="shrink-0
                                   px-5 py-2.5
                                   rounded-xl
                                   bg-[#0F3F4A]
                                   text-white
                                   font-medium
                                   hover:opacity-90
                                   hover:-translate-y-0.5
                                   transition">

                            Change Password

                        </button>

                    </div>

                </div>

            </div>



            {{-- ===================================================== --}}
            {{-- QUICK ACCOUNT SUMMARY --}}
            {{-- ===================================================== --}}

            <div class="space-y-8">


                {{-- SUBSCRIPTION --}}
                
                @php

                    $subscription = auth()->user()->subscription;

                    $isAdmin = auth()->user()->is_admin;

                @endphp


                <div class="bg-white
                            rounded-3xl
                            border border-[#D5DDD8]
                            shadow-sm
                            overflow-hidden">

                    <div class="p-6
                                border-b border-[#D5DDD8]">

                        <p class="text-xs uppercase
                                  tracking-[0.2em]
                                  text-[#B87945]">

                            Membership

                        </p>

                        <h2 class="text-2xl font-bold
                                   text-[#0F3F4A]
                                   mt-1">

                            Subscription

                        </h2>

                    </div>


                    <div class="p-6">


                        {{-- ADMIN --}}

                        @if($isAdmin)

                            <div class="rounded-2xl
                                        bg-[#E5EEF0]
                                        border border-[#C7DADD]
                                        p-5">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10
                                                rounded-xl
                                                bg-[#0F3F4A]
                                                text-white
                                                flex items-center
                                                justify-center">

                                        ✓

                                    </div>


                                    <div>

                                        <h3 class="font-bold
                                                   text-[#0F3F4A]">

                                            Administrator

                                        </h3>

                                        <p class="text-xs
                                                  text-[#315F6D]
                                                  mt-1">

                                            Permanent access

                                        </p>

                                    </div>

                                </div>


                                <div class="mt-5 pt-5
                                            border-t border-[#C7DADD]">

                                    <p class="text-xs uppercase
                                              tracking-wider
                                              text-[#B87945]">

                                        Access Level

                                    </p>

                                    <p class="text-lg font-bold
                                              text-[#0F3F4A]
                                              mt-1">

                                        ∞ Unlimited

                                    </p>

                                </div>

                            </div>



                        {{-- ACTIVE --}}

                        @elseif($subscription && $subscription->isActive())

                            @php

                                $daysRemaining = 0;

                                $totalDays = 30;

                                $progress = 0;

                                if($subscription->ends_at) {

                                    $daysRemaining = max(
                                        0,
                                        (int) now()->diffInDays(
                                            $subscription->ends_at,
                                            false
                                        )
                                    );

                                    if($subscription->starts_at) {

                                        $totalDays = max(
                                            1,
                                            (int) $subscription->starts_at
                                                ->diffInDays(
                                                    $subscription->ends_at
                                                )
                                        );

                                    }

                                    $progress = min(
                                        100,
                                        max(
                                            0,
                                            ($daysRemaining / $totalDays) * 100
                                        )
                                    );

                                }

                            @endphp


                            <div class="rounded-2xl
                                        bg-[#DCEAE4]
                                        border border-[#BFD8CE]
                                        p-5">

                                <div class="flex items-start
                                            justify-between
                                            gap-4">

                                    <div class="flex items-center gap-3">

                                        <div class="w-10 h-10
                                                    rounded-xl
                                                    bg-[#4F806D]
                                                    text-white
                                                    flex items-center
                                                    justify-center">

                                            ✓

                                        </div>


                                        <div>

                                            <h3 class="font-bold
                                                       text-[#3E735F]">

                                                Active

                                            </h3>

                                            <p class="text-xs
                                                      text-[#315F6D]
                                                      mt-1">

                                                Premium access enabled

                                            </p>

                                        </div>

                                    </div>


                                    <span class="text-xs
                                                 font-bold
                                                 px-2.5 py-1
                                                 rounded-full
                                                 bg-white
                                                 text-[#3E735F]">

                                        ACTIVE

                                    </span>

                                </div>


                                @if($subscription->ends_at)

                                    <div class="mt-6">

                                        <div class="flex
                                                    justify-between
                                                    text-sm">

                                            <span class="text-[#315F6D]">

                                                Remaining

                                            </span>

                                            <strong class="text-[#0F3F4A]">

                                                {{ $daysRemaining }}
                                                {{ $daysRemaining === 1 ? 'day' : 'days' }}

                                            </strong>

                                        </div>


                                        {{-- PROGRESS BAR --}}

                                        <div class="mt-3
                                                    h-2
                                                    bg-white
                                                    rounded-full
                                                    overflow-hidden">

                                            <div
                                                class="h-full
                                                       bg-[#4F806D]
                                                       rounded-full
                                                       transition-all"
                                                style="width: {{ $progress }}%"
                                            >
                                            </div>

                                        </div>

                                    </div>


                                    <div class="grid grid-cols-2
                                                gap-3
                                                mt-5">

                                        <div class="bg-white
                                                    rounded-xl
                                                    p-3">

                                            <p class="text-[10px]
                                                      uppercase
                                                      tracking-wider
                                                      text-[#B87945]">

                                                Started

                                            </p>

                                            <p class="text-sm
                                                      font-semibold
                                                      text-[#0F3F4A]
                                                      mt-1">

                                                {{ $subscription->starts_at
                                                    ? $subscription->starts_at->format('M d, Y')
                                                    : '—'
                                                }}

                                            </p>

                                        </div>


                                        <div class="bg-white
                                                    rounded-xl
                                                    p-3">

                                            <p class="text-[10px]
                                                      uppercase
                                                      tracking-wider
                                                      text-[#B87945]">

                                                Expires

                                            </p>

                                            <p class="text-sm
                                                      font-semibold
                                                      text-[#0F3F4A]
                                                      mt-1">

                                                {{ $subscription->ends_at->format('M d, Y') }}

                                            </p>

                                        </div>

                                    </div>

                                @endif

                            </div>



                        {{-- PENDING --}}

                        @elseif($subscription &&
                                $subscription->status === 'pending')

                            <div class="rounded-2xl
                                        bg-[#FFF4D6]
                                        border border-[#E8D49A]
                                        p-5">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10
                                                rounded-xl
                                                bg-[#E8D49A]
                                                text-[#8A6A20]
                                                flex items-center
                                                justify-center">

                                        ⏳

                                    </div>


                                    <div>

                                        <h3 class="font-bold
                                                   text-[#8A6A20]">

                                            Payment Pending

                                        </h3>

                                        <p class="text-xs
                                                  text-[#6F5A2A]
                                                  mt-1">

                                            Waiting for confirmation

                                        </p>

                                    </div>

                                </div>


                                <p class="text-sm
                                          text-[#6F5A2A]
                                          mt-5">

                                    We're waiting for PayMongo
                                    to confirm your payment.

                                </p>

                            </div>



                        {{-- EXPIRED --}}

                        @elseif($subscription &&
                                $subscription->status === 'expired')

                            <div class="rounded-2xl
                                        bg-[#F5E6D8]
                                        border border-[#E5CDB8]
                                        p-5">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10
                                                rounded-xl
                                                bg-[#A45F2C]
                                                text-white
                                                flex items-center
                                                justify-center">

                                        ✕

                                    </div>


                                    <div>

                                        <h3 class="font-bold
                                                   text-[#A45F2C]">

                                            Subscription Expired

                                        </h3>

                                        <p class="text-xs
                                                  text-[#7A5538]
                                                  mt-1">

                                            Premium access ended

                                        </p>

                                    </div>

                                </div>


                                @if($subscription->ends_at)

                                    <p class="text-sm
                                              text-[#7A5538]
                                              mt-5">

                                        Expired on

                                        <strong>

                                            {{ $subscription->ends_at->format('F d, Y') }}

                                        </strong>

                                    </p>

                                @endif

                            </div>



                        {{-- NONE --}}

                        @else

                            <div class="rounded-2xl
                                        bg-[#F5E6D8]
                                        border border-[#E5CDB8]
                                        p-5">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10
                                                rounded-xl
                                                bg-[#A45F2C]
                                                text-white
                                                flex items-center
                                                justify-center">

                                        🔒

                                    </div>


                                    <div>

                                        <h3 class="font-bold
                                                   text-[#A45F2C]">

                                            No Active Subscription

                                        </h3>

                                        <p class="text-xs
                                                  text-[#7A5538]
                                                  mt-1">

                                            Premium access unavailable

                                        </p>

                                    </div>

                                </div>


                                <p class="text-sm
                                          text-[#7A5538]
                                          mt-5">

                                    Subscribe to unlock premium
                                    projects and resources.

                                </p>

                            </div>

                        @endif


                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- PREMIUM PLAN --}}
                {{-- ================================================= --}}

                @if(!$isAdmin &&
                    (!$subscription || !$subscription->isActive()))

                    <div class="rounded-3xl
                                bg-[#0F3F4A]
                                p-6
                                shadow-sm">

                        <p class="text-xs uppercase
                                  tracking-[0.25em]
                                  text-[#D9B38C]">

                            Premium Access

                        </p>


                        <h3 class="text-2xl font-bold
                                   text-white
                                   mt-2">

                            Unlock Everything

                        </h3>


                        <p class="text-sm
                                  text-white/70
                                  mt-2">

                            Get access to premium projects,
                            source code, guides, and resources.

                        </p>


                        <div class="mt-6">

                            <span class="text-4xl
                                         font-bold
                                         text-white">

                                ₱99

                            </span>

                            <span class="text-white/60">

                                / month

                            </span>

                        </div>


                        @if(!$subscription ||
                            $subscription->status !== 'pending')

                            <form
                                action="{{ route('subscription.checkout') }}"
                                method="POST"
                                class="mt-6"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="w-full
                                           px-5 py-3
                                           rounded-xl
                                           bg-[#4F806D]
                                           text-white
                                           font-semibold
                                           hover:bg-[#5D927D]
                                           hover:-translate-y-0.5
                                           transition">

                                    Subscribe Now →

                                </button>

                            </form>

                        @else

                            <div class="mt-6
                                        p-3
                                        rounded-xl
                                        bg-white/10
                                        text-white/80
                                        text-sm">

                                Please wait while your payment
                                is being confirmed.

                            </div>

                        @endif

                    </div>

                @endif

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- BROWSE PROJECTS --}}
        {{-- ========================================================= --}}

        <div class="mt-8
                    bg-white
                    rounded-3xl
                    border border-[#D5DDD8]
                    shadow-sm
                    p-6 sm:p-8">

            <div class="flex flex-col
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                        gap-5">

                <div>

                    <p class="text-xs uppercase
                              tracking-[0.2em]
                              text-[#B87945]">

                        Projects

                    </p>

                    <h2 class="text-2xl
                               font-bold
                               text-[#0F3F4A]
                               mt-1">

                        Explore Projects

                    </h2>

                    <p class="text-[#315F6D]
                              mt-1">

                        Browse our available projects,
                        guides, and resources.

                    </p>

                </div>


                <a
                    href="{{ route('projects.index') }}"
                    class="inline-flex
                           items-center
                           justify-center
                           px-6 py-3
                           rounded-xl
                           bg-[#0F3F4A]
                           text-white
                           font-medium
                           hover:opacity-90
                           hover:-translate-y-0.5
                           transition">

                    Browse Projects

                    <span class="ml-2">

                        →

                    </span>

                </a>

            </div>

        </div>

    </div>

</div>



{{-- =============================================================== --}}
{{-- NAME MODAL --}}
{{-- =============================================================== --}}

<div
    id="name-modal"
    class="hidden fixed inset-0 z-50
           items-center justify-center
           bg-black/50
           backdrop-blur-sm
           px-4 sm:px-6">

    <div
        class="w-full max-w-md
               bg-white
               rounded-3xl
               shadow-2xl
               p-6 sm:p-8"
    >

        <div class="flex items-center gap-4">

            <div class="w-11 h-11
                        rounded-xl
                        bg-[#DCEAE4]
                        text-[#3E735F]
                        flex items-center
                        justify-center">

                ✎

            </div>


            <div>

                <h2 class="text-2xl font-bold
                           text-[#0F3F4A]">

                    Edit Name

                </h2>

                <p class="text-sm text-gray-500 mt-1">

                    Update the name displayed on your account.

                </p>

            </div>

        </div>


        <form
            action="{{ route('user-profile-information.update') }}"
            method="POST"
            class="mt-7">

            @csrf

            @method('PUT')


            <label
                for="name"
                class="block text-sm font-medium
                       text-[#0F3F4A]
                       mb-2">

                Name

            </label>


            <input
                id="name"
                type="text"
                name="name"
                value="{{ auth()->user()->name }}"
                required
                autocomplete="name"
                class="w-full
                       px-4 py-3
                       rounded-xl
                       border border-[#D5DDD8]
                       bg-[#FAF9F5]
                       focus:outline-none
                       focus:ring-2
                       focus:ring-[#4F806D]
                       focus:border-transparent"
            >


            <div class="flex flex-col-reverse
                        sm:flex-row
                        justify-end
                        gap-3
                        mt-6">

                <button
                    type="button"
                    onclick="closeAccountModal('name')"
                    class="px-5 py-2.5
                           rounded-xl
                           border border-gray-300
                           text-gray-700
                           hover:bg-gray-100
                           transition">

                    Cancel

                </button>


                <button
                    type="submit"
                    class="px-5 py-2.5
                           rounded-xl
                           bg-[#4F806D]
                           text-white
                           font-medium
                           hover:bg-[#3E735F]
                           transition">

                    Save Changes

                </button>

            </div>

        </form>

    </div>

</div>



{{-- =============================================================== --}}
{{-- PASSWORD MODAL --}}
{{-- =============================================================== --}}

<div
    id="password-modal"
    class="hidden fixed inset-0 z-50
           items-center justify-center
           bg-black/50
           backdrop-blur-sm
           px-4 sm:px-6">

    <div
        class="w-full max-w-md
               bg-white
               rounded-3xl
               shadow-2xl
               p-6 sm:p-8"
    >


        {{-- ======================================================= --}}
        {{-- STEP 1 --}}
        {{-- ======================================================= --}}

        <div id="password-step-1">

            <div class="flex justify-center mb-5">

                <div
                    class="w-14 h-14
                           rounded-2xl
                           bg-[#E5EEF0]
                           flex items-center justify-center"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7 text-[#0F3F4A]"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                        />

                    </svg>

                </div>

            </div>


            <h2 class="text-2xl font-bold
                       text-[#0F3F4A]
                       text-center">

                Verify Your Password

            </h2>


            <p class="text-gray-500
                      text-center
                      mt-2">

                Enter your current password
                before changing it.

            </p>


            <form
                action="{{ route('profile.verify-password') }}"
                method="POST"
                class="mt-6">

                @csrf


                <label
                    for="verify_current_password"
                    class="block text-sm font-medium
                           text-[#0F3F4A]
                           mb-2">

                    Current Password

                </label>


                <input
                    id="verify_current_password"
                    type="password"
                    name="current_password"
                    required
                    autocomplete="current-password"
                    class="w-full
                           px-4 py-3
                           rounded-xl
                           border border-[#D5DDD8]
                           bg-[#FAF9F5]
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#4F806D]
                           focus:border-transparent"
                >


                @if($errors->passwordVerification->has('current_password'))

                    <p class="mt-2
                              text-sm
                              text-[#A45F2C]">

                        {{ $errors->passwordVerification->first('current_password') }}

                    </p>

                @endif


                <div class="flex flex-col-reverse
                            sm:flex-row
                            justify-end
                            gap-3
                            mt-6">

                    <button
                        type="button"
                        onclick="closeAccountModal('password')"
                        class="px-5 py-2.5
                               rounded-xl
                               border border-gray-300
                               text-gray-700
                               hover:bg-gray-100
                               transition">

                        Cancel

                    </button>


                    <button
                        type="submit"
                        class="px-5 py-2.5
                               rounded-xl
                               bg-[#0F3F4A]
                               text-white
                               font-medium
                               hover:opacity-90
                               transition">

                        Verify Password

                    </button>

                </div>

            </form>

        </div>



        {{-- ======================================================= --}}
        {{-- STEP 2 --}}
        {{-- ======================================================= --}}

        <div
            id="password-step-2"
            class="hidden"
        >

            <div class="mb-6">

                <p class="text-xs uppercase
                          tracking-[0.2em]
                          text-[#B87945]">

                    Security

                </p>


                <h2 class="text-2xl font-bold
                           text-[#0F3F4A]
                           mt-1">

                    Create New Password

                </h2>


                <p class="text-gray-500 mt-2">

                    Choose a new secure password for your account.

                </p>

            </div>


            <form
                action="{{ route('user-password.update') }}"
                method="POST"
                class="space-y-4">

                @csrf

                @method('PUT')


                {{-- CURRENT PASSWORD --}}

                <input
                    id="confirmed_current_password"
                    type="hidden"
                    name="current_password"
                    value="{{ old('current_password') }}"
                >


                {{-- NEW PASSWORD --}}

                <div>

                    <label
                        for="password"
                        class="block text-sm font-medium
                               text-[#0F3F4A]
                               mb-2">

                        New Password

                    </label>


                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        class="w-full
                               px-4 py-3
                               rounded-xl
                               border border-[#D5DDD8]
                               bg-[#FAF9F5]
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#4F806D]
                               focus:border-transparent"
                    >

                </div>


                {{-- CONFIRM PASSWORD --}}

                <div>

                    <label
                        for="password_confirmation"
                        class="block text-sm font-medium
                               text-[#0F3F4A]
                               mb-2">

                        Confirm New Password

                    </label>


                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        class="w-full
                               px-4 py-3
                               rounded-xl
                               border border-[#D5DDD8]
                               bg-[#FAF9F5]
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#4F806D]
                               focus:border-transparent"
                    >

                </div>


                <div class="flex flex-col-reverse
                            sm:flex-row
                            justify-end
                            gap-3
                            pt-2">

                    <button
                        type="button"
                        onclick="showCurrentPasswordStep()"
                        class="px-5 py-2.5
                               rounded-xl
                               border border-gray-300
                               text-gray-700
                               hover:bg-gray-100
                               transition">

                        Back

                    </button>


                    <button
                        type="submit"
                        class="px-5 py-2.5
                               rounded-xl
                               bg-[#0F3F4A]
                               text-white
                               font-medium
                               hover:opacity-90
                               transition">

                        Update Password

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- =============================================================== --}}
{{-- JAVASCRIPT --}}
{{-- =============================================================== --}}

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

        const step1 =
            document.getElementById('password-step-1');

        const step2 =
            document.getElementById('password-step-2');


        if (!step1 || !step2) {
            return;
        }


        step2.classList.add('hidden');

        step1.classList.remove('hidden');

    }


    function showNewPasswordStep() {

        const step1 =
            document.getElementById('password-step-1');

        const step2 =
            document.getElementById('password-step-2');


        if (!step1 || !step2) {
            return;
        }


        step1.classList.add('hidden');

        step2.classList.remove('hidden');

    }


    {{-- Close when clicking overlay --}}

    document.addEventListener('click', function(event) {

        if (event.target.classList.contains('bg-black/50')) {

            event.target.classList.add('hidden');

            event.target.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');

        }

    });


    {{-- Close with Escape --}}

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            document
                .querySelectorAll(
                    '#name-modal, #password-modal'
                )
                .forEach(function(modal) {

                    modal.classList.add('hidden');

                    modal.classList.remove('flex');

                });


            document.body.classList.remove('overflow-hidden');

        }

    });


    {{-- ============================================================= --}}
    {{-- OPEN PASSWORD STEP 2 AFTER VERIFICATION --}}
    {{-- ============================================================= --}}

    @if(session('password_verified'))

        document.addEventListener(
            'DOMContentLoaded',
            function() {

                openAccountModal('password');

                document
                    .getElementById('password-step-1')
                    .classList.add('hidden');

                document
                    .getElementById('password-step-2')
                    .classList.remove('hidden');

            }
        );

    @endif


    {{-- ============================================================= --}}
    {{-- RESTORE PASSWORD STEP 1 IF VERIFICATION FAILS --}}
    {{-- ============================================================= --}}

    @if($errors->passwordVerification->has('current_password'))

        document.addEventListener(
            'DOMContentLoaded',
            function() {

                openAccountModal('password');

                document
                    .getElementById('password-step-1')
                    .classList.remove('hidden');

                document
                    .getElementById('password-step-2')
                    .classList.add('hidden');

            }
        );

    @endif

</script>

@endsection