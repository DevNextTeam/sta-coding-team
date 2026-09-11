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
                Update your project information, resources, and project guide.
            </p>

        </div>


        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif


        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">
                <p class="font-semibold text-red-700 mb-2">
                    Please fix the following:
                </p>

                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- ========================================================= --}}
        {{-- MAIN PROJECT FORM --}}
        {{-- ========================================================= --}}

        <form
            action="{{ route('developer.projects.update', $project) }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-white rounded-2xl sm:rounded-3xl border border-[#D9E2DD] shadow-sm p-5 sm:p-8"
        >

            @csrf
            @method('PUT')


            {{-- Project Information --}}
            <div class="mb-10">

                <div class="mb-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-[#B87945]">
                        Project Information
                    </p>

                    <h2 class="text-2xl font-bold text-[#29483D] mt-1">
                        Basic Details
                    </h2>
                </div>


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
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
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
                        rows="7"
                        required
                        class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 outline-none resize-y focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                    >{{ old('description', $project->description) }}</textarea>

                    <p class="mt-2 text-xs text-gray-500">
                        You can use line breaks to organize your project description.
                    </p>

                    @error('description')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
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
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
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

                        <p class="mt-2 text-xs text-gray-500">
                            Current image:
                            {{ $project->image }}
                        </p>

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
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- LINKS --}}
            {{-- ========================================================= --}}

            <div class="mb-10 border-t border-[#E2E9E5] pt-8">

                <div class="mb-6">

                    <p class="text-xs font-bold uppercase tracking-widest text-[#B87945]">
                        Project Links
                    </p>

                    <h2 class="text-2xl font-bold text-[#29483D] mt-1">
                        Online Resources
                    </h2>

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

                    <p class="mt-2 text-xs text-gray-500">
                        Link to your project's source code repository.
                    </p>

                    @error('github_url')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
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

                    <p class="mt-2 text-xs text-gray-500">
                        Link where visitors can try your project online.
                    </p>

                    @error('demo_url')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
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

                    <p class="mt-2 text-xs text-gray-500">
                        Add a YouTube video demonstrating your project.
                    </p>

                    @error('video_url')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- PUBLISH --}}
            {{-- ========================================================= --}}

            <div class="mb-10 border-t border-[#E2E9E5] pt-8">

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
                            Published projects can appear on your public developer profile and the Projects page.
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


        {{-- ========================================================= --}}
        {{-- PROJECT RESOURCES --}}
        {{-- ========================================================= --}}

        <section class="mt-8 bg-white rounded-2xl sm:rounded-3xl border border-[#D9E2DD] shadow-sm p-5 sm:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

                <div>

                    <p class="text-xs font-bold uppercase tracking-widest text-[#B87945]">
                        Project Files
                    </p>

                    <h2 class="text-2xl font-bold text-[#29483D] mt-1">
                        Project Resources
                    </h2>

                    <p class="text-sm text-gray-600 mt-2">
                        Upload source code, documents, files, or other resources related to this project.
                    </p>

                </div>

            </div>


            {{-- Upload Resource --}}
            <form
                action="{{ route('developer.projects.resources.store', $project) }}"
                method="POST"
                enctype="multipart/form-data"
                class="border border-dashed border-[#CBD8D2] rounded-2xl p-5 bg-[#F9FBFA]"
            >

                @csrf

                <div class="mb-4">

                    <label
                        for="resource_file"
                        class="block text-sm font-semibold text-[#29483D] mb-2"
                    >
                        Upload Resource
                    </label>

                    <input
                        type="file"
                        id="resource_file"
                        name="file"
                        required
                        class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 text-sm bg-white"
                    >

                    <p class="mt-2 text-xs text-gray-500">
                        Maximum file size: 10 MB.
                    </p>

                    @error('file')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-[#4F806D] text-white text-sm font-semibold hover:bg-[#3E735F] transition"
                >
                    + Upload Resource
                </button>

            </form>


            {{-- Existing Resources --}}
            <div class="mt-8">

                <h3 class="text-lg font-bold text-[#29483D] mb-4">
                    Existing Resources
                </h3>

                @if($project->resources->count())

                    <div class="space-y-3">

                        @foreach($project->resources as $resource)

                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 rounded-2xl border border-[#D9E2DD] p-4">

                                <div class="min-w-0">

                                    <p class="font-semibold text-[#29483D] break-words">
                                        {{ $resource->name }}
                                    </p>

                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $resource->file_type ?: 'File' }}
                                        ·
                                        {{ number_format($resource->file_size / 1024, 1) }} KB
                                    </p>

                                </div>


                                <form
                                    action="{{ route('developer.projects.resources.destroy', $resource) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this resource?');"
                                    class="shrink-0"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="inline-flex items-center justify-center px-4 py-2 rounded-xl border border-red-200 text-red-600 text-sm font-semibold hover:bg-red-50 transition"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="rounded-2xl border border-[#E2E9E5] bg-[#F9FBFA] p-6 text-center">

                        <p class="text-sm text-gray-500">
                            No project resources have been uploaded yet.
                        </p>

                    </div>

                @endif

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- PROJECT GUIDE --}}
        {{-- ========================================================= --}}

        <section class="mt-8 bg-white rounded-2xl sm:rounded-3xl border border-[#D9E2DD] shadow-sm p-5 sm:p-8">

            <div class="mb-6">

                <p class="text-xs font-bold uppercase tracking-widest text-[#B87945]">
                    Project Guide
                </p>

                <h2 class="text-2xl font-bold text-[#29483D] mt-1">
                    Project Instructions
                </h2>

                <p class="text-sm text-gray-600 mt-2">
                    Create a step-by-step guide to help other developers understand or use your project.
                </p>

            </div>


            {{-- Add New Step --}}
            <div class="border border-dashed border-[#CBD8D2] rounded-2xl p-5 bg-[#F9FBFA]">

                <h3 class="text-lg font-bold text-[#29483D] mb-5">
                    + Add New Step
                </h3>

                <form
                    action="{{ route('developer.projects.instructions.store', $project) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf


                    {{-- Step --}}
                    <div class="mb-5">

                        <label
                            for="step"
                            class="block text-sm font-semibold text-[#29483D] mb-2"
                        >
                            Step Number
                        </label>

                        <input
                            type="number"
                            id="step"
                            name="step"
                            min="1"
                            value="{{ old('step') }}"
                            required
                            placeholder="1"
                            class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 outline-none focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                        >

                    </div>


                    {{-- Title --}}
                    <div class="mb-5">

                        <label
                            for="instruction_title"
                            class="block text-sm font-semibold text-[#29483D] mb-2"
                        >
                            Step Title
                        </label>

                        <input
                            type="text"
                            id="instruction_title"
                            name="title"
                            value="{{ old('title') }}"
                            required
                            placeholder="e.g. Connect the Arduino"
                            class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 outline-none focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                        >

                    </div>


                    {{-- Description --}}
                    <div class="mb-5">

                        <label
                            for="instruction_description"
                            class="block text-sm font-semibold text-[#29483D] mb-2"
                        >
                            Instructions
                        </label>

                        <textarea
                            id="instruction_description"
                            name="description"
                            rows="6"
                            required
                            placeholder="Explain what the user needs to do in this step..."
                            class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 outline-none resize-y focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                        >{{ old('description') }}</textarea>

                    </div>


                    {{-- Image --}}
                    <div class="mb-5">

                        <label
                            for="instruction_image"
                            class="block text-sm font-semibold text-[#29483D] mb-2"
                        >
                            Instruction Image
                        </label>

                        <input
                            type="file"
                            id="instruction_image"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                            class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 text-sm bg-white"
                        >

                        <p class="mt-2 text-xs text-gray-500">
                            JPG, JPEG, PNG, or WEBP. Maximum size: 2 MB.
                        </p>

                    </div>


                    <button
                        type="submit"
                        class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-[#4F806D] text-white text-sm font-semibold hover:bg-[#3E735F] transition"
                    >
                        Add Step
                    </button>

                </form>

            </div>


            {{-- Existing Steps --}}
            <div class="mt-8">

                <h3 class="text-lg font-bold text-[#29483D] mb-4">
                    Existing Steps
                </h3>

                @if($project->instructions->count())

                    <div class="space-y-5">

                        @foreach($project->instructions as $instruction)

                            <div class="rounded-2xl border border-[#D9E2DD] overflow-hidden">

                                <div class="p-5">

                                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">

                                        <div>

                                            <p class="text-xs font-bold uppercase tracking-widest text-[#B87945]">
                                                Step {{ $instruction->step }}
                                            </p>

                                            <h4 class="text-xl font-bold text-[#29483D] mt-1">
                                                {{ $instruction->title }}
                                            </h4>

                                        </div>


                                        <div class="flex gap-2 shrink-0">

                                            {{-- Edit --}}
                                            <button
                                                type="button"
                                                onclick="document.getElementById('edit-instruction-{{ $instruction->id }}').classList.toggle('hidden')"
                                                class="px-4 py-2 rounded-xl border border-[#CBD8D2] text-[#29483D] text-sm font-semibold hover:bg-[#F5F1E8] transition"
                                            >
                                                Edit
                                            </button>


                                            {{-- Delete --}}
                                            <form
                                                action="{{ route('developer.projects.instructions.destroy', $instruction) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this project step?');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="px-4 py-2 rounded-xl border border-red-200 text-red-600 text-sm font-semibold hover:bg-red-50 transition"
                                                >
                                                    Delete
                                                </button>

                                            </form>

                                        </div>

                                    </div>


                                    {{-- Instruction Image --}}
                                    @if($instruction->image)

                                        <div class="mt-5">

                                            <img
                                                src="{{ asset('storage/' . $instruction->image) }}"
                                                alt="{{ $instruction->title }}"
                                                class="w-full max-w-2xl max-h-96 object-contain rounded-xl border border-[#D9E2DD] bg-[#F9FBFA]"
                                            >

                                        </div>

                                    @endif


                                    {{-- Description --}}
                                    <div class="mt-5 text-sm text-gray-700 whitespace-pre-line">
                                        {{ $instruction->description }}
                                    </div>

                                </div>


                                {{-- Edit Form --}}
                                <div
                                    id="edit-instruction-{{ $instruction->id }}"
                                    class="hidden border-t border-[#D9E2DD] bg-[#F9FBFA] p-5"
                                >

                                    <h4 class="text-lg font-bold text-[#29483D] mb-5">
                                        Edit Step {{ $instruction->step }}
                                    </h4>


                                    <form
                                        action="{{ route('developer.projects.instructions.update', $instruction) }}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                    >

                                        @csrf
                                        @method('PUT')


                                        {{-- Step --}}
                                        <div class="mb-5">

                                            <label
                                                class="block text-sm font-semibold text-[#29483D] mb-2"
                                            >
                                                Step Number
                                            </label>

                                            <input
                                                type="number"
                                                name="step"
                                                min="1"
                                                value="{{ $instruction->step }}"
                                                required
                                                class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 outline-none focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                                            >

                                        </div>


                                        {{-- Title --}}
                                        <div class="mb-5">

                                            <label
                                                class="block text-sm font-semibold text-[#29483D] mb-2"
                                            >
                                                Step Title
                                            </label>

                                            <input
                                                type="text"
                                                name="title"
                                                value="{{ $instruction->title }}"
                                                required
                                                class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 outline-none focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                                            >

                                        </div>


                                        {{-- Description --}}
                                        <div class="mb-5">

                                            <label
                                                class="block text-sm font-semibold text-[#29483D] mb-2"
                                            >
                                                Instructions
                                            </label>

                                            <textarea
                                                name="description"
                                                rows="6"
                                                required
                                                class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 outline-none resize-y focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                                            >{{ $instruction->description }}</textarea>

                                        </div>


                                        {{-- Image --}}
                                        <div class="mb-5">

                                            <label
                                                class="block text-sm font-semibold text-[#29483D] mb-2"
                                            >
                                                Replace Instruction Image
                                            </label>

                                            <input
                                                type="file"
                                                name="image"
                                                accept="image/jpeg,image/png,image/webp"
                                                class="w-full rounded-xl border border-[#CBD8D2] px-4 py-3 text-sm bg-white"
                                            >

                                            <p class="mt-2 text-xs text-gray-500">
                                                Leave empty to keep the current image.
                                                Maximum size: 2 MB.
                                            </p>

                                        </div>


                                        <div class="flex flex-col sm:flex-row gap-3">

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-[#4F806D] text-white text-sm font-semibold hover:bg-[#3E735F] transition"
                                            >
                                                Save Step
                                            </button>

                                            <button
                                                type="button"
                                                onclick="document.getElementById('edit-instruction-{{ $instruction->id }}').classList.add('hidden')"
                                                class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-[#CBD8D2] text-[#29483D] text-sm font-semibold hover:bg-white transition"
                                            >
                                                Cancel
                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="rounded-2xl border border-[#E2E9E5] bg-[#F9FBFA] p-6 text-center">

                        <p class="text-sm text-gray-500">
                            No project instructions have been added yet.
                        </p>

                    </div>

                @endif

            </div>

        </section>


    </main>

</div>

@endsection