@extends('layouts.app')

@section('content')

<div class="relative min-h-[calc(100vh-6rem)] overflow-hidden">

    {{-- =========================================================
       DECORATIVE BACKGROUND
    ========================================================== --}}

    <div
        class="pointer-events-none absolute -top-32 -right-32
               w-80 h-80
               rounded-full
               bg-[#E5F0EB]
               blur-3xl
               opacity-70">
    </div>

    <div
        class="pointer-events-none absolute
               -bottom-40 -left-40
               w-96 h-96
               rounded-full
               bg-[#F1EDE3]
               blur-3xl
               opacity-80">
    </div>


    <div class="relative max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-6 sm:py-10 lg:py-14">


        {{-- =====================================================
           MAIN CONTACT CARD
        ====================================================== --}}

        <section
            class="relative
                   overflow-hidden
                   rounded-[2rem] sm:rounded-[2.5rem]
                   border border-[#DDE7E1]
                   bg-[#FFFDFC]
                   shadow-[0_20px_60px_rgba(41,72,61,0.08)]">


            {{-- =================================================
               TOP ACCENT LINE
            ================================================== --}}

            <div
                class="h-1.5
                       bg-gradient-to-r
                       from-[#29483D]
                       via-[#4F806D]
                       to-[#B8CEC5]">
            </div>


            <div
                class="grid
                       grid-cols-1
                       lg:grid-cols-[0.9fr_1.1fr]">


                {{-- =================================================
                   LEFT — CONTACT INFORMATION
                ================================================== --}}

                <div
                    class="relative
                           overflow-hidden
                           bg-[#29483D]
                           p-7 sm:p-10 lg:p-14
                           text-white">


                    {{-- Decorative circles --}}

                    <div
                        class="absolute
                               -top-20 -right-20
                               w-64 h-64
                               rounded-full
                               border border-white/10">
                    </div>

                    <div
                        class="absolute
                               -bottom-24 -left-24
                               w-72 h-72
                               rounded-full
                               border border-white/10">
                    </div>


                    <div class="relative z-10">


                        {{-- Eyebrow --}}

                        <div
                            class="inline-flex
                                   items-center
                                   gap-2
                                   px-3.5 py-2
                                   rounded-full
                                   bg-white/10
                                   border border-white/10
                                   text-[#D8E6E0]
                                   text-xs
                                   font-semibold
                                   uppercase
                                   tracking-[0.2em]">

                            <span
                                class="w-2 h-2
                                       rounded-full
                                       bg-[#B8CEC5]
                                       animate-pulse">
                            </span>

                            Contact DevNext

                        </div>


                        {{-- Heading --}}

                        <h1
                            class="mt-6
                                   text-4xl
                                   sm:text-5xl
                                   lg:text-6xl
                                   font-black
                                   tracking-tight
                                   leading-[0.95]">

                            Let's build
                            <span class="text-[#B8CEC5]">
                                something
                            </span>
                            together.

                        </h1>


                        {{-- Description --}}

                        <p
                            class="mt-6
                                   text-sm sm:text-base
                                   text-white/70
                                   leading-7
                                   max-w-md">

                            Have an idea, question, suggestion, or
                            simply want to reach out? We'd love to
                            hear from you.

                        </p>


                        {{-- =================================================
                           CONTACT DETAILS
                        ================================================== --}}

                        <div class="mt-10 space-y-4">


                            {{-- Email --}}

                            <div
                                class="group
                                       flex items-center gap-4
                                       p-4
                                       rounded-2xl
                                       bg-white/[0.06]
                                       border border-white/[0.08]
                                       hover:bg-white/[0.10]
                                       transition">


                                <div
                                    class="w-12 h-12
                                           shrink-0
                                           rounded-xl
                                           bg-white/10
                                           flex items-center
                                           justify-center
                                           text-[#B8CEC5]
                                           group-hover:scale-105
                                           transition">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-5 h-5">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 7.5A2.5 2.5 0 0 1 5.5 5h13A2.5 2.5 0 0 1 21 7.5v9a2.5 2.5 0 0 1-2.5 2.5h-13A2.5 2.5 0 0 1 3 16.5v-9Z"/>

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m4 7 8 6 8-6"/>

                                    </svg>

                                </div>


                                <div class="min-w-0">

                                    <p
                                        class="text-[10px]
                                               uppercase
                                               tracking-[0.2em]
                                               font-semibold
                                               text-[#B8CEC5]">

                                        Email

                                    </p>

                                    <p
                                        class="mt-1
                                               text-sm sm:text-base
                                               font-medium
                                               text-white
                                               truncate">

                                        devnextteam@gmail.com

                                    </p>

                                </div>

                            </div>



                            {{-- Projects --}}

                            <a
                                href="{{ route('projects.index') }}"
                                class="group
                                       flex items-center gap-4
                                       p-4
                                       rounded-2xl
                                       bg-white/[0.06]
                                       border border-white/[0.08]
                                       hover:bg-white/[0.10]
                                       transition">


                                <div
                                    class="w-12 h-12
                                           shrink-0
                                           rounded-xl
                                           bg-white/10
                                           flex items-center
                                           justify-center
                                           text-[#B8CEC5]
                                           group-hover:scale-105
                                           transition">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-5 h-5">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4 5.5A2.5 2.5 0 0 1 6.5 3h11A2.5 2.5 0 0 1 20 5.5v13a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 4 18.5v-13Z"/>

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M8 8h8M8 12h8M8 16h5"/>

                                    </svg>

                                </div>


                                <div>

                                    <p
                                        class="text-[10px]
                                               uppercase
                                               tracking-[0.2em]
                                               font-semibold
                                               text-[#B8CEC5]">

                                        Explore

                                    </p>

                                    <p
                                        class="mt-1
                                               text-sm sm:text-base
                                               font-medium
                                               text-white
                                               group-hover:text-[#B8CEC5]
                                               transition">

                                        View our projects
                                        <span class="ml-1">
                                            →
                                        </span>

                                    </p>

                                </div>

                            </a>

                        </div>


                        {{-- =================================================
                           BOTTOM STATEMENT
                        ================================================== --}}

                        <div
                            class="mt-12
                                   pt-7
                                   border-t border-white/10">

                            <p
                                class="text-xs
                                       uppercase
                                       tracking-[0.2em]
                                       text-white/40
                                       font-semibold">

                                S.T.A Coding Team

                            </p>

                            <p
                                class="mt-2
                                       text-sm
                                       text-white/60
                                       leading-relaxed
                                       max-w-sm">

                                Learn. Build. Improve.

                                <span class="text-[#B8CEC5]">
                                    One project at a time.
                                </span>

                            </p>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                   RIGHT — CONTACT FORM
                ================================================== --}}

                <div
                    class="p-7
                           sm:p-10
                           lg:p-14">


                    {{-- Form Header --}}

                    <div class="max-w-xl">

                        <div
                            class="flex
                                   items-center
                                   justify-between
                                   gap-4">

                            <div>

                                <p
                                    class="text-xs
                                           uppercase
                                           tracking-[0.25em]
                                           font-semibold
                                           text-[#B87945]">

                                    Send a message

                                </p>

                                <h2
                                    class="mt-2
                                           text-3xl
                                           sm:text-4xl
                                           font-black
                                           tracking-tight
                                           text-[#29483D]">

                                    Tell us what's on your mind.

                                </h2>

                            </div>


                            <div
                                class="hidden sm:flex
                                       w-12 h-12
                                       rounded-2xl
                                       bg-[#E5F0EB]
                                       border border-[#D4E4DD]
                                       items-center
                                       justify-center
                                       text-[#4F806D]">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="w-6 h-6">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21.75 12a9.75 9.75 0 1 1-3.87-7.83"/>

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m21.75 3.75-9.5 9.5-3.5-3.5"/>

                                </svg>

                            </div>

                        </div>


                        <p
                            class="mt-3
                                   text-sm sm:text-base
                                   text-[#71847D]
                                   leading-relaxed">

                            Fill out the form and send your message
                            directly to the S.T.A Coding Team.

                        </p>

                    </div>



                    {{-- =================================================
                       SUCCESS MESSAGE
                    ================================================== --}}

                    @if(session('success'))

                        <div
                            class="mt-8
                                   rounded-2xl
                                   border border-[#C8DED4]
                                   bg-[#EAF4EF]
                                   p-5">

                            <div class="flex items-start gap-4">

                                <div
                                    class="w-10 h-10
                                           shrink-0
                                           rounded-xl
                                           bg-white
                                           flex items-center
                                           justify-center
                                           text-[#4F806D]">

                                    ✓

                                </div>

                                <div>

                                    <p
                                        class="font-bold
                                               text-[#29483D]">

                                        Message sent successfully.

                                    </p>

                                    <p
                                        class="mt-1
                                               text-sm
                                               text-[#587067]">

                                        Thank you for contacting
                                        the S.T.A Coding Team.

                                    </p>

                                </div>

                            </div>

                        </div>

                    @endif



                    {{-- =================================================
                       ERROR MESSAGE
                    ================================================== --}}

                    @if($errors->any())

                        <div
                            class="mt-8
                                   rounded-2xl
                                   border border-red-200
                                   bg-red-50
                                   p-5
                                   text-red-700">

                            <div class="flex items-start gap-3">

                                <div
                                    class="w-9 h-9
                                           shrink-0
                                           rounded-xl
                                           bg-white
                                           flex items-center
                                           justify-center
                                           font-bold">

                                    !

                                </div>

                                <div>

                                    <p class="font-bold">

                                        Please check your message.

                                    </p>

                                    <ul
                                        class="mt-2
                                               list-disc
                                               list-inside
                                               text-sm
                                               space-y-1">

                                        @foreach($errors->all() as $error)

                                            <li>
                                                {{ $error }}
                                            </li>

                                        @endforeach

                                    </ul>

                                </div>

                            </div>

                        </div>

                    @endif



                    {{-- =================================================
                       FORM
                    ================================================== --}}

                    <form
                        action="/contact"
                        method="POST"
                        class="mt-8 space-y-6">

                        @csrf


                        {{-- =================================================
                           NAME
                        ================================================== --}}

                        <div>

                            <label
                                for="name"
                                class="block
                                       text-sm
                                       font-bold
                                       text-[#29483D]
                                       mb-2">

                                Name

                            </label>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Your name"
                                class="w-full
                                       px-4 py-3.5
                                       rounded-2xl
                                       bg-[#F8F6F1]
                                       border border-[#E4DDD0]
                                       text-[#29483D]
                                       placeholder-[#9AA7A1]
                                       focus:outline-none
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-[#B8CEC5]/30
                                       focus:border-[#4F806D]
                                       transition-all
                                       duration-200">

                        </div>



                        {{-- =================================================
                           EMAIL
                        ================================================== --}}

                        <div>

                            <label
                                for="email"
                                class="block
                                       text-sm
                                       font-bold
                                       text-[#29483D]
                                       mb-2">

                                Email

                            </label>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="you@example.com"
                                class="w-full
                                       px-4 py-3.5
                                       rounded-2xl
                                       bg-[#F8F6F1]
                                       border border-[#E4DDD0]
                                       text-[#29483D]
                                       placeholder-[#9AA7A1]
                                       focus:outline-none
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-[#B8CEC5]/30
                                       focus:border-[#4F806D]
                                       transition-all
                                       duration-200">

                        </div>



                        {{-- =================================================
                           MESSAGE
                        ================================================== --}}

                        <div>

                            <div class="flex items-center justify-between gap-3 mb-2">

                                <label
                                    for="message"
                                    class="block
                                           text-sm
                                           font-bold
                                           text-[#29483D]">

                                    Message

                                </label>

                                <span
                                    class="text-xs
                                           text-[#9AA7A1]">

                                    Required

                                </span>

                            </div>


                            <textarea
                                id="message"
                                name="message"
                                rows="7"
                                placeholder="Tell us what's on your mind..."
                                class="w-full
                                       px-4 py-3.5
                                       rounded-2xl
                                       bg-[#F8F6F1]
                                       border border-[#E4DDD0]
                                       text-[#29483D]
                                       placeholder-[#9AA7A1]
                                       resize-none
                                       focus:outline-none
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-[#B8CEC5]/30
                                       focus:border-[#4F806D]
                                       transition-all
                                       duration-200">{{ old('message') }}</textarea>

                        </div>



                        {{-- =================================================
                           SUBMIT AREA
                        ================================================== --}}

                        <div
                            class="pt-2
                                   flex
                                   flex-col
                                   sm:flex-row
                                   sm:items-center
                                   sm:justify-between
                                   gap-4">


                            <p
                                class="text-xs
                                       text-[#8A9891]
                                       leading-relaxed
                                       max-w-xs">

                                We'll review your message and
                                respond through email.

                            </p>


                            <button
                                type="submit"
                                class="w-full sm:w-auto
                                       inline-flex
                                       items-center
                                       justify-center
                                       gap-2
                                       px-7 py-3.5
                                       rounded-full
                                       bg-[#4F806D]
                                       text-white
                                       font-bold
                                       shadow-[0_8px_20px_rgba(79,128,109,0.20)]
                                       hover:bg-[#3E735F]
                                       hover:-translate-y-0.5
                                       hover:shadow-[0_12px_25px_rgba(79,128,109,0.25)]
                                       active:translate-y-0
                                       transition-all
                                       duration-200">

                                Send Message

                                <span
                                    class="text-lg
                                           transition-transform
                                           duration-200">

                                    →

                                </span>

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </section>


        {{-- =========================================================
           BOTTOM TRUST STRIP
        ========================================================== --}}

        <div
            class="mt-5
                   grid
                   grid-cols-1
                   sm:grid-cols-3
                   gap-3">


            <div
                class="rounded-2xl
                       border border-[#DDE7E1]
                       bg-white/70
                       backdrop-blur
                       px-5 py-4
                       flex items-center gap-3">

                <div
                    class="w-9 h-9
                           rounded-xl
                           bg-[#E5F0EB]
                           flex items-center
                           justify-center
                           text-[#4F806D]
                           font-bold">

                    ✓

                </div>

                <div>

                    <p class="text-sm font-bold text-[#29483D]">
                        Simple
                    </p>

                    <p class="text-xs text-[#71847D]">
                        Clear communication
                    </p>

                </div>

            </div>


            <div
                class="rounded-2xl
                       border border-[#DDE7E1]
                       bg-white/70
                       backdrop-blur
                       px-5 py-4
                       flex items-center gap-3">

                <div
                    class="w-9 h-9
                           rounded-xl
                           bg-[#F1EDE3]
                           flex items-center
                           justify-center
                           text-[#B87945]
                           font-bold">

                    ✦

                </div>

                <div>

                    <p class="text-sm font-bold text-[#29483D]">
                        Purposeful
                    </p>

                    <p class="text-xs text-[#71847D]">
                        Built with intention
                    </p>

                </div>

            </div>


            <div
                class="rounded-2xl
                       border border-[#DDE7E1]
                       bg-white/70
                       backdrop-blur
                       px-5 py-4
                       flex items-center gap-3">

                <div
                    class="w-9 h-9
                           rounded-xl
                           bg-[#E5F0EB]
                           flex items-center
                           justify-center
                           text-[#4F806D]
                           font-bold">

                    ↗

                </div>

                <div>

                    <p class="text-sm font-bold text-[#29483D]">
                        Growing
                    </p>

                    <p class="text-xs text-[#71847D]">
                        Always learning
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection