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
                       rounded-3xl border border-[#D9D3C7]
                       bg-white shadow-sm
                       transition duration-300
                       hover:-translate-y-1 hover:shadow-lg"
            >

                {{-- Card top --}}

                <div class="p-6">

                    <div class="flex items-start gap-4">

                        {{-- Avatar --}}

                        <a
                            href="{{ route('profile.show', $profile->username) }}"
                            class="shrink-0"
                        >

                            @if($profile->avatar)

                                <img
                                    src="{{ asset('storage/' . $profile->avatar) }}"
                                    alt="{{ $profile->username }}"
                                    class="h-16 w-16 rounded-2xl object-cover
                                           ring-2 ring-[#E8E3D8]"
                                >

                            @else

                                <div
                                    class="flex h-16 w-16 items-center justify-center
                                           rounded-2xl bg-[#B8CEC5]
                                           text-2xl font-bold text-[#29483D]
                                           ring-2 ring-[#E8E3D8]"
                                >
                                    {{ strtoupper(substr($profile->username, 0, 1)) }}
                                </div>

                            @endif

                        </a>


                        {{-- Identity --}}

                        <div class="min-w-0 flex-1">

                            <a
                                href="{{ route('profile.show', $profile->username) }}"
                                class="block truncate text-lg font-bold text-[#0F3F4A]
                                       transition hover:text-[#4F806D]"
                            >
                                {{ $profile->user->name }}
                            </a>

                            <p class="truncate text-sm text-[#4F806D]">
                                {{ '@' . $profile->username }}
                            </p>

                        </div>

                    </div>


                    {{-- Headline --}}

                    @if($profile->headline)

                        <p class="mt-5 text-sm font-semibold text-[#29483D]">
                            {{ $profile->headline }}
                        </p>

                    @endif


                    {{-- Bio --}}

                    @if($profile->bio)

                        <p class="mt-2 line-clamp-3 text-sm leading-6 text-[#7A8581]">
                            {{ $profile->bio }}
                        </p>

                    @else

                        <p class="mt-2 text-sm italic text-[#9A9F9B]">
                            No bio yet.
                        </p>

                    @endif


                    {{-- Skills --}}

                    @if(is_array($profile->skills) && count($profile->skills))

                        <div class="mt-5 flex flex-wrap gap-2">

                            @foreach(array_slice($profile->skills, 0, 5) as $skill)

                                <span
                                    class="rounded-full bg-[#E8E3D8] px-3 py-1
                                           text-xs font-medium text-[#29483D]"
                                >
                                    {{ $skill }}
                                </span>

                            @endforeach

                            @if(count($profile->skills) > 5)

                                <span
                                    class="rounded-full bg-[#F5F1E8] px-3 py-1
                                           text-xs font-medium text-[#7A8581]"
                                >
                                    +{{ count($profile->skills) - 5 }}
                                </span>

                            @endif

                        </div>

                    @endif


                    {{-- Followers --}}

                    <div class="mt-5 flex items-center gap-4 text-sm text-[#7A8581]">

                        <span class="flex items-center gap-1.5">
                            <i class="bi bi-people"></i>
                            {{ $profile->user->followers()->count() }}
                            {{ Str::plural('follower', $profile->user->followers()->count()) }}
                        </span>

                        <span class="flex items-center gap-1.5">
                            <i class="bi bi-folder2-open"></i>
                            {{ $profile->user->projects()->count() }}
                            {{ Str::plural('project', $profile->user->projects()->count()) }}
                        </span>

                    </div>

                </div>


                {{-- Card footer --}}

                <div class="mt-auto border-t border-[#E8E3D8] bg-[#FCFAF5] p-5">

                    <a
                        href="{{ route('profile.show', $profile->username) }}"
                        class="flex w-full items-center justify-center gap-2
                               rounded-2xl bg-[#4F806D] px-5 py-3
                               text-sm font-semibold text-white
                               transition hover:bg-[#3E735F]
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
        class="rounded-3xl border border-[#D9D3C7]
               bg-white px-6 py-16 text-center shadow-sm"
    >

        <div
            class="mx-auto flex h-16 w-16 items-center justify-center
                   rounded-2xl bg-[#E8E3D8] text-2xl text-[#4F806D]"
        >
            <i class="bi bi-person-x"></i>
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
                       rounded-2xl bg-[#4F806D] px-5 py-3
                       text-sm font-semibold text-white
                       transition hover:bg-[#3E735F]"
            >
                <i class="bi bi-arrow-counterclockwise"></i>
                Show All Developers
            </a>

        @endif

    </div>

@endif

</div>

@endsection
