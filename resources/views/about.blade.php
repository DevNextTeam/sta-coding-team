@extends('layouts.app')
@section('content')

<div class="w-full max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 space-y-6 sm:space-y-10">


    {{-- =========================================================
       HERO
    ========================================================== --}}

    <section
        class="relative overflow-hidden
               rounded-[2rem] sm:rounded-[2.5rem]
               border border-[#DDE7E1]
               bg-[#FFFDFC]
               shadow-sm">

        {{-- Decorative background --}}
        <div
            class="absolute -top-32 -right-24
                   w-72 h-72 sm:w-96 sm:h-96
                   rounded-full
                   bg-[#E5F0EB]
                   blur-3xl
                   opacity-80">
        </div>

        <div
            class="absolute -bottom-32 -left-24
                   w-72 h-72 sm:w-96 sm:h-96
                   rounded-full
                   bg-[#F1EDE3]
                   blur-3xl
                   opacity-80">
        </div>


        <div
            class="relative
                   grid
                   grid-cols-1
                   lg:grid-cols-[1.15fr_0.85fr]
                   gap-8
                   items-center
                   px-6 py-10
                   sm:px-10 sm:py-14
                   lg:px-16 lg:py-20">


            {{-- HERO TEXT --}}

            <div>

                <div
                    class="inline-flex
                           items-center
                           gap-2
                           px-4 py-2
                           rounded-full
                           bg-[#E5F0EB]
                           border border-[#D4E4DD]
                           text-[#4F806D]
                           text-xs sm:text-sm
                           font-semibold">

                    <span
                        class="w-2 h-2
                               rounded-full
                               bg-[#4F806D]
                               animate-pulse">
                    </span>

                    S.T.A Coding Team

                </div>


                <p
                    class="mt-6
                           text-xs sm:text-sm
                           uppercase
                           tracking-[0.3em]
                           font-semibold
                           text-[#B58A5A]">

                    About DevNext

                </p>


                <h1
                    class="mt-3
                           text-4xl
                           sm:text-5xl
                           lg:text-6xl
                           font-black
                           tracking-tight
                           leading-[1.02]
                           text-[#29483D]">

                    We build.

                    <span class="text-[#4F806D]">
                        We learn.
                    </span>

                    <br>

                    We grow.

                </h1>


                <p
                    class="mt-6
                           text-base
                           sm:text-lg
                           leading-8
                           text-[#587067]
                           max-w-2xl">

                    DevNext is the digital home of the
                    <span class="font-semibold text-[#29483D]">
                        S.T.A Coding Team
                    </span>
                    — a group of students turning what we learn
                    into real projects, practical solutions,
                    and meaningful digital experiences.

                </p>


                {{-- HERO BUTTONS --}}

                <div
                    class="flex
                           flex-col
                           sm:flex-row
                           gap-3
                           mt-8">

                    <a
                        href="{{ route('developers.index') }}"
                        class="inline-flex
                               items-center
                               justify-center
                               gap-2
                               px-6 py-3.5
                               rounded-full
                               bg-[#4F806D]
                               text-white
                               font-semibold
                               shadow-sm
                               hover:bg-[#3E735F]
                               hover:-translate-y-0.5
                               hover:shadow-md
                               transition-all
                               duration-300">

                        Meet the Team

                        <span class="text-lg">
                            →
                        </span>

                    </a>


                    <a
                        href="{{ route('projects.index') }}"
                        class="inline-flex
                               items-center
                               justify-center
                               gap-2
                               px-6 py-3.5
                               rounded-full
                               border border-[#C8D8D1]
                               bg-white
                               text-[#4F806D]
                               font-semibold
                               hover:bg-[#E5F0EB]
                               hover:-translate-y-0.5
                               transition-all
                               duration-300">

                        Explore Projects

                    </a>

                </div>

            </div>



            {{-- HERO VISUAL --}}

            <div class="relative">

                <div
                    class="relative
                           rounded-[2rem]
                           bg-[#29483D]
                           p-6 sm:p-8
                           shadow-xl
                           overflow-hidden">

                    {{-- Background decoration --}}

                    <div
                        class="absolute
                               -top-20
                               -right-20
                               w-48 h-48
                               rounded-full
                               bg-[#4F806D]
                               opacity-30
                               blur-3xl">
                    </div>


                    <div
                        class="absolute
                               -bottom-20
                               -left-20
                               w-48 h-48
                               rounded-full
                               bg-[#B8CEC5]
                               opacity-20
                               blur-3xl">
                    </div>


                    {{-- Terminal header --}}

                    <div
                        class="relative
                               flex
                               items-center
                               gap-2
                               pb-5
                               border-b border-white/10">

                        <span
                            class="w-3 h-3
                                   rounded-full
                                   bg-[#D8C7AC]">
                        </span>

                        <span
                            class="w-3 h-3
                                   rounded-full
                                   bg-[#B8CEC5]">
                        </span>

                        <span
                            class="w-3 h-3
                                   rounded-full
                                   bg-[#E5F0EB]">
                        </span>

                        <span
                            class="ml-auto
                                   text-xs
                                   font-mono
                                   text-white/40">

                            devnext/about

                        </span>

                    </div>


                    {{-- Code style content --}}

                    <div
                        class="relative
                               mt-6
                               font-mono
                               text-xs sm:text-sm
                               leading-7">

                        <p class="text-white/40">
                            // our story
                        </p>

                        <p class="mt-3">

                            <span class="text-[#B8CEC5]">
                                const
                            </span>

                            <span class="text-white">
                                team
                            </span>

                            <span class="text-white/40">
                                =
                            </span>

                            <span class="text-[#D8C7AC]">
                                "S.T.A"
                            </span>

                        </p>


                        <p>

                            <span class="text-[#B8CEC5]">
                                const
                            </span>

                            <span class="text-white">
                                mission
                            </span>

                            <span class="text-white/40">
                                =
                            </span>

                            <span class="text-[#D8C7AC]">
                                "Create with purpose"
                            </span>

                        </p>


                        <p>

                            <span class="text-[#B8CEC5]">
                                const
                            </span>

                            <span class="text-white">
                                mindset
                            </span>

                            <span class="text-white/40">
                                =
                            </span>

                            <span class="text-[#D8C7AC]">
                                "Keep learning"
                            </span>

                        </p>


                        <p>

                            <span class="text-[#B8CEC5]">
                                const
                            </span>

                            <span class="text-white">
                                future
                            </span>

                            <span class="text-white/40">
                                =
                            </span>

                            <span class="text-[#D8C7AC]">
                                "Keep building"
                            </span>

                        </p>


                        <div
                            class="mt-6
                                   pt-5
                                   border-t border-white/10
                                   text-white/40">

                            <span class="text-[#B8CEC5]">
                                $
                            </span>

                            building the next idea

                            <span class="animate-pulse">
                                _
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Floating badge --}}

                <div
                    class="absolute
                           -bottom-5
                           left-4 sm:-left-5
                           bg-[#F1EDE3]
                           border border-[#E4DDD0]
                           rounded-2xl
                           px-5 py-3
                           shadow-lg">

                    <p
                        class="text-[10px]
                               uppercase
                               tracking-[0.2em]
                               font-semibold
                               text-[#B58A5A]">

                        Our Philosophy

                    </p>

                    <p
                        class="mt-1
                               text-sm
                               font-bold
                               text-[#29483D]">

                        Learn → Build → Improve

                    </p>

                </div>

            </div>

        </div>

    </section>



    {{-- =========================================================
       INTRO / NUMBERS
    ========================================================== --}}

    <section
        class="grid
               grid-cols-2
               lg:grid-cols-4
               gap-3 sm:gap-4">

        <div
            class="rounded-[1.5rem]
                   bg-[#E5F0EB]
                   border border-[#D4E4DD]
                   p-5 sm:p-6">

            <p
                class="text-3xl sm:text-4xl
                       font-black
                       text-[#29483D]">

                03

            </p>

            <p
                class="mt-2
                       text-sm
                       font-semibold
                       text-[#4F806D]">

                Team Members

            </p>

            <p
                class="mt-1
                       text-xs sm:text-sm
                       text-[#71847D]">

                One shared direction.

            </p>

        </div>


        <div
            class="rounded-[1.5rem]
                   bg-[#FFFDFC]
                   border border-[#E5E0D7]
                   p-5 sm:p-6">

            <p
                class="text-3xl sm:text-4xl
                       font-black
                       text-[#29483D]">

                ∞

            </p>

            <p
                class="mt-2
                       text-sm
                       font-semibold
                       text-[#4F806D]">

                Ideas

            </p>

            <p
                class="mt-1
                       text-xs sm:text-sm
                       text-[#71847D]">

                Always something to build.

            </p>

        </div>


        <div
            class="rounded-[1.5rem]
                   bg-[#F1EDE3]
                   border border-[#E4DDD0]
                   p-5 sm:p-6">

            <p
                class="text-3xl sm:text-4xl
                       font-black
                       text-[#29483D]">

                01

            </p>

            <p
                class="mt-2
                       text-sm
                       font-semibold
                       text-[#B58A5A]">

                Mission

            </p>

            <p
                class="mt-1
                       text-xs sm:text-sm
                       text-[#71847D]">

                Create with purpose.

            </p>

        </div>


        <div
            class="rounded-[1.5rem]
                   bg-[#E5F0EB]
                   border border-[#D4E4DD]
                   p-5 sm:p-6">

            <p
                class="text-3xl sm:text-4xl
                       font-black
                       text-[#29483D]">

                ∞

            </p>

            <p
                class="mt-2
                       text-sm
                       font-semibold
                       text-[#4F806D]">

                Learning

            </p>

            <p
                class="mt-1
                       text-xs sm:text-sm
                       text-[#71847D]">

                Always improving.

            </p>

        </div>

    </section>



    {{-- =========================================================
       MISSION + APPROACH
    ========================================================== --}}

    <section
        class="grid
               grid-cols-1
               lg:grid-cols-2
               gap-5">


        {{-- MISSION --}}

        <div
            class="relative
                   overflow-hidden
                   rounded-[2rem]
                   bg-[#29483D]
                   p-7 sm:p-10
                   text-white">

            <div
                class="absolute
                       -top-16
                       -right-16
                       w-48 h-48
                       rounded-full
                       bg-[#4F806D]
                       opacity-30
                       blur-3xl">
            </div>


            <div class="relative">

                <div
                    class="w-12 h-12
                           rounded-2xl
                           bg-white/10
                           border border-white/10
                           flex items-center justify-center
                           text-xl">

                    ◎

                </div>


                <p
                    class="mt-6
                           text-xs
                           uppercase
                           tracking-[0.3em]
                           font-semibold
                           text-[#B8CEC5]">

                    Our Mission

                </p>


                <h2
                    class="mt-2
                           text-3xl sm:text-4xl
                           font-black">

                    Create with purpose.

                </h2>


                <p
                    class="mt-5
                           text-white/70
                           leading-7
                           max-w-xl">

                    Our mission is to combine creativity and technology
                    to create simple, responsive, and useful web solutions
                    while continuously improving our skills.

                </p>


                <div
                    class="mt-7
                           flex flex-wrap gap-2">

                    <span
                        class="px-3 py-1.5
                               rounded-full
                               bg-white/10
                               text-xs
                               font-semibold
                               text-white/80">

                        Creativity

                    </span>

                    <span
                        class="px-3 py-1.5
                               rounded-full
                               bg-white/10
                               text-xs
                               font-semibold
                               text-white/80">

                        Technology

                    </span>

                    <span
                        class="px-3 py-1.5
                               rounded-full
                               bg-white/10
                               text-xs
                               font-semibold
                               text-white/80">

                        Growth

                    </span>

                </div>

            </div>

        </div>



        {{-- APPROACH --}}

        <div
            class="rounded-[2rem]
                   bg-[#E5F0EB]
                   border border-[#D4E4DD]
                   p-7 sm:p-10">

            <div
                class="w-12 h-12
                       rounded-2xl
                       bg-white
                       border border-[#D4E4DD]
                       flex items-center justify-center
                       text-xl
                       text-[#4F806D]">

                ↗

            </div>


            <p
                class="mt-6
                       text-xs
                       uppercase
                       tracking-[0.3em]
                       font-semibold
                       text-[#4F806D]">

                Our Approach

            </p>


            <h2
                class="mt-2
                       text-3xl sm:text-4xl
                       font-black
                       text-[#29483D]">

                Learn by doing.

            </h2>


            <p
                class="mt-5
                       text-[#587067]
                       leading-7
                       max-w-xl">

                Instead of only studying concepts,
                we believe that building actual projects
                helps us understand technology and develop
                practical skills.

            </p>


            <div class="mt-7 space-y-3">

                <div
                    class="flex items-center gap-3">

                    <span
                        class="w-7 h-7
                               rounded-full
                               bg-white
                               flex items-center justify-center
                               text-xs
                               font-bold
                               text-[#4F806D]">

                        ✓

                    </span>

                    <span
                        class="text-sm
                               font-medium
                               text-[#29483D]">

                        Study the fundamentals

                    </span>

                </div>


                <div
                    class="flex items-center gap-3">

                    <span
                        class="w-7 h-7
                               rounded-full
                               bg-white
                               flex items-center justify-center
                               text-xs
                               font-bold
                               text-[#4F806D]">

                        ✓

                    </span>

                    <span
                        class="text-sm
                               font-medium
                               text-[#29483D]">

                        Build real projects

                    </span>

                </div>


                <div
                    class="flex items-center gap-3">

                    <span
                        class="w-7 h-7
                               rounded-full
                               bg-white
                               flex items-center justify-center
                               text-xs
                               font-bold
                               text-[#4F806D]">

                        ✓

                    </span>

                    <span
                        class="text-sm
                               font-medium
                               text-[#29483D]">

                        Learn from every iteration

                    </span>

                </div>

            </div>

        </div>

    </section>



    {{-- =========================================================
       HOW WE WORK
    ========================================================== --}}

    <section>

        <div
            class="mb-6">

            <p
                class="text-xs sm:text-sm
                       uppercase
                       tracking-[0.3em]
                       font-semibold
                       text-[#B58A5A]">

                How We Work

            </p>


            <h2
                class="mt-2
                       text-3xl sm:text-4xl
                       font-black
                       text-[#29483D]">

                From idea to reality.

            </h2>


            <p
                class="mt-2
                       max-w-2xl
                       text-[#71847D]
                       leading-relaxed">

                Every project gives us another opportunity
                to learn something new and improve what we can do.

            </p>

        </div>


        <div
            class="grid
                   grid-cols-1
                   md:grid-cols-3
                   gap-4">


            {{-- STEP 01 --}}

            <div
                class="group
                       relative
                       rounded-[1.75rem]
                       bg-[#FFFDFC]
                       border border-[#E5E0D7]
                       p-7
                       shadow-sm
                       hover:-translate-y-1
                       hover:shadow-lg
                       transition-all
                       duration-300">

                <div
                    class="flex
                           items-center
                           justify-between">

                    <span
                        class="text-4xl
                               font-black
                               text-[#E5E0D7]
                               group-hover:text-[#D4E4DD]
                               transition">

                        01

                    </span>

                    <span
                        class="w-11 h-11
                               rounded-xl
                               bg-[#E5F0EB]
                               flex items-center justify-center
                               text-[#4F806D]">

                        ◇

                    </span>

                </div>


                <h3
                    class="mt-6
                           text-xl
                           font-bold
                           text-[#29483D]">

                    Learn

                </h3>


                <p
                    class="mt-3
                           text-sm
                           text-[#71847D]
                           leading-6">

                    Understand the technology,
                    explore the fundamentals,
                    and learn how things work.

                </p>

            </div>



            {{-- STEP 02 --}}

            <div
                class="group
                       relative
                       rounded-[1.75rem]
                       bg-[#F1EDE3]
                       border border-[#E4DDD0]
                       p-7
                       shadow-sm
                       hover:-translate-y-1
                       hover:shadow-lg
                       transition-all
                       duration-300">

                <div
                    class="flex
                           items-center
                           justify-between">

                    <span
                        class="text-4xl
                               font-black
                               text-[#E1D8C8]">

                        02

                    </span>

                    <span
                        class="w-11 h-11
                               rounded-xl
                               bg-white
                               flex items-center justify-center
                               text-[#B58A5A]">

                        ◈

                    </span>

                </div>


                <h3
                    class="mt-6
                           text-xl
                           font-bold
                           text-[#29483D]">

                    Build

                </h3>


                <p
                    class="mt-3
                           text-sm
                           text-[#71847D]
                           leading-6">

                    Turn ideas into functional
                    projects and put our knowledge
                    into practice.

                </p>

            </div>



            {{-- STEP 03 --}}

            <div
                class="group
                       relative
                       rounded-[1.75rem]
                       bg-[#FFFDFC]
                       border border-[#E5E0D7]
                       p-7
                       shadow-sm
                       hover:-translate-y-1
                       hover:shadow-lg
                       transition-all
                       duration-300">

                <div
                    class="flex
                           items-center
                           justify-between">

                    <span
                        class="text-4xl
                               font-black
                               text-[#E5E0D7]">

                        03

                    </span>

                    <span
                        class="w-11 h-11
                               rounded-xl
                               bg-[#E5F0EB]
                               flex items-center justify-center
                               text-[#4F806D]">

                        ✦

                    </span>

                </div>


                <h3
                    class="mt-6
                           text-xl
                           font-bold
                           text-[#29483D]">

                    Improve

                </h3>


                <p
                    class="mt-3
                           text-sm
                           text-[#71847D]
                           leading-6">

                    Review what we created,
                    find ways to improve it,
                    and keep growing.

                </p>

            </div>

        </div>

    </section>



    {{-- =========================================================
       TEAM HEADER
    ========================================================== --}}

    <section>

        <div
            class="flex
                   flex-col
                   sm:flex-row
                   sm:items-end
                   sm:justify-between
                   gap-4
                   mb-2">

            <div>

                <p
                    class="text-xs sm:text-sm
                           uppercase
                           tracking-[0.3em]
                           font-semibold
                           text-[#B58A5A]">

                    The Team

                </p>


                <h2
                    class="mt-2
                           text-3xl sm:text-4xl
                           font-black
                           text-[#29483D]">

                    Meet S.T.A.

                </h2>

            </div>


            <p
                class="max-w-md
                       text-sm
                       text-[#71847D]
                       leading-relaxed">

                Three people, different strengths,
                one direction — becoming better developers.

            </p>

        </div>

    </section>



    {{-- =========================================================
       TEAM CARDS
    ========================================================== --}}

    <section
        class="grid
               grid-cols-1
               sm:grid-cols-2
               lg:grid-cols-3
               gap-6
               pb-4">


        {{-- =================================================
        ARIEL
        ================================================== --}}

        <div
            class="group
                   relative
                   pt-28 sm:pt-32 lg:pt-36">


            {{-- IMAGE --}}

            <div
                class="absolute
                       top-0
                       left-1/2
                       -translate-x-1/2
                       z-0
                       w-44 h-44
                       sm:w-52 sm:h-52
                       lg:w-60 lg:h-60
                       pointer-events-none
                       flex items-end justify-center">

                <img
                    src="{{ asset('images/team/Sarong.png') }}"
                    alt="Ariel"
                    class="w-full h-full
                           object-contain
                           object-bottom
                           mix-blend-multiply
                           opacity-95
                           group-hover:scale-[1.03]
                           transition-transform
                           duration-500"
                >

            </div>


            {{-- CARD --}}

            <div
                class="relative
                       z-10
                       bg-[#FFFDFC]
                       rounded-[1.75rem]
                       border border-[#E5E0D7]
                       shadow-sm
                       p-6
                       min-h-[185px]
                       hover:-translate-y-2
                       hover:shadow-xl
                       transition-all
                       duration-300">


                <div
                    class="flex
                           items-start
                           justify-between
                           gap-3">

                    <div>

                        <h3
                            class="text-xl sm:text-2xl
                                   font-black
                                   text-[#29483D]">

                            Ariel (Sarong)

                        </h3>


                        <p
                            class="text-xs sm:text-sm
                                   text-[#B58A5A]
                                   font-semibold
                                   mt-1">

                            Full Stack Development

                        </p>

                    </div>


                    <span
                        class="shrink-0
                               w-9 h-9
                               rounded-xl
                               bg-[#E5F0EB]
                               flex items-center justify-center
                               text-[#4F806D]
                               text-sm">

                        01

                    </span>

                </div>


                <p
                    class="text-sm
                           text-[#587067]
                           leading-6
                           mt-5">

                    Focused on creating clean interfaces,
                    responsive layouts, and user-friendly
                    digital experiences.

                </p>

            </div>

        </div>



        {{-- =================================================
        CHERY
        ================================================== --}}

        <div
            class="group
                   relative
                   pt-28 sm:pt-32 lg:pt-36">


            {{-- IMAGE --}}

            <div
                class="absolute
                       top-0
                       left-1/2
                       -translate-x-1/2
                       z-0
                       w-44 h-44
                       sm:w-52 sm:h-52
                       lg:w-60 lg:h-60
                       pointer-events-none
                       flex items-end justify-center">

                <img
                    src="{{ asset('images/team/Tallie.png') }}"
                    alt="Chery"
                    class="w-full h-full
                           object-contain
                           object-bottom
                           mix-blend-multiply
                           opacity-95
                           group-hover:scale-[1.03]
                           transition-transform
                           duration-500"
                >

            </div>


            {{-- CARD --}}

            <div
                class="relative
                       z-10
                       bg-[#FFFDFC]
                       rounded-[1.75rem]
                       border border-[#E5E0D7]
                       shadow-sm
                       p-6
                       min-h-[185px]
                       hover:-translate-y-2
                       hover:shadow-xl
                       transition-all
                       duration-300">


                <div
                    class="flex
                           items-start
                           justify-between
                           gap-3">

                    <div>

                        <h3
                            class="text-xl sm:text-2xl
                                   font-black
                                   text-[#29483D]">

                            Chery (Tallie)

                        </h3>


                        <p
                            class="text-xs sm:text-sm
                                   text-[#B58A5A]
                                   font-semibold
                                   mt-1">

                            Frontend Development

                        </p>

                    </div>


                    <span
                        class="shrink-0
                               w-9 h-9
                               rounded-xl
                               bg-[#F1EDE3]
                               flex items-center justify-center
                               text-[#B58A5A]
                               text-sm">

                        02

                    </span>

                </div>


                <p
                    class="text-sm
                           text-[#587067]
                           leading-6
                           mt-5">

                    Focused on developing functional,
                    practical, and reliable web solutions
                    through continuous learning.

                </p>

            </div>

        </div>



        {{-- =================================================
        ANGEL
        ================================================== --}}

        <div
            class="group
                   relative
                   pt-28 sm:pt-32 lg:pt-36">


            {{-- IMAGE --}}

            <div
                class="absolute
                       top-0
                       left-1/2
                       -translate-x-1/2
                       z-0
                       w-44 h-44
                       sm:w-52 sm:h-52
                       lg:w-60 lg:h-60
                       pointer-events-none
                       flex items-end justify-center">

                <img
                    src="{{ asset('images/team/Angulo.png') }}"
                    alt="Angel"
                    class="w-full h-full
                           object-contain
                           object-bottom
                           mix-blend-multiply
                           opacity-95
                           group-hover:scale-[1.03]
                           transition-transform
                           duration-500"
                >

            </div>


            {{-- CARD --}}

            <div
                class="relative
                       z-10
                       bg-[#FFFDFC]
                       rounded-[1.75rem]
                       border border-[#E5E0D7]
                       shadow-sm
                       p-6
                       min-h-[185px]
                       hover:-translate-y-2
                       hover:shadow-xl
                       transition-all
                       duration-300">


                <div
                    class="flex
                           items-start
                           justify-between
                           gap-3">

                    <div>

                        <h3
                            class="text-xl sm:text-2xl
                                   font-black
                                   text-[#29483D]">

                            Angel (Angulo)

                        </h3>


                        <p
                            class="text-xs sm:text-sm
                                   text-[#B58A5A]
                                   font-semibold
                                   mt-1">

                            Backend & Support

                        </p>

                    </div>


                    <span
                        class="shrink-0
                               w-9 h-9
                               rounded-xl
                               bg-[#E5F0EB]
                               flex items-center justify-center
                               text-[#4F806D]
                               text-sm">

                        03

                    </span>

                </div>


                <p
                    class="text-sm
                           text-[#587067]
                           leading-6
                           mt-5">

                    Focused on backend development,
                    project functionality, support,
                    and making systems work together.

                </p>

            </div>

        </div>

    </section>



    {{-- =========================================================
       FINAL CTA
    ========================================================== --}}

    <section
        class="relative
               overflow-hidden
               rounded-[2rem]
               bg-[#29483D]
               p-8 sm:p-10 lg:p-14
               mb-4">


        <div
            class="absolute
                   -top-24
                   -right-20
                   w-64 h-64
                   rounded-full
                   bg-[#4F806D]
                   opacity-30
                   blur-3xl">
        </div>


        <div
            class="absolute
                   -bottom-24
                   -left-20
                   w-64 h-64
                   rounded-full
                   bg-[#B8CEC5]
                   opacity-20
                   blur-3xl">
        </div>


        <div
            class="relative
                   flex
                   flex-col
                   md:flex-row
                   md:items-center
                   md:justify-between
                   gap-8">


            <div>

                <p
                    class="text-xs sm:text-sm
                           uppercase
                           tracking-[0.3em]
                           font-semibold
                           text-[#D8C7AC]">

                    What's Next?

                </p>


                <h2
                    class="mt-2
                           text-3xl sm:text-4xl
                           lg:text-5xl
                           font-black
                           text-white">

                    Let's keep building.

                </h2>


                <p
                    class="mt-4
                           max-w-2xl
                           text-white/65
                           leading-7">

                    Explore what the S.T.A Coding Team has created
                    and follow our journey as we continue learning,
                    experimenting, and improving.

                </p>

            </div>


            <a
                href="{{ route('projects.index') }}"
                class="shrink-0
                       inline-flex
                       items-center
                       justify-center
                       gap-2
                       px-7 py-3.5
                       rounded-full
                       bg-[#F1EDE3]
                       text-[#29483D]
                       font-bold
                       shadow-sm
                       hover:bg-white
                       hover:-translate-y-0.5
                       hover:shadow-lg
                       transition-all
                       duration-300">

                Explore Projects

                <span class="text-lg">
                    →
                </span>

            </a>

        </div>

    </section>


</div>

@endsection