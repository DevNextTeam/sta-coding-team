@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#F5F1E8] py-12 px-6">

    <div class="max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="mb-10">

            <a
                href="{{ route('admin.dashboard') }}"
                class="text-[#4F806D] hover:underline"
            >
                ← Back to Admin Dashboard
            </a>

            <p class="text-sm tracking-[0.3em] text-[#B87945] uppercase mt-6">
                Admin
            </p>

            <h1 class="text-4xl font-bold text-[#0F3F4A] mt-2">
                User Management
            </h1>

            <p class="text-[#315F6D] mt-2">
                View users and manage their subscription status.
            </p>

        </div>


        {{-- Success Message --}}
        @if(session('success'))

            <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-700">
                {{ session('success') }}
            </div>

        @endif


        {{-- Error Message --}}
        @if(session('error'))

            <div class="mb-6 p-4 rounded-xl bg-red-100 text-red-700">
                {{ session('error') }}
            </div>

        @endif


        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="mb-6 p-4 rounded-xl bg-red-100 text-red-700">

                <ul class="list-disc ml-5">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Search & Filter --}}
        <form
            method="GET"
            action="{{ route('admin.users.index') }}"
            class="bg-white rounded-2xl border border-[#D5DDD8]
                   shadow-sm p-6 mb-8"
        >

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                {{-- Search --}}
                <div class="md:col-span-2">

                    <label
                        for="search"
                        class="block text-sm font-semibold
                               text-[#0F3F4A] mb-2"
                    >
                        Search Users
                    </label>

                    <input
                        type="text"
                        id="search"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Search by name or email..."
                        class="w-full border border-[#D5DDD8]
                               rounded-xl px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#4F806D]"
                    >

                </div>


                {{-- Subscription Filter --}}
                <div>

                    <label
                        for="status"
                        class="block text-sm font-semibold
                               text-[#0F3F4A] mb-2"
                    >
                        Subscription Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="w-full border border-[#D5DDD8]
                               rounded-xl px-4 py-3
                               bg-white
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#4F806D]"
                    >

                        <option
                            value="all"
                            {{ ($status ?? 'all') === 'all' ? 'selected' : '' }}
                        >
                            All Users
                        </option>

                        <option
                            value="active"
                            {{ ($status ?? '') === 'active' ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="pending"
                            {{ ($status ?? '') === 'pending' ? 'selected' : '' }}
                        >
                            Pending
                        </option>

                        <option
                            value="expired"
                            {{ ($status ?? '') === 'expired' ? 'selected' : '' }}
                        >
                            Expired
                        </option>

                        <option
                            value="none"
                            {{ ($status ?? '') === 'none' ? 'selected' : '' }}
                        >
                            No Subscription
                        </option>

                    </select>

                </div>

            </div>


            {{-- Search Buttons --}}
            <div class="flex flex-wrap gap-3 mt-5">

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl
                           bg-[#0F3F4A] text-white
                           hover:opacity-90 transition"
                >
                    Search & Filter
                </button>

                <a
                    href="{{ route('admin.users.index') }}"
                    class="px-6 py-3 rounded-xl
                           border border-[#D5DDD8]
                           text-[#0F3F4A]
                           hover:bg-gray-50 transition"
                >
                    Clear
                </a>

            </div>

        </form>


        {{-- Result Count --}}
        <div class="mb-4">

            <p class="text-sm text-gray-500">

                Showing
                <span class="font-semibold text-[#0F3F4A]">
                    {{ $users->count() }}
                </span>

                {{ $users->count() === 1 ? 'user' : 'users' }}

                @if(!empty($search))

                    matching
                    <span class="font-semibold text-[#0F3F4A]">
                        "{{ $search }}"
                    </span>

                @endif

            </p>

        </div>


        {{-- Users --}}
        <div class="space-y-4">

            @forelse($users as $user)

                <div class="bg-white rounded-2xl border border-[#D5DDD8]
                            shadow-sm p-6">

                    {{-- User Header --}}
                    <div class="flex flex-col lg:flex-row
                                lg:items-center lg:justify-between gap-6">


                        {{-- User Information --}}
                        <div>

                            <div class="flex items-center gap-3">

                                <h2 class="text-xl font-bold text-[#0F3F4A]">
                                    {{ $user->name }}
                                </h2>


                                {{-- Admin Badge --}}
                                @if($user->is_admin)

                                    <span
                                        class="px-3 py-1 rounded-full
                                               text-xs font-semibold
                                               bg-[#E5EEF0] text-[#0F3F4A]"
                                    >
                                        ADMIN
                                    </span>

                                @endif

                            </div>


                            <p class="text-gray-500 mt-1">
                                {{ $user->email }}
                            </p>

                        </div>


                        {{-- Subscription Status --}}
                        <div class="lg:text-right">

                            <p class="text-sm uppercase tracking-wider
                                      text-[#B87945]">
                                Subscription
                            </p>


                            @if($user->subscription)

                                {{-- ACTIVE --}}
                                @if($user->subscription->isActive())

                                    <span
                                        class="inline-block mt-1 px-3 py-1
                                               rounded-full text-sm font-semibold
                                               bg-[#DCEAE4] text-[#3E735F]"
                                    >
                                        ✓ Active
                                    </span>


                                {{-- PENDING --}}
                                @elseif($user->subscription->status === 'pending')

                                    <span
                                        class="inline-block mt-1 px-3 py-1
                                               rounded-full text-sm font-semibold
                                               bg-yellow-100 text-yellow-700"
                                    >
                                        Pending
                                    </span>


                                {{-- EXPIRED --}}
                                @else

                                    <span
                                        class="inline-block mt-1 px-3 py-1
                                               rounded-full text-sm font-semibold
                                               bg-[#F1E3D4] text-[#A45F2C]"
                                    >
                                        Expired
                                    </span>

                                @endif


                            @else

                                {{-- NO SUBSCRIPTION --}}
                                <span
                                    class="inline-block mt-1 px-3 py-1
                                           rounded-full text-sm font-semibold
                                           bg-gray-100 text-gray-600"
                                >
                                    No Subscription
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- Subscription Details --}}
                    @if($user->subscription)

                        <div class="grid grid-cols-1 sm:grid-cols-3
                                    gap-4 mt-6 pt-6
                                    border-t border-[#D5DDD8]">


                            {{-- Started --}}
                            <div>

                                <p class="text-xs uppercase tracking-wider
                                          text-gray-500">
                                    Started
                                </p>

                                <p class="font-semibold text-[#0F3F4A] mt-1">

                                    @if($user->subscription->starts_at)

                                        {{ $user->subscription->starts_at->format('M d, Y') }}

                                    @else

                                        —

                                    @endif

                                </p>

                            </div>


                            {{-- Expires --}}
                            <div>

                                <p class="text-xs uppercase tracking-wider
                                          text-gray-500">
                                    Expires
                                </p>

                                <p class="font-semibold text-[#0F3F4A] mt-1">

                                    @if($user->subscription->ends_at)

                                        {{ $user->subscription->ends_at->format('M d, Y') }}

                                    @else

                                        —

                                    @endif

                                </p>

                            </div>


                            {{-- Payment Session --}}
                            <div>

                                <p class="text-xs uppercase tracking-wider
                                          text-gray-500">
                                    Payment Session
                                </p>

                                <p class="font-mono text-xs text-gray-600 mt-1
                                          break-all">

                                    {{ $user->subscription->paymongo_checkout_session_id ?? '—' }}

                                </p>

                            </div>

                        </div>

                    @endif


                    {{-- Subscription Management --}}
                    <div class="mt-6 pt-6 border-t border-[#D5DDD8]">

                        <p class="text-xs uppercase tracking-wider
                                  text-gray-500 mb-3">
                            Subscription Management
                        </p>


                        <div class="flex flex-wrap gap-3">


                            {{-- Activate --}}
                            <form
                                action="{{ route('admin.users.activate', $user) }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="px-4 py-2 rounded-xl
                                           bg-[#4F806D] text-white
                                           hover:bg-[#3E735F]
                                           transition"
                                >
                                    Activate
                                </button>

                            </form>


                            {{-- Extend --}}
                            <form
                                action="{{ route('admin.users.extend', $user) }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="px-4 py-2 rounded-xl
                                           bg-blue-100 text-blue-700
                                           hover:bg-blue-200
                                           transition"
                                >
                                    Extend 30 Days
                                </button>

                            </form>


                            {{-- Expire --}}
                            <button
                                type="button"
                                onclick="openExpireModal({{ $user->id }}, '{{ addslashes($user->name) }}')"
                                class="px-4 py-2 rounded-xl
                                       bg-red-100 text-red-700
                                       hover:bg-red-200
                                       transition"
                            >
                                Expire
                            </button>

                        </div>

                    </div>

                </div>


                {{-- Expire Confirmation Modal --}}
                <div
                    id="expire-modal-{{ $user->id }}"
                    class="hidden fixed inset-0 z-50
                           items-center justify-center
                           bg-black/50 px-6"
                >

                    <div
                        class="w-full max-w-md bg-white
                               rounded-2xl shadow-xl p-8"
                    >

                        {{-- Warning Icon --}}
                        <div class="flex justify-center mb-5">

                            <div
                                class="w-14 h-14 rounded-full
                                       bg-red-100
                                       flex items-center justify-center"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-7 h-7 text-red-600"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 3h15.58a2 2 0 001.74-3l-7.82-14a2 2 0 00-3.48 0z"
                                    />
                                </svg>

                            </div>

                        </div>


                        {{-- Title --}}
                        <h2
                            class="text-2xl font-bold
                                   text-[#0F3F4A]
                                   text-center"
                        >
                            Expire Subscription?
                        </h2>


                        {{-- Message --}}
                        <p
                            class="text-gray-600 text-center
                                   mt-3 leading-relaxed"
                        >
                            Are you sure you want to expire
                            <span
                                id="expire-user-name-{{ $user->id }}"
                                class="font-semibold text-[#0F3F4A]"
                            >
                                {{ $user->name }}
                            </span>'s subscription?
                        </p>


                        <p
                            class="text-sm text-gray-500
                                   text-center mt-2"
                        >
                            Their premium access will be removed
                            immediately.
                        </p>


                        {{-- Actions --}}
                        <div
                            class="flex justify-center
                                   gap-3 mt-7"
                        >

                            {{-- Cancel --}}
                            <button
                                type="button"
                                onclick="closeExpireModal({{ $user->id }})"
                                class="px-5 py-2.5 rounded-xl
                                       border border-gray-300
                                       text-gray-700
                                       hover:bg-gray-100
                                       transition"
                            >
                                Cancel
                            </button>


                            {{-- Confirm Expire --}}
                            <form
                                action="{{ route('admin.users.expire', $user) }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="px-5 py-2.5 rounded-xl
                                           bg-red-600 text-white
                                           hover:bg-red-700
                                           transition"
                                >
                                    Expire Subscription
                                </button>

                            </form>

                        </div>

                    </div>

                </div>


            @empty

                <div
                    class="bg-white rounded-2xl
                           border border-[#D5DDD8]
                           p-10 text-center"
                >

                    <h2 class="text-xl font-bold text-[#0F3F4A]">
                        No users found
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Try changing your search or subscription filter.
                    </p>

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="inline-block mt-5
                               px-5 py-3 rounded-xl
                               bg-[#0F3F4A] text-white"
                    >
                        Clear Filters
                    </a>

                </div>

            @endforelse

        </div>

    </div>

</div>


{{-- Modal JavaScript --}}
<script>

    function openExpireModal(userId, userName) {

        const modal = document.getElementById(
            'expire-modal-' + userId
        );

        const name = document.getElementById(
            'expire-user-name-' + userId
        );

        if (name) {
            name.textContent = userName;
        }

        if (modal) {

            modal.classList.remove('hidden');

            modal.classList.add('flex');

            document.body.classList.add('overflow-hidden');

        }
    }


    function closeExpireModal(userId) {

        const modal = document.getElementById(
            'expire-modal-' + userId
        );

        if (modal) {

            modal.classList.add('hidden');

            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');

        }
    }


    // Close modal when clicking the dark background.
    document.addEventListener('click', function (event) {

        if (
            event.target.classList.contains('bg-black/50')
        ) {

            const modal = event.target;

            modal.classList.add('hidden');

            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');

        }

    });


    // Close modal with Escape key.
    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {

            document
                .querySelectorAll('[id^="expire-modal-"]')
                .forEach(function (modal) {

                    modal.classList.add('hidden');

                    modal.classList.remove('flex');

                });

            document.body.classList.remove('overflow-hidden');

        }

    });

</script>

@endsection