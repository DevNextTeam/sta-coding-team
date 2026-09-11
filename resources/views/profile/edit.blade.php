@extends('layouts.app')

@section('title', 'Edit Developer Profile')

@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <p class="text-sm font-semibold text-[#4F806D] mb-1">
                    Developer Studio
                </p>

                <h1 class="text-3xl sm:text-4xl font-bold text-[#0F3F4A]">
                    Edit Your Profile
                </h1>

                <p class="mt-2 text-[#5D6B68]">
                    Customize how other developers see you on DevNext.
                </p>
            </div>

            <a
                href="{{ route('profile.show', $profile->username) }}"
                target="_blank"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-[#D8DED9] bg-white text-[#29483D] font-semibold hover:bg-[#F5F1E8] transition"
            >
                View Public Profile
            </a>

        </div>
    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif


    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4 text-red-700">
            <p class="font-semibold mb-2">
                Please fix the following:
            </p>

            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form
        action="{{ route('profile.update') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
    >

        @csrf
        @method('PUT')


        {{-- Profile Identity --}}
        <div class="bg-white rounded-2xl border border-[#D8DED9] shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-[#E4E8E5]">
                <h2 class="text-xl font-bold text-[#0F3F4A]">
                    Profile Identity
                </h2>

                <p class="text-sm text-[#6B7773] mt-1">
                    The information people will see first on your developer profile.
                </p>
            </div>


            <div class="p-6 space-y-6">

                {{-- Avatar --}}
                <div>
                    <label class="block text-sm font-semibold text-[#29483D] mb-3">
                        Profile Picture
                    </label>

                    <div class="flex flex-col sm:flex-row sm:items-center gap-5">

                        <div
                            id="avatarPreview"
                            class="w-24 h-24 rounded-full overflow-hidden bg-[#E8EEE9] border-4 border-white shadow-md flex items-center justify-center shrink-0"
                        >
                            @if($profile->avatar)
                                <img
                                    src="{{ asset('storage/' . $profile->avatar) }}"
                                    alt="Profile avatar"
                                    class="w-full h-full object-cover"
                                >
                            @else
                                <span class="text-3xl font-bold text-[#4F806D]">
                                    {{ strtoupper(substr($profile->username, 0, 1)) }}
                                </span>
                            @endif
                        </div>

                        <div>
                            <input
                                type="file"
                                name="avatar"
                                id="avatar"
                                accept="image/jpeg,image/png,image/webp"
                                class="block w-full text-sm text-[#5D6B68]
                                       file:mr-4 file:py-2.5 file:px-4
                                       file:rounded-xl file:border-0
                                       file:bg-[#E8EEE9] file:text-[#29483D]
                                       file:font-semibold
                                       hover:file:bg-[#DCE7DF]
                                       cursor-pointer"
                            >

                            <p class="mt-2 text-xs text-[#7A8581]">
                                JPG, PNG, or WebP. Maximum size: 5MB.
                            </p>
                        </div>

                    </div>
                </div>


                {{-- Username --}}
                <div>
                    <label
                        for="username"
                        class="block text-sm font-semibold text-[#29483D] mb-2"
                    >
                        Username
                    </label>

                    <div class="flex rounded-xl border border-[#D8DED9] overflow-hidden bg-white">

                        <span class="flex items-center px-4 bg-[#F5F1E8] text-[#6B7773] text-sm border-r border-[#D8DED9]">
                            devnext.com/u/
                        </span>

                        <input
                            type="text"
                            name="username"
                            id="username"
                            value="{{ old('username', $profile->username) }}"
                            maxlength="30"
                            required
                            class="flex-1 px-4 py-3 border-0 focus:ring-0 focus:outline-none text-[#29483D]"
                            placeholder="your-username"
                        >

                    </div>

                    <p class="mt-2 text-xs text-[#7A8581]">
                        3–30 characters. Letters, numbers, hyphens, and underscores only.
                    </p>
                </div>


                {{-- Headline --}}
                <div>
                    <label
                        for="headline"
                        class="block text-sm font-semibold text-[#29483D] mb-2"
                    >
                        Headline
                    </label>

                    <input
                        type="text"
                        name="headline"
                        id="headline"
                        value="{{ old('headline', $profile->headline) }}"
                        maxlength="100"
                        class="w-full px-4 py-3 rounded-xl border border-[#D8DED9] focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20 outline-none text-[#29483D]"
                        placeholder="e.g. Full-Stack Developer"
                    >
                </div>


                {{-- Bio --}}
                <div>
                    <label
                        for="bio"
                        class="block text-sm font-semibold text-[#29483D] mb-2"
                    >
                        Bio
                    </label>

                    <textarea
                        name="bio"
                        id="bio"
                        rows="5"
                        maxlength="1000"
                        class="w-full px-4 py-3 rounded-xl border border-[#D8DED9] focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20 outline-none text-[#29483D] resize-y"
                        placeholder="Tell the DevNext community a little about yourself..."
                    >{{ old('bio', $profile->bio) }}</textarea>

                    <p class="mt-2 text-xs text-[#7A8581]">
                        Maximum 1,000 characters.
                    </p>
                </div>

            </div>

        </div>


        {{-- Skills --}}
        <div class="bg-white rounded-2xl border border-[#D8DED9] shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-[#E4E8E5]">
                <h2 class="text-xl font-bold text-[#0F3F4A]">
                    Skills
                </h2>

                <p class="text-sm text-[#6B7773] mt-1">
                    Add the technologies and tools you work with.
                </p>
            </div>


            <div class="p-6">

                <label
                    for="skills"
                    class="block text-sm font-semibold text-[#29483D] mb-2"
                >
                    Your Skills
                </label>

                <input
                    type="text"
                    name="skills"
                    id="skills"
                    value="{{ old('skills', is_array($profile->skills) ? implode(', ', $profile->skills) : '') }}"
                    maxlength="500"
                    class="w-full px-4 py-3 rounded-xl border border-[#D8DED9] focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20 outline-none text-[#29483D]"
                    placeholder="HTML, CSS, JavaScript, PHP, Laravel"
                >

                <p class="mt-2 text-xs text-[#7A8581]">
                    Separate each skill with a comma.
                </p>

            </div>

        </div>


        {{-- Social Links --}}
        <div class="bg-white rounded-2xl border border-[#D8DED9] shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-[#E4E8E5]">
                <h2 class="text-xl font-bold text-[#0F3F4A]">
                    Links
                </h2>

                <p class="text-sm text-[#6B7773] mt-1">
                    Connect your developer profile to your other websites.
                </p>
            </div>


            <div class="p-6 space-y-5">

                {{-- GitHub --}}
                <div>
                    <label
                        for="github_url"
                        class="block text-sm font-semibold text-[#29483D] mb-2"
                    >
                        GitHub URL
                    </label>

                    <input
                        type="url"
                        name="github_url"
                        id="github_url"
                        value="{{ old('github_url', $profile->github_url) }}"
                        class="w-full px-4 py-3 rounded-xl border border-[#D8DED9] focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20 outline-none text-[#29483D]"
                        placeholder="https://github.com/yourusername"
                    >
                </div>


                {{-- Website --}}
                <div>
                    <label
                        for="website_url"
                        class="block text-sm font-semibold text-[#29483D] mb-2"
                    >
                        Personal Website
                    </label>

                    <input
                        type="url"
                        name="website_url"
                        id="website_url"
                        value="{{ old('website_url', $profile->website_url) }}"
                        class="w-full px-4 py-3 rounded-xl border border-[#D8DED9] focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20 outline-none text-[#29483D]"
                        placeholder="https://yourwebsite.com"
                    >
                </div>

            </div>

        </div>


        {{-- Save --}}
        <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">

            <a
                href="{{ route('dashboard') }}"
                class="inline-flex items-center justify-center px-6 py-3 rounded-xl border border-[#D8DED9] bg-white text-[#29483D] font-semibold hover:bg-[#F5F1E8] transition"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-[#4F806D] text-white font-semibold shadow-sm hover:bg-[#3E735F] transition"
            >
                Save Profile
            </button>

        </div>

    </form>

</div>


{{-- Avatar Preview --}}
<script>
    const avatarInput = document.getElementById('avatar');
    const avatarPreview = document.getElementById('avatarPreview');

    if (avatarInput && avatarPreview) {

        avatarInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                avatarPreview.innerHTML = `
                    <img
                        src="${event.target.result}"
                        alt="Avatar preview"
                        class="w-full h-full object-cover"
                    >
                `;

            };

            reader.readAsDataURL(file);
        });

    }
</script>

@endsection