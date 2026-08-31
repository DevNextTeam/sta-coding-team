@extends('layouts.app')


@section('content')

<div class="max-w-7xl mx-auto space-y-8 sm:space-y-10">


    {{-- =========================================================
       HERO
    ========================================================== --}}

    <section
        class="relative overflow-hidden
               rounded-[2rem]
               border border-[#DDE7E1]
               bg-[#FFFDFC]
               shadow-sm">

        {{-- Decorative background --}}
        <div
            class="absolute -top-24 -right-24
                   w-72 h-72
                   rounded-full
                   bg-[#E5F0EB]
                   blur-3xl
                   opacity-70">
        </div>

        <div
            class="absolute -bottom-32 -left-20
                   w-72 h-72
                   rounded-full
                   bg-[#F1EDE3]
                   blur-3xl
                   opacity-80">
        </div>


        <div
            class="relative
                   grid
                   grid-cols-1
                   lg:grid-cols-[1.2fr_0.8fr]
                   gap-10
                   items-center
                   p-7 sm:p-10 lg:p-16">


            {{-- HERO CONTENT --}}

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
                           text-sm
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
                    class="mt-7
                           text-sm
                           uppercase
                           tracking-[0.3em]
                           font-semibold
                           text-[#B58A5A]">

                    Welcome to

                </p>


                <h1
                    class="mt-3
                           text-5xl
                           sm:text-6xl
                           lg:text-7xl
                           font-black
                           tracking-tight
                           leading-[0.95]
                           text-[#29483D]">

                    Dev<span class="text-[#B58A5A]">Next</span>

                </h1>


                <p
                    class="mt-6
                           text-lg
                           sm:text-xl
                           leading-relaxed
                           text-[#587067]
                           max-w-2xl">

                    A modern space for
                    <span class="font-semibold text-[#29483D]">
                        projects, ideas, and code.
                    </span>

                    Built by the S.T.A Coding Team
                    as we learn, create, and grow through
                    real-world web development.

                </p>


                {{-- BUTTONS --}}

                <div
                    class="flex
                           flex-col
                           sm:flex-row
                           gap-3
                           mt-8">

                    <a
                        href="/projects"
                        class="inline-flex
                               items-center
                               justify-center
                               gap-2
                               px-7 py-3.5
                               rounded-full
                               bg-[#4F806D]
                               text-white
                               font-semibold
                               shadow-sm
                               hover:bg-[#3F6D5B]
                               hover:-translate-y-0.5
                               hover:shadow-md
                               transition-all
                               duration-300">

                        Explore Projects

                        <span class="text-lg">
                            →
                        </span>

                    </a>


                    <a
                        href="/about"
                        class="inline-flex
                               items-center
                               justify-center
                               px-7 py-3.5
                               rounded-full
                               border border-[#C8D8D1]
                               bg-white
                               text-[#4F806D]
                               font-semibold
                               hover:bg-[#E5F0EB]
                               hover:-translate-y-0.5
                               transition-all
                               duration-300">

                        Meet the Team

                    </a>

                </div>


                {{-- SMALL TRUST LINE --}}

                <div
                    class="flex
                           flex-wrap
                           items-center
                           gap-x-6
                           gap-y-2
                           mt-8
                           text-sm
                           text-[#71847D]">

                    <span class="flex items-center gap-2">
                        <span class="text-[#4F806D]">✓</span>
                        Responsive Design
                    </span>

                    <span class="flex items-center gap-2">
                        <span class="text-[#4F806D]">✓</span>
                        Real Projects
                    </span>

                    <span class="flex items-center gap-2">
                        <span class="text-[#4F806D]">✓</span>
                        Continuous Learning
                    </span>

                </div>

            </div>



            {{-- HERO VISUAL / CODE CARD --}}

            <div class="relative">

                <div
                    class="rounded-[1.75rem]
                           bg-[#29483D]
                           p-1
                           shadow-xl
                           rotate-1
                           hover:rotate-0
                           transition-transform
                           duration-500">

                    <div
                        class="rounded-[1.5rem]
                               bg-[#213B32]
                               overflow-hidden">


                        {{-- Window bar --}}

                        <div
                            class="flex
                                   items-center
                                   gap-2
                                   px-5 py-4
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
                                       text-white/40
                                       font-mono">

                                devnext

                            </span>

                        </div>


                        {{-- Code --}}

                        <div
                            class="p-6 sm:p-8
                                   font-mono
                                   text-sm
                                   leading-8
                                   text-white/80">

                            <p>
                                <span class="text-[#B8CEC5]">
                                    const
                                </span>

                                <span class="text-[#FFFDFC]">
                                    devNext
                                </span>

                                <span class="text-white/50">
                                    =
                                </span>

                                <span class="text-[#D8C7AC]">
                                    {
                                </span>
                            </p>


                            <p class="pl-5">
                                <span class="text-[#B8CEC5]">
                                    team
                                </span>:

                                <span class="text-[#D8C7AC]">
                                    "S.T.A"
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
                                    projects
                                </span>:

                                <span class="text-[#D8C7AC]">
                                    "Real World"
                                </span>,
                            </p>


                            <p class="pl-5">
                                <span class="text-[#B8CEC5]">
                                    mindset
                                </span>:

                                <span class="text-[#D8C7AC]">
                                    "Keep Learning"
                                </span>
                            </p>


                            <p>
                                <span class="text-[#D8C7AC]">
                                    };
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

                                build something meaningful

                                <span class="animate-pulse">
                                    _
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Floating badge --}}

                <div
                    class="absolute
                           -bottom-5
                           -left-3 sm:-left-6
                           px-5 py-3
                           rounded-2xl
                           bg-[#F1EDE3]
                           border border-[#E4DDD0]
                           shadow-lg">

                    <p
                        class="text-xs
                               uppercase
                               tracking-wider
                               text-[#B58A5A]
                               font-semibold">

                        Current Goal

                    </p>

                    <p
                        class="text-sm
                               font-bold
                               text-[#29483D]
                               mt-1">

                        Build. Learn. Improve.

                    </p>

                </div>

            </div>

        </div>

    </section>



    {{-- =========================================================
       QUICK STATS
    ========================================================== --}}

    <section
        class="grid
               grid-cols-1
               sm:grid-cols-3
               gap-4">


        <div
            class="group
                   rounded-[1.5rem]
                   bg-[#E5F0EB]
                   border border-[#D4E4DD]
                   p-6
                   hover:-translate-y-1
                   hover:shadow-md
                   transition-all
                   duration-300">

            <p
                class="text-sm
                       text-[#587067]
                       font-medium">

                Team Members

            </p>

            <p
                class="mt-2
                       text-3xl
                       font-black
                       text-[#29483D]">

                03

            </p>

            <p
                class="mt-1
                       text-sm
                       text-[#71847D]">

                One team, one direction.

            </p>

        </div>


        <div
            class="group
                   rounded-[1.5rem]
                   bg-[#F1EDE3]
                   border border-[#E4DDD0]
                   p-6
                   hover:-translate-y-1
                   hover:shadow-md
                   transition-all
                   duration-300">

            <p
                class="text-sm
                       text-[#587067]
                       font-medium">

                Main Focus

            </p>

            <p
                class="mt-2
                       text-3xl
                       font-black
                       text-[#29483D]">

                Web

            </p>

            <p
                class="mt-1
                       text-sm
                       text-[#71847D]">

                Modern web development.

            </p>

        </div>


        <div
            class="group
                   rounded-[1.5rem]
                   bg-[#E5F0EB]
                   border border-[#D4E4DD]
                   p-6
                   hover:-translate-y-1
                   hover:shadow-md
                   transition-all
                   duration-300">

            <p
                class="text-sm
                       text-[#587067]
                       font-medium">

                Philosophy

            </p>

            <p
                class="mt-2
                       text-3xl
                       font-black
                       text-[#29483D]">

                Grow

            </p>

            <p
                class="mt-1
                       text-sm
                       text-[#71847D]">

                Learn through building.

            </p>

        </div>

    </section>



    {{-- =========================================================
       WHAT WE DO
    ========================================================== --}}

    <section>

        <div
            class="flex
                   flex-col
                   sm:flex-row
                   sm:items-end
                   sm:justify-between
                   gap-4
                   mb-6">

            <div>

                <p
                    class="text-sm
                           uppercase
                           tracking-[0.25em]
                           font-semibold
                           text-[#B58A5A]">

                    What We Do

                </p>

                <h2
                    class="text-3xl
                           sm:text-4xl
                           font-black
                           text-[#29483D]
                           mt-2">

                    Turning ideas into projects.

                </h2>

            </div>


            <p
                class="max-w-md
                       text-[#71847D]
                       leading-relaxed">

                We combine development, design,
                and problem-solving to create
                useful digital experiences.

            </p>

        </div>



        <div
            class="grid
                   grid-cols-1
                   md:grid-cols-3
                   gap-5">


            {{-- CARD 1 --}}

            <div
                class="group
                       relative
                       overflow-hidden
                       rounded-[1.75rem]
                       bg-[#FFFDFC]
                       border border-[#E5E0D7]
                       p-7
                       shadow-sm
                       hover:-translate-y-2
                       hover:shadow-lg
                       transition-all
                       duration-300">

                <div
                    class="w-14 h-14
                           rounded-2xl
                           bg-[#E5F0EB]
                           border border-[#D4E4DD]
                           flex items-center
                           justify-center
                           text-2xl
                           group-hover:scale-110
                           transition">

                    💻

                </div>


                <h3
                    class="text-xl
                           font-bold
                           text-[#29483D]
                           mt-6">

                    Web Development

                </h3>


                <p
                    class="mt-3
                           text-[#587067]
                           leading-relaxed">

                    Building responsive and functional
                    websites using modern development
                    tools and technologies.

                </p>


                <div
                    class="mt-6
                           text-sm
                           font-semibold
                           text-[#4F806D]">

                    Development →

                </div>

            </div>



            {{-- CARD 2 --}}

            <div
                class="group
                       relative
                       overflow-hidden
                       rounded-[1.75rem]
                       bg-[#F1EDE3]
                       border border-[#E4DDD0]
                       p-7
                       shadow-sm
                       hover:-translate-y-2
                       hover:shadow-lg
                       transition-all
                       duration-300">

                <div
                    class="w-14 h-14
                           rounded-2xl
                           bg-[#D8C7AC]
                           flex items-center
                           justify-center
                           text-2xl
                           group-hover:scale-110
                           transition">

                    🎨

                </div>


                <h3
                    class="text-xl
                           font-bold
                           text-[#29483D]
                           mt-6">

                    Creative Design

                </h3>


                <p
                    class="mt-3
                           text-[#587067]
                           leading-relaxed">

                    Designing clean, accessible,
                    and user-friendly interfaces
                    that feel natural to use.

                </p>


                <div
                    class="mt-6
                           text-sm
                           font-semibold
                           text-[#B58A5A]">

                    Design →

                </div>

            </div>



            {{-- CARD 3 --}}

            <div
                class="group
                       relative
                       overflow-hidden
                       rounded-[1.75rem]
                       bg-[#FFFDFC]
                       border border-[#E5E0D7]
                       p-7
                       shadow-sm
                       hover:-translate-y-2
                       hover:shadow-lg
                       transition-all
                       duration-300">

                <div
                    class="w-14 h-14
                           rounded-2xl
                           bg-[#E5F0EB]
                           border border-[#D4E4DD]
                           flex items-center
                           justify-center
                           text-2xl
                           group-hover:scale-110
                           transition">

                    🚀

                </div>


                <h3
                    class="text-xl
                           font-bold
                           text-[#29483D]
                           mt-6">

                    Real Solutions

                </h3>


                <p
                    class="mt-3
                           text-[#587067]
                           leading-relaxed">

                    Turning concepts into practical
                    projects designed to solve
                    real-world problems.

                </p>


                <div
                    class="mt-6
                           text-sm
                           font-semibold
                           text-[#4F806D]">

                    Innovation →

                </div>

            </div>


        </div>

    </section>



    {{-- =========================================================
       WHY DEVNEXT
    ========================================================== --}}

    <section
        class="grid
               grid-cols-1
               lg:grid-cols-2
               gap-5">


        <div
            class="rounded-[2rem]
                   bg-[#29483D]
                   p-8 sm:p-10
                   text-white">

            <p
                class="text-sm
                       uppercase
                       tracking-[0.25em]
                       text-[#D8C7AC]
                       font-semibold">

                Why DevNext?

            </p>


            <h2
                class="text-3xl
                       sm:text-4xl
                       font-black
                       mt-3">

                Built while we're
                still learning.

            </h2>


            <p
                class="mt-5
                       text-white/70
                       leading-relaxed
                       max-w-xl">

                DevNext isn't just a website.
                It's a place where we can put
                what we learn into practice,
                experiment with new technologies,
                and turn our ideas into something real.

            </p>


            <a
                href="/about"
                class="inline-flex
                       items-center
                       gap-2
                       mt-7
                       text-[#D8C7AC]
                       font-semibold
                       hover:text-white
                       transition">

                Learn about our team

                <span>
                    →
                </span>

            </a>

        </div>



        <div
            class="rounded-[2rem]
                   bg-[#E5F0EB]
                   border border-[#D4E4DD]
                   p-8 sm:p-10">

            <p
                class="text-sm
                       uppercase
                       tracking-[0.25em]
                       text-[#4F806D]
                       font-semibold">

                Our Approach

            </p>


            <div class="mt-7 space-y-6">


                <div class="flex gap-4">

                    <div
                        class="shrink-0
                               w-10 h-10
                               rounded-xl
                               bg-white
                               flex items-center
                               justify-center
                               font-bold
                               text-[#4F806D]">

                        01

                    </div>

                    <div>

                        <h3
                            class="font-bold
                                   text-[#29483D]">

                            Learn

                        </h3>

                        <p
                            class="text-sm
                                   text-[#587067]
                                   mt-1">

                            Understand the technology
                            before building with it.

                        </p>

                    </div>

                </div>


                <div class="flex gap-4">

                    <div
                        class="shrink-0
                               w-10 h-10
                               rounded-xl
                               bg-white
                               flex items-center
                               justify-center
                               font-bold
                               text-[#4F806D]">

                        02

                    </div>

                    <div>

                        <h3
                            class="font-bold
                                   text-[#29483D]">

                            Build

                        </h3>

                        <p
                            class="text-sm
                                   text-[#587067]
                                   mt-1">

                            Turn what we learn into
                            working projects.

                        </p>

                    </div>

                </div>


                <div class="flex gap-4">

                    <div
                        class="shrink-0
                               w-10 h-10
                               rounded-xl
                               bg-white
                               flex items-center
                               justify-center
                               font-bold
                               text-[#4F806D]">

                        03

                    </div>

                    <div>

                        <h3
                            class="font-bold
                                   text-[#29483D]">

                            Improve

                        </h3>

                        <p
                            class="text-sm
                                   text-[#587067]
                                   mt-1">

                            Keep refining our skills
                            and our projects.

                        </p>

                    </div>

                </div>


            </div>

        </div>

    </section>



    {{-- =========================================================
       PROJECT CTA
    ========================================================== --}}

    <section
        class="relative
               overflow-hidden
               rounded-[2rem]
               bg-[#F1EDE3]
               border border-[#E4DDD0]
               p-8 sm:p-10 lg:p-12">


        <div
            class="relative
                   flex
                   flex-col
                   md:flex-row
                   md:items-center
                   md:justify-between
                   gap-7">


            <div>

                <p
                    class="text-sm
                           uppercase
                           tracking-[0.25em]
                           text-[#B58A5A]
                           font-semibold">

                    Explore Our Work

                </p>


                <h2
                    class="text-3xl
                           sm:text-4xl
                           font-black
                           text-[#29483D]
                           mt-2">

                    See what we've built.

                </h2>


                <p
                    class="mt-3
                           text-[#587067]
                           max-w-xl
                           leading-relaxed">

                    Explore our projects, experiments,
                    and practical solutions created
                    by the S.T.A Coding Team.

                </p>

            </div>


            <a
                href="/projects"
                class="shrink-0
                       inline-flex
                       items-center
                       justify-center
                       gap-2
                       px-7 py-3.5
                       rounded-full
                       bg-[#4F806D]
                       text-white
                       font-semibold
                       shadow-sm
                       hover:bg-[#3F6D5B]
                       hover:-translate-y-0.5
                       hover:shadow-md
                       transition-all
                       duration-300">

                View Projects

                <span class="text-lg">
                    →
                </span>

            </a>

        </div>

    </section>


</div>

@endsection