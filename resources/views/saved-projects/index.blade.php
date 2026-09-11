@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#F5F1E8] py-12 px-6">

    <div class="max-w-6xl mx-auto">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <div class="mb-10">

            <p
                class="text-sm
                       uppercase
                       tracking-[0.3em]
                       text-[#B87945]"
            >
                YOUR COLLECTION
            </p>

            <h1
                class="text-4xl
                       md:text-5xl
                       font-bold
                       text-[#0F3F4A]
                       mt-2"
            >
                Saved Projects
            </h1>

            <p
                class="text-[#315F6D]
                       mt-3
                       max-w-2xl"
            >
                Projects you've saved for later. Come back anytime
                to explore them again.
            </p>

        </div>


        {{-- ===================================================== --}}
        {{-- EMPTY STATE --}}
        {{-- ===================================================== --}}

        @if($projects->isEmpty())

            <div
                class="bg-white
                       rounded-3xl
                       border border-[#D5DDD8]
                       shadow-sm
                       p-10
                       md:p-14
                       text-center"
            >

                <div
                    class="w-20
                           h-20
                           mx-auto
                           rounded-3xl
                           bg-[#E8E3D8]
                           flex
                           items-center
                           justify-center
                           text-4xl"
                >
                    🔖
                </div>

                <h2
                    class="text-2xl
                           font-bold
                           text-[#0F3F4A]
                           mt-6"
                >
                    No saved projects yet
                </h2>

                <p
                    class="text-[#315F6D]
                           mt-3
                           max-w-md
                           mx-auto
                           leading-7"
                >
                    When you find a project you want to come back to,
                    click the Save button and it will appear here.
                </p>

                <a
                    href="{{ route('projects.index') }}"
                    class="inline-flex
                           items-center
                           justify-center
                           mt-6
                           px-6
                           py-3
                           rounded-xl
                           bg-[#4F806D]
                           text-white
                           font-semibold
                           hover:bg-[#3E735F]
                           transition"
                >
                    Browse Projects
                </a>

            </div>


        {{-- ===================================================== --}}
        {{-- PROJECT GRID --}}
        {{-- ===================================================== --}}

        @else

            <div
                class="grid
                       grid-cols-1
                       sm:grid-cols-2
                       lg:grid-cols-3
                       gap-6"
            >

                @foreach($projects as $project)

                    <article
                        class="group
                               bg-white
                               rounded-2xl
                               overflow-hidden
                               border border-[#D5DDD8]
                               shadow-sm
                               hover:shadow-md
                               hover:-translate-y-1
                               transition-all
                               duration-200"
                    >

                        {{-- ================================================= --}}
                        {{-- PROJECT IMAGE --}}
                        {{-- ================================================= --}}

                        @if($project->image)

                            <a
                                href="{{ route(
                                    'projects.show',
                                    $project->slug
                                ) }}"
                            >

                                <img
                                    src="{{ asset(
                                        'storage/' . $project->image
                                    ) }}"
                                    alt="{{ $project->title }}"
                                    class="w-full
                                           h-48
                                           object-cover
                                           group-hover:scale-[1.02]
                                           transition
                                           duration-300"
                                >

                            </a>

                        @else

                            <a
                                href="{{ route(
                                    'projects.show',
                                    $project->slug
                                ) }}"
                                class="block"
                            >

                                <div
                                    class="w-full
                                           h-48
                                           bg-[#DCEAE4]
                                           flex
                                           items-center
                                           justify-center"
                                >

                                    <span
                                        class="text-5xl
                                               text-[#4F806D]"
                                    >
                                        💻
                                    </span>

                                </div>

                            </a>

                        @endif


                        {{-- ================================================= --}}
                        {{-- PROJECT CONTENT --}}
                        {{-- ================================================= --}}

                        <div class="p-6">

                            {{-- CATEGORY --}}

                            @if($project->category)

                                <p
                                    class="text-xs
                                           uppercase
                                           tracking-[0.2em]
                                           text-[#B87945]"
                                >
                                    {{ $project->category }}
                                </p>

                            @endif


                            {{-- TITLE --}}

                            <h2
                                class="text-xl
                                       font-bold
                                       text-[#0F3F4A]
                                       mt-2
                                       line-clamp-2"
                            >
                                {{ $project->title }}
                            </h2>


                            {{-- CREATOR --}}

                            @if($project->user && $project->user->profile)

                                <a
                                    href="{{ route(
                                        'profile.show',
                                        $project->user->profile->username
                                    ) }}"
                                    class="inline-flex
                                           items-center
                                           gap-2
                                           mt-4
                                           group/creator"
                                >

                                    @if($project->user->profile->avatar)

                                        <img
                                            src="{{ asset(
                                                'storage/' .
                                                $project->user->profile->avatar
                                            ) }}"
                                            alt="{{ $project->user->profile->username }}"
                                            class="w-8
                                                   h-8
                                                   rounded-full
                                                   object-cover
                                                   border border-[#D5DDD8]"
                                        >

                                    @else

                                        <div
                                            class="w-8
                                                   h-8
                                                   rounded-full
                                                   bg-[#DCEAE4]
                                                   text-[#3E735F]
                                                   flex
                                                   items-center
                                                   justify-center
                                                   text-sm
                                                   font-bold"
                                        >
                                            {{ strtoupper(
                                                substr(
                                                    $project->user->profile->username,
                                                    0,
                                                    1
                                                )
                                            ) }}
                                        </div>

                                    @endif

                                    <div>

                                        <p
                                            class="text-[11px]
                                                   text-gray-500"
                                        >
                                            Created by
                                        </p>

                                        <p
                                            class="text-sm
                                                   font-semibold
                                                   text-[#0F3F4A]
                                                   group-hover/creator:text-[#4F806D]
                                                   transition"
                                        >
                                            {{ $project->user->profile->username }}
                                        </p>

                                    </div>

                                </a>

                            @else

                                <div
                                    class="inline-flex
                                           items-center
                                           gap-2
                                           mt-4"
                                >

                                    <div
                                        class="w-8
                                               h-8
                                               rounded-full
                                               bg-[#DCEAE4]
                                               text-[#3E735F]
                                               flex
                                               items-center
                                               justify-center
                                               text-sm
                                               font-bold"
                                    >
                                        D
                                    </div>

                                    <div>

                                        <p
                                            class="text-[11px]
                                                   text-gray-500"
                                        >
                                            Created by
                                        </p>

                                        <p
                                            class="text-sm
                                                   font-semibold
                                                   text-[#0F3F4A]"
                                        >
                                            DevNext Team
                                        </p>

                                    </div>

                                </div>

                            @endif


                            {{-- PREMIUM / FREE --}}

                            <div class="mt-4">

                                @if($project->is_premium)

                                    <span
                                        class="inline-flex
                                               items-center
                                               gap-1
                                               px-3
                                               py-1
                                               rounded-full
                                               text-xs
                                               font-semibold
                                               bg-[#F1E3D4]
                                               text-[#A45F2C]"
                                    >
                                        🔒 Premium
                                    </span>

                                @else

                                    <span
                                        class="inline-flex
                                               items-center
                                               gap-1
                                               px-3
                                               py-1
                                               rounded-full
                                               text-xs
                                               font-semibold
                                               bg-[#DCEAE4]
                                               text-[#3E735F]"
                                    >
                                        ✓ Free
                                    </span>

                                @endif

                            </div>


                            {{-- DESCRIPTION --}}

                            <p
                                class="mt-4
                                       text-sm
                                       text-[#315F6D]
                                       leading-6
                                       line-clamp-3"
                            >
                                {{ $project->description }}
                            </p>


                            {{-- VIEW PROJECT --}}

                            <a
                                href="{{ route(
                                    'projects.show',
                                    $project->slug
                                ) }}"
                                class="inline-flex
                                       items-center
                                       justify-center
                                       w-full
                                       mt-6
                                       px-5
                                       py-3
                                       rounded-xl
                                       bg-[#0F3F4A]
                                       text-white
                                       font-semibold
                                       hover:opacity-90
                                       transition"
                            >
                                View Project
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>

        @endif

    </div>

</div>

@endsection