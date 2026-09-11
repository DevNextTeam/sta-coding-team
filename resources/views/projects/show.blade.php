```blade
@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#F5F1E8] py-12 px-6">

    <div class="max-w-4xl mx-auto">

        {{-- ===================================================== --}}
        {{-- BACK --}}
        {{-- ===================================================== --}}

        <a
            href="{{ route('projects.index') }}"
            class="inline-flex items-center
                   text-[#4F806D]
                   hover:text-[#3E735F]
                   hover:underline
                   transition"
        >
            ← Back to Projects
        </a>


        {{-- ===================================================== --}}
        {{-- PROJECT CARD --}}
        {{-- ===================================================== --}}

        <div
            class="bg-white
                   rounded-2xl
                   overflow-hidden
                   border border-[#D5DDD8]
                   shadow-sm
                   mt-6"
        >

            {{-- ================================================= --}}
            {{-- PROJECT IMAGE --}}
            {{-- ================================================= --}}

            @if($project->image)

                <img
                    src="{{ asset('storage/' . $project->image) }}"
                    alt="{{ $project->title }}"
                    class="w-full h-72 object-cover"
                >

            @endif


            <div class="p-8">

                {{-- ================================================= --}}
                {{-- CATEGORY --}}
                {{-- ================================================= --}}

                @if($project->category)

                    <p
                        class="text-sm
                               uppercase
                               tracking-wider
                               text-[#B87945]"
                    >
                        {{ $project->category }}
                    </p>

                @endif


                {{-- ================================================= --}}
                {{-- TITLE --}}
                {{-- ================================================= --}}

                <h1
                    class="text-4xl
                           font-bold
                           text-[#0F3F4A]
                           mt-2"
                >
                    {{ $project->title }}
                </h1>


                {{-- ================================================= --}}
                {{-- CREATOR --}}
                {{-- ================================================= --}}

                <div class="mt-5">

                    @if($project->user && $project->user->profile)

                        <a
                            href="{{ route(
                                'profile.show',
                                $project->user->profile->username
                            ) }}"
                            class="inline-flex
                                   items-center
                                   gap-3
                                   group"
                        >

                            @if($project->user->profile->avatar)

                                <img
                                    src="{{ asset(
                                        'storage/' .
                                        $project->user->profile->avatar
                                    ) }}"
                                    alt="{{ $project->user->profile->username }}"
                                    class="w-10
                                           h-10
                                           rounded-full
                                           object-cover
                                           border border-[#D5DDD8]"
                                >

                            @else

                                <div
                                    class="w-10
                                           h-10
                                           rounded-full
                                           bg-[#DCEAE4]
                                           text-[#3E735F]
                                           flex
                                           items-center
                                           justify-center
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
                                    class="text-xs
                                           text-gray-500"
                                >
                                    Created by
                                </p>

                                <p
                                    class="font-semibold
                                           text-[#0F3F4A]
                                           group-hover:text-[#4F806D]
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
                                   gap-3"
                        >

                            <div
                                class="w-10
                                       h-10
                                       rounded-full
                                       bg-[#DCEAE4]
                                       text-[#3E735F]
                                       flex
                                       items-center
                                       justify-center
                                       font-bold"
                            >
                                D
                            </div>

                            <div>

                                <p
                                    class="text-xs
                                           text-gray-500"
                                >
                                    Created by
                                </p>

                                <p
                                    class="font-semibold
                                           text-[#0F3F4A]"
                                >
                                    DevNext Team
                                </p>

                            </div>

                        </div>

                    @endif

                </div>


                {{-- ================================================= --}}
                {{-- PREMIUM / FREE --}}
                {{-- ================================================= --}}

                @if($project->is_premium)

                    <span
                        class="inline-flex
                               items-center
                               gap-1
                               mt-4
                               px-3
                               py-1
                               rounded-full
                               text-xs
                               font-semibold
                               bg-[#F1E3D4]
                               text-[#A45F2C]"
                    >
                        🔒 Premium Project
                    </span>

                @else

                    <span
                        class="inline-block
                               mt-4
                               px-3
                               py-1
                               rounded-full
                               text-xs
                               font-semibold
                               bg-[#DCEAE4]
                               text-[#3E735F]"
                    >
                        ✓ Free Project
                    </span>

                @endif


                {{-- ================================================= --}}
                {{-- SOCIAL ACTIONS --}}
                {{-- ================================================= --}}

                <div
                    class="mt-6
                           flex
                           flex-wrap
                           items-center
                           gap-3"
                >

                    {{-- ================================================= --}}
                    {{-- LIKE --}}
                    {{-- ================================================= --}}

                    @auth

                        @php
                            $hasLiked = $project->likedBy()
                                ->where('users.id', auth()->id())
                                ->exists();

                            $likeCount = $project->likedBy()->count();
                        @endphp


                        <button
                            type="button"
                            id="likeButton"
                            data-liked="{{ $hasLiked ? 'true' : 'false' }}"
                            data-like-url="{{ $hasLiked
                                ? route('projects.unlike', $project)
                                : route('projects.like', $project) }}"
                            class="inline-flex
                                   items-center
                                   gap-2
                                   px-5
                                   py-3
                                   rounded-xl
                                   font-semibold
                                   transition
                                   duration-200
                                   {{ $hasLiked
                                       ? 'bg-[#F1E3D4] text-[#A45F2C] hover:opacity-90'
                                       : 'bg-[#DCEAE4] text-[#3E735F] hover:bg-[#B8CEC5]' }}"
                        >

                            <span id="likeIcon">
                                {{ $hasLiked ? '❤️' : '🤍' }}
                            </span>

                            <span id="likeText">
                                {{ $hasLiked ? 'Liked' : 'Like' }}
                            </span>

                        </button>

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="inline-flex
                                   items-center
                                   gap-2
                                   px-5
                                   py-3
                                   rounded-xl
                                   bg-[#DCEAE4]
                                   text-[#3E735F]
                                   font-semibold
                                   hover:bg-[#B8CEC5]
                                   transition"
                        >
                            🤍 Like
                        </a>

                    @endauth


                    {{-- LIKE COUNT --}}

                    <span
                        id="likeCount"
                        class="text-sm
                               font-medium
                               text-[#315F6D]"
                    >
                        {{ $likeCount ?? $project->likedBy()->count() }}
                        {{ ($likeCount ?? $project->likedBy()->count()) === 1
                            ? 'Like'
                            : 'Likes' }}
                    </span>


                    {{-- ================================================= --}}
                    {{-- SAVE --}}
                    {{-- ================================================= --}}

                    @auth

                        @php
                            $hasSaved = $project->savedBy()
                                ->where('users.id', auth()->id())
                                ->exists();

                            $saveCount = $project->savedBy()->count();
                        @endphp


                        <button
                            type="button"
                            id="saveButton"
                            data-saved="{{ $hasSaved ? 'true' : 'false' }}"
                            data-save-url="{{ $hasSaved
                                ? route('projects.unsave', $project)
                                : route('projects.save', $project) }}"
                            class="inline-flex
                                   items-center
                                   gap-2
                                   px-5
                                   py-3
                                   rounded-xl
                                   font-semibold
                                   transition
                                   duration-200
                                   {{ $hasSaved
                                       ? 'bg-[#B8CEC5] text-[#29483D] hover:bg-[#A8C0B6]'
                                       : 'bg-[#E8E3D8] text-[#29483D] hover:bg-[#D8D1C3]' }}"
                        >

                            <span id="saveIcon">
                                🔖
                            </span>

                            <span id="saveText">
                                {{ $hasSaved ? 'Saved' : 'Save' }}
                            </span>

                        </button>

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="inline-flex
                                   items-center
                                   gap-2
                                   px-5
                                   py-3
                                   rounded-xl
                                   bg-[#E8E3D8]
                                   text-[#29483D]
                                   font-semibold
                                   hover:bg-[#D8D1C3]
                                   transition"
                        >
                            🔖 Save
                        </a>

                    @endauth


                    {{-- SAVE COUNT --}}

                    <span
                        id="saveCount"
                        class="text-sm
                               font-medium
                               text-[#315F6D]"
                    >
                        {{ $saveCount ?? $project->savedBy()->count() }}
                        {{ ($saveCount ?? $project->savedBy()->count()) === 1
                            ? 'Save'
                            : 'Saves' }}
                    </span>

                </div>


                {{-- ================================================= --}}
                {{-- DESCRIPTION --}}
                {{-- ================================================= --}}

                <div
                    class="mt-6
                           text-[#315F6D]
                           leading-7
                           whitespace-pre-line"
                >
                    {{ $project->description }}
                </div>


                {{-- ================================================= --}}
                {{-- ACCESS --}}
                {{-- ================================================= --}}

                @if($hasAccess)

                    @if($project->is_premium)

                        <div
                            class="mt-8
                                   p-5
                                   rounded-2xl
                                   bg-[#DCEAE4]
                                   border border-[#BFD8CE]"
                        >

                            <div class="flex items-center gap-3">

                                <span class="text-xl">
                                    ✓
                                </span>

                                <div>

                                    <h3
                                        class="font-bold
                                               text-[#3E735F]"
                                    >
                                        Premium Access Granted
                                    </h3>

                                    <p
                                        class="text-sm
                                               text-[#315F6D]
                                               mt-1"
                                    >
                                        Your active subscription gives you
                                        access to this project and its resources.
                                    </p>

                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- SOURCE / GITHUB / DEMO --}}
                    {{-- ================================================= --}}

                    <div class="flex flex-wrap gap-4 mt-8">

                        @php

                            $sourceExtensions = [
                                'php',
                                'blade.php',
                                'css',
                                'js',
                                'jsx',
                                'ts',
                                'tsx',
                                'html',
                                'htm',
                                'json',
                                'xml',
                                'sql',
                                'md',
                                'txt',
                                'vue',
                                'env.example',
                                'gitignore',
                            ];

                            $sourceResource = $project->resources->first(
                                function ($resource) use ($sourceExtensions) {

                                    $fileName = strtolower(
                                        $resource->name ?? ''
                                    );

                                    foreach ($sourceExtensions as $extension) {

                                        if (
                                            str_ends_with(
                                                $fileName,
                                                '.' . $extension
                                            ) ||
                                            $fileName === $extension
                                        ) {
                                            return true;
                                        }

                                    }

                                    return false;
                                }
                            );

                        @endphp


                        @if($sourceResource)

                            <a
                                href="{{ route(
                                    'project-resources.view',
                                    $sourceResource
                                ) }}"
                                class="px-5
                                       py-3
                                       rounded-xl
                                       bg-[#0F3F4A]
                                       text-white
                                       hover:opacity-90
                                       transition"
                            >
                                View Source Code
                            </a>

                        @endif


                        @if($project->github_url)

                            <a
                                href="{{ $project->github_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="px-5
                                       py-3
                                       rounded-xl
                                       bg-gray-800
                                       text-white
                                       hover:bg-gray-700
                                       transition"
                            >
                                GitHub
                            </a>

                        @endif


                        @if($project->demo_url)

                            <a
                                href="{{ $project->demo_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="px-5
                                       py-3
                                       rounded-xl
                                       bg-[#4F806D]
                                       text-white
                                       hover:bg-[#3E735F]
                                       transition"
                            >
                                Live Demo
                            </a>

                        @endif

                    </div>


                    {{-- ================================================= --}}
                    {{-- PROJECT VIDEO --}}
                    {{-- ================================================= --}}

                    @if($project->video_url)

                        @php

                            $videoUrl = $project->video_url;

                            $youtubeId = null;

                            if (str_contains($videoUrl, 'youtube.com/watch')) {

                                parse_str(
                                    parse_url($videoUrl, PHP_URL_QUERY) ?? '',
                                    $youtubeQuery
                                );

                                $youtubeId =
                                    $youtubeQuery['v'] ?? null;
                            }

                            elseif (str_contains($videoUrl, 'youtu.be/')) {

                                $youtubeId = trim(
                                    parse_url(
                                        $videoUrl,
                                        PHP_URL_PATH
                                    ),
                                    '/'
                                );
                            }

                            elseif (str_contains($videoUrl, 'youtube.com/shorts/')) {

                                $path = parse_url(
                                    $videoUrl,
                                    PHP_URL_PATH
                                );

                                $youtubeId = basename($path);
                            }

                            if ($youtubeId) {

                                $youtubeId = preg_replace(
                                    '/[^a-zA-Z0-9_-]/',
                                    '',
                                    $youtubeId
                                );
                            }

                        @endphp


                        @if($youtubeId)

                            <div class="mt-12">

                                <div class="mb-5">

                                    <p
                                        class="text-sm
                                               uppercase
                                               tracking-[0.3em]
                                               text-[#B87945]"
                                    >
                                        PROJECT VIDEO
                                    </p>

                                    <h2
                                        class="text-3xl
                                               font-bold
                                               text-[#0F3F4A]
                                               mt-1"
                                    >
                                        Video Demonstration
                                    </h2>

                                    <p
                                        class="text-[#315F6D]
                                               mt-2"
                                    >
                                        Watch the video demonstration of this
                                        project.
                                    </p>

                                </div>


                                <div
                                    class="relative
                                           w-full
                                           overflow-hidden
                                           rounded-2xl
                                           border border-[#D5DDD8]
                                           shadow-sm"
                                    style="aspect-ratio: 16 / 9;"
                                >

                                    <iframe
                                        class="absolute inset-0
                                               w-full h-full"
                                        src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                        title="{{ $project->title }} Video"
                                        frameborder="0"
                                        allow="accelerometer;
                                               autoplay;
                                               clipboard-write;
                                               encrypted-media;
                                               gyroscope;
                                               picture-in-picture;
                                               web-share"
                                        allowfullscreen
                                    ></iframe>

                                </div>

                            </div>

                        @endif

                    @endif


                    {{-- ================================================= --}}
                    {{-- PROJECT INSTRUCTIONS --}}
                    {{-- ================================================= --}}

                    @if($project->instructions->count())

                        <div class="mt-12">

                            <div class="mb-6">

                                <p
                                    class="text-sm
                                           uppercase
                                           tracking-[0.3em]
                                           text-[#B87945]"
                                >
                                    PROJECT GUIDE
                                </p>

                                <h2
                                    class="text-3xl
                                           font-bold
                                           text-[#0F3F4A]
                                           mt-1"
                                >
                                    Instructions
                                </h2>

                                <p
                                    class="text-[#315F6D]
                                           mt-2"
                                >
                                    Follow these steps to set up and use
                                    this project.
                                </p>

                            </div>


                            <div class="space-y-6">

                                @foreach($project->instructions as $instruction)

                                    <div
                                        class="relative
                                               bg-[#F5F1E8]
                                               border border-[#D5DDD8]
                                               rounded-2xl
                                               p-6"
                                    >

                                        <div class="flex items-start gap-4">

                                            <div
                                                class="shrink-0
                                                       w-11
                                                       h-11
                                                       rounded-full
                                                       bg-[#4F806D]
                                                       text-white
                                                       flex
                                                       items-center
                                                       justify-center
                                                       font-bold
                                                       text-lg"
                                            >
                                                {{ $instruction->step }}
                                            </div>


                                            <div class="min-w-0 flex-1">

                                                <h3
                                                    class="text-xl
                                                           font-bold
                                                           text-[#0F3F4A]"
                                                >
                                                    Step {{ $instruction->step }}:
                                                    {{ $instruction->title }}
                                                </h3>

                                                <p
                                                    class="mt-3
                                                           text-[#315F6D]
                                                           leading-7
                                                           whitespace-pre-line"
                                                >
                                                    {{ $instruction->description }}
                                                </p>

                                            </div>

                                        </div>


                                        @if($instruction->image)

                                            <div class="mt-6">

                                                <img
                                                    src="{{ asset(
                                                        'storage/' .
                                                        $instruction->image
                                                    ) }}"
                                                    alt="{{ $instruction->title }}"
                                                    class="w-full
                                                           max-w-2xl
                                                           rounded-xl
                                                           border border-[#D5DDD8]
                                                           shadow-sm"
                                                >

                                            </div>

                                        @endif

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- PROJECT RESOURCES --}}
                    {{-- ================================================= --}}

                    <div class="mt-12">

                        <h2
                            class="text-2xl
                                   font-bold
                                   text-[#0F3F4A]"
                        >
                            Project Resources
                        </h2>

                        <p
                            class="text-[#315F6D]
                                   mt-2"
                        >
                            View or download the files and resources
                            for this project.
                        </p>


                        @if($project->resources->count())

                            <div class="mt-5 space-y-3">

                                @foreach($project->resources as $resource)

                                    <div
                                        class="flex
                                               items-center
                                               justify-between
                                               gap-4
                                               p-4
                                               rounded-xl
                                               bg-[#F5F1E8]
                                               border border-[#D5DDD8]"
                                    >

                                        <div class="min-w-0">

                                            <p
                                                class="font-semibold
                                                       text-[#0F3F4A]
                                                       truncate"
                                            >
                                                {{ $resource->name }}
                                            </p>

                                            <p
                                                class="text-xs
                                                       text-gray-500
                                                       mt-1"
                                            >

                                                {{ strtoupper(
                                                    $resource->file_type ?? 'FILE'
                                                ) }}

                                                @if($resource->file_size)

                                                    •
                                                    {{ number_format(
                                                        $resource->file_size / 1024,
                                                        1
                                                    ) }}
                                                    KB

                                                @endif

                                            </p>

                                        </div>


                                        <div
                                            class="flex
                                                   gap-2
                                                   shrink-0"
                                        >

                                            @php

                                                $fileName = strtolower(
                                                    $resource->name ?? ''
                                                );

                                                $canView = false;

                                                foreach (
                                                    $sourceExtensions
                                                    as $extension
                                                ) {

                                                    if (
                                                        str_ends_with(
                                                            $fileName,
                                                            '.' . $extension
                                                        ) ||
                                                        $fileName === $extension
                                                    ) {

                                                        $canView = true;

                                                        break;
                                                    }

                                                }

                                            @endphp


                                            @if($canView)

                                                <a
                                                    href="{{ route(
                                                        'project-resources.view',
                                                        $resource
                                                    ) }}"
                                                    class="px-4
                                                           py-2
                                                           rounded-xl
                                                           bg-[#0F3F4A]
                                                           text-white
                                                           hover:opacity-90
                                                           transition"
                                                >
                                                    View
                                                </a>

                                            @endif


                                            <a
                                                href="{{ route(
                                                    'project-resources.download',
                                                    $resource
                                                ) }}"
                                                class="px-4
                                                       py-2
                                                       rounded-xl
                                                       bg-[#4F806D]
                                                       text-white
                                                       hover:bg-[#3E735F]
                                                       transition"
                                            >
                                                Download
                                            </a>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div
                                class="mt-5
                                       p-6
                                       rounded-2xl
                                       bg-[#F5F1E8]
                                       border border-[#D5DDD8]"
                            >

                                <p class="text-[#315F6D]">
                                    No downloadable resources are available
                                    for this project yet.
                                </p>

                            </div>

                        @endif

                    </div>


                    {{-- ================================================= --}}
                    {{-- COMMUNITY COMMENTS --}}
                    {{-- ================================================= --}}

                    <div
                        class="mt-16
                               pt-10
                               border-t border-[#D5DDD8]"
                    >

                        <div class="mb-6">

                            <p
                                class="text-sm
                                       uppercase
                                       tracking-[0.3em]
                                       text-[#B87945]"
                            >
                                COMMUNITY
                            </p>

                            <h2
                                class="text-3xl
                                       font-bold
                                       text-[#0F3F4A]
                                       mt-1"
                            >
                                Comments
                                (<span id="commentCount">
                                    {{ $project->comments()->count() }}
                                </span>)
                            </h2>

                            <p
                                class="text-[#315F6D]
                                       mt-2"
                            >
                                Share your thoughts, questions, or feedback
                                about this project.
                            </p>

                        </div>


                        {{-- ================================================= --}}
                        {{-- COMMENT FORM --}}
                        {{-- ================================================= --}}

                        @auth

                            <form
                                id="commentForm"
                                action="{{ route(
                                    'projects.comments.store',
                                    $project
                                ) }}"
                                method="POST"
                                class="mb-8"
                            >

                                @csrf

                                <div>

                                    <textarea
                                        id="commentBody"
                                        name="body"
                                        rows="4"
                                        maxlength="2000"
                                        required
                                        placeholder="Write a comment..."
                                        class="w-full
                                               rounded-2xl
                                               border border-[#D5DDD8]
                                               bg-[#F5F1E8]
                                               px-5
                                               py-4
                                               text-[#315F6D]
                                               outline-none
                                               resize-y
                                               focus:border-[#4F806D]
                                               focus:ring-2
                                               focus:ring-[#B8CEC5]"
                                    ></textarea>

                                </div>


                                {{-- ERROR --}}

                                <p
                                    id="commentError"
                                    class="hidden
                                           mt-3
                                           text-sm
                                           text-red-600"
                                ></p>


                                <div class="mt-4">

                                    <button
                                        type="submit"
                                        id="commentSubmit"
                                        class="inline-flex
                                               items-center
                                               justify-center
                                               px-5
                                               py-3
                                               rounded-xl
                                               bg-[#4F806D]
                                               text-white
                                               font-semibold
                                               hover:bg-[#3E735F]
                                               transition
                                               disabled:opacity-50
                                               disabled:cursor-not-allowed"
                                    >
                                        <span id="commentSubmitText">
                                            Post Comment
                                        </span>
                                    </button>

                                </div>

                            </form>

                        @else

                            <div
                                class="mb-8
                                       p-5
                                       rounded-2xl
                                       bg-[#F5F1E8]
                                       border border-[#D5DDD8]"
                            >

                                <p class="text-[#315F6D]">

                                    Want to join the conversation?

                                    <a
                                        href="{{ route('login') }}"
                                        class="font-semibold
                                               text-[#4F806D]
                                               hover:text-[#3E735F]
                                               hover:underline"
                                    >
                                        Login
                                    </a>

                                    to post a comment.

                                </p>

                            </div>

                        @endauth


                        {{-- ================================================= --}}
                        {{-- COMMENTS LIST --}}
                        {{-- ================================================= --}}

                        <div
                            id="commentsList"
                            class="space-y-4"
                        >

                            @forelse($project->comments()->with('user.profile')->latest()->get() as $comment)

                                <div
                                    id="comment-{{ $comment->id }}"
                                    class="comment-card
                                           bg-[#F5F1E8]
                                           border border-[#D5DDD8]
                                           rounded-2xl
                                           p-5"
                                >

                                    <div
                                        class="flex
                                               items-start
                                               gap-4"
                                    >

                                        {{-- AVATAR --}}

                                        @if($comment->user->profile?->avatar)

                                            <a
                                                href="{{ route(
                                                    'profile.show',
                                                    $comment->user->profile->username
                                                ) }}"
                                            >

                                                <img
                                                    src="{{ asset(
                                                        'storage/' .
                                                        $comment->user->profile->avatar
                                                    ) }}"
                                                    alt="{{ $comment->user->profile->username }}"
                                                    class="w-11
                                                           h-11
                                                           rounded-full
                                                           object-cover
                                                           border border-[#D5DDD8]"
                                                >

                                            </a>

                                        @else

                                            <div
                                                class="shrink-0
                                                       w-11
                                                       h-11
                                                       rounded-full
                                                       bg-[#DCEAE4]
                                                       text-[#3E735F]
                                                       flex
                                                       items-center
                                                       justify-center
                                                       font-bold"
                                            >
                                                {{ strtoupper(
                                                    substr(
                                                        $comment->user->profile->username
                                                            ?? $comment->user->name,
                                                        0,
                                                        1
                                                    )
                                                ) }}
                                            </div>

                                        @endif


                                        {{-- COMMENT CONTENT --}}

                                        <div class="min-w-0 flex-1">

                                            <div
                                                class="flex
                                                       flex-wrap
                                                       items-center
                                                       gap-x-3
                                                       gap-y-1"
                                            >

                                                @if($comment->user->profile)

                                                    <a
                                                        href="{{ route(
                                                            'profile.show',
                                                            $comment->user->profile->username
                                                        ) }}"
                                                        class="font-bold
                                                               text-[#0F3F4A]
                                                               hover:text-[#4F806D]"
                                                    >
                                                        {{ $comment->user->profile->username }}
                                                    </a>

                                                @else

                                                    <span
                                                        class="font-bold
                                                               text-[#0F3F4A]"
                                                    >
                                                        {{ $comment->user->name }}
                                                    </span>

                                                @endif


                                                <span
                                                    class="text-xs
                                                           text-gray-500"
                                                >
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </span>

                                            </div>


                                            <p
                                                class="comment-body
                                                       mt-2
                                                       text-[#315F6D]
                                                       leading-7
                                                       whitespace-pre-line
                                                       break-words"
                                            >
                                                {{ $comment->body }}
                                            </p>


                                            {{-- COMMENT ACTIONS --}}

                                            @auth

                                                @if($comment->user_id === auth()->id())

                                                    <div
                                                        class="mt-3
                                                               flex
                                                               items-center
                                                               gap-3"
                                                    >

                                                        <button
                                                            type="button"
                                                            class="edit-comment
                                                                   text-xs
                                                                   font-semibold
                                                                   text-[#4F806D]
                                                                   hover:underline"
                                                            data-id="{{ $comment->id }}"
                                                        >
                                                            Edit
                                                        </button>


                                                        <button
                                                            type="button"
                                                            class="delete-comment
                                                                   text-xs
                                                                   font-semibold
                                                                   text-red-600
                                                                   hover:underline"
                                                            data-id="{{ $comment->id }}"
                                                        >
                                                            Delete
                                                        </button>

                                                    </div>

                                                @endif

                                            @endauth

                                        </div>

                                    </div>

                                </div>

                            @empty

                                <div
                                    id="noComments"
                                    class="p-8
                                           rounded-2xl
                                           bg-[#F5F1E8]
                                           border border-[#D5DDD8]
                                           text-center"
                                >

                                    <div class="text-3xl">
                                        💬
                                    </div>

                                    <h3
                                        class="mt-3
                                               font-bold
                                               text-[#0F3F4A]"
                                    >
                                        No comments yet
                                    </h3>

                                    <p
                                        class="mt-1
                                               text-sm
                                               text-[#315F6D]"
                                    >
                                        Be the first to share your thoughts!
                                    </p>

                                </div>

                            @endforelse

                        </div>

                    </div>


                {{-- ================================================= --}}
                {{-- NO ACCESS --}}
                {{-- ================================================= --}}

                @else

                    <div
                        class="mt-8
                               p-6
                               rounded-2xl
                               bg-[#F5E6D8]
                               border border-[#E5CDB8]"
                    >

                        <h2
                            class="text-xl
                                   font-bold
                                   text-[#A45F2C]"
                        >
                            🔒 Premium Project
                        </h2>

                        <p
                            class="text-[#7A5538]
                                   mt-2"
                        >
                            This project is available to subscribers.
                            Subscribe to access the source code,
                            instructions, project video, and resources.
                        </p>


                        @guest

                            <a
                                href="{{ route('login') }}"
                                class="inline-block
                                       mt-4
                                       px-5
                                       py-3
                                       rounded-xl
                                       bg-[#4F806D]
                                       text-white
                                       hover:bg-[#3E735F]
                                       transition"
                            >
                                Login to Continue
                            </a>

                        @else

                            <form
                                action="{{ route('subscription.checkout') }}"
                                method="POST"
                                class="mt-4"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="px-5
                                           py-3
                                           rounded-xl
                                           bg-[#4F806D]
                                           text-white
                                           hover:bg-[#3E735F]
                                           transition"
                                >
                                    Subscribe for ₱99/month
                                </button>

                            </form>

                        @endguest

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

{{-- ============================================================= --}}
{{-- DELETE COMMENT MODAL --}}
{{-- ============================================================= --}}

<div
    id="deleteCommentModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4 backdrop-blur-sm"
>
    <div
        id="deleteCommentModalBox"
        class="w-full max-w-md rounded-3xl bg-white p-7 shadow-2xl border border-[#D5DDD8] scale-95 opacity-0 transition-all duration-200"
    >

        <div class="flex items-start gap-4">

            <div
                class="shrink-0 w-12 h-12 rounded-2xl bg-[#F1E3D4] text-[#A45F2C] flex items-center justify-center text-xl"
            >
                🗑️
            </div>

            <div class="min-w-0">

                <h3
                    class="text-xl font-bold text-[#0F3F4A]"
                >
                    Delete Comment
                </h3>

                <p
                    class="mt-2 text-sm leading-6 text-[#315F6D]"
                >
                    Are you sure you want to delete this comment?
                    This action cannot be undone.
                </p>

            </div>

        </div>


        <div class="mt-7 flex justify-end gap-3">

            <button
                type="button"
                id="cancelDeleteComment"
                class="px-5 py-3 rounded-xl bg-[#E8E3D8] text-[#29483D] font-semibold hover:bg-[#D8D1C3] transition"
            >
                Cancel
            </button>

            <button
                type="button"
                id="confirmDeleteComment"
                class="px-5 py-3 rounded-xl bg-[#A45F2C] text-white font-semibold hover:bg-[#8F4F25] transition disabled:opacity-50 disabled:cursor-not-allowed"
            >
                Delete Comment
            </button>

        </div>

    </div>
</div>

{{-- ============================================================= --}}
{{-- EDIT COMMENT MODAL --}}
{{-- ============================================================= --}}

<div
    id="editCommentModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4 backdrop-blur-sm"
>
    <div
        id="editCommentModalBox"
        class="w-full max-w-lg rounded-3xl bg-white p-7 shadow-2xl border border-[#D5DDD8] scale-95 opacity-0 transition-all duration-200"
    >

        <div class="flex items-start gap-4">

            <div
                class="shrink-0 w-12 h-12 rounded-2xl bg-[#DCEAE4] text-[#3E735F] flex items-center justify-center text-xl"
            >
                ✏️
            </div>

            <div class="min-w-0">

                <h3
                    class="text-xl font-bold text-[#0F3F4A]"
                >
                    Edit Comment
                </h3>

                <p
                    class="mt-2 text-sm leading-6 text-[#315F6D]"
                >
                    Update your comment below.
                </p>

            </div>

        </div>


        <textarea
            id="editCommentBody"
            rows="5"
            maxlength="2000"
            class="mt-6 w-full rounded-2xl border border-[#D5DDD8] bg-[#F5F1E8] px-5 py-4 text-[#315F6D] outline-none resize-y focus:border-[#4F806D] focus:ring-2 focus:ring-[#B8CEC5]"
            placeholder="Write your comment..."
        ></textarea>


        <p
            id="editCommentError"
            class="hidden mt-3 text-sm text-red-600"
        ></p>


        <div class="mt-6 flex justify-end gap-3">

            <button
                type="button"
                id="cancelEditComment"
                class="px-5 py-3 rounded-xl bg-[#E8E3D8] text-[#29483D] font-semibold hover:bg-[#D8D1C3] transition"
            >
                Cancel
            </button>


            <button
                type="button"
                id="confirmEditComment"
                class="px-5 py-3 rounded-xl bg-[#4F806D] text-white font-semibold hover:bg-[#3E735F] transition disabled:opacity-50 disabled:cursor-not-allowed"
            >
                Save Changes
            </button>

        </div>

    </div>
</div>

{{-- ============================================================= --}}
{{-- AJAX --}}
{{-- ============================================================= --}}

@auth

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | LIKE
    |--------------------------------------------------------------------------
    */

    const likeButton = document.getElementById('likeButton');
    const likeIcon = document.getElementById('likeIcon');
    const likeText = document.getElementById('likeText');
    const likeCount = document.getElementById('likeCount');


    if (likeButton) {

        likeButton.addEventListener('click', async function () {

            const isLiked =
                likeButton.dataset.liked === 'true';

            const url =
                likeButton.dataset.likeUrl;

            likeButton.disabled = true;

            try {

                const response = await fetch(url, {

                    method: isLiked
                        ? 'DELETE'
                        : 'POST',

                    headers: {

                        'X-CSRF-TOKEN':
                            '{{ csrf_token() }}',

                        'Accept':
                            'application/json',

                        'Content-Type':
                            'application/json',

                        'X-Requested-With':
                            'XMLHttpRequest'

                    }

                });


                if (!response.ok) {
                    throw new Error('Like request failed.');
                }


                const data =
                    await response.json();


                if (data.liked) {

                    likeButton.dataset.liked = 'true';

                    likeButton.dataset.likeUrl =
                        '{{ route('projects.unlike', $project) }}';

                    likeIcon.textContent = '❤️';
                    likeText.textContent = 'Liked';

                    likeButton.className =
                        'inline-flex items-center gap-2 px-5 py-3 rounded-xl font-semibold transition duration-200 bg-[#F1E3D4] text-[#A45F2C] hover:opacity-90';

                } else {

                    likeButton.dataset.liked = 'false';

                    likeButton.dataset.likeUrl =
                        '{{ route('projects.like', $project) }}';

                    likeIcon.textContent = '🤍';
                    likeText.textContent = 'Like';

                    likeButton.className =
                        'inline-flex items-center gap-2 px-5 py-3 rounded-xl font-semibold transition duration-200 bg-[#DCEAE4] text-[#3E735F] hover:bg-[#B8CEC5]';

                }


                likeCount.textContent =
                    data.like_count +
                    (
                        data.like_count === 1
                            ? ' Like'
                            : ' Likes'
                    );

            }

            catch (error) {

                console.error(error);

                alert(
                    'Something went wrong. Please try again.'
                );

            }

            finally {

                likeButton.disabled = false;

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | SAVE
    |--------------------------------------------------------------------------
    */

    const saveButton = document.getElementById('saveButton');
    const saveIcon = document.getElementById('saveIcon');
    const saveText = document.getElementById('saveText');
    const saveCount = document.getElementById('saveCount');


    if (saveButton) {

        saveButton.addEventListener('click', async function () {

            const isSaved =
                saveButton.dataset.saved === 'true';

            const url =
                saveButton.dataset.saveUrl;

            saveButton.disabled = true;

            try {

                const response = await fetch(url, {

                    method: isSaved
                        ? 'DELETE'
                        : 'POST',

                    headers: {

                        'X-CSRF-TOKEN':
                            '{{ csrf_token() }}',

                        'Accept':
                            'application/json',

                        'Content-Type':
                            'application/json',

                        'X-Requested-With':
                            'XMLHttpRequest'

                    }

                });


                if (!response.ok) {
                    throw new Error('Save request failed.');
                }


                const data =
                    await response.json();


                if (data.saved) {

                    saveButton.dataset.saved = 'true';

                    saveButton.dataset.saveUrl =
                        '{{ route('projects.unsave', $project) }}';

                    saveIcon.textContent = '🔖';
                    saveText.textContent = 'Saved';

                    saveButton.className =
                        'inline-flex items-center gap-2 px-5 py-3 rounded-xl font-semibold transition duration-200 bg-[#B8CEC5] text-[#29483D] hover:bg-[#A8C0B6]';

                } else {

                    saveButton.dataset.saved = 'false';

                    saveButton.dataset.saveUrl =
                        '{{ route('projects.save', $project) }}';

                    saveIcon.textContent = '🔖';
                    saveText.textContent = 'Save';

                    saveButton.className =
                        'inline-flex items-center gap-2 px-5 py-3 rounded-xl font-semibold transition duration-200 bg-[#E8E3D8] text-[#29483D] hover:bg-[#D8D1C3]';

                }


                saveCount.textContent =
                    data.save_count +
                    (
                        data.save_count === 1
                            ? ' Save'
                            : ' Saves'
                    );

            }

            catch (error) {

                console.error(error);

                alert(
                    'Something went wrong. Please try again.'
                );

            }

            finally {

                saveButton.disabled = false;

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | COMMENTS
    |--------------------------------------------------------------------------
    */

    const commentForm =
        document.getElementById('commentForm');

    const commentBody =
        document.getElementById('commentBody');

    const commentSubmit =
        document.getElementById('commentSubmit');

    const commentSubmitText =
        document.getElementById('commentSubmitText');

    const commentError =
        document.getElementById('commentError');

    const commentsList =
        document.getElementById('commentsList');

    const commentCount =
        document.getElementById('commentCount');


    /*
    |--------------------------------------------------------------------------
    | POST COMMENT
    |--------------------------------------------------------------------------
    */

    if (commentForm) {

        commentForm.addEventListener(
            'submit',
            async function (event) {

                event.preventDefault();


                const body =
                    commentBody.value.trim();


                if (!body) {

                    commentError.textContent =
                        'Please write a comment first.';

                    commentError.classList.remove('hidden');

                    return;
                }


                commentError.classList.add('hidden');

                commentSubmit.disabled = true;

                commentSubmitText.textContent =
                    'Posting...';


                try {

                    const response = await fetch(
                        commentForm.action,
                        {

                            method: 'POST',

                            headers: {

                                'X-CSRF-TOKEN':
                                    '{{ csrf_token() }}',

                                'Accept':
                                    'application/json',

                                'Content-Type':
                                    'application/json',

                                'X-Requested-With':
                                    'XMLHttpRequest'

                            },

                            body: JSON.stringify({
                                body: body
                            })

                        }
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | VALIDATION ERROR
                    |--------------------------------------------------------------------------
                    */

                    if (response.status === 422) {

                        const data =
                            await response.json();

                        const firstError =
                            Object.values(
                                data.errors || {}
                            )[0]?.[0];

                        throw new Error(
                            firstError ||
                            'Please check your comment.'
                        );

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | OTHER ERROR
                    |--------------------------------------------------------------------------
                    */

                    if (!response.ok) {

                        throw new Error(
                            'Unable to post comment.'
                        );

                    }


                    const data =
                        await response.json();


                    /*
                    |--------------------------------------------------------------------------
                    | REMOVE EMPTY STATE
                    |--------------------------------------------------------------------------
                    */

                    const noComments =
                        document.getElementById(
                            'noComments'
                        );

                    if (noComments) {
                        noComments.remove();
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | CREATE COMMENT HTML
                    |--------------------------------------------------------------------------
                    */

                    const comment =
                        data.comment;


                    const avatarHtml =
                        comment.avatar

                            ? `
                                <a href="${comment.profile_url}">
                                    <img
                                        src="${comment.avatar}"
                                        alt="${escapeHtml(comment.username)}"
                                        class="w-11 h-11 rounded-full object-cover border border-[#D5DDD8]"
                                    >
                                </a>
                              `

                            : `
                                <div
                                    class="shrink-0 w-11 h-11 rounded-full bg-[#DCEAE4] text-[#3E735F] flex items-center justify-center font-bold"
                                >
                                    ${escapeHtml(comment.initial)}
                                </div>
                              `;


                    const profileHtml =
                        comment.profile_url

                            ? `
                                <a
                                    href="${comment.profile_url}"
                                    class="font-bold text-[#0F3F4A] hover:text-[#4F806D]"
                                >
                                    ${escapeHtml(comment.username)}
                                </a>
                              `

                            : `
                                <span
                                    class="font-bold text-[#0F3F4A]"
                                >
                                    ${escapeHtml(comment.username)}
                                </span>
                              `;


                    const commentHtml = `

                        <div
                            id="comment-${comment.id}"
                            class="comment-card bg-[#F5F1E8] border border-[#D5DDD8] rounded-2xl p-5"
                        >

                            <div
                                class="flex items-start gap-4"
                            >

                                ${avatarHtml}

                                <div
                                    class="min-w-0 flex-1"
                                >

                                    <div
                                        class="flex flex-wrap items-center gap-x-3 gap-y-1"
                                    >

                                        ${profileHtml}

                                        <span
                                            class="text-xs text-gray-500"
                                        >
                                            ${escapeHtml(comment.created_at)}
                                        </span>

                                    </div>


                                    <p
                                        class="comment-body mt-2 text-[#315F6D] leading-7 whitespace-pre-line break-words"
                                    >
                                        ${escapeHtml(comment.body)}
                                    </p>


                                    <div
                                        class="mt-3 flex items-center gap-3"
                                    >

                                        <button
                                            type="button"
                                            class="edit-comment text-xs font-semibold text-[#4F806D] hover:underline"
                                            data-id="${comment.id}"
                                        >
                                            Edit
                                        </button>


                                        <button
                                            type="button"
                                            class="delete-comment text-xs font-semibold text-red-600 hover:underline"
                                            data-id="${comment.id}"
                                        >
                                            Delete
                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    `;


                    commentsList.insertAdjacentHTML(
                        'afterbegin',
                        commentHtml
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | UPDATE COUNT
                    |--------------------------------------------------------------------------
                    */

                    commentCount.textContent =
                        data.comment_count;


                    /*
                    |--------------------------------------------------------------------------
                    | CLEAR FORM
                    |--------------------------------------------------------------------------
                    */

                    commentBody.value = '';


                    /*
                    |--------------------------------------------------------------------------
                    | SUCCESS FEEDBACK
                    |--------------------------------------------------------------------------
                    */

                    commentSubmitText.textContent =
                        'Posted ✓';


                    setTimeout(function () {

                        commentSubmitText.textContent =
                            'Post Comment';

                    }, 1500);

                }

                catch (error) {

                    console.error(
                        'Comment error:',
                        error
                    );


                    commentError.textContent =
                        error.message ||
                        'Something went wrong. Please try again.';

                    commentError.classList.remove(
                        'hidden'
                    );

                }

                finally {

                    commentSubmit.disabled =
                        false;

                    if (
                        commentSubmitText.textContent ===
                        'Posting...'
                    ) {
                        commentSubmitText.textContent =
                            'Post Comment';
                    }

                }

            }
        );

    }


    /*
|--------------------------------------------------------------------------
| DELETE COMMENT
|--------------------------------------------------------------------------
*/

const deleteCommentModal =
    document.getElementById('deleteCommentModal');

const deleteCommentModalBox =
    document.getElementById('deleteCommentModalBox');

const cancelDeleteComment =
    document.getElementById('cancelDeleteComment');

const confirmDeleteComment =
    document.getElementById('confirmDeleteComment');

let commentToDelete = null;


/*
|--------------------------------------------------------------------------
| OPEN DELETE MODAL
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'click',
    function (event) {

        const button =
            event.target.closest(
                '.delete-comment'
            );

        if (!button) {
            return;
        }

        commentToDelete = button;

        deleteCommentModal.classList.remove('hidden');

        deleteCommentModal.classList.add('flex');

        requestAnimationFrame(function () {

            deleteCommentModalBox.classList.remove(
                'scale-95',
                'opacity-0'
            );

            deleteCommentModalBox.classList.add(
                'scale-100',
                'opacity-100'
            );

        });

    }
);


/*
|--------------------------------------------------------------------------
| CLOSE DELETE MODAL
|--------------------------------------------------------------------------
*/

function closeDeleteCommentModal() {

    deleteCommentModalBox.classList.remove(
        'scale-100',
        'opacity-100'
    );

    deleteCommentModalBox.classList.add(
        'scale-95',
        'opacity-0'
    );

    setTimeout(function () {

        deleteCommentModal.classList.add('hidden');

        deleteCommentModal.classList.remove('flex');

        commentToDelete = null;

        confirmDeleteComment.disabled = false;

        confirmDeleteComment.textContent =
            'Delete Comment';

    }, 200);

}


/*
|--------------------------------------------------------------------------
| CANCEL
|--------------------------------------------------------------------------
*/

cancelDeleteComment.addEventListener(
    'click',
    function () {

        closeDeleteCommentModal();

    }
);


/*
|--------------------------------------------------------------------------
| CLICK OUTSIDE MODAL
|--------------------------------------------------------------------------
*/

deleteCommentModal.addEventListener(
    'click',
    function (event) {

        if (
            event.target ===
            deleteCommentModal
        ) {

            closeDeleteCommentModal();

        }

    }
);


/*
|--------------------------------------------------------------------------
| ESC KEY
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'keydown',
    function (event) {

        if (
            event.key === 'Escape' &&
            !deleteCommentModal.classList.contains('hidden')
        ) {

            closeDeleteCommentModal();

        }

    }
);


/*
|--------------------------------------------------------------------------
| CONFIRM DELETE
|--------------------------------------------------------------------------
*/

confirmDeleteComment.addEventListener(
    'click',
    async function () {

        if (!commentToDelete) {
            return;
        }


        const button =
            commentToDelete;

        const commentId =
            button.dataset.id;


        button.disabled = true;

        confirmDeleteComment.disabled = true;

        confirmDeleteComment.textContent =
            'Deleting...';


        try {

            const response =
                await fetch(
                    `/comments/${commentId}`,
                    {

                        method: 'DELETE',

                        headers: {

                            'X-CSRF-TOKEN':
                                '{{ csrf_token() }}',

                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest'

                        }

                    }
                );


            if (!response.ok) {

                throw new Error(
                    'Unable to delete comment.'
                );

            }


            const data =
                await response.json();


            const commentElement =
                document.getElementById(
                    `comment-${commentId}`
                );


            if (commentElement) {

                commentElement.remove();

            }


            commentCount.textContent =
                data.comment_count;


            /*
            |----------------------------------------------------------------------
            | SHOW EMPTY STATE
            |----------------------------------------------------------------------
            */

            if (
                commentsList.children.length === 0
            ) {

                commentsList.innerHTML = `

                    <div
                        id="noComments"
                        class="p-8 rounded-2xl bg-[#F5F1E8] border border-[#D5DDD8] text-center"
                    >

                        <div class="text-3xl">
                            💬
                        </div>

                        <h3
                            class="mt-3 font-bold text-[#0F3F4A]"
                        >
                            No comments yet
                        </h3>

                        <p
                            class="mt-1 text-sm text-[#315F6D]"
                        >
                            Be the first to share your thoughts!
                        </p>

                    </div>

                `;

            }


            closeDeleteCommentModal();

        }

        catch (error) {

            console.error(
                'Delete comment error:',
                error
            );


            confirmDeleteComment.disabled = false;

            confirmDeleteComment.textContent =
                'Delete Comment';

            button.disabled = false;

            alert(
                'Something went wrong. Please try again.'
            );

        }

    }
);


    /*
|--------------------------------------------------------------------------
| EDIT COMMENT
|--------------------------------------------------------------------------
*/

const editCommentModal =
    document.getElementById('editCommentModal');

const editCommentModalBox =
    document.getElementById('editCommentModalBox');

const editCommentBody =
    document.getElementById('editCommentBody');

const editCommentError =
    document.getElementById('editCommentError');

const cancelEditComment =
    document.getElementById('cancelEditComment');

const confirmEditComment =
    document.getElementById('confirmEditComment');

let commentToEdit = null;


/*
|--------------------------------------------------------------------------
| OPEN EDIT MODAL
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'click',
    function (event) {

        const button =
            event.target.closest(
                '.edit-comment'
            );

        if (!button) {
            return;
        }


        const commentId =
            button.dataset.id;


        const commentElement =
            document.getElementById(
                `comment-${commentId}`
            );


        if (!commentElement) {
            return;
        }


        const bodyElement =
            commentElement.querySelector(
                '.comment-body'
            );


        if (!bodyElement) {
            return;
        }


        commentToEdit = button;


        editCommentBody.value =
            bodyElement.textContent.trim();


        editCommentError.classList.add(
            'hidden'
        );

        editCommentError.textContent = '';


        editCommentModal.classList.remove(
            'hidden'
        );

        editCommentModal.classList.add(
            'flex'
        );


        requestAnimationFrame(function () {

            editCommentModalBox.classList.remove(
                'scale-95',
                'opacity-0'
            );

            editCommentModalBox.classList.add(
                'scale-100',
                'opacity-100'
            );


            editCommentBody.focus();

        });

    }
);


/*
|--------------------------------------------------------------------------
| CLOSE EDIT MODAL
|--------------------------------------------------------------------------
*/

function closeEditCommentModal() {

    editCommentModalBox.classList.remove(
        'scale-100',
        'opacity-100'
    );

    editCommentModalBox.classList.add(
        'scale-95',
        'opacity-0'
    );


    setTimeout(function () {

    editCommentModal.classList.add(
        'hidden'
    );

    editCommentModal.classList.remove(
        'flex'
    );


    // Re-enable the original Edit button
    if (commentToEdit) {

        commentToEdit.disabled = false;

    }


    commentToEdit = null;


    editCommentBody.value = '';

    editCommentError.classList.add(
        'hidden'
    );

    editCommentError.textContent = '';

    confirmEditComment.disabled = false;

    confirmEditComment.textContent =
        'Save Changes';

}, 200);

}


/*
|--------------------------------------------------------------------------
| CANCEL
|--------------------------------------------------------------------------
*/

cancelEditComment.addEventListener(
    'click',
    function () {

        closeEditCommentModal();

    }
);


/*
|--------------------------------------------------------------------------
| CLICK OUTSIDE MODAL
|--------------------------------------------------------------------------
*/

editCommentModal.addEventListener(
    'click',
    function (event) {

        if (
            event.target ===
            editCommentModal
        ) {

            closeEditCommentModal();

        }

    }
);


/*
|--------------------------------------------------------------------------
| ESC KEY
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'keydown',
    function (event) {

        if (
            event.key === 'Escape' &&
            !editCommentModal.classList.contains(
                'hidden'
            )
        ) {

            closeEditCommentModal();

        }

    }
);


/*
|--------------------------------------------------------------------------
| SAVE EDITED COMMENT
|--------------------------------------------------------------------------
*/

confirmEditComment.addEventListener(
    'click',
    async function () {

        if (!commentToEdit) {
            return;
        }


        const newBody =
            editCommentBody.value.trim();


        /*
        |--------------------------------------------------------------------------
        | VALIDATE
        |--------------------------------------------------------------------------
        */

        if (!newBody) {

            editCommentError.textContent =
                'Please write a comment first.';

            editCommentError.classList.remove(
                'hidden'
            );

            editCommentBody.focus();

            return;

        }


        editCommentError.classList.add(
            'hidden'
        );


        const button =
            commentToEdit;

        const commentId =
            button.dataset.id;


        const commentElement =
            document.getElementById(
                `comment-${commentId}`
            );


        if (!commentElement) {
            return;
        }


        const bodyElement =
            commentElement.querySelector(
                '.comment-body'
            );


        button.disabled = true;

        confirmEditComment.disabled = true;

        confirmEditComment.textContent =
            'Saving...';


        try {

            const response =
                await fetch(
                    `/comments/${commentId}`,
                    {

                        method: 'PUT',

                        headers: {

                            'X-CSRF-TOKEN':
                                '{{ csrf_token() }}',

                            'Accept':
                                'application/json',

                            'Content-Type':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest'

                        },

                        body: JSON.stringify({
                            body: newBody
                        })

                    }
                );


            /*
            |--------------------------------------------------------------------------
            | VALIDATION ERROR
            |--------------------------------------------------------------------------
            */

            if (
                response.status === 422
            ) {

                const data =
                    await response.json();


                const firstError =
                    Object.values(
                        data.errors || {}
                    )[0]?.[0];


                throw new Error(
                    firstError ||
                    'Invalid comment.'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | OTHER ERROR
            |--------------------------------------------------------------------------
            */

            if (!response.ok) {

                throw new Error(
                    'Unable to update comment.'
                );

            }


            const data =
                await response.json();


            /*
            |--------------------------------------------------------------------------
            | UPDATE COMMENT ON PAGE
            |--------------------------------------------------------------------------
            */

            bodyElement.textContent =
                data.comment.body;


            /*
            |--------------------------------------------------------------------------
            | CLOSE MODAL
            |--------------------------------------------------------------------------
            */

            closeEditCommentModal();

        }

        catch (error) {

            console.error(
                'Edit comment error:',
                error
            );


            editCommentError.textContent =
                error.message ||
                'Something went wrong. Please try again.';


            editCommentError.classList.remove(
                'hidden'
            );


            confirmEditComment.disabled =
                false;

            confirmEditComment.textContent =
                'Save Changes';

            button.disabled =
                false;

        }

    }
);


    /*
    |--------------------------------------------------------------------------
    | ESCAPE HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value) {

        const div =
            document.createElement('div');

        div.textContent =
            value ?? '';

        return div.innerHTML;

    }

});

</script>

@endauth

@endsection
```
