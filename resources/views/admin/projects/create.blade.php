@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-10">

    <div class="mb-8">
        <a href="{{ route('admin.projects.index') }}"
           class="text-[#4f8775]">
            ← Back to Projects
        </a>

        <p class="text-sm tracking-[0.3em] text-orange-500 mt-6">
            ADMIN
        </p>

        <h1 class="text-4xl font-bold text-[#00485c]">
            Add New Project
        </h1>

        <p class="text-gray-600 mt-2">
            Add a project to the DevNext project collection.
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-100 text-red-700">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="bg-white rounded-2xl shadow-sm border p-8">

        @csrf

        {{-- Title --}}
        <div class="mb-6">
            <label class="block font-semibold mb-2">
                Project Title
            </label>

            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
                placeholder="Rain Sensor Clothes Protection"
                class="w-full border rounded-xl px-4 py-3"
                required
            >
        </div>

        {{-- Slug --}}
        <div class="mb-6">
            <label class="block font-semibold mb-2">
                Slug
            </label>

            <input
                type="text"
                name="slug"
                value="{{ old('slug') }}"
                placeholder="rain-sensor-clothes-protection"
                class="w-full border rounded-xl px-4 py-3"
                required
            >

            <p class="text-sm text-gray-500 mt-1">
                Used in the project URL.
            </p>
        </div>

        {{-- Description --}}
        <div class="mb-6">
            <label class="block font-semibold mb-2">
                Description
            </label>

            <textarea
                name="description"
                rows="5"
                placeholder="Describe your project..."
                class="w-full border rounded-xl px-4 py-3"
                required
            >{{ old('description') }}</textarea>
        </div>

        {{-- Category --}}
        <div class="mb-6">
            <label class="block font-semibold mb-2">
                Category
            </label>

            <input
                type="text"
                name="category"
                value="{{ old('category') }}"
                placeholder="Arduino"
                class="w-full border rounded-xl px-4 py-3"
            >
        </div>

        {{-- Image --}}
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

    <p class="text-sm text-gray-500 mt-1">
        Upload a JPG, PNG, or WebP image. Maximum size: 2MB.
    </p>
</div>

        {{-- Premium --}}
        <div class="mb-6">
            <label class="flex items-center gap-3">
                <input
                    type="checkbox"
                    name="is_premium"
                    value="1"
                    {{ old('is_premium') ? 'checked' : '' }}
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

        {{-- GitHub --}}
        <div class="mb-6">
            <label class="block font-semibold mb-2">
                GitHub URL
            </label>

            <input
                type="url"
                name="github_url"
                value="{{ old('github_url') }}"
                placeholder="https://github.com/..."
                class="w-full border rounded-xl px-4 py-3"
            >
        </div>

        {{-- Demo --}}
        <div class="mb-6">
            <label class="block font-semibold mb-2">
                Demo URL
            </label>

            <input
                type="url"
                name="demo_url"
                value="{{ old('demo_url') }}"
                placeholder="https://..."
                class="w-full border rounded-xl px-4 py-3"
            >
        </div>

        {{-- Published --}}
        <div class="mb-8">
            <label class="block font-semibold mb-2">
                Published At
            </label>

            <input
                type="datetime-local"
                name="published_at"
                value="{{ old('published_at') }}"
                class="w-full border rounded-xl px-4 py-3"
            >

            <p class="text-sm text-gray-500 mt-1">
                Leave empty if you don't want to publish it yet.
            </p>
        </div>

        {{-- Buttons --}}
        <div class="flex gap-3">

            <a href="{{ route('admin.projects.index') }}"
               class="px-6 py-3 rounded-xl border">
                Cancel
            </a>

            <button
                type="submit"
                class="px-6 py-3 rounded-xl bg-[#4f8775] text-white">
                Create Project
            </button>

        </div>

    </form>

</div>

@endsection