@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#F5F1E8] py-12 px-6">

    <div class="max-w-4xl mx-auto">

        {{-- Back --}}
        <a
            href="{{ route('projects.index') }}"
            class="text-[#4F806D] hover:underline"
        >
            ← Back to Projects
        </a>


        {{-- Project Card --}}
        <div class="bg-white rounded-2xl overflow-hidden
                    border border-[#D5DDD8]
                    shadow-sm mt-6">

            {{-- Project Image --}}
            @if($project->image)

                <img
                    src="{{ asset('storage/' . $project->image) }}"
                    alt="{{ $project->title }}"
                    class="w-full h-72 object-cover"
                >

            @endif


            <div class="p-8">

                {{-- Category --}}
                @if($project->category)

                    <p class="text-sm uppercase tracking-wider
                              text-[#B87945]">
                        {{ $project->category }}
                    </p>

                @endif


                {{-- Title --}}
                <h1 class="text-4xl font-bold text-[#0F3F4A] mt-2">
                    {{ $project->title }}
                </h1>


                {{-- Premium / Free Badge --}}
                @if($project->is_premium)

                    <span class="inline-flex items-center gap-1
                                 mt-4 px-3 py-1
                                 rounded-full text-xs font-semibold
                                 bg-[#F1E3D4] text-[#A45F2C]">

                        🔒 Premium Project

                    </span>

                @else

                    <span class="inline-block mt-4 px-3 py-1
                                 rounded-full text-xs font-semibold
                                 bg-[#DCEAE4] text-[#3E735F]">

                        ✓ Free Project

                    </span>

                @endif


                {{-- Description --}}
                <div class="mt-6 text-[#315F6D] leading-7">
                    {{ $project->description }}
                </div>


                {{-- ================================================= --}}
                {{-- ACCESS GRANTED --}}
                {{-- ================================================= --}}

                @if($hasAccess)


                    {{-- ================================================= --}}
                    {{-- PREMIUM ACCESS MESSAGE --}}
                    {{-- ================================================= --}}

                    @if($project->is_premium)

                        <div class="mt-8 p-5 rounded-2xl
                                    bg-[#DCEAE4]
                                    border border-[#BFD8CE]">

                            <div class="flex items-center gap-3">

                                <span class="text-xl">
                                    ✓
                                </span>

                                <div>

                                    <h3 class="font-bold text-[#3E735F]">
                                        Premium Access Granted
                                    </h3>

                                    <p class="text-sm text-[#315F6D] mt-1">
                                        Your active subscription gives you access
                                        to this project and its resources.
                                    </p>

                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- SOURCE CODE / GITHUB / DEMO --}}
                    {{-- ================================================= --}}

                    @php

                        /*
                        |--------------------------------------------------------------------------
                        | Find the first source-code resource
                        |--------------------------------------------------------------------------
                        */

                        $sourceResource = $project->resources->first(
                            function ($resource) {

                                $fileName = strtolower($resource->name ?? '');

                                $allowedExtensions = [
                                    '.php',
                                    '.blade.php',
                                    '.css',
                                    '.js',
                                    '.jsx',
                                    '.ts',
                                    '.tsx',
                                    '.html',
                                    '.htm',
                                    '.json',
                                    '.xml',
                                    '.sql',
                                    '.md',
                                    '.txt',
                                    '.vue',
                                    '.env.example',
                                    '.gitignore',
                                ];

                                foreach ($allowedExtensions as $extension) {

                                    if (str_ends_with($fileName, $extension)) {
                                        return true;
                                    }

                                }

                                return false;
                            }
                        );

                    @endphp


                    <div class="flex flex-wrap gap-4 mt-8">


                        {{-- ================================================= --}}
                        {{-- VIEW SOURCE CODE --}}
                        {{-- ================================================= --}}

                        @if($sourceResource)

                            <a
                                href="{{ route(
                                    'project-resources.view',
                                    $sourceResource
                                ) }}"
                                class="inline-flex items-center gap-2
                                       px-5 py-3
                                       rounded-xl
                                       bg-[#0F3F4A]
                                       text-white
                                       hover:opacity-90
                                       transition"
                            >

                                <span>
                                    &lt;/&gt;
                                </span>

                                <span>
                                    View Source Code
                                </span>

                            </a>

                        @endif


                        {{-- ================================================= --}}
                        {{-- GITHUB --}}
                        {{-- ================================================= --}}

                        @if($project->github_url)

                            <a
                                href="{{ $project->github_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-2
                                       px-5 py-3
                                       rounded-xl
                                       bg-gray-800
                                       text-white
                                       hover:bg-gray-700
                                       transition"
                            >

                                <span>
                                    GitHub
                                </span>

                            </a>

                        @endif


                        {{-- ================================================= --}}
                        {{-- LIVE DEMO --}}
                        {{-- ================================================= --}}

                        @if($project->demo_url)

                            <a
                                href="{{ $project->demo_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-2
                                       px-5 py-3
                                       rounded-xl
                                       bg-[#4F806D]
                                       text-white
                                       hover:bg-[#3E735F]
                                       transition"
                            >

                                <span>
                                    Live Demo
                                </span>

                                <span>
                                    ↗
                                </span>

                            </a>

                        @endif

                    </div>


                    {{-- ================================================= --}}
                    {{-- PROJECT RESOURCES --}}
                    {{-- ================================================= --}}

                    <div class="mt-10">

                        <h2 class="text-2xl font-bold text-[#0F3F4A]">
                            Project Resources
                        </h2>

                        <p class="text-[#315F6D] mt-2">
                            View or download the files and resources for this project.
                        </p>


                        @if($project->resources->count())


                            <div class="mt-5 space-y-3">

                                @foreach($project->resources as $resource)


                                    @php

                                        /*
                                        |--------------------------------------------------------------------------
                                        | Determine if resource can be viewed
                                        |--------------------------------------------------------------------------
                                        */

                                        $fileName = strtolower(
                                            $resource->name ?? ''
                                        );

                                        $allowedExtensions = [
                                            '.php',
                                            '.blade.php',
                                            '.css',
                                            '.js',
                                            '.jsx',
                                            '.ts',
                                            '.tsx',
                                            '.html',
                                            '.htm',
                                            '.json',
                                            '.xml',
                                            '.sql',
                                            '.md',
                                            '.txt',
                                            '.vue',
                                            '.env.example',
                                            '.gitignore',
                                        ];

                                        $canView = false;

                                        foreach ($allowedExtensions as $extension) {

                                            if (str_ends_with($fileName, $extension)) {
                                                $canView = true;
                                                break;
                                            }

                                        }

                                    @endphp


                                    <div
                                        class="flex items-center justify-between
                                               gap-4
                                               p-4
                                               rounded-xl
                                               bg-[#F5F1E8]
                                               border border-[#D5DDD8]"
                                    >


                                        {{-- ================================================= --}}
                                        {{-- FILE INFORMATION --}}
                                        {{-- ================================================= --}}

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

                                                {{ strtoupper($resource->file_type ?? 'FILE') }}

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


                                        {{-- ================================================= --}}
                                        {{-- RESOURCE BUTTONS --}}
                                        {{-- ================================================= --}}

                                        <div
                                            class="flex
                                                   flex-wrap
                                                   gap-2
                                                   shrink-0"
                                        >


                                            {{-- ================================================= --}}
                                            {{-- VIEW --}}
                                            {{-- ================================================= --}}

                                            @if($canView)

                                                <a
                                                    href="{{ route(
                                                        'project-resources.view',
                                                        $resource
                                                    ) }}"
                                                    class="inline-flex
                                                           items-center
                                                           gap-1
                                                           px-4
                                                           py-2
                                                           rounded-xl
                                                           bg-[#0F3F4A]
                                                           text-white
                                                           hover:opacity-90
                                                           transition"
                                                >

                                                    <span>
                                                        View
                                                    </span>

                                                </a>

                                            @endif


                                            {{-- ================================================= --}}
                                            {{-- DOWNLOAD --}}
                                            {{-- ================================================= --}}

                                            <a
                                                href="{{ route(
                                                    'project-resources.download',
                                                    $resource
                                                ) }}"
                                                class="inline-flex
                                                       items-center
                                                       gap-1
                                                       px-4
                                                       py-2
                                                       rounded-xl
                                                       bg-[#4F806D]
                                                       text-white
                                                       hover:bg-[#3E735F]
                                                       transition"
                                            >

                                                <span>
                                                    Download
                                                </span>

                                            </a>

                                        </div>

                                    </div>


                                @endforeach

                            </div>


                        @else


                            {{-- ================================================= --}}
                            {{-- NO RESOURCES --}}
                            {{-- ================================================= --}}

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

                        <h2 class="text-xl font-bold text-[#A45F2C]">
                            🔒 Premium Project
                        </h2>


                        <p class="text-[#7A5538] mt-2">
                            This project is available to subscribers.
                            Subscribe to access the source code and
                            project resources.
                        </p>


                        {{-- ================================================= --}}
                        {{-- GUEST --}}
                        {{-- ================================================= --}}

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


                        {{-- ================================================= --}}
                        {{-- LOGGED IN WITHOUT SUBSCRIPTION --}}
                        {{-- ================================================= --}}

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

@endsection