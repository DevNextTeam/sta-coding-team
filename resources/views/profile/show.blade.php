@extends('layouts.app')

@section('title', $profile->username . ' — DevNext')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Back --}}
    <div class="mb-6">
        <a
            href="{{ route('projects.index') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-[#4F806D] hover:text-[#3E735F] transition"
        >
            ← Back to Projects
        </a>
    </div>


    {{-- Profile Header --}}
    <div class="bg-white rounded-3xl border border-[#D8DED9] shadow-sm overflow-hidden">

        {{-- Cover --}}
        <div class="h-32 sm:h-44 bg-gradient-to-r from-[#29483D] via-[#4F806D] to-[#B8CEC5]">
        </div>


        {{-- Profile Information --}}
        <div class="px-5 sm:px-8 pb-8">

            <div class="flex flex-col sm:flex-row sm:items-end gap-5">

                {{-- Avatar --}}
                <div class="-mt-14 sm:-mt-16">

                    <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-full overflow-hidden bg-[#E8EEE9] border-4 border-white shadow-lg flex items-center justify-center">

                        @if($profile->avatar)

                            <img
                                src="{{ asset('storage/' . $profile->avatar) }}"
                                alt="{{ $profile->username }} profile picture"
                                class="w-full h-full object-cover"
                            >

                        @else

                            <span class="text-4xl sm:text-5xl font-bold text-[#4F806D]">
                                {{ strtoupper(substr($profile->username, 0, 1)) }}
                            </span>

                        @endif

                    </div>

                </div>


                {{-- Name / Username --}}
                <div class="flex-1 pt-1 sm:pt-0">

                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">

                        <h1 class="text-2xl sm:text-3xl font-bold text-[#0F3F4A]">
                            {{ $profile->username }}
                        </h1>

                        <span class="inline-flex w-fit items-center px-3 py-1 rounded-full bg-[#E8EEE9] text-[#4F806D] text-xs font-semibold">
                            Developer
                        </span>

                    </div>

                    @if($profile->headline)

                        <p class="mt-1 text-[#5D6B68] text-base sm:text-lg">
                            {{ $profile->headline }}
                        </p>

                    @endif

                </div>


                {{-- Edit Button --}}
                @auth

                    @if(auth()->id() === $profile->user_id)

                        <div class="sm:pb-1">

                            <a
                                href="{{ route('profile.edit') }}"
                                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-[#4F806D] text-white font-semibold hover:bg-[#3E735F] transition shadow-sm"
                            >
                                Edit Profile
                            </a>

                        </div>

                    @endif

                @endauth

            </div>


            {{-- Bio --}}
            @if($profile->bio)

                <div class="mt-7 max-w-3xl">

                    <h2 class="text-sm font-bold uppercase tracking-wide text-[#4F806D] mb-2">
                        About
                    </h2>

                    <p class="text-[#5D6B68] leading-7 whitespace-pre-line">
                        {{ $profile->bio }}
                    </p>

                </div>

            @endif


            {{-- Skills --}}
            @if(is_array($profile->skills) && count($profile->skills))

                <div class="mt-7">

                    <h2 class="text-sm font-bold uppercase tracking-wide text-[#4F806D] mb-3">
                        Skills
                    </h2>

                    <div class="flex flex-wrap gap-2">

                        @foreach($profile->skills as $skill)

                            <span class="px-3 py-1.5 rounded-lg bg-[#F5F1E8] border border-[#D8DED9] text-sm font-medium text-[#29483D]">
                                {{ $skill }}
                            </span>

                        @endforeach

                    </div>

                </div>

            @endif


            {{-- Links --}}
            @if($profile->github_url || $profile->website_url)

                <div class="mt-7 flex flex-wrap gap-3">

                    @if($profile->github_url)

                        <a
                            href="{{ $profile->github_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-[#D8DED9] bg-white text-[#29483D] font-semibold hover:bg-[#F5F1E8] transition"
                        >
                            GitHub ↗
                        </a>

                    @endif


                    @if($profile->website_url)

                        <a
                            href="{{ $profile->website_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-[#D8DED9] bg-white text-[#29483D] font-semibold hover:bg-[#F5F1E8] transition"
                        >
                            Personal Website ↗
                        </a>

                    @endif

                </div>

            @endif

        </div>

    </div>


    {{-- Projects --}}
    <div class="mt-8">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-5">

            <div>

                <p class="text-sm font-semibold text-[#4F806D]">
                    Developer Portfolio
                </p>

                <h2 class="text-2xl sm:text-3xl font-bold text-[#0F3F4A]">
                    Published Projects
                </h2>

                <p class="mt-1 text-[#6B7773]">
                    Projects published by {{ $profile->username }}.
                </p>

            </div>

        </div>


        @if($profile->user->projects->count())

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($profile->user->projects as $project)

                    <article class="bg-white rounded-2xl border border-[#D8DED9] shadow-sm overflow-hidden hover:shadow-md transition">

                        {{-- Project Image --}}
                        @if($project->image)

                            <a href="{{ route('projects.show', $project) }}">

                                <img
                                    src="{{ asset('storage/' . $project->image) }}"
                                    alt="{{ $project->title }}"
                                    class="w-full h-48 object-cover"
                                >

                            </a>

                        @else

                            <a
                                href="{{ route('projects.show', $project) }}"
                                class="h-48 bg-[#E8EEE9] flex items-center justify-center"
                            >
                                <span class="text-4xl font-bold text-[#4F806D]">
                                    {{ strtoupper(substr($project->title, 0, 1)) }}
                                </span>
                            </a>

                        @endif


                        {{-- Project Content --}}
                        <div class="p-5">

                            <div class="flex items-center justify-between gap-3">

                                @if($project->category)

                                    <span class="text-xs font-semibold text-[#4F806D] uppercase tracking-wide">
                                        {{ $project->category }}
                                    </span>

                                @endif

                                @if($project->is_premium)

                                    <span class="px-2.5 py-1 rounded-full bg-[#FFF1E5] text-[#A45F2C] text-xs font-semibold">
                                        Premium
                                    </span>

                                @else

                                    <span class="px-2.5 py-1 rounded-full bg-[#E8EEE9] text-[#4F806D] text-xs font-semibold">
                                        Free
                                    </span>

                                @endif

                            </div>


                            <h3 class="mt-3 text-xl font-bold text-[#0F3F4A]">

                                <a
                                    href="{{ route('projects.show', $project) }}"
                                    class="hover:text-[#4F806D] transition"
                                >
                                    {{ $project->title }}
                                </a>

                            </h3>


                            <p class="mt-2 text-sm text-[#6B7773] leading-6 line-clamp-3">
                                {{ $project->description }}
                            </p>


                            <div class="mt-5">

                                <a
                                    href="{{ route('projects.show', $project) }}"
                                    class="inline-flex items-center gap-2 text-sm font-semibold text-[#4F806D] hover:text-[#3E735F] transition"
                                >
                                    View Project →
                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            <div class="bg-white rounded-2xl border border-[#D8DED9] p-8 text-center">

                <div class="w-14 h-14 mx-auto rounded-full bg-[#E8EEE9] flex items-center justify-center">

                    <span class="text-2xl">
                        💻
                    </span>

                </div>

                <h3 class="mt-4 text-lg font-bold text-[#0F3F4A]">
                    No published projects yet
                </h3>

                <p class="mt-2 text-sm text-[#6B7773]">
                    {{ $profile->username }} hasn't published any projects yet.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection