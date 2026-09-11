@extends('layouts.app')

@section('title', 'Edit Project — DevNext')

@section('content')

<div class="min-h-screen bg-[#F5F1E8]">

    <main class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

        {{-- Back --}}
        <div class="mb-6">
            <a
                href="{{ route('developer.projects.index') }}"
                class="text-sm font-medium text-[#4F806D] hover:text-[#3E735F] transition"
            >
                ← My Projects
            </a>
        </div>

        {{-- Header --}}
        <div class="mb-8">

            <p class="text-sm font-semibold uppercase tracking-widest text-[#B87945]">
                Developer Studio
            </p>

            <h1 class="text-3xl sm:text-4xl font-bold text-[#29483D] mt-1">
                Edit Project
            </h1>

            <p class="mt-2 text-gray-600">
                Update your project information.
            </p>

        </div>

        {{-- Form --}}
        <form
            action="{{ route('developer.projects.update', $project) }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-white rounded-2xl sm:rounded-3xl border border-[#D9E2DD] shadow-sm p-5 sm:p-8"
        >

            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-6">

                <label
                    for="title"
                    class="block text-sm font-semibold text-[#29483D] mb-2"
                >
                    Project Title
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $project->title) }}"
                    required
                    class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 outline-none focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                >

                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

            </div>

            {{-- Description --}}
            <div class="mb-6">

                <label
                    for="description"
                    class="block text-sm font-semibold text-[#29483D] mb-2"
                >
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="6"
                    required
                    class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 outline-none resize-y focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                >{{ old('description', $project->description) }}</textarea>

                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

            </div>

            {{-- Category --}}
            <div class="mb-6">

                <label
                    for="category"
                    class="block text-sm font-semibold text-[#29483D] mb-2"
                >
                    Category
                </label>

                <input
                    type="text"
                    id="category"
                    name="category"
                    value="{{ old('category', $project->category) }}"
                    placeholder="e.g. Web Development, Java, Arduino"
                    class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 outline-none focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                >

                @error('category')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

            </div>

            {{-- Current Image --}}
            @if($project->image)

                <div class="mb-6">

                    <p class="block text-sm font-semibold text-[#29483D] mb-2">
                        Current Project Image
                    </p>

                    <img
                        src="{{ asset('storage/' . $project->image) }}"
                        alt="{{ $project->title }}"
                        class="w-full max-w-md h-48 object-cover rounded-xl border border-[#D9E2DD]"
                    >

                </div>

            @endif

            {{-- New Image --}}
            <div class="mb-6">

                <label
                    for="image"
                    class="block text-sm font-semibold text-[#29483D] mb-2"
                >
                    {{ $project->image ? 'Replace Project Image' : 'Project Image' }}
                </label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    accept="image/*"
                    class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 text-sm bg-white"
                >

                <p class="mt-2 text-xs text-gray-500">
                    Maximum size: 5 MB. Leave empty to keep the current image.
                </p>

                @error('image')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

            </div>

            {{-- GitHub --}}
            <div class="mb-6">

                <label
                    for="github_url"
                    class="block text-sm font-semibold text-[#29483D] mb-2"
                >
                    GitHub URL
                </label>

                <input
                    type="url"
                    id="github_url"
                    name="github_url"
                    value="{{ old('github_url', $project->github_url) }}"
                    placeholder="https://github.com/username/project"
                    class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 outline-none focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                >

                @error('github_url')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

            </div>

            {{-- Demo --}}
            <div class="mb-6">

                <label
                    for="demo_url"
                    class="block text-sm font-semibold text-[#29483D] mb-2"
                >
                    Live Demo URL
                </label>

                <input
                    type="url"
                    id="demo_url"
                    name="demo_url"
                    value="{{ old('demo_url', $project->demo_url) }}"
                    placeholder="https://example.com"
                    class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 outline-none focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                >

                @error('demo_url')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

            </div>

            {{-- Video --}}
            <div class="mb-6">

                <label
                    for="video_url"
                    class="block text-sm font-semibold text-[#29483D] mb-2"
                >
                    Project Video URL
                </label>

                <input
                    type="url"
                    id="video_url"
                    name="video_url"
                    value="{{ old('video_url', $project->video_url) }}"
                    placeholder="https://youtube.com/watch?v=..."
                    class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 outline-none focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                >

                @error('video_url')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

            </div>

            {{-- Publish --}}
            <div class="mb-8">

                <label class="flex items-start gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="published"
                        value="1"
                        {{ $project->published_at ? 'checked' : '' }}
                        class="mt-1 w-4 h-4 rounded border-gray-300 text-[#4F806D] focus:ring-[#4F806D]"
                    >

                    <div>

                        <span class="block text-sm font-semibold text-[#29483D]">
                            Publish this project
                        </span>

                        <span class="block text-xs text-gray-500 mt-1">
                            Published projects appear on your public developer profile.
                        </span>

                    </div>

                </label>

            </div>

            {{-- Buttons --}}
            <div class="flex flex-col sm:flex-row gap-3">

                <a
                    href="{{ route('developer.projects.index') }}"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-[#CBD8D2] text-[#29483D] text-sm font-semibold hover:bg-[#F5F1E8] transition"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-[#4F806D] text-white text-sm font-semibold hover:bg-[#3E735F] transition"
                >
                    Save Changes
                </button>

            </div>

        </form>

    </main>

</div>

@endsection