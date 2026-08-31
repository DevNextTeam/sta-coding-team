@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#F5F1E8] py-12 px-6">

    <div class="max-w-6xl mx-auto">

        {{-- ========================================= --}}
        {{-- HEADER --}}
        {{-- ========================================= --}}

        <div class="flex flex-col sm:flex-row sm:justify-between
                    sm:items-center gap-5 mb-10">

            <div>

                <p class="text-sm tracking-[0.3em] text-[#B87945] uppercase">
                    Admin
                </p>

                <h1 class="text-4xl font-bold text-[#0F3F4A] mt-2">
                    Manage Projects
                </h1>

                <p class="text-[#315F6D] mt-2">
                    Create, edit, and manage your projects and resources.
                </p>

            </div>


            <a
                href="{{ route('admin.projects.create') }}"
                class="inline-flex items-center justify-center
                       px-5 py-3 rounded-xl
                       bg-[#4F806D] text-white
                       font-medium
                       hover:bg-[#3E735F]
                       transition"
            >
                + Add Project
            </a>

        </div>


        {{-- ========================================= --}}
        {{-- SUCCESS MESSAGE --}}
        {{-- ========================================= --}}

        @if(session('success'))

            <div class="mb-6 p-4 rounded-xl
                        bg-[#DCEAE4]
                        border border-[#BFD8CE]
                        text-[#3E735F]">

                {{ session('success') }}

            </div>

        @endif


        {{-- ========================================= --}}
        {{-- PROJECT LIST --}}
        {{-- ========================================= --}}

        <div class="space-y-5">

            @forelse($projects as $project)

                <div class="bg-white rounded-2xl
                            border border-[#D5DDD8]
                            shadow-sm overflow-hidden">

                    <div class="p-6">

                        <div class="flex flex-col lg:flex-row
                                    lg:items-center
                                    lg:justify-between gap-6">


                            {{-- ================================= --}}
                            {{-- PROJECT INFORMATION --}}
                            {{-- ================================= --}}

                            <div class="flex items-start gap-5 min-w-0">


                                {{-- Project Image --}}

                                @if($project->image)

                                    <img
                                        src="{{ asset('storage/' . $project->image) }}"
                                        alt="{{ $project->title }}"
                                        class="w-24 h-24 rounded-xl
                                               object-cover shrink-0
                                               border border-[#D5DDD8]"
                                    >

                                @else

                                    <div
                                        class="w-24 h-24 rounded-xl
                                               bg-[#F5F1E8]
                                               border border-[#D5DDD8]
                                               flex items-center justify-center
                                               text-[#B87945]
                                               text-xs
                                               shrink-0"
                                    >
                                        No Image
                                    </div>

                                @endif


                                {{-- Information --}}

                                <div class="min-w-0">

                                    <h2 class="text-xl font-bold
                                               text-[#0F3F4A]">

                                        {{ $project->title }}

                                    </h2>


                                    <p class="text-sm text-[#315F6D] mt-1">

                                        {{ $project->category ?? 'Uncategorized' }}

                                    </p>


                                    {{-- Badges --}}

                                    <div class="flex flex-wrap gap-2 mt-3">


                                        {{-- Premium / Free --}}

                                        @if($project->is_premium)

                                            <span
                                                class="px-3 py-1 rounded-full
                                                       text-xs font-semibold
                                                       bg-[#F1E3D4]
                                                       text-[#A45F2C]"
                                            >
                                                🔒 Premium
                                            </span>

                                        @else

                                            <span
                                                class="px-3 py-1 rounded-full
                                                       text-xs font-semibold
                                                       bg-[#DCEAE4]
                                                       text-[#3E735F]"
                                            >
                                                ✓ Free
                                            </span>

                                        @endif


                                        {{-- Published --}}

                                        @if($project->published_at)

                                            <span
                                                class="px-3 py-1 rounded-full
                                                       text-xs font-semibold
                                                       bg-[#DCEAE4]
                                                       text-[#3E735F]"
                                            >
                                                Published
                                            </span>

                                        @else

                                            <span
                                                class="px-3 py-1 rounded-full
                                                       text-xs font-semibold
                                                       bg-gray-100
                                                       text-gray-600"
                                            >
                                                Draft
                                            </span>

                                        @endif


                                        {{-- Resources --}}

                                        <span
                                            class="px-3 py-1 rounded-full
                                                   text-xs font-semibold
                                                   bg-[#F5F1E8]
                                                   text-[#315F6D]"
                                        >
                                            {{ $project->resources->count() }}
                                            {{ $project->resources->count() === 1 ? 'Resource' : 'Resources' }}
                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- ================================= --}}
                            {{-- ACTIONS --}}
                            {{-- ================================= --}}

                            <div class="flex flex-wrap gap-2 shrink-0">


                                {{-- View --}}

                                <a
                                    href="{{ route('projects.show', $project) }}"
                                    class="px-4 py-2 rounded-xl
                                           border border-[#D5DDD8]
                                           text-[#315F6D]
                                           hover:bg-[#F5F1E8]
                                           transition"
                                >
                                    View
                                </a>


                                {{-- Edit --}}

                                <a
                                    href="{{ route('admin.projects.edit', $project) }}"
                                    class="px-4 py-2 rounded-xl
                                           bg-[#E4EEF0]
                                           text-[#0F3F4A]
                                           hover:opacity-80
                                           transition"
                                >
                                    Edit
                                </a>


                                {{-- Delete --}}

                                <form
                                    action="{{ route('admin.projects.destroy', $project) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Are you sure you want to delete this project?')"
                                        class="px-4 py-2 rounded-xl
                                               bg-[#F5E6D8]
                                               text-[#A45F2C]
                                               hover:bg-[#EEDAC8]
                                               transition"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                {{-- ========================================= --}}
                {{-- NO PROJECTS --}}
                {{-- ========================================= --}}

                <div
                    class="bg-white rounded-2xl
                           p-12 text-center
                           border border-[#D5DDD8]
                           shadow-sm"
                >

                    <div class="text-4xl mb-4">
                        📁
                    </div>

                    <h2 class="text-xl font-bold text-[#0F3F4A]">
                        No projects yet
                    </h2>

                    <p class="text-[#315F6D] mt-2">
                        Create your first project to get started.
                    </p>


                    <a
                        href="{{ route('admin.projects.create') }}"
                        class="inline-block mt-6
                               px-5 py-3 rounded-xl
                               bg-[#4F806D] text-white
                               hover:bg-[#3E735F]
                               transition"
                    >
                        + Add Your First Project
                    </a>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection