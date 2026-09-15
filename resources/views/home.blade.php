@extends('layouts.app')
@section('content')

<div class="w-full overflow-hidden bg-[#F5F1E8]">

    {{-- =========================================================
       HERO SECTION
    ========================================================== --}}

    <section class="relative">

        {{-- Background glow --}}

        <div
            class="absolute
                   -top-40
                   right-[-10rem]
                   w-[32rem]
                   h-[32rem]
                   rounded-full
                   bg-[#DCEAE4]
                   blur-3xl
                   opacity-70
                   pointer-events-none">
        </div>

        <div
            class="absolute
                   top-[35rem]
                   left-[-12rem]
                   w-[30rem]
                   h-[30rem]
                   rounded-full
                   bg-[#E9DDCD]
                   blur-3xl
                   opacity-50
                   pointer-events-none">
        </div>


        <div
            class="relative
                   max-w-7xl
                   mx-auto
                   px-4 sm:px-6 lg:px-8
                   pt-6 sm:pt-10 lg:pt-16
                   pb-12 sm:pb-16 lg:pb-20">


            {{-- =============================================
               TOP LABEL
            ============================================== --}}

            <div class="flex justify-center">

                <div
                    class="inline-flex
                           items-center
                           gap-2
                           px-4 py-2
                           rounded-full
                           border border-[#C9D9D2]
                           bg-white/80
                           backdrop-blur-sm
                           shadow-sm">

                    <span
                        class="relative
                               flex
                               w-2.5 h-2.5">

                        <span
                            class="absolute
                                   inline-flex
                                   w-full h-full
                                   rounded-full
                                   bg-[#4F806D]
                                   opacity-60
                                   animate-ping">
                        </span>

                        <span
                            class="relative
                                   inline-flex
                                   w-2.5 h-2.5
                                   rounded-full
                                   bg-[#4F806D]">
                        </span>

                    </span>

                    <span
                        class="text-xs sm:text-sm
                               font-semibold
                               text-[#29483D]">

                        S.T.A Coding Team

                    </span>

                </div>

            </div>


            {{-- =============================================
               HERO CONTENT
            ============================================== --}}

            <div
                class="max-w-5xl
                       mx-auto
                       text-center
                       mt-8 sm:mt-10">


                <p
                    class="text-xs sm:text-sm
                           uppercase
                           tracking-[0.35em]
                           font-bold
                           text-[#B87945]">

                    Welcome to DevNext

                </p>


                <h1
                    class="mt-5
                           text-[3.2rem]
                           sm:text-6xl
                           md:text-7xl
                           lg:text-8xl
                           font-black
                           tracking-[-0.055em]
                           leading-[0.9]
                           text-[#173F46]">

                    We don't just
                    <span class="text-[#4F806D]">
                        learn.
                    </span>

                    <br>

                    We
                    <span class="text-[#B87945]">
                        build.
                    </span>

                </h1>


                <p
                    class="max-w-2xl
                           mx-auto
                           mt-7
                           text-base sm:text-lg lg:text-xl
                           leading-8
                           text-[#657873]">

                    DevNext is the digital home of the
                    <span class="font-semibold text-[#29483D]">
                        S.T.A Coding Team
                    </span>

                    — where ideas become projects,
                    lessons become experience,
                    and curiosity becomes something real.

                </p>


                {{-- =============================================
                   HERO BUTTONS
                ============================================== --}}

                <div
                    class="flex
                           flex-col sm:flex-row
                           items-center
                           justify-center
                           gap-3
                           mt-8">


                    <a
                        href="{{ route('projects.index') }}"
                        class="group
                               w-full sm:w-auto
                               inline-flex
                               items-center
                               justify-center
                               gap-3
                               px-7 py-4
                               rounded-2xl
                               bg-[#29483D]
                               text-white
                               font-bold
                               shadow-lg
                               shadow-[#29483D]/10
                               hover:bg-[#1F3C33]
                               hover:-translate-y-1
                               hover:shadow-xl
                               transition-all
                               duration-300">

                        Explore Projects

                        <span
                            class="text-xl
                                   group-hover:translate-x-1
                                   transition-transform">

                            →

                        </span>

                    </a>


                    <a
                        href="{{ route('about') }}"
                        class="w-full sm:w-auto
                               inline-flex
                               items-center
                               justify-center
                               gap-2
                               px-7 py-4
                               rounded-2xl
                               bg-white
                               border border-[#D4DED9]
                               text-[#29483D]
                               font-bold
                               hover:bg-[#E8EEE9]
                               hover:-translate-y-1
                               transition-all
                               duration-300">

                        Meet the Team

                    </a>

                </div>


                {{-- =============================================
                   HERO TRUST POINTS
                ============================================== --}}

                <div
                    class="flex
                           flex-wrap
                           justify-center
                           items-center
                           gap-x-6
                           gap-y-3
                           mt-7
                           text-xs sm:text-sm
                           text-[#71817C]">

                    <span class="flex items-center gap-2">

                        <span
                            class="flex
                                   w-5 h-5
                                   items-center
                                   justify-center
                                   rounded-full
                                   bg-[#DCEAE4]
                                   text-[#4F806D]
                                   font-bold">

                            ✓

                        </span>

                        Real Projects

                    </span>


                    <span class="hidden sm:block text-[#C5CEC9]">
                        •
                    </span>


                    <span class="flex items-center gap-2">

                        <span
                            class="flex
                                   w-5 h-5
                                   items-center
                                   justify-center
                                   rounded-full
                                   bg-[#DCEAE4]
                                   text-[#4F806D]
                                   font-bold">

                            ✓

                        </span>

                        Modern Development

                    </span>


                    <span class="hidden sm:block text-[#C5CEC9]">
                        •
                    </span>


                    <span class="flex items-center gap-2">

                        <span
                            class="flex
                                   w-5 h-5
                                   items-center
                                   justify-center
                                   rounded-full
                                   bg-[#DCEAE4]
                                   text-[#4F806D]
                                   font-bold">

                            ✓

                        </span>

                        Always Learning

                    </span>

                </div>

            </div>


            {{-- =================================================
               PREMIUM CODE VISUAL
            ================================================== --}}

            <div
                class="relative
                       max-w-5xl
                       mx-auto
                       mt-14 sm:mt-16 lg:mt-20">


                {{-- Glow behind code card --}}

                <div
                    class="absolute
                           inset-8
                           rounded-[2.5rem]
                           bg-[#4F806D]
                           blur-3xl
                           opacity-20">
                </div>


                <div
                    class="relative
                           rounded-[2rem]
                           sm:rounded-[2.5rem]
                           bg-[#19352D]
                           p-2
                           shadow-2xl">


                    <div
                        class="rounded-[1.6rem]
                               sm:rounded-[2rem]
                               overflow-hidden
                               bg-[#112A24]">


                        {{-- Browser Header --}}

                        <div
                            class="flex
                                   items-center
                                   gap-2
                                   px-5 sm:px-7
                                   py-4
                                   border-b border-white/10">


                            <span
                                class="w-3 h-3
                                       rounded-full
                                       bg-[#D6B99A]">
                            </span>

                            <span
                                class="w-3 h-3
                                       rounded-full
                                       bg-[#B8CEC5]">
                            </span>

                            <span
                                class="w-3 h-3
                                       rounded-full
                                       bg-[#E4EEE9]">
                            </span>


                            <div
                                class="ml-4
                                       flex-1
                                       max-w-xs
                                       h-7
                                       rounded-lg
                                       bg-white/5
                                       border border-white/5
                                       flex items-center
                                       px-3">

                                <span
                                    class="text-[10px]
                                           font-mono
                                           text-white/30">

                                    devnext.local

                                </span>

                            </div>


                            <span
                                class="ml-auto
                                       text-xs
                                       font-mono
                                       text-white/30">

                                S.T.A

                            </span>

                        </div>


                        {{-- Code Area --}}

                        <div
                            class="grid
                                   grid-cols-1
                                   md:grid-cols-[1fr_0.7fr]
                                   min-h-[22rem]">


                            {{-- Code --}}

                            <div
                                class="p-6 sm:p-10
                                       font-mono
                                       text-xs sm:text-sm
                                       leading-7
                                       text-white/70">


                                <p>

                                    <span class="text-[#B8CEC5]">
                                        const
                                    </span>

                                    <span class="text-white">
                                        devNext
                                    </span>

                                    <span class="text-white/40">
                                        =
                                    </span>

                                    <span class="text-[#D8C7AC]">
                                        {
                                    </span>

                                </p>


                                <p class="pl-5">

                                    <span class="text-[#B8CEC5]">
                                        mission
                                    </span>:

                                    <span class="text-[#D8C7AC]">
                                        "Build meaningful things"
                                    </span>,

                                </p>


                                <p class="pl-5">

                                    <span class="text-[#B8CEC5]">
                                        team
                                    </span>:

                                    <span class="text-[#D8C7AC]">
                                        "S.T.A Coding Team"
                                    </span>,

                                </p>


                                <p class="pl-5">

                                    <span class="text-[#B8CEC5]">
                                        focus
                                    </span>:

                                    <span class="text-[#D8C7AC]">
                                        "Web Development"
                                    </span>,

                                </p>


                                <p class="pl-5">

                                    <span class="text-[#B8CEC5]">
                                        mindset
                                    </span>:

                                    <span class="text-[#D8C7AC]">
                                        "Keep Learning"
                                    </span>,

                                </p>


                                <p class="pl-5">

                                    <span class="text-[#B8CEC5]">
                                        future
                                    </span>:

                                    <span class="text-[#D8C7AC]">
                                        "Unlimited"
                                    </span>

                                </p>


                                <p>

                                    <span class="text-[#D8C7AC]">
                                        };
                                    </span>

                                </p>


                                <div
                                    class="mt-7
                                           pt-5
                                           border-t border-white/10
                                           flex
                                           items-center
                                           gap-2
                                           text-white/35">

                                    <span class="text-[#B8CEC5]">
                                        $
                                    </span>

                                    <span>
                                        npm run build-future
                                    </span>

                                    <span class="animate-pulse">
                                        █
                                    </span>

                                </div>

                            </div>


                            {{-- Side Panel --}}

                            <div
                                class="hidden md:flex
                                       border-l border-white/10
                                       p-8
                                       flex-col
                                       justify-center">


                                <p
                                    class="text-xs
                                           uppercase
                                           tracking-[0.25em]
                                           text-[#B8CEC5]
                                           font-semibold">

                                    Current Status

                                </p>


                                <h3
                                    class="mt-3
                                           text-3xl
                                           font-black
                                           text-white">

                                    Building.

                                </h3>


                                <p
                                    class="mt-3
                                           text-sm
                                           leading-6
                                           text-white/45">

                                    Every project is another
                                    step toward becoming
                                    better developers.

                                </p>


                                <div
                                    class="mt-7
                                           flex
                                           items-center
                                           gap-3">

                                    <div
                                        class="w-9 h-9
                                               rounded-xl
                                               bg-[#4F806D]/20
                                               border border-[#4F806D]/30
                                               flex
                                               items-center
                                               justify-center
                                               text-[#B8CEC5]">

                                        ↗

                                    </div>

                                    <div>

                                        <p
                                            class="text-xs
                                                   text-white/30">

                                            NEXT STEP

                                        </p>

                                        <p
                                            class="text-sm
                                                   font-semibold
                                                   text-white/70">

                                            Ship something real.

                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Floating status card --}}

                <div
                    class="absolute
                           -bottom-6
                           left-3 sm:left-[-2rem]
                           bg-white
                           border border-[#D8E1DC]
                           rounded-2xl
                           shadow-xl
                           px-4 sm:px-5
                           py-3 sm:py-4">


                    <div class="flex items-center gap-3">

                        <div
                            class="w-9 h-9
                                   rounded-xl
                                   bg-[#E5F0EB]
                                   flex
                                   items-center
                                   justify-center
                                   text-[#4F806D]">

                            ✓

                        </div>


                        <div>

                            <p
                                class="text-[10px]
                                       uppercase
                                       tracking-wider
                                       text-[#84918C]">

                                Team Goal

                            </p>

                            <p
                                class="text-sm
                                       font-bold
                                       text-[#29483D]">

                                Build. Learn. Improve.

                            </p>

                        </div>

                    </div>

                </div>


                {{-- Floating year card --}}

                <div
                    class="absolute
                           -top-5
                           right-3 sm:right-[-1.5rem]
                           hidden sm:block
                           rounded-2xl
                           bg-[#F1E6D7]
                           border border-[#E3D4C1]
                           shadow-lg
                           px-5
                           py-4">


                    <p
                        class="text-[10px]
                               uppercase
                               tracking-wider
                               text-[#B87945]
                               font-bold">

                        Founded on learning

                    </p>


                    <p
                        class="mt-1
                               text-lg
                               font-black
                               text-[#29483D]">

                        S.T.A Coding Team

                    </p>

                </div>

            </div>

        </div>

    </section>



    {{-- =========================================================
       NUMBERS / STATS
    ========================================================== --}}

    <section
        class="max-w-7xl
               mx-auto
               px-4 sm:px-6 lg:px-8
               py-8 sm:py-12">


        <div
            class="grid
                   grid-cols-2
                   lg:grid-cols-4
                   rounded-[2rem]
                   overflow-hidden
                   border border-[#D9E1DC]
                   bg-white
                   shadow-sm">


            <div
                class="p-6 sm:p-8
                       border-b
                       border-r
                       lg:border-b-0
                       border-[#E3E8E5]">

                <p
                    class="text-xs
                           uppercase
                           tracking-[0.2em]
                           text-[#7C8984]">

                    Team

                </p>

                <p
                    class="mt-2
                           text-3xl sm:text-4xl
                           font-black
                           text-[#29483D]">

                    03

                </p>

                <p
                    class="mt-1
                           text-sm
                           text-[#71817C]">

                    Members building together

                </p>

            </div>


            <div
                class="p-6 sm:p-8
                       border-b
                       lg:border-b-0
                       lg:border-r
                       border-[#E3E8E5]">

                <p
                    class="text-xs
                           uppercase
                           tracking-[0.2em]
                           text-[#7C8984]">

                    Focus

                </p>

                <p
                    class="mt-2
                           text-3xl sm:text-4xl
                           font-black
                           text-[#29483D]">

                    Web

                </p>

                <p
                    class="mt-1
                           text-sm
                           text-[#71817C]">

                    Modern digital experiences

                </p>

            </div>


            <div
                class="p-6 sm:p-8
                       border-r
                       border-[#E3E8E5]">

                <p
                    class="text-xs
                           uppercase
                           tracking-[0.2em]
                           text-[#7C8984]">

                    Mindset

                </p>

                <p
                    class="mt-2
                           text-3xl sm:text-4xl
                           font-black
                           text-[#29483D]">

                    Learn

                </p>

                <p
                    class="mt-1
                           text-sm
                           text-[#71817C]">

                    Skills through real practice

                </p>

            </div>


            <div
                class="p-6 sm:p-8">

                <p
                    class="text-xs
                           uppercase
                           tracking-[0.2em]
                           text-[#7C8984]">

                    Direction

                </p>

                <p
                    class="mt-2
                           text-3xl sm:text-4xl
                           font-black
                           text-[#B87945]">

                    Next

                </p>

                <p
                    class="mt-1
                           text-sm
                           text-[#71817C]">

                    Always moving forward

                </p>

            </div>

        </div>

    </section>



    {{-- =========================================================
       INTRODUCTION
    ========================================================== --}}

    <section
        class="max-w-7xl
               mx-auto
               px-4 sm:px-6 lg:px-8
               py-12 sm:py-20">


        <div
            class="grid
                   grid-cols-1
                   lg:grid-cols-[0.8fr_1.2fr]
                   gap-10 lg:gap-20
                   items-start">


            <div>

                <p
                    class="text-sm
                           uppercase
                           tracking-[0.3em]
                           font-bold
                           text-[#B87945]">

                    More Than A Website

                </p>


                <h2
                    class="mt-4
                           text-4xl sm:text-5xl
                           font-black
                           tracking-tight
                           leading-tight
                           text-[#173F46]">

                    A place to
                    <span class="text-[#4F806D]">
                        grow.
                    </span>

                </h2>

            </div>


            <div>

                <p
                    class="text-lg sm:text-xl
                           leading-8
                           text-[#657873]">

                    DevNext started with a simple idea:
                    <span class="font-semibold text-[#29483D]">
                        learning becomes more meaningful when you build something with it.
                    </span>

                </p>


                <p
                    class="mt-5
                           text-base
                           leading-7
                           text-[#7A8782]">

                    Instead of keeping our skills inside tutorials
                    and classroom exercises, we use them to create
                    websites, systems, experiments, and projects
                    that solve practical problems.

                </p>


                <a
                    href="{{ route('about') }}"
                    class="group
                           inline-flex
                           items-center
                           gap-2
                           mt-7
                           font-bold
                           text-[#4F806D]
                           hover:text-[#29483D]
                           transition">

                    Discover our story

                    <span
                        class="group-hover:translate-x-1
                               transition-transform">

                        →

                    </span>

                </a>

            </div>

        </div>

    </section>



    {{-- =========================================================
       WHAT WE BUILD
    ========================================================== --}}

    <section
        class="max-w-7xl
               mx-auto
               px-4 sm:px-6 lg:px-8
               py-12 sm:py-20">


        <div
            class="flex
                   flex-col
                   lg:flex-row
                   lg:items-end
                   lg:justify-between
                   gap-5
                   mb-8 sm:mb-10">


            <div>

                <p
                    class="text-sm
                           uppercase
                           tracking-[0.3em]
                           font-bold
                           text-[#B87945]">

                    What We Build

                </p>


                <h2
                    class="mt-3
                           text-3xl sm:text-5xl
                           font-black
                           tracking-tight
                           text-[#173F46]">

                    Ideas into
                    <span class="text-[#4F806D]">
                        experiences.
                    </span>

                </h2>

            </div>


            <p
                class="max-w-lg
                       text-[#71817C]
                       leading-7">

                From simple experiments to full systems,
                every project gives us another opportunity
                to learn, solve problems, and improve.

            </p>

        </div>



        <div
            class="grid
                   grid-cols-1
                   md:grid-cols-3
                   gap-5">


            {{-- CARD 1 --}}

            <article
                class="group
                       relative
                       overflow-hidden
                       rounded-[2rem]
                       bg-[#29483D]
                       p-7 sm:p-8
                       text-white
                       shadow-sm
                       hover:-translate-y-2
                       hover:shadow-xl
                       transition-all
                       duration-300">


                <div
                    class="absolute
                           -right-12
                           -top-12
                           w-32 h-32
                           rounded-full
                           bg-white/5
                           group-hover:scale-150
                           transition-transform
                           duration-700">
                </div>


                <div
                    class="relative
                           w-14 h-14
                           rounded-2xl
                           bg-white/10
                           border border-white/10
                           flex items-center
                           justify-center
                           text-2xl">

                    &lt;/&gt;

                </div>


                <p
                    class="relative
                           mt-7
                           text-xs
                           uppercase
                           tracking-[0.2em]
                           text-white/40">

                    01 / Development

                </p>


                <h3
                    class="relative
                           mt-2
                           text-2xl
                           font-black">

                    Web Development

                </h3>


                <p
                    class="relative
                           mt-3
                           text-white/65
                           leading-7">

                    Responsive websites,
                    interactive interfaces,
                    and functional web systems
                    built with modern technologies.

                </p>


                <div
                    class="relative
                           mt-7
                           text-sm
                           font-bold
                           text-[#D8C7AC]">

                    Code with purpose →

                </div>

            </article>



            {{-- CARD 2 --}}

            <article
                class="group
                       relative
                       overflow-hidden
                       rounded-[2rem]
                       bg-white
                       border border-[#D9E1DC]
                       p-7 sm:p-8
                       shadow-sm
                       hover:-translate-y-2
                       hover:shadow-xl
                       transition-all
                       duration-300">


                <div
                    class="w-14 h-14
                           rounded-2xl
                           bg-[#F1E6D7]
                           border border-[#E4D8C9]
                           flex items-center
                           justify-center
                           text-2xl">

                    ✦

                </div>


                <p
                    class="mt-7
                           text-xs
                           uppercase
                           tracking-[0.2em]
                           text-[#B87945]
                           font-bold">

                    02 / Design

                </p>


                <h3
                    class="mt-2
                           text-2xl
                           font-black
                           text-[#29483D]">

                    Creative Design

                </h3>


                <p
                    class="mt-3
                           text-[#71817C]
                           leading-7">

                    Clean layouts,
                    thoughtful interactions,
                    and interfaces designed
                    to feel simple and natural.

                </p>


                <div
                    class="mt-7
                           text-sm
                           font-bold
                           text-[#B87945]">

                    Make it feel right →

                </div>

            </article>



            {{-- CARD 3 --}}

            <article
                class="group
                       relative
                       overflow-hidden
                       rounded-[2rem]
                       bg-[#E5F0EB]
                       border border-[#D1E1DA]
                       p-7 sm:p-8
                       shadow-sm
                       hover:-translate-y-2
                       hover:shadow-xl
                       transition-all
                       duration-300">


                <div
                    class="w-14 h-14
                           rounded-2xl
                           bg-white
                           border border-[#D5E3DD]
                           flex items-center
                           justify-center
                           text-2xl">

                    ↗

                </div>


                <p
                    class="mt-7
                           text-xs
                           uppercase
                           tracking-[0.2em]
                           text-[#4F806D]
                           font-bold">

                    03 / Innovation

                </p>


                <h3
                    class="mt-2
                           text-2xl
                           font-black
                           text-[#29483D]">

                    Real Solutions

                </h3>


                <p
                    class="mt-3
                           text-[#657873]
                           leading-7">

                    Turning concepts into practical
                    projects that explore how technology
                    can solve everyday problems.

                </p>


                <div
                    class="mt-7
                           text-sm
                           font-bold
                           text-[#4F806D]">

                    Solve something real →

                </div>

            </article>


        </div>

    </section>



    {{-- =========================================================
       PROCESS
    ========================================================== --}}

    <section
        class="max-w-7xl
               mx-auto
               px-4 sm:px-6 lg:px-8
               py-12 sm:py-20">


        <div
            class="rounded-[2.5rem]
                   bg-[#173F46]
                   overflow-hidden
                   relative">


            <div
                class="absolute
                       right-[-8rem]
                       top-[-8rem]
                       w-72 h-72
                       rounded-full
                       bg-[#4F806D]
                       blur-3xl
                       opacity-20">
            </div>


            <div
                class="relative
                       p-7 sm:p-10 lg:p-14">


                <div
                    class="max-w-2xl">

                    <p
                        class="text-sm
                               uppercase
                               tracking-[0.3em]
                               font-bold
                               text-[#D8C7AC]">

                        Our Process

                    </p>


                    <h2
                        class="mt-4
                               text-3xl sm:text-5xl
                               font-black
                               tracking-tight
                               text-white">

                        Learn.
                        <span class="text-[#B8CEC5]">
                            Build.
                        </span>
                        Improve.

                    </h2>


                    <p
                        class="mt-5
                               text-white/55
                               leading-7">

                        We don't expect to know everything.
                        We focus on learning enough to take
                        the next step — then we take it.

                    </p>

                </div>



                <div
                    class="grid
                           grid-cols-1
                           md:grid-cols-3
                           gap-4
                           mt-10">


                    {{-- STEP 1 --}}

                    <div
                        class="rounded-2xl
                               bg-white/5
                               border border-white/10
                               p-6
                               hover:bg-white/10
                               transition">

                        <span
                            class="text-sm
                                   font-mono
                                   text-[#B8CEC5]">

                            01

                        </span>


                        <h3
                            class="mt-5
                                   text-xl
                                   font-bold
                                   text-white">

                            Learn

                        </h3>


                        <p
                            class="mt-2
                                   text-sm
                                   leading-6
                                   text-white/45">

                            Understand the tools,
                            concepts, and problems
                            before jumping into code.

                        </p>

                    </div>



                    {{-- STEP 2 --}}

                    <div
                        class="rounded-2xl
                               bg-white/5
                               border border-white/10
                               p-6
                               hover:bg-white/10
                               transition">

                        <span
                            class="text-sm
                                   font-mono
                                   text-[#D8C7AC]">

                            02

                        </span>


                        <h3
                            class="mt-5
                                   text-xl
                                   font-bold
                                   text-white">

                            Build

                        </h3>


                        <p
                            class="mt-2
                                   text-sm
                                   leading-6
                                   text-white/45">

                            Turn knowledge into
                            working projects and
                            practical experiments.

                        </p>

                    </div>



                    {{-- STEP 3 --}}

                    <div
                        class="rounded-2xl
                               bg-white/5
                               border border-white/10
                               p-6
                               hover:bg-white/10
                               transition">

                        <span
                            class="text-sm
                                   font-mono
                                   text-[#B8CEC5]">

                            03

                        </span>


                        <h3
                            class="mt-5
                                   text-xl
                                   font-bold
                                   text-white">

                            Improve

                        </h3>


                        <p
                            class="mt-2
                                   text-sm
                                   leading-6
                                   text-white/45">

                            Review what we built,
                            find weaknesses,
                            and make it better.

                        </p>

                    </div>


                </div>

            </div>

        </div>

    </section>



    {{-- =========================================================
       FEATURED PROJECT CTA
    ========================================================== --}}

    <section
        class="max-w-7xl
               mx-auto
               px-4 sm:px-6 lg:px-8
               py-12 sm:py-20">


        <div
            class="relative
                   overflow-hidden
                   rounded-[2.5rem]
                   bg-[#F1E6D7]
                   border border-[#E4D8C9]">


            <div
                class="absolute
                       right-[-5rem]
                       bottom-[-8rem]
                       w-72 h-72
                       rounded-full
                       bg-[#D8C7AC]
                       blur-3xl
                       opacity-40">
            </div>


            <div
                class="relative
                       p-8 sm:p-12 lg:p-16
                       flex
                       flex-col
                       lg:flex-row
                       lg:items-center
                       lg:justify-between
                       gap-10">


                <div class="max-w-2xl">

                    <p
                        class="text-sm
                               uppercase
                               tracking-[0.3em]
                               font-bold
                               text-[#B87945]">

                        Explore Our Work

                    </p>


                    <h2
                        class="mt-4
                               text-3xl sm:text-5xl
                               font-black
                               tracking-tight
                               text-[#29483D]">

                        See what we're
                        <span class="text-[#B87945]">
                            building.
                        </span>

                    </h2>


                    <p
                        class="mt-4
                               text-base sm:text-lg
                               leading-7
                               text-[#657873]">

                        Explore projects, experiments,
                        systems, and ideas created by
                        the S.T.A Coding Team.

                    </p>

                </div>


                <a
                    href="{{ route('projects.index') }}"
                    class="group
                           shrink-0
                           inline-flex
                           items-center
                           justify-center
                           gap-3
                           px-7 py-4
                           rounded-2xl
                           bg-[#29483D]
                           text-white
                           font-bold
                           shadow-lg
                           hover:bg-[#1F3C33]
                           hover:-translate-y-1
                           hover:shadow-xl
                           transition-all
                           duration-300">

                    Browse Projects

                    <span
                        class="text-xl
                               group-hover:translate-x-1
                               transition-transform">

                        →

                    </span>

                </a>

            </div>

        </div>

    </section>



    {{-- =========================================================
       FINAL CTA
    ========================================================== --}}

    <section
        class="max-w-7xl
               mx-auto
               px-4 sm:px-6 lg:px-8
               pt-8
               pb-16 sm:pb-24">


        <div
            class="relative
                   text-center
                   rounded-[2.5rem]
                   bg-white
                   border border-[#D9E1DC]
                   p-8 sm:p-12 lg:p-16
                   shadow-sm
                   overflow-hidden">


            <div
                class="absolute
                       left-1/2
                       -top-32
                       -translate-x-1/2
                       w-72 h-72
                       rounded-full
                       bg-[#E5F0EB]
                       blur-3xl
                       opacity-70">
            </div>


            <div class="relative">

                <p
                    class="text-sm
                           uppercase
                           tracking-[0.3em]
                           font-bold
                           text-[#4F806D]">

                    The Next Step

                </p>


                <h2
                    class="mt-4
                           text-3xl sm:text-5xl
                           lg:text-6xl
                           font-black
                           tracking-tight
                           leading-tight
                           text-[#173F46]">

                    There's always
                    <span class="text-[#B87945]">
                        something next.
                    </span>

                </h2>


                <p
                    class="max-w-xl
                           mx-auto
                           mt-5
                           text-base sm:text-lg
                           leading-7
                           text-[#71817C]">

                    New ideas.
                    New projects.
                    New problems to solve.
                    And another opportunity to become better.

                </p>


                <div
                    class="flex
                           flex-col sm:flex-row
                           justify-center
                           gap-3
                           mt-8">


                    <a
                        href="{{ route('projects.index') }}"
                        class="inline-flex
                               items-center
                               justify-center
                               gap-2
                               px-7 py-4
                               rounded-2xl
                               bg-[#4F806D]
                               text-white
                               font-bold
                               hover:bg-[#3E735F]
                               hover:-translate-y-1
                               transition-all
                               duration-300">

                        Explore DevNext

                        <span>
                            →
                        </span>

                    </a>


                    <a
                        href="{{ route('contact') }}"
                        class="inline-flex
                               items-center
                               justify-center
                               px-7 py-4
                               rounded-2xl
                               border border-[#D4DED9]
                               bg-[#F8FAF8]
                               text-[#29483D]
                               font-bold
                               hover:bg-[#E8EEE9]
                               hover:-translate-y-1
                               transition-all
                               duration-300">

                        Get in Touch

                    </a>

                </div>

            </div>

        </div>

    </section>


</div>

@endsection