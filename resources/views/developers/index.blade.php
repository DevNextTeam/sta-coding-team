@extends('layouts.app')

@section('title', 'Discover Developers — DevNext')

@section('content')

<div class="mx-auto w-full max-w-7xl">

{{-- =====================================================
PAGE HEADER
====================================================== --}}

<div class="mb-8">

    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#B87945]">
        DevNext Community
    </p>

    <h1 class="mt-2 text-3xl font-bold tracking-tight text-[#0F3F4A] sm:text-4xl">
        Discover Developers
    </h1>

    <p class="mt-2 max-w-2xl text-sm leading-6 text-[#29483D]/70 sm:text-base">
        Find developers, explore their projects, and connect with people
        who share your interests.
    </p>

</div>


{{-- =====================================================
SEARCH
====================================================== --}}

<form
    method="GET"
    action="{{ route('developers.index') }}"
    class="mb-8"
>

    <div class="relative max-w-3xl">

        <i
            class="bi bi-search pointer-events-none absolute left-5 top-1/2
                   -translate-y-1/2 text-lg text-[#7A8581]"
        ></i>

        <input
            type="text"
            name="search"
            value="{{ $search }}"
            placeholder="Search developers by username, headline, or bio..."
            class="w-full rounded-2xl border border-[#D9D3C7]
                   bg-white px-14 py-4 text-sm text-[#29483D]
                   shadow-sm outline-none transition
                   placeholder:text-[#9A9F9B]
                   focus:border-[#4F806D]
                   focus:ring-2 focus:ring-[#4F806D]/20"
        >

        @if($search)

            <a
                href="{{ route('developers.index') }}"
                class="absolute right-4 top-1/2 flex h-9 w-9
                       -translate-y-1/2 items-center justify-center
                       rounded-full text-[#7A8581]
                       transition hover:bg-[#E8E3D8]
                       hover:text-[#29483D]"
                aria-label="Clear search"
            >
                <i class="bi bi-x-lg"></i>
            </a>

        @endif

    </div>

</form>


{{-- =====================================================
RESULTS INFO
====================================================== --}}

<div class="mb-5 flex flex-wrap items-center justify-between gap-3">

    <div>

        @if($search)

            <p class="text-sm text-[#7A8581]">
                Search results for
                <span class="font-semibold text-[#29483D]">
                    "{{ $search }}"
                </span>
            </p>

        @else

            <p class="text-sm text-[#7A8581]">
                Developers in the DevNext community
            </p>

        @endif

    </div>

    <p class="text-sm text-[#7A8581]">
        {{ $profiles->total() }}
        {{ Str::plural('developer', $profiles->total()) }}
    </p>

</div>


{{-- =====================================================
DEVELOPER GRID
====================================================== --}}

@if($profiles->count())

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">

        @foreach($profiles as $profile)

            <article
                class="group flex h-full flex-col overflow-hidden
                       rounded-[1.5rem]
                       border border-[#E4DED2]
                       bg-white
                       shadow-[0_4px_20px_rgba(41,72,61,0.06)]
                       transition-all duration-300
                       hover:-translate-y-1
                       hover:border-[#C8D8D0]
                       hover:shadow-[0_12px_30px_rgba(41,72,61,0.12)]"
            >

                {{-- =================================================
                CARD CONTENT
                ================================================== --}}

                <div class="p-6 sm:p-7">

                    <div class="flex items-start gap-4">

                        {{-- =================================================
                        AVATAR
                        ================================================== --}}

                        <a
                            href="{{ route('profile.show', [
                                'username' => $profile->username,
                                'from' => 'developers',
                            ]) }}"
                            class="shrink-0"
                            aria-label="View {{ $profile->user->name }}'s profile"
                        >

                            @if($profile->avatar)

                                {{-- Uploaded Avatar --}}

                                <img
                                    src="{{ asset('storage/' . $profile->avatar) }}"
                                    alt="{{ $profile->username }}"
                                    class="h-16 w-16 rounded-2xl object-cover
                                           ring-1 ring-[#D9D3C7]
                                           shadow-sm
                                           transition duration-300
                                           group-hover:ring-[#B8CEC5]"
                                >

                            @else

                                {{-- Default Avatar --}}

                                <div
                                    class="flex h-16 w-16 items-center justify-center
                                           overflow-hidden rounded-2xl
                                           bg-[#E7EFEA]
                                           text-[#4F806D]
                                           ring-1 ring-[#D6E1DB]
                                           shadow-sm
                                           transition duration-300
                                           group-hover:bg-[#DDEAE3]
                                           group-hover:ring-[#B8CEC5]"
                                    aria-label="Default profile avatar"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        class="h-9 w-9"
                                        aria-hidden="true"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M12 2a5 5 0 1 0 0 10 5 5 0 0 0 0-10ZM4.5 20.25a7.5 7.5 0 0 1 15 0 .75.75 0 0 1-.75.75H5.25a.75.75 0 0 1-.75-.75Z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>

                                </div>

                            @endif

                        </a>


                        {{-- =================================================
                        IDENTITY
                        ================================================== --}}

                        <div class="min-w-0 flex-1">

                            <a
                                href="{{ route('profile.show', [
                                    'username' => $profile->username,
                                    'from' => 'developers',
                                ]) }}"
                                class="block truncate text-lg font-bold
                                       text-[#0F3F4A]
                                       transition
                                       hover:text-[#4F806D]"
                            >
                                {{ $profile->user->name }}
                            </a>

                            <p class="truncate text-sm text-[#4F806D]">
                                {{ '@' . $profile->username }}
                            </p>

                        </div>

                    </div>


                    {{-- =================================================
                    HEADLINE
                    ================================================== --}}

                    @if($profile->headline)

                        <p class="mt-5 text-sm font-semibold text-[#29483D]">
                            {{ $profile->headline }}
                        </p>

                    @endif


                    {{-- =================================================
                    BIO
                    ================================================== --}}

                    @if($profile->bio)

                        <p class="mt-2 line-clamp-3 text-sm leading-6 text-[#7A8581]">
                            {{ $profile->bio }}
                        </p>

                    @else

                        <p class="mt-2 text-sm italic text-[#9A9F9B]">
                            No bio yet.
                        </p>

                    @endif


                    {{-- =================================================
                    SKILLS
                    ================================================== --}}

                    @if(is_array($profile->skills) && count($profile->skills))

                        <div class="mt-5 flex flex-wrap gap-2">

                            @foreach(array_slice($profile->skills, 0, 5) as $skill)

                                <span
                                    class="rounded-full
                                           border border-[#DDE5E0]
                                           bg-[#F1F5F2]
                                           px-3 py-1
                                           text-xs font-medium
                                           text-[#29483D]"
                                >
                                    {{ $skill }}
                                </span>

                            @endforeach

                            @if(count($profile->skills) > 5)

                                <span
                                    class="rounded-full
                                           border border-[#E8E3D8]
                                           bg-[#F5F1E8]
                                           px-3 py-1
                                           text-xs font-medium
                                           text-[#7A8581]"
                                >
                                    +{{ count($profile->skills) - 5 }}
                                </span>

                            @endif

                        </div>

                    @endif


                    {{-- =================================================
                    FOLLOWERS / PROJECTS
                    ================================================== --}}

                    <div
                        class="mt-5 flex flex-wrap items-center gap-x-5 gap-y-2
                               text-sm text-[#7A8581]"
                    >

                        <span class="flex items-center gap-1.5">

                            <i class="bi bi-people"></i>

                            {{ $profile->user->followers()->count() }}

                            {{ Str::plural(
                                'follower',
                                $profile->user->followers()->count()
                            ) }}

                        </span>


                        <span class="flex items-center gap-1.5">

                            <i class="bi bi-folder2-open"></i>

                            {{ $profile->user->projects()->count() }}

                            {{ Str::plural(
                                'project',
                                $profile->user->projects()->count()
                            ) }}

                        </span>

                    </div>

                </div>


                {{-- =================================================
                CARD FOOTER
                ================================================== --}}

                <div
                    class="mt-auto border-t border-[#E8E3D8]
                           bg-[#FCFAF5] p-5"
                >

                    <a
                        href="{{ route('profile.show', [
                            'username' => $profile->username,
                            'from' => 'developers',
                        ]) }}"
                        class="flex w-full items-center justify-center gap-2
                               rounded-2xl
                               bg-[#4F806D]
                               px-5 py-3
                               text-sm font-semibold text-white
                               shadow-sm
                               transition-all duration-200
                               hover:bg-[#3E735F]
                               hover:shadow-md
                               active:scale-[0.98]"
                    >

                        <i class="bi bi-person"></i>

                        View Profile

                    </a>

                </div>

            </article>

        @endforeach

    </div>


    {{-- =================================================
    PAGINATION
    ================================================== --}}

    @if($profiles->hasPages())

        <div class="mt-10">

            {{ $profiles->links() }}

        </div>

    @endif

@else

    {{-- =================================================
    EMPTY STATE
    ================================================== --}}

    <div
        class="rounded-3xl
               border border-[#D9D3C7]
               bg-white
               px-6 py-16
               text-center
               shadow-sm"
    >

        <div
            class="mx-auto flex h-16 w-16 items-center justify-center
                   rounded-2xl
                   bg-[#E7EFEA]
                   text-[#4F806D]
                   ring-1 ring-[#D6E1DB]"
        >

            <i class="bi bi-person-x text-2xl"></i>

        </div>


        <h2 class="mt-5 text-xl font-bold text-[#0F3F4A]">
            No developers found
        </h2>


        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-[#7A8581]">
            We couldn't find any developers matching your search.
            Try a different name, username, or keyword.
        </p>


        @if($search)

            <a
                href="{{ route('developers.index') }}"
                class="mt-6 inline-flex items-center gap-2
                       rounded-2xl
                       bg-[#4F806D]
                       px-5 py-3
                       text-sm font-semibold text-white
                       shadow-sm
                       transition
                       hover:bg-[#3E735F]
                       hover:shadow-md"
            >

                <i class="bi bi-arrow-counterclockwise"></i>

                Show All Developers

            </a>

        @endif

    </div>

@endif

</div>

@endsection