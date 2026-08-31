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
                {{-- PREMIUM / FREE BADGE --}}
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
                {{-- ACCESS GRANTED --}}
                {{-- ================================================= --}}

                @if($hasAccess)

                    {{-- ============================================= --}}
                    {{-- PREMIUM ACCESS MESSAGE --}}
                    {{-- ============================================= --}}

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
                    {{-- SOURCE CODE / GITHUB / DEMO --}}
                    {{-- ================================================= --}}

                    <div class="flex flex-wrap gap-4 mt-8">

                        {{-- ============================================= --}}
                        {{-- FIND SOURCE CODE RESOURCE --}}
                        {{-- ============================================= --}}

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

                                    $fileName = strtolower($resource->name ?? '');

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


                        {{-- ============================================= --}}
                        {{-- VIEW SOURCE CODE --}}
                        {{-- ============================================= --}}

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


                        {{-- ============================================= --}}
                        {{-- GITHUB --}}
                        {{-- ============================================= --}}

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


                        {{-- ============================================= --}}
                        {{-- LIVE DEMO --}}
                        {{-- ============================================= --}}

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
                    {{-- PROJECT INSTRUCTIONS --}}
                    {{-- ================================================= --}}

                    @if($project->instructions->count())

                        <div class="mt-12">

                            {{-- ========================================= --}}
                            {{-- SECTION HEADER --}}
                            {{-- ========================================= --}}

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


                            {{-- ========================================= --}}
                            {{-- INSTRUCTION LIST --}}
                            {{-- ========================================= --}}

                            <div class="space-y-6">

                                @foreach($project->instructions as $instruction)

                                    <div
                                        class="relative
                                               bg-[#F5F1E8]
                                               border border-[#D5DDD8]
                                               rounded-2xl
                                               p-6"
                                    >

                                        {{-- ================================= --}}
                                        {{-- STEP HEADER --}}
                                        {{-- ================================= --}}

                                        <div class="flex items-start gap-4">

                                            {{-- STEP NUMBER --}}

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


                                            {{-- TITLE + DESCRIPTION --}}

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


                                        {{-- ================================= --}}
                                        {{-- INSTRUCTION IMAGE --}}
                                        {{-- ================================= --}}

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

                                        {{-- ================================= --}}
                                        {{-- FILE INFORMATION --}}
                                        {{-- ================================= --}}

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


                                        {{-- ================================= --}}
                                        {{-- BUTTONS --}}
                                        {{-- ================================= --}}

                                        <div
                                            class="flex
                                                   gap-2
                                                   shrink-0"
                                        >

                                            {{-- ================================= --}}
                                            {{-- VIEW --}}
                                            {{-- ================================= --}}

                                            @php

                                                $fileName = strtolower(
                                                    $resource->name ?? ''
                                                );

                                                $canView = false;

                                                foreach ($sourceExtensions as $extension) {

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


                                            {{-- ================================= --}}
                                            {{-- DOWNLOAD --}}
                                            {{-- ================================= --}}

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
                            instructions, and project resources.
                        </p>


                        {{-- ============================================= --}}
                        {{-- GUEST --}}
                        {{-- ============================================= --}}

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


                        {{-- ============================================= --}}
                        {{-- LOGGED IN WITHOUT SUBSCRIPTION --}}
                        {{-- ============================================= --}}

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