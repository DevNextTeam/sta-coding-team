@extends('layouts.app')

@section('content')

<div class="w-full max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-8 sm:py-12 lg:py-16">

    {{-- =========================================================
       HEADER
    ========================================================== --}}

    <div class="text-center mb-8 sm:mb-10">

        <p
            class="text-xs sm:text-sm
                   tracking-[0.3em] sm:tracking-[0.4em]
                   text-[#C47A45]
                   uppercase"
        >
            Our Work
        </p>

        <h1
            class="text-3xl sm:text-4xl
                   font-bold
                   text-[#003B4A]
                   mt-2"
        >
            Projects
        </h1>

        <p
            class="text-sm sm:text-base
                   text-[#245A73]
                   mt-3
                   max-w-2xl
                   mx-auto
                   leading-relaxed
                   px-2"
        >
            Explore the projects and applications created by the
            S.T.A Coding Team.
        </p>

    </div>


    {{-- =========================================================
       SEARCH
    ========================================================== --}}

    <div class="max-w-3xl mx-auto mb-10 sm:mb-12">

        <form
            action="{{ route('projects.index') }}"
            method="GET"
            class="flex flex-col sm:flex-row gap-3"
        >

            <div class="relative flex-1">

                <span
                    class="absolute
                           left-4
                           top-1/2
                           -translate-y-1/2
                           text-[#6B7773]"
                >
                    🔎
                </span>

                <input
                    type="search"
                    name="search"
                    value="{{ $search ?? '' }}"
                    placeholder="Search projects, technologies, or categories..."
                    class="w-full
                           pl-11 pr-4
                           py-3.5
                           rounded-xl
                           border border-[#D8E2DD]
                           bg-white
                           text-[#003B4A]
                           placeholder-[#8A9692]
                           outline-none
                           focus:border-[#518A77]
                           focus:ring-2
                           focus:ring-[#518A77]/20
                           transition"
                >

            </div>


            <button
                type="submit"
                class="w-full sm:w-auto
                       inline-flex
                       items-center
                       justify-center
                       px-6 py-3.5
                       rounded-xl
                       bg-[#518A77]
                       text-white
                       font-semibold
                       hover:bg-[#407260]
                       hover:-translate-y-0.5
                       hover:shadow-md
                       transition-all
                       duration-300"
            >
                Search
            </button>

        </form>


        {{-- Search Result Message --}}
        @if(!empty($search))

            <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                <p class="text-sm text-[#245A73]">

                    Search results for:

                    <span class="font-semibold text-[#003B4A]">
                        "{{ $search }}"
                    </span>

                </p>


                <a
                    href="{{ route('projects.index') }}"
                    class="text-sm
                           font-semibold
                           text-[#C47A45]
                           hover:text-[#A85D2F]
                           transition"
                >
                    Clear Search
                </a>

            </div>

        @endif

    </div>


    {{-- =========================================================
       PROJECTS
    ========================================================== --}}

    @if ($projects->count())

        <div
            class="grid
                   grid-cols-1
                   sm:grid-cols-2
                   lg:grid-cols-3
                   gap-5 sm:gap-6 lg:gap-8"
        >

            @foreach ($projects as $project)

                <div
                    class="group
                           bg-white
                           rounded-[1.5rem] sm:rounded-2xl
                           border border-[#D8E2DD]
                           shadow-sm
                           overflow-hidden
                           hover:shadow-lg
                           hover:-translate-y-1
                           transition-all
                           duration-300"
                >

                    {{-- =================================================
                       IMAGE
                    ================================================== --}}

                    @if ($project->image)

                        <div class="overflow-hidden">

                            <img
                                src="{{ asset('storage/' . $project->image) }}"
                                alt="{{ $project->title }}"
                                class="w-full
                                       h-48 sm:h-52
                                       object-cover
                                       group-hover:scale-[1.03]
                                       transition-transform
                                       duration-500"
                            >

                        </div>

                    @else

                        <div
                            class="w-full
                                   h-48 sm:h-52
                                   bg-[#E4F0EC]
                                   flex
                                   items-center
                                   justify-center"
                        >

                            <span
                                class="text-sm
                                       text-[#4F806D]"
                            >
                                No Image
                            </span>

                        </div>

                    @endif


                    {{-- =================================================
                       CONTENT
                    ================================================== --}}

                    <div class="p-5 sm:p-6">

                        {{-- Category --}}

                        @if ($project->category)

                            <p
                                class="text-[11px] sm:text-xs
                                       tracking-[0.18em] sm:tracking-widest
                                       uppercase
                                       text-[#C47A45]
                                       mb-2"
                            >
                                {{ $project->category }}
                            </p>

                        @endif


                        {{-- Title --}}

                        <h2
                            class="text-lg sm:text-xl
                                   font-bold
                                   text-[#003B4A]
                                   leading-snug"
                        >
                            {{ $project->title }}
                        </h2>


                        {{-- Description --}}

                        <p
                            class="text-sm sm:text-base
                                   text-[#245A73]
                                   mt-3
                                   line-clamp-3
                                   leading-relaxed"
                        >
                            {{ $project->description }}
                        </p>


                        {{-- =================================================
                           PREMIUM / FREE
                        ================================================== --}}

                        <div class="mt-4">

                            @if ($project->is_premium)

                                <span
                                    class="inline-flex
                                           items-center
                                           gap-1
                                           px-3 py-1
                                           rounded-full
                                           text-xs
                                           bg-[#F5E6D8]
                                           text-[#A85D2F]"
                                >
                                    🔒 Premium
                                </span>

                            @else

                                <span
                                    class="inline-flex
                                           items-center
                                           px-3 py-1
                                           rounded-full
                                           text-xs
                                           bg-[#DCEDE7]
                                           text-[#397B67]"
                                >
                                    ✓ Free Project
                                </span>

                            @endif

                        </div>


                        {{-- =================================================
                           BUTTON
                        ================================================== --}}

                        <a
                            href="{{ route('projects.show', $project) }}"
                            class="w-full sm:w-auto
                                   inline-flex
                                   items-center
                                   justify-center
                                   mt-5
                                   bg-[#518A77]
                                   text-white
                                   px-5 py-2.5
                                   rounded-xl
                                   font-medium
                                   text-sm sm:text-base
                                   hover:bg-[#407260]
                                   hover:-translate-y-0.5
                                   hover:shadow-md
                                   transition-all
                                   duration-300"
                        >
                            View Project

                            <span class="ml-1">
                                →
                            </span>

                        </a>

                    </div>

                </div>

            @endforeach

        </div>


    {{-- =========================================================
       EMPTY STATE
    ========================================================== --}}

    @else

        <div
            class="bg-white
                   rounded-[1.5rem] sm:rounded-2xl
                   border border-[#D8E2DD]
                   p-8 sm:p-12
                   text-center"
        >

            @if(!empty($search))

                <div
                    class="w-16 h-16
                           mx-auto
                           rounded-full
                           bg-[#E4F0EC]
                           flex
                           items-center
                           justify-center"
                >
                    <span class="text-2xl">
                        🔎
                    </span>
                </div>

                <h2
                    class="text-xl sm:text-2xl
                           font-bold
                           text-[#003B4A]
                           mt-5"
                >
                    No projects found
                </h2>

                <p
                    class="text-sm sm:text-base
                           text-[#245A73]
                           mt-2
                           max-w-lg
                           mx-auto"
                >
                    We couldn't find any projects matching
                    "{{ $search }}".
                </p>

                <a
                    href="{{ route('projects.index') }}"
                    class="inline-flex
                           items-center
                           justify-center
                           mt-5
                           px-5 py-2.5
                           rounded-xl
                           bg-[#518A77]
                           text-white
                           font-medium
                           hover:bg-[#407260]
                           transition"
                >
                    View All Projects
                </a>

            @else

                <h2
                    class="text-xl sm:text-2xl
                           font-bold
                           text-[#003B4A]"
                >
                    No projects yet
                </h2>

                <p
                    class="text-sm sm:text-base
                           text-[#245A73]
                           mt-2"
                >
                    Our projects will appear here soon.
                </p>

            @endif

        </div>

    @endif

</div>

@endsection