@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-10">

    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <div class="mb-8">

        <a
            href="{{ route('admin.projects.index') }}"
            class="text-[#4f8775]"
        >
            ← Back to Projects
        </a>

        <p class="text-sm tracking-[0.3em] text-orange-500 mt-6">
            ADMIN
        </p>

        <h1 class="text-4xl font-bold text-[#00485c]">
            Edit Project
        </h1>

        <p class="text-gray-600 mt-2">
            Update the details of this project.
        </p>

    </div>


    {{-- ===================================================== --}}
    {{-- ERRORS --}}
    {{-- ===================================================== --}}

    @if ($errors->any())

        <div class="mb-6 p-4 rounded-xl bg-red-100 text-red-700">

            <ul class="list-disc ml-5">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- PROJECT FORM --}}
    {{-- ===================================================== --}}

    <form
        action="{{ route('admin.projects.update', $project) }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white rounded-2xl shadow-sm border p-8"
    >

        @csrf
        @method('PUT')


        {{-- ================================================= --}}
        {{-- TITLE --}}
        {{-- ================================================= --}}

        <div class="mb-6">

            <label class="block font-semibold mb-2">
                Project Title
            </label>

            <input
                type="text"
                name="title"
                value="{{ old('title', $project->title) }}"
                class="w-full border rounded-xl px-4 py-3"
                required
            >

        </div>


        {{-- ================================================= --}}
        {{-- SLUG --}}
        {{-- ================================================= --}}

        <div class="mb-6">

            <label class="block font-semibold mb-2">
                Slug
            </label>

            <input
                type="text"
                name="slug"
                value="{{ old('slug', $project->slug) }}"
                class="w-full border rounded-xl px-4 py-3"
                required
            >

            <p class="text-sm text-gray-500 mt-1">
                Used in the project URL.
            </p>

        </div>


        {{-- ================================================= --}}
        {{-- DESCRIPTION --}}
        {{-- ================================================= --}}

        <div class="mb-6">

            <label class="block font-semibold mb-2">
                Description
            </label>

            <textarea
                name="description"
                rows="5"
                class="w-full border rounded-xl px-4 py-3"
                required
            >{{ old('description', $project->description) }}</textarea>

        </div>


        {{-- ================================================= --}}
        {{-- CATEGORY --}}
        {{-- ================================================= --}}

        <div class="mb-6">

            <label class="block font-semibold mb-2">
                Category
            </label>

            <input
                type="text"
                name="category"
                value="{{ old('category', $project->category) }}"
                class="w-full border rounded-xl px-4 py-3"
            >

        </div>


        {{-- ================================================= --}}
        {{-- PROJECT IMAGE --}}
        {{-- ================================================= --}}

        <div class="mb-6">

            <label class="block font-semibold mb-2">
                Project Image
            </label>

            <input
                type="file"
                name="image"
                accept="image/jpeg,image/png,image/jpg,image/webp"
                class="w-full border rounded-xl px-4 py-3"
            >

            {{-- Current Image --}}

            @if ($project->image)

                <div class="mt-4">

                    <p class="text-sm font-medium text-gray-700 mb-2">
                        Current Image
                    </p>

                    <img
                        src="{{ asset('storage/' . $project->image) }}"
                        alt="{{ $project->title }}"
                        class="w-48 h-32 object-cover rounded-xl border"
                    >

                    <p class="text-sm text-gray-500 mt-2">
                        {{ $project->image }}
                    </p>

                </div>

            @else

                <p class="text-sm text-gray-500 mt-2">
                    No image currently uploaded.
                </p>

            @endif

            <p class="text-sm text-gray-500 mt-2">
                Leave this empty to keep the current image.
                Upload a JPG, JPEG, PNG, or WebP image to replace it.
            </p>

            <p class="text-sm text-gray-500 mt-1">
                Maximum image size: 2MB.
            </p>

        </div>


        {{-- ================================================= --}}
        {{-- PREMIUM --}}
        {{-- ================================================= --}}

        <div class="mb-6">

            <label class="flex items-center gap-3">

                <input
                    type="checkbox"
                    name="is_premium"
                    value="1"
                    {{ old('is_premium', $project->is_premium) ? 'checked' : '' }}
                    class="w-5 h-5"
                >

                <span class="font-semibold">
                    Premium Project
                </span>

            </label>

            <p class="text-sm text-gray-500 mt-1">
                Premium projects will eventually require a subscription.
            </p>

        </div>


        {{-- ================================================= --}}
        {{-- GITHUB --}}
        {{-- ================================================= --}}

        <div class="mb-6">

            <label class="block font-semibold mb-2">
                GitHub URL
            </label>

            <input
                type="url"
                name="github_url"
                value="{{ old('github_url', $project->github_url) }}"
                placeholder="https://github.com/..."
                class="w-full border rounded-xl px-4 py-3"
            >

        </div>


        {{-- ================================================= --}}
        {{-- DEMO --}}
        {{-- ================================================= --}}

        <div class="mb-6">

            <label class="block font-semibold mb-2">
                Demo URL
            </label>

            <input
                type="url"
                name="demo_url"
                value="{{ old('demo_url', $project->demo_url) }}"
                placeholder="https://..."
                class="w-full border rounded-xl px-4 py-3"
            >

        </div>


        {{-- ================================================= --}}
        {{-- PUBLISHED --}}
        {{-- ================================================= --}}

        <div class="mb-8">

            <label class="block font-semibold mb-2">
                Published At
            </label>

            <input
                type="datetime-local"
                name="published_at"
                value="{{ old(
                    'published_at',
                    $project->published_at
                        ? $project->published_at->format('Y-m-d\TH:i')
                        : ''
                ) }}"
                class="w-full border rounded-xl px-4 py-3"
            >

            <p class="text-sm text-gray-500 mt-1">
                Leave empty if you don't want to publish it yet.
            </p>

        </div>


        {{-- ================================================= --}}
        {{-- BUTTONS --}}
        {{-- ================================================= --}}

        <div class="flex gap-3">

            <a
                href="{{ route('admin.projects.index') }}"
                class="px-6 py-3 rounded-xl border"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="px-6 py-3 rounded-xl bg-[#4f8775] text-white hover:bg-[#3e705f] transition"
            >
                Update Project
            </button>

        </div>

    </form>


    {{-- ===================================================== --}}
    {{-- PROJECT RESOURCES --}}
    {{-- ===================================================== --}}

    <div class="bg-white rounded-2xl shadow-sm border p-8 mt-8">

        <div class="mb-6">

            <p class="text-sm tracking-[0.3em] text-orange-500">
                PROJECT FILES
            </p>

            <h2 class="text-2xl font-bold text-[#00485c] mt-1">
                Project Resources
            </h2>

            <p class="text-gray-600 mt-2">
                Upload source code, documentation, ZIP files, and other
                resources for this project.
            </p>

        </div>


        {{-- ================================================= --}}
        {{-- SUCCESS MESSAGE --}}
        {{-- ================================================= --}}

        @if (session('success'))

            <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-700">

                {{ session('success') }}

            </div>

        @endif


        {{-- ================================================= --}}
        {{-- RESOURCE UPLOAD --}}
        {{-- ================================================= --}}

        <form
            action="{{ route('admin.projects.resources.store', $project) }}"
            method="POST"
            enctype="multipart/form-data"
            class="border border-dashed border-gray-300 rounded-xl p-6"
        >

            @csrf

            <label class="block font-semibold mb-2">
                Upload Resource
            </label>

            <div>

                <input
                    id="resource-file"
                    type="file"
                    name="file"
                    required
                    class="w-full border rounded-xl px-4 py-3"
                >

                <p
                    id="selected-file"
                    class="text-sm text-[#4F806D] mt-2 hidden"
                ></p>

            </div>

            <p class="text-sm text-gray-500 mt-2">
                Maximum file size: 10MB.
            </p>

            <button
                type="submit"
                class="mt-4 px-6 py-3 rounded-xl bg-[#4f8775] text-white hover:bg-[#3e705f] transition"
            >
                Upload Resource
            </button>

        </form>


        {{-- ================================================= --}}
        {{-- EXISTING RESOURCES --}}
        {{-- ================================================= --}}

        <div class="mt-8">

            <h3 class="text-lg font-bold text-[#00485c] mb-4">
                Existing Resources
            </h3>

            @if ($project->resources->count())

                <div class="space-y-3">

                    @foreach ($project->resources as $resource)

                        <div
                            class="flex items-center justify-between gap-4 p-4 rounded-xl bg-gray-50 border"
                        >

                            <div>

                                <p class="font-semibold text-[#00485c]">
                                    {{ $resource->name }}
                                </p>

                                <p class="text-sm text-gray-500">

                                    {{ $resource->file_type }}

                                    ·

                                    {{ number_format($resource->file_size / 1024, 1) }} KB

                                </p>

                            </div>


                            <form
                                action="{{ route(
                                    'admin.projects.resources.destroy',
                                    $resource
                                ) }}"
                                method="POST"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="px-4 py-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition"
                                >
                                    Delete
                                </button>

                            </form>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="p-6 rounded-xl bg-gray-50 text-center">

                    <p class="text-gray-500">
                        No resources uploaded yet.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection


{{-- ========================================================= --}}
{{-- RESOURCE FILE NAME SCRIPT --}}
{{-- ========================================================= --}}

<script>

    const fileInput = document.getElementById('resource-file');
    const selectedFile = document.getElementById('selected-file');

    if (fileInput && selectedFile) {

        fileInput.addEventListener('change', function () {

            if (this.files.length > 0) {

                selectedFile.textContent =
                    'Selected file: ' + this.files[0].name;

                selectedFile.classList.remove('hidden');

            } else {

                selectedFile.textContent = '';

                selectedFile.classList.add('hidden');

            }

        });

    }

</script>