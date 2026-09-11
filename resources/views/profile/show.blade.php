@extends('layouts.app')

@section('title', $profile->username . ' — DevNext')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

{{-- =========================================================
BACK TO PROJECTS
========================================================== --}}

<div class="mb-6">

    <a
        href="{{ route('projects.index') }}"
        class="inline-flex items-center gap-2 text-sm font-semibold text-[#4F806D] hover:text-[#3E735F] transition"
    >
        ← Back to Projects
    </a>

</div>


{{-- =========================================================
PROFILE HEADER
========================================================== --}}

<div class="bg-white rounded-3xl border border-[#D8DED9] shadow-sm overflow-hidden">


    {{-- =====================================================
    COVER
    ====================================================== --}}

    <div class="h-32 sm:h-44 bg-gradient-to-r from-[#29483D] via-[#4F806D] to-[#B8CEC5]">
    </div>


    {{-- =====================================================
    PROFILE INFORMATION
    ====================================================== --}}

    <div class="px-5 sm:px-8 pb-8">

        <div class="flex flex-col sm:flex-row sm:items-end gap-5">


            {{-- =================================================
            AVATAR
            ================================================== --}}

            <div class="-mt-14 sm:-mt-16">

                <div
                    class="w-28 h-28 sm:w-32 sm:h-32 rounded-full overflow-hidden
                           bg-[#E8EEE9]
                           border-4 border-white
                           shadow-lg
                           flex items-center justify-center"
                >

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


            {{-- =================================================
            NAME / USERNAME
            ================================================== --}}

            <div class="flex-1 pt-1 sm:pt-0">

                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">

                    {{-- Real Name --}}
                    <h1 class="text-2xl sm:text-3xl font-bold text-[#0F3F4A]">
                        {{ $profile->user->name }}
                    </h1>


                    {{-- User Badge --}}
                    <span
                        class="inline-flex w-fit items-center
                               px-3 py-1
                               rounded-full
                               bg-[#E8EEE9]
                               text-[#4F806D]
                               text-xs font-semibold"
                    >
                        User
                    </span>

                </div>


                {{-- Username --}}
                <p class="mt-1 text-[#6B7773] text-sm sm:text-base">
                    {{ '@' . $profile->username }}
                </p>


                {{-- Headline --}}
                @if($profile->headline)

                    <p class="mt-2 text-[#5D6B68] text-base sm:text-lg">
                        {{ $profile->headline }}
                    </p>

                @endif

            </div>


            {{-- =================================================
            PROFILE ACTION
            ================================================== --}}

            <div class="sm:pb-1">

                @auth

                    {{-- Owner --}}
                    @if(auth()->id() === $profile->user_id)

                        <a
                            href="{{ route('profile.edit') }}"
                            class="inline-flex items-center justify-center gap-2
                                   px-5 py-3
                                   rounded-xl
                                   bg-[#4F806D]
                                   text-white
                                   font-semibold
                                   hover:bg-[#3E735F]
                                   transition
                                   shadow-sm"
                        >
                            Edit Profile
                        </a>

                    {{-- Other User --}}
                    @else

                        @php
                            $isFollowing = auth()->user()
                                ->following()
                                ->where('users.id', $profile->user_id)
                                ->exists();
                        @endphp

                        <button
                            id="followButton"
                            type="button"
                            data-follow-url="{{ route('users.follow', $profile->user) }}"
                            data-unfollow-url="{{ route('users.unfollow', $profile->user) }}"
                            data-following="{{ $isFollowing ? 'true' : 'false' }}"
                            class="inline-flex items-center justify-center gap-2
                                   min-w-28
                                   px-5 py-3
                                   rounded-xl
                                   font-semibold
                                   transition
                                   shadow-sm
                                   {{ $isFollowing
                                        ? 'bg-[#E8EEE9] text-[#29483D] border border-[#D8DED9] hover:bg-[#DDE7E1]'
                                        : 'bg-[#4F806D] text-white hover:bg-[#3E735F]' }}"
                        >
                            <span id="followButtonText">
                                {{ $isFollowing ? 'Following' : 'Follow' }}
                            </span>
                        </button>

                    @endif

                @endauth

            </div>

        </div>


        {{-- =====================================================
        PROFILE STATS
        ====================================================== --}}

        <div class="mt-7 flex flex-wrap gap-6">

            {{-- Projects --}}
            <div>

                <p class="text-xl font-bold text-[#0F3F4A]">
                    {{ $profile->user->projects->count() }}
                </p>

                <p class="text-xs uppercase tracking-wide text-[#7A8581]">
                    Projects
                </p>

            </div>


            {{-- Followers --}}
            <a
                href="{{ route('profile.followers', $profile->username) }}"
                class="group"
            >

                <p
                    id="followersCount"
                    class="text-xl font-bold text-[#0F3F4A] group-hover:text-[#4F806D] transition"
                >
                    {{ $profile->user->followers()->count() }}
                </p>

                <p class="text-xs uppercase tracking-wide text-[#7A8581] group-hover:text-[#4F806D] transition">
                    Followers
                </p>

            </a>


            {{-- Following --}}
            <a
                href="{{ route('profile.following', $profile->username) }}"
                class="group"
            >

                <p class="text-xl font-bold text-[#0F3F4A] group-hover:text-[#4F806D] transition">
                    {{ $profile->user->following()->count() }}
                </p>

                <p class="text-xs uppercase tracking-wide text-[#7A8581] group-hover:text-[#4F806D] transition">
                    Following
                </p>

            </a>


            {{-- Skills --}}
            @if(is_array($profile->skills) && count($profile->skills))

                <div>

                    <p class="text-xl font-bold text-[#0F3F4A]">
                        {{ count($profile->skills) }}
                    </p>

                    <p class="text-xs uppercase tracking-wide text-[#7A8581]">
                        Skills
                    </p>

                </div>

            @endif

        </div>



        {{-- =====================================================
        BIO
        ====================================================== --}}

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


        {{-- =====================================================
        SKILLS
        ====================================================== --}}

        @if(is_array($profile->skills) && count($profile->skills))

            <div class="mt-7">

                <h2 class="text-sm font-bold uppercase tracking-wide text-[#4F806D] mb-3">
                    Skills
                </h2>

                <div class="flex flex-wrap gap-2">

                    @foreach($profile->skills as $skill)

                        <span
                            class="px-3 py-1.5
                                   rounded-lg
                                   bg-[#F5F1E8]
                                   border border-[#D8DED9]
                                   text-sm
                                   font-medium
                                   text-[#29483D]"
                        >
                            {{ $skill }}
                        </span>

                    @endforeach

                </div>

            </div>

        @endif


        {{-- =====================================================
        SOCIAL LINKS
        ====================================================== --}}

        @if($profile->github_url || $profile->website_url)

            <div class="mt-7 flex flex-wrap gap-3">

                @if($profile->github_url)

                    <a
                        href="{{ $profile->github_url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2
                               px-4 py-2.5
                               rounded-xl
                               border border-[#D8DED9]
                               bg-white
                               text-[#29483D]
                               font-semibold
                               hover:bg-[#F5F1E8]
                               transition"
                    >
                        GitHub ↗
                    </a>

                @endif


                @if($profile->website_url)

                    <a
                        href="{{ $profile->website_url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2
                               px-4 py-2.5
                               rounded-xl
                               border border-[#D8DED9]
                               bg-white
                               text-[#29483D]
                               font-semibold
                               hover:bg-[#F5F1E8]
                               transition"
                    >
                        Personal Website ↗
                    </a>

                @endif

            </div>

        @endif

    </div>

</div>


{{-- =========================================================
PUBLISHED PROJECTS
========================================================== --}}

<div class="mt-8">


    {{-- =====================================================
    SECTION HEADER
    ====================================================== --}}

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


        {{-- Project Count --}}
        @if($profile->user->projects->count())

            <div class="text-sm text-[#6B7773]">
                {{ $profile->user->projects->count() }}
                {{ $profile->user->projects->count() === 1 ? 'project' : 'projects' }}
            </div>

        @endif

    </div>


    {{-- =====================================================
    PROJECT GRID
    ====================================================== --}}

    @if($profile->user->projects->count())

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($profile->user->projects as $project)

                <article
                    class="group
                           bg-white
                           rounded-2xl
                           border border-[#D8DED9]
                           shadow-sm
                           overflow-hidden
                           hover:shadow-lg
                           hover:-translate-y-1
                           transition-all duration-200"
                >


                    {{-- =================================================
                    PROJECT IMAGE
                    ================================================== --}}

                    <a
                        href="{{ route('projects.show', $project) }}"
                        class="block"
                    >

                        @if($project->image)

                            <img
                                src="{{ asset('storage/' . $project->image) }}"
                                alt="{{ $project->title }}"
                                class="w-full h-48 object-cover
                                       group-hover:scale-[1.02]
                                       transition-transform duration-300"
                            >

                        @else

                            <div
                                class="h-48
                                       bg-[#E8EEE9]
                                       flex items-center justify-center"
                            >

                                <span class="text-4xl font-bold text-[#4F806D]">
                                    {{ strtoupper(substr($project->title, 0, 1)) }}
                                </span>

                            </div>

                        @endif

                    </a>


                    {{-- =================================================
                    PROJECT CONTENT
                    ================================================== --}}

                    <div class="p-5">


                        {{-- Category + Status --}}
                        <div class="flex items-center justify-between gap-3">

                            @if($project->category)

                                <span
                                    class="text-xs
                                           font-semibold
                                           text-[#4F806D]
                                           uppercase
                                           tracking-wide"
                                >
                                    {{ $project->category }}
                                </span>

                            @else

                                <span></span>

                            @endif


                            @if($project->is_premium)

                                <span
                                    class="px-2.5 py-1
                                           rounded-full
                                           bg-[#FFF1E5]
                                           text-[#A45F2C]
                                           text-xs
                                           font-semibold"
                                >
                                    Premium
                                </span>

                            @else

                                <span
                                    class="px-2.5 py-1
                                           rounded-full
                                           bg-[#E8EEE9]
                                           text-[#4F806D]
                                           text-xs
                                           font-semibold"
                                >
                                    Free
                                </span>

                            @endif

                        </div>


                        {{-- Project Title --}}
                        <h3 class="mt-3 text-xl font-bold text-[#0F3F4A]">

                            <a
                                href="{{ route('projects.show', $project) }}"
                                class="group-hover:text-[#4F806D] hover:text-[#4F806D] transition"
                            >
                                {{ $project->title }}
                            </a>

                        </h3>


                        {{-- Description --}}
                        <p class="mt-2 text-sm text-[#6B7773] leading-6 line-clamp-3">
                            {{ $project->description }}
                        </p>


                        {{-- View Project --}}
                        <div class="mt-5">

                            <a
                                href="{{ route('projects.show', $project) }}"
                                class="inline-flex items-center gap-2
                                       text-sm
                                       font-semibold
                                       text-[#4F806D]
                                       group-hover:gap-3
                                       hover:text-[#3E735F]
                                       transition-all"
                            >
                                View Project →
                            </a>

                        </div>

                    </div>

                </article>

            @endforeach

        </div>


    {{-- =====================================================
    EMPTY STATE
    ====================================================== --}}

    @else

        <div
            class="bg-white
                   rounded-2xl
                   border border-[#D8DED9]
                   p-8 sm:p-10
                   text-center"
        >

            <div
                class="w-14 h-14
                       mx-auto
                       rounded-full
                       bg-[#E8EEE9]
                       flex items-center justify-center"
            >

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


            {{-- Owner shortcut --}}
            @auth

                @if(auth()->id() === $profile->user_id)

                    <div class="mt-5">

                        <a
                            href="{{ route('developer.projects.create') }}"
                            class="inline-flex items-center justify-center
                                   px-5 py-2.5
                                   rounded-xl
                                   bg-[#4F806D]
                                   text-white
                                   font-semibold
                                   hover:bg-[#3E735F]
                                   transition"
                        >
                            Create Your First Project
                        </a>

                    </div>

                @endif

            @endauth

        </div>

    @endif

</div>

</div>

{{-- =========================================================
FOLLOW SYSTEM
========================================================= --}}

@auth

@if(auth()->id() !== $profile->user_id)

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const followButton = document.getElementById('followButton');
            const followButtonText = document.getElementById('followButtonText');
            const followersCount = document.getElementById('followersCount');

            if (!followButton) {
                return;
            }

            let isFollowing = followButton.dataset.following === 'true';

            function updateButton() {

                if (isFollowing) {

                    followButtonText.textContent = 'Following';

                    followButton.classList.remove(
                        'bg-[#4F806D]',
                        'text-white',
                        'hover:bg-[#3E735F]'
                    );

                    followButton.classList.add(
                        'bg-[#E8EEE9]',
                        'text-[#29483D]',
                        'border',
                        'border-[#D8DED9]',
                        'hover:bg-[#DDE7E1]'
                    );

                } else {

                    followButtonText.textContent = 'Follow';

                    followButton.classList.remove(
                        'bg-[#E8EEE9]',
                        'text-[#29483D]',
                        'border',
                        'border-[#D8DED9]',
                        'hover:bg-[#DDE7E1]'
                    );

                    followButton.classList.add(
                        'bg-[#4F806D]',
                        'text-white',
                        'hover:bg-[#3E735F]'
                    );
                }
            }


            followButton.addEventListener('click', async function () {

                if (followButton.disabled) {
                    return;
                }

                followButton.disabled = true;

                const url = isFollowing
                    ? followButton.dataset.unfollowUrl
                    : followButton.dataset.followUrl;

                const method = isFollowing
                    ? 'DELETE'
                    : 'POST';

                try {

                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        throw new Error(
                            data.message || 'Something went wrong.'
                        );
                    }

                    isFollowing = data.following;

                    followButton.dataset.following =
                        isFollowing ? 'true' : 'false';

                    followersCount.textContent =
                        data.followers_count;

                    updateButton();

                } catch (error) {

                    console.error(
                        'Follow error:',
                        error
                    );

                } finally {

                    followButton.disabled = false;

                }

            });

        });

    </script>

@endif

@endauth

@endsection
