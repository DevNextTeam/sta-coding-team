@extends('layouts.app')

@section('title', 'Edit Developer Profile')

@section('content')

<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

    {{-- PAGE HEADER --}}
    <div class="mb-8">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

            <div>
                <div class="mb-2 flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-[#4F806D]"></span>

                    <p class="text-sm font-semibold uppercase tracking-wide text-[#4F806D]">
                        Developer Studio
                    </p>
                </div>

                <h1 class="text-3xl font-bold tracking-tight text-[#0F3F4A] sm:text-4xl">
                    Edit Your Profile
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-[#5D6B68] sm:text-base">
                    Customize your developer identity and show the DevNext community what you build.
                </p>
            </div>

            <a
                href="{{ route('profile.show', $profile->username) }}"
                target="_blank"
                class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl border border-[#D8DED9] bg-white px-5 py-3 text-sm font-semibold text-[#29483D] shadow-sm transition hover:bg-[#F5F1E8] hover:shadow"
            >
                <i class="bi bi-box-arrow-up-right"></i>
                View Public Profile
            </a>

        </div>
    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="mb-6 flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">
            <i class="bi bi-check-circle-fill mt-0.5"></i>

            <div>
                <p class="font-semibold">
                    Profile updated
                </p>

                <p class="mt-0.5 text-sm">
                    {{ session('success') }}
                </p>
            </div>
        </div>
    @endif


    {{-- VALIDATION ERRORS --}}
    @if($errors->any())
        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-700">

            <div class="flex items-start gap-3">

                <i class="bi bi-exclamation-circle-fill mt-0.5"></i>

                <div>
                    <p class="font-semibold">
                        Please fix the following:
                    </p>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>

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


        {{-- ========================================================= --}}
        {{-- PROFILE IDENTITY --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-[#D8DED9] bg-white shadow-sm">

            <div class="border-b border-[#E4E8E5] bg-[#FCFBF8] px-5 py-5 sm:px-6">

                <div class="flex items-start gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#E8EEE9] text-[#4F806D]">
                        <i class="bi bi-person text-lg"></i>
                    </div>

                    <div>
                        <h2 class="text-lg font-bold text-[#0F3F4A] sm:text-xl">
                            Profile Identity
                        </h2>

                        <p class="mt-1 text-sm text-[#6B7773]">
                            This is the information developers see first when visiting your profile.
                        </p>
                    </div>

                </div>

            </div>


            <div class="space-y-7 p-5 sm:p-6">


                {{-- AVATAR --}}
                <div>

                    <label class="mb-3 block text-sm font-semibold text-[#29483D]">
                        Profile Picture
                    </label>

                    <div class="rounded-2xl border border-[#E2E7E3] bg-[#FAFAF7] p-4 sm:p-5">

                        <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                            {{-- PREVIEW --}}
                            <div
                                id="avatarPreview"
                                class="flex h-28 w-28 shrink-0 items-center justify-center overflow-hidden rounded-full border-4 border-white bg-[#E8EEE9] shadow-md"
                            >

                                @if($profile->avatar)

                                    <img
                                        src="{{ asset('storage/' . $profile->avatar) }}"
                                        alt="Profile avatar"
                                        class="h-full w-full object-cover"
                                    >

                                @else

                                    <span class="text-4xl font-bold text-[#4F806D]">
                                        {{ strtoupper(substr($profile->username, 0, 1)) }}
                                    </span>

                                @endif

                            </div>


                            {{-- UPLOAD --}}
                            <div class="min-w-0 flex-1">

                                <p class="text-sm font-semibold text-[#29483D]">
                                    Choose a new profile picture
                                </p>

                                <p class="mt-1 text-sm leading-5 text-[#6B7773]">
                                    Use a clear image that represents you as a developer.
                                </p>

                                <div class="mt-4">

                                    <input
                                        type="file"
                                        name="avatar"
                                        id="avatar"
                                        accept="image/jpeg,image/png,image/webp"
                                        class="block w-full cursor-pointer text-sm text-[#5D6B68]
                                               file:mr-4 file:cursor-pointer file:rounded-xl
                                               file:border-0 file:bg-[#E8EEE9]
                                               file:px-4 file:py-2.5
                                               file:font-semibold file:text-[#29483D]
                                               hover:file:bg-[#DCE7DF]"
                                    >

                                </div>

                                <p class="mt-2 text-xs text-[#7A8581]">
                                    JPG, PNG, or WebP · Maximum 5MB
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- USERNAME --}}
                <div>

                    <label
                        for="username"
                        class="mb-2 block text-sm font-semibold text-[#29483D]"
                    >
                        Username
                    </label>

                    <div class="flex overflow-hidden rounded-xl border border-[#D8DED9] bg-white transition focus-within:border-[#4F806D] focus-within:ring-2 focus-within:ring-[#4F806D]/20">

                        <span class="flex shrink-0 items-center border-r border-[#D8DED9] bg-[#F5F1E8] px-3 text-sm text-[#6B7773] sm:px-4">
                            /u/
                        </span>

                        <input
                            type="text"
                            name="username"
                            id="username"
                            value="{{ old('username', $profile->username) }}"
                            maxlength="30"
                            required
                            class="min-w-0 flex-1 border-0 bg-transparent px-4 py-3 text-[#29483D] outline-none focus:ring-0"
                            placeholder="your-username"
                        >

                    </div>

                    <div class="mt-2 flex flex-col gap-1 text-xs text-[#7A8581] sm:flex-row sm:justify-between">
                        <span>
                            3–30 characters. Letters, numbers, hyphens, and underscores only.
                        </span>

                        <span id="usernameCount">
                            {{ strlen(old('username', $profile->username)) }}/30
                        </span>
                    </div>

                </div>


                {{-- HEADLINE --}}
                <div>

                    <div class="mb-2 flex items-center justify-between">

                        <label
                            for="headline"
                            class="block text-sm font-semibold text-[#29483D]"
                        >
                            Professional Headline
                        </label>

                        <span
                            id="headlineCount"
                            class="text-xs text-[#7A8581]"
                        >
                            {{ strlen(old('headline', $profile->headline ?? '')) }}/100
                        </span>

                    </div>

                    <input
                        type="text"
                        name="headline"
                        id="headline"
                        value="{{ old('headline', $profile->headline) }}"
                        maxlength="100"
                        class="w-full rounded-xl border border-[#D8DED9] px-4 py-3 text-[#29483D] outline-none transition focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                        placeholder="e.g. Full-Stack Developer"
                    >

                    <p class="mt-2 text-xs text-[#7A8581]">
                        A short description of what you do.
                    </p>

                </div>


                {{-- BIO --}}
                <div>

                    <div class="mb-2 flex items-center justify-between">

                        <label
                            for="bio"
                            class="block text-sm font-semibold text-[#29483D]"
                        >
                            Bio
                        </label>

                        <span
                            id="bioCount"
                            class="text-xs text-[#7A8581]"
                        >
                            {{ strlen(old('bio', $profile->bio ?? '')) }}/1000
                        </span>

                    </div>

                    <textarea
                        name="bio"
                        id="bio"
                        rows="6"
                        maxlength="1000"
                        class="w-full resize-y rounded-xl border border-[#D8DED9] px-4 py-3 leading-6 text-[#29483D] outline-none transition focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                        placeholder="Tell the DevNext community a little about yourself..."
                    >{{ old('bio', $profile->bio) }}</textarea>

                    <p class="mt-2 text-xs text-[#7A8581]">
                        Tell people about your interests, experience, goals, or the technologies you enjoy working with.
                    </p>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- SKILLS --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-[#D8DED9] bg-white shadow-sm">

            <div class="border-b border-[#E4E8E5] bg-[#FCFBF8] px-5 py-5 sm:px-6">

                <div class="flex items-start gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#E8EEE9] text-[#4F806D]">
                        <i class="bi bi-code-slash text-lg"></i>
                    </div>

                    <div>
                        <h2 class="text-lg font-bold text-[#0F3F4A] sm:text-xl">
                            Skills
                        </h2>

                        <p class="mt-1 text-sm text-[#6B7773]">
                            Add the technologies and tools you work with.
                        </p>
                    </div>

                </div>

            </div>


            <div class="p-5 sm:p-6">

                <label
                    for="skills"
                    class="mb-2 block text-sm font-semibold text-[#29483D]"
                >
                    Your Skills
                </label>

                <input
                    type="text"
                    name="skills"
                    id="skills"
                    value="{{ old('skills', is_array($profile->skills) ? implode(', ', $profile->skills) : '') }}"
                    maxlength="500"
                    class="w-full rounded-xl border border-[#D8DED9] px-4 py-3 text-[#29483D] outline-none transition focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                    placeholder="HTML, CSS, JavaScript, PHP, Laravel"
                >

                <p class="mt-2 text-xs text-[#7A8581]">
                    Separate each skill with a comma.
                </p>


                {{-- SKILL EXAMPLES --}}
                <div class="mt-4 flex flex-wrap gap-2">

                    @foreach(['HTML', 'CSS', 'JavaScript', 'PHP', 'Laravel', 'MySQL', 'Git', 'React'] as $skill)

                        <button
                            type="button"
                            onclick="addSkill('{{ $skill }}')"
                            class="rounded-full border border-[#D8DED9] bg-[#FAFAF7] px-3 py-1.5 text-xs font-semibold text-[#4F806D] transition hover:border-[#4F806D] hover:bg-[#E8EEE9]"
                        >
                            + {{ $skill }}
                        </button>

                    @endforeach

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- LINKS --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-[#D8DED9] bg-white shadow-sm">

            <div class="border-b border-[#E4E8E5] bg-[#FCFBF8] px-5 py-5 sm:px-6">

                <div class="flex items-start gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#E8EEE9] text-[#4F806D]">
                        <i class="bi bi-link-45deg text-xl"></i>
                    </div>

                    <div>
                        <h2 class="text-lg font-bold text-[#0F3F4A] sm:text-xl">
                            Links
                        </h2>

                        <p class="mt-1 text-sm text-[#6B7773]">
                            Connect your DevNext profile to your other websites.
                        </p>
                    </div>

                </div>

            </div>


            <div class="space-y-6 p-5 sm:p-6">

                {{-- GITHUB --}}
                <div>

                    <label
                        for="github_url"
                        class="mb-2 block text-sm font-semibold text-[#29483D]"
                    >
                        GitHub URL
                    </label>

                    <div class="relative">

                        <i class="bi bi-github pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-lg text-[#6B7773]"></i>

                        <input
                            type="url"
                            name="github_url"
                            id="github_url"
                            value="{{ old('github_url', $profile->github_url) }}"
                            class="w-full rounded-xl border border-[#D8DED9] py-3 pl-11 pr-4 text-[#29483D] outline-none transition focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                            placeholder="https://github.com/yourusername"
                        >

                    </div>

                </div>


                {{-- WEBSITE --}}
                <div>

                    <label
                        for="website_url"
                        class="mb-2 block text-sm font-semibold text-[#29483D]"
                    >
                        Personal Website
                    </label>

                    <div class="relative">

                        <i class="bi bi-globe2 pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-lg text-[#6B7773]"></i>

                        <input
                            type="url"
                            name="website_url"
                            id="website_url"
                            value="{{ old('website_url', $profile->website_url) }}"
                            class="w-full rounded-xl border border-[#D8DED9] py-3 pl-11 pr-4 text-[#29483D] outline-none transition focus:border-[#4F806D] focus:ring-2 focus:ring-[#4F806D]/20"
                            placeholder="https://yourwebsite.com"
                        >

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- ACTIONS --}}
        {{-- ========================================================= --}}

        <div class="flex flex-col gap-3 rounded-2xl border border-[#D8DED9] bg-[#FCFBF8] p-4 sm:flex-row sm:items-center sm:justify-between sm:p-5">

            <div class="flex items-start gap-3">

                <div class="mt-0.5 hidden h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#E8EEE9] text-[#4F806D] sm:flex">
                    <i class="bi bi-info-circle"></i>
                </div>

                <div>
                    <p class="text-sm font-semibold text-[#29483D]">
                        Ready to publish your profile?
                    </p>

                    <p class="mt-1 text-xs leading-5 text-[#7A8581]">
                        Your changes will be visible on your public developer profile after saving.
                    </p>
                </div>

            </div>


            <div class="flex flex-col gap-3 sm:flex-row">

                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-[#D8DED9] bg-white px-6 py-3 text-sm font-semibold text-[#29483D] transition hover:bg-[#F5F1E8]"
                >
                    <i class="bi bi-arrow-left"></i>
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#4F806D] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#3E735F] hover:shadow-md"
                >
                    <i class="bi bi-check2-circle"></i>
                    Save Profile
                </button>

            </div>

        </div>

    </form>

</div>


{{-- ============================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ============================================================= --}}

<script>

    // -------------------------------------------------------------
    // AVATAR PREVIEW
    // -------------------------------------------------------------

    const avatarInput = document.getElementById('avatar');
    const avatarPreview = document.getElementById('avatarPreview');

    if (avatarInput && avatarPreview) {

        avatarInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                return;
            }

            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!allowedTypes.includes(file.type)) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                avatarPreview.innerHTML = `
                    <img
                        src="${event.target.result}"
                        alt="Avatar preview"
                        class="h-full w-full object-cover"
                    >
                `;

            };

            reader.readAsDataURL(file);

        });

    }


    // -------------------------------------------------------------
    // CHARACTER COUNTERS
    // -------------------------------------------------------------

    function updateCharacterCount(inputId, counterId, maxLength) {

        const input = document.getElementById(inputId);
        const counter = document.getElementById(counterId);

        if (!input || !counter) {
            return;
        }

        function update() {
            counter.textContent = `${input.value.length}/${maxLength}`;
        }

        input.addEventListener('input', update);

        update();
    }


    updateCharacterCount(
        'username',
        'usernameCount',
        30
    );

    updateCharacterCount(
        'headline',
        'headlineCount',
        100
    );

    updateCharacterCount(
        'bio',
        'bioCount',
        1000
    );


    // -------------------------------------------------------------
    // QUICK SKILL BUTTONS
    // -------------------------------------------------------------

    function addSkill(skill) {

        const input = document.getElementById('skills');

        if (!input) {
            return;
        }

        let skills = input.value
            .split(',')
            .map(item => item.trim())
            .filter(item => item.length > 0);

        const alreadyExists = skills.some(
            item => item.toLowerCase() === skill.toLowerCase()
        );

        if (!alreadyExists) {
            skills.push(skill);
        }

        input.value = skills.join(', ');

        input.focus();

    }

</script>

@endsection