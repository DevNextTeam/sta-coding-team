@extends('layouts.app')

@section('content')

<div class="min-h-screen
            bg-[#F5F1E8]
            flex items-center justify-center
            px-4 py-12">

    <div class="w-full max-w-lg">

        <div class="bg-white
                    rounded-3xl
                    border border-[#D5DDD8]
                    shadow-sm
                    overflow-hidden">

            {{-- ===================================================== --}}
            {{-- HEADER --}}
            {{-- ===================================================== --}}

            <div class="bg-[#0F3F4A]
                        px-6 sm:px-8
                        py-8
                        text-center">

                <div class="mx-auto
                            w-16 h-16
                            rounded-2xl
                            bg-white/10
                            border border-white/20
                            flex items-center justify-center
                            text-white
                            text-2xl">

                    @if(session('blocked_type') === 'banned')
                        !
                    @else
                        !
                    @endif

                </div>

                <h1 class="text-2xl sm:text-3xl
                           font-bold
                           text-white
                           mt-5">

                    @if(session('blocked_type') === 'banned')

                        Account Banned

                    @else

                        Account Suspended

                    @endif

                </h1>

                <p class="text-white/70
                          text-sm
                          mt-2">

                    Your account currently has restricted access.

                </p>

            </div>


            {{-- ===================================================== --}}
            {{-- CONTENT --}}
            {{-- ===================================================== --}}

            <div class="p-6 sm:p-8">

                @if(session('blocked_type') === 'banned')

                    {{-- ================================================= --}}
                    {{-- BANNED --}}
                    {{-- ================================================= --}}

                    <div class="rounded-2xl
                                bg-[#F5E6D8]
                                border border-[#E5CDB8]
                                p-5">

                        <p class="text-xs uppercase
                                  tracking-[0.2em]
                                  text-[#A45F2C]">

                            Account Restriction

                        </p>

                        <h2 class="text-xl
                                   font-bold
                                   text-[#A45F2C]
                                   mt-2">

                            Your account has been banned.

                        </h2>

                        <p class="text-sm
                                  text-[#7A5538]
                                  mt-3">

                            You cannot access the DevNext website
                            while your account is banned.

                        </p>

                        @if(auth()->user()->status_until)

                            <div class="mt-5
                                        pt-5
                                        border-t border-[#E5CDB8]">

                                <p class="text-xs uppercase
                                          tracking-wider
                                          text-[#A45F2C]">

                                    Ban Ends

                                </p>

                                <p class="text-lg
                                          font-bold
                                          text-[#7A5538]
                                          mt-1">

                                    {{ auth()->user()->status_until->format('F d, Y h:i A') }}

                                </p>

                            </div>

                        @else

                            <div class="mt-5
                                        pt-5
                                        border-t border-[#E5CDB8]">

                                <p class="text-xs uppercase
                                          tracking-wider
                                          text-[#A45F2C]">

                                    Duration

                                </p>

                                <p class="text-lg
                                          font-bold
                                          text-[#7A5538]
                                          mt-1">

                                    Permanent

                                </p>

                            </div>

                        @endif

                    </div>

                @else

                    {{-- ================================================= --}}
                    {{-- SUSPENDED --}}
                    {{-- ================================================= --}}

                    <div class="rounded-2xl
                                bg-[#FFF8D9]
                                border border-[#E8D49A]
                                p-5">

                        <p class="text-xs uppercase
                                  tracking-[0.2em]
                                  text-[#A87918]">

                            Account Restriction

                        </p>

                        <h2 class="text-xl
                                   font-bold
                                   text-[#8A6A20]
                                   mt-2">

                            Your account is suspended.

                        </h2>

                        <p class="text-sm
                                  text-[#6F5A2A]
                                  mt-3">

                            Your account is temporarily restricted
                            and you cannot use the DevNext website
                            during this period.

                        </p>


                        @if(auth()->user()->status_until)

                            <div class="mt-5
                                        pt-5
                                        border-t border-[#E8D49A]">

                                <p class="text-xs uppercase
                                          tracking-wider
                                          text-[#A87918]">

                                    Suspension Ends

                                </p>

                                <p class="text-lg
                                          font-bold
                                          text-[#6F5A2A]
                                          mt-1">

                                    {{ auth()->user()->status_until->format('F d, Y h:i A') }}

                                </p>

                            </div>

                        @endif

                    </div>

                @endif


                {{-- ================================================= --}}
                {{-- LOGOUT --}}
                {{-- ================================================= --}}

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="mt-6"
                >

                    @csrf

                    <button
                        type="submit"
                        class="w-full
                               px-5 py-3
                               rounded-xl
                               bg-[#0F3F4A]
                               text-white
                               font-semibold
                               hover:opacity-90
                               transition">

                        Log Out

                    </button>

                </form>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- ACCOUNT EMAIL --}}
        {{-- ===================================================== --}}

        <p class="text-center
                  text-sm
                  text-[#315F6D]
                  mt-5">

            {{ auth()->user()->email }}

        </p>

    </div>

</div>

@endsection