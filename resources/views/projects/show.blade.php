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

                    {{-- Premium Access Message --}}
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
                    {{-- SOURCE CODE / DEMO --}}
                    {{-- ================================================= --}}

                    @if($project->github_url || $project->demo_url)

                        <div class="flex flex-wrap gap-4 mt-8">

                            {{-- GitHub --}}
                            @if($project->github_url)

                                <a
                                    href="{{ $project->github_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="px-5 py-3 rounded-xl
                                           bg-[#0F3F4A] text-white
                                           hover:opacity-90 transition"
                                >
                                    View Source Code
                                </a>

                            @endif


                            {{-- Live Demo --}}
                            @if($project->demo_url)

                                <a
                                    href="{{ $project->demo_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="px-5 py-3 rounded-xl
                                           bg-[#4F806D] text-white
                                           hover:bg-[#3E735F] transition"
                                >
                                    Live Demo
                                </a>

                            @endif

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- PROJECT RESOURCES --}}
                    {{-- ================================================= --}}

                    <div class="mt-10">

                        <h2 class="text-2xl font-bold text-[#0F3F4A]">
                            Project Resources
                        </h2>

                        <p class="text-[#315F6D] mt-2">
                            Download the files and resources for this project.
                        </p>


                        @if($project->resources->count())

                            <div class="mt-5 space-y-3">

                                @foreach($project->resources as $resource)

                                    <div
                                        class="flex items-center justify-between
                                               gap-4 p-4 rounded-xl
                                               bg-[#F5F1E8]
                                               border border-[#D5DDD8]"
                                    >

                                        {{-- File Information --}}
                                        <div class="min-w-0">

                                            <p
                                                class="font-semibold text-[#0F3F4A]
                                                       truncate"
                                            >
                                                {{ $resource->name }}
                                            </p>


                                            <p class="text-xs text-gray-500 mt-1">

                                                {{ strtoupper($resource->file_type ?? 'FILE') }}

                                                @if($resource->file_size)

                                                    •
                                                    {{ number_format($resource->file_size / 1024, 1) }}
                                                    KB

                                                @endif

                                            </p>

                                        </div>


                                        {{-- Download --}}
                                        <a
                                            href="{{ route(
                                                'project-resources.download',
                                                $resource
                                            ) }}"
                                            class="shrink-0 inline-block px-5 py-2
                                                   rounded-xl
                                                   bg-[#4F806D] text-white
                                                   hover:bg-[#3E735F]
                                                   transition"
                                        >
                                            Download
                                        </a>

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div
                                class="mt-5 p-6 rounded-2xl
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
                        class="mt-8 p-6 rounded-2xl
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
                                class="inline-block mt-4 px-5 py-3 rounded-xl
                                       bg-[#4F806D] text-white
                                       hover:bg-[#3E735F] transition"
                            >
                                Login to Continue
                            </a>


                        {{-- ================================================= --}}
                        {{-- LOGGED IN WITHOUT ACTIVE SUBSCRIPTION --}}
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
                                    class="px-5 py-3 rounded-xl
                                           bg-[#4F806D] text-white
                                           hover:bg-[#3E735F] transition"
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