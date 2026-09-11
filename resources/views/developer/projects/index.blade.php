@extends('layouts.app')

@section('title', 'My Projects — DevNext')

@section('content')

<div class="min-h-screen bg-[#F5F1E8]">

    <main class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">

            <div>

                <p class="text-sm font-semibold uppercase tracking-widest text-[#B87945]">
                    Developer Studio
                </p>

                <h1 class="text-3xl sm:text-4xl font-bold text-[#29483D] mt-1">
                    My Projects
                </h1>

                <p class="mt-2 text-gray-600">
                    Manage the projects you've created.
                </p>

            </div>


            <a
                href="{{ route('developer.projects.create') }}"
                class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-[#4F806D] text-white text-sm font-semibold hover:bg-[#3E735F] transition"
            >
                + Create Project
            </a>

        </div>


        {{-- ========================================================= --}}
        {{-- SUCCESS MESSAGE --}}
        {{-- ========================================================= --}}

        @if(session('success'))

            <div
                class="mb-6 rounded-xl bg-[#E8F0EC] border border-[#B8CEC5] px-4 py-3 text-sm text-[#29483D]"
            >
                {{ session('success') }}
            </div>

        @endif


        {{-- ========================================================= --}}
        {{-- ERROR MESSAGE --}}
        {{-- ========================================================= --}}

        @if(session('error'))

            <div
                class="mb-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700"
            >
                {{ session('error') }}
            </div>

        @endif


        {{-- ========================================================= --}}
        {{-- VALIDATION ERRORS --}}
        {{-- ========================================================= --}}

        @if($errors->any())

            <div
                class="mb-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700"
            >

                <p class="font-semibold mb-1">
                    Something went wrong.
                </p>

                <ul class="list-disc list-inside space-y-1">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- ========================================================= --}}
        {{-- PROJECTS --}}
        {{-- ========================================================= --}}

        @if($projects->count())

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">

                @foreach($projects as $project)

                    <article
                        class="bg-white rounded-2xl border border-[#D9E2DD] overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-300"
                    >

                        {{-- ================================================= --}}
                        {{-- PROJECT IMAGE --}}
                        {{-- ================================================= --}}

                        <div class="h-44 bg-[#E8F0EC] overflow-hidden">

                            @if($project->image)

                                <img
                                    src="{{ asset('storage/' . $project->image) }}"
                                    alt="{{ $project->title }}"
                                    class="w-full h-full object-cover hover:scale-105 transition duration-500"
                                >

                            @else

                                <div class="w-full h-full flex items-center justify-center">

                                    <div class="text-center">

                                        <div class="text-3xl mb-2">
                                            💻
                                        </div>

                                        <span class="text-[#4F806D] font-semibold text-sm">
                                            DevNext Project
                                        </span>

                                    </div>

                                </div>

                            @endif

                        </div>


                        {{-- ================================================= --}}
                        {{-- PROJECT INFORMATION --}}
                        {{-- ================================================= --}}

                        <div class="p-5">

                            @if($project->category)

                                <p class="text-xs font-semibold uppercase tracking-wide text-[#4F806D]">
                                    {{ $project->category }}
                                </p>

                            @endif


                            <h2 class="mt-2 text-xl font-bold text-[#29483D] line-clamp-2">
                                {{ $project->title }}
                            </h2>


                            {{-- Status --}}

                            @if($project->published_at)

                                <span
                                    class="inline-flex items-center gap-1.5 mt-3 px-2.5 py-1 rounded-full bg-[#E8F0EC] text-[#3E735F] text-xs font-semibold"
                                >

                                    <span class="w-1.5 h-1.5 rounded-full bg-[#4F806D]"></span>

                                    Published

                                </span>

                            @else

                                <span
                                    class="inline-flex items-center gap-1.5 mt-3 px-2.5 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-semibold"
                                >

                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>

                                    Draft

                                </span>

                            @endif

                        </div>


                        {{-- ================================================= --}}
                        {{-- ACTIONS --}}
                        {{-- ================================================= --}}

                        <div class="px-5 pb-5 flex gap-2">

                            {{-- Edit --}}

                            <a
                                href="{{ route('developer.projects.edit', $project) }}"
                                class="flex-1 inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-[#E8F0EC] text-[#3E735F] text-sm font-semibold hover:bg-[#D9E8E1] transition"
                            >
                                Edit
                            </a>


                            {{-- Delete --}}

                            <form
                                method="POST"
                                action="{{ route('developer.projects.destroy', $project) }}"
                                class="flex-1"
                                data-delete-form
                                data-project-title="{{ $project->title }}"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                type="submit"
                                data-delete-button
                                class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-red-50 text-red-600 text-sm font-semibold hover:bg-red-100 transition"
                            >
                                Delete
                            </button>

                            </form>

                        </div>

                    </article>

                @endforeach

            </div>


        @else

            {{-- ========================================================= --}}
            {{-- EMPTY STATE --}}
            {{-- ========================================================= --}}

            <div
                class="bg-white rounded-2xl sm:rounded-3xl border border-[#D9E2DD] p-10 sm:p-14 text-center shadow-sm"
            >

                <div
                    class="w-16 h-16 mx-auto rounded-2xl bg-[#E8F0EC] flex items-center justify-center"
                >

                    <svg
                        class="w-8 h-8 text-[#4F806D]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9 3h6l2 3h4a1 1 0 011 1v11a2 2 0 01-2 2H4a2 2 0 01-2-2V7a1 1 0 011-1h4l2-3z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 10v5m-2.5-2.5h5"
                        />

                    </svg>

                </div>


                <h2 class="mt-5 text-xl sm:text-2xl font-bold text-[#29483D]">
                    You haven't created any projects yet
                </h2>


                <p class="mt-2 text-sm sm:text-base text-gray-500 max-w-md mx-auto">
                    Create your first project and showcase your work on DevNext.
                </p>


                <a
                    href="{{ route('developer.projects.create') }}"
                    class="mt-7 inline-flex items-center justify-center px-5 py-3 rounded-xl bg-[#4F806D] text-white text-sm font-semibold hover:bg-[#3E735F] transition"
                >
                    Create Your First Project
                </a>

            </div>

        @endif

    </main>

</div>


{{-- ========================================================= --}}
{{-- DELETE CONFIRMATION MODAL --}}
{{-- ========================================================= --}}

<div
    id="deleteModal"
    class="fixed inset-0 z-[100] hidden items-center justify-center px-4 py-6"
    aria-hidden="true"
>

    {{-- ========================================================= --}}
    {{-- BACKDROP --}}
    {{-- ========================================================= --}}

    <div
        id="deleteModalBackdrop"
        class="absolute inset-0 bg-[#29483D]/55 backdrop-blur-md opacity-0 transition-opacity duration-200"
    ></div>


    {{-- ========================================================= --}}
    {{-- MODAL --}}
    {{-- ========================================================= --}}

    <div
        id="deleteModalContent"
        class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl border border-[#D9E2DD] p-6 sm:p-8 opacity-0 scale-95 transition-all duration-200"
        role="dialog"
        aria-modal="true"
        aria-labelledby="deleteModalTitle"
    >

        {{-- ===================================================== --}}
        {{-- CLOSE --}}
        {{-- ===================================================== --}}

        <button
            type="button"
            id="deleteCloseButton"
            class="absolute top-4 right-4 w-9 h-9 rounded-xl flex items-center justify-center text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition"
            aria-label="Close delete confirmation"
        >

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                />

            </svg>

        </button>


        {{-- ===================================================== --}}
        {{-- DELETE ICON --}}
        {{-- ===================================================== --}}

        <div
            class="w-14 h-14 rounded-2xl bg-red-50 flex items-center justify-center mb-5"
        >

            <svg
                class="w-7 h-7 text-red-500"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m-4 0h14"
                />

            </svg>

        </div>


        {{-- ===================================================== --}}
        {{-- TITLE --}}
        {{-- ===================================================== --}}

        <h2
            id="deleteModalTitle"
            class="text-xl sm:text-2xl font-bold text-[#29483D]"
        >
            Delete Project?
        </h2>


        {{-- ===================================================== --}}
        {{-- MESSAGE --}}
        {{-- ===================================================== --}}

        <p class="mt-3 text-sm sm:text-base text-gray-600 leading-relaxed">

            Are you sure you want to delete

            <span
                id="deleteProjectName"
                class="font-semibold text-[#29483D]"
            ></span>?

        </p>


        <p class="mt-2 text-sm text-gray-500">
            This action cannot be undone.
        </p>


        {{-- ===================================================== --}}
        {{-- ERROR --}}
        {{-- ===================================================== --}}

        <div
            id="deleteError"
            class="hidden mt-5 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-600"
        ></div>


        {{-- ===================================================== --}}
        {{-- BUTTONS --}}
        {{-- ===================================================== --}}

        <div class="mt-7 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">

            {{-- Cancel --}}

            <button
                type="button"
                id="deleteCancelButton"
                class="w-full sm:w-auto px-5 py-3 rounded-xl border border-[#CBD8D2] text-[#29483D] text-sm font-semibold hover:bg-[#F5F1E8] transition"
            >
                Cancel
            </button>


            {{-- Confirm --}}

            <button
                type="button"
                id="deleteConfirmButton"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-red-500 text-white text-sm font-semibold hover:bg-red-600 transition disabled:opacity-60 disabled:cursor-not-allowed"
            >

                <span id="deleteConfirmIcon">

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m-4 0h14"
                        />

                    </svg>

                </span>

                <span id="deleteConfirmText">
                    Delete Project
                </span>

            </button>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | Elements
    |--------------------------------------------------------------------------
    */

    const modal = document.getElementById('deleteModal');

    const backdrop = document.getElementById('deleteModalBackdrop');

    const content = document.getElementById('deleteModalContent');

    const projectName = document.getElementById('deleteProjectName');

    const cancelButton = document.getElementById('deleteCancelButton');

    const closeButton = document.getElementById('deleteCloseButton');

    const confirmButton = document.getElementById('deleteConfirmButton');

    const confirmText = document.getElementById('deleteConfirmText');

    const confirmIcon = document.getElementById('deleteConfirmIcon');

    const errorBox = document.getElementById('deleteError');


    /*
    |--------------------------------------------------------------------------
    | State
    |--------------------------------------------------------------------------
    */

    let selectedDeleteForm = null;

    let isDeleting = false;

    let submittingForm = false;


    /*
    |--------------------------------------------------------------------------
    | OPEN MODAL
    |--------------------------------------------------------------------------
    */

    function openDeleteModal(form, name) {

        selectedDeleteForm = form;

        isDeleting = false;

        submittingForm = false;


        /*
        | Set project name
        */

        projectName.textContent = name;


        /*
        | Reset error
        */

        errorBox.textContent = '';

        errorBox.classList.add('hidden');


        /*
        | Reset buttons
        */

        confirmButton.disabled = false;

        cancelButton.disabled = false;

        closeButton.disabled = false;


        confirmText.textContent = 'Delete Project';


        confirmIcon.innerHTML = `
            <svg
                class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 01-1 1v3m-4 0h14"
                />

            </svg>
        `;


        /*
        | Show modal
        */

        modal.classList.remove('hidden');

        modal.classList.add('flex');

        modal.setAttribute('aria-hidden', 'false');


        document.body.classList.add('overflow-hidden');


        /*
        | Animate
        */

        requestAnimationFrame(function () {

            backdrop.classList.remove('opacity-0');

            backdrop.classList.add('opacity-100');


            content.classList.remove(
                'opacity-0',
                'scale-95'
            );

            content.classList.add(
                'opacity-100',
                'scale-100'
            );

        });

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE MODAL
    |--------------------------------------------------------------------------
    */

    function closeDeleteModal() {

        /*
        | Don't close while deleting
        */

        if (isDeleting || submittingForm) {
            return;
        }


        /*
        | Animate out
        */

        backdrop.classList.remove('opacity-100');

        backdrop.classList.add('opacity-0');


        content.classList.remove(
            'opacity-100',
            'scale-100'
        );

        content.classList.add(
            'opacity-0',
            'scale-95'
        );


        modal.setAttribute('aria-hidden', 'true');


        document.body.classList.remove('overflow-hidden');


        setTimeout(function () {

            modal.classList.remove('flex');

            modal.classList.add('hidden');

            selectedDeleteForm = null;

        }, 200);

    }


    /*
    |--------------------------------------------------------------------------
    | DELETE BUTTONS
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('[data-delete-button]')
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function (event) {

                    event.preventDefault();

                    event.stopPropagation();


                    const form = button.closest(
                        '[data-delete-form]'
                    );


                    if (!form) {
                        return;
                    }


                    const name = form.getAttribute(
                        'data-project-title'
                    );


                    openDeleteModal(
                        form,
                        name
                    );

                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | CANCEL
    |--------------------------------------------------------------------------
    */

    cancelButton.addEventListener(
        'click',
        function () {

            closeDeleteModal();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | CLOSE BUTTON
    |--------------------------------------------------------------------------
    */

    closeButton.addEventListener(
        'click',
        function () {

            closeDeleteModal();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | BACKDROP
    |--------------------------------------------------------------------------
    */

    backdrop.addEventListener(
        'click',
        function () {

            closeDeleteModal();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | CONFIRM DELETE
    |--------------------------------------------------------------------------
    */

    confirmButton.addEventListener(
        'click',
        function () {

            /*
            | Prevent double submission
            */

            if (isDeleting || submittingForm) {
                return;
            }


            /*
            | Make sure a form is selected
            */

            if (!selectedDeleteForm) {
                return;
            }


            /*
            | Lock deletion
            */

            isDeleting = true;

            submittingForm = true;


            /*
            | Disable buttons
            */

            confirmButton.disabled = true;

            cancelButton.disabled = true;

            closeButton.disabled = true;


            /*
            | Loading state
            */

            confirmText.textContent = 'Deleting...';


            confirmIcon.innerHTML = `
                <svg
                    class="w-4 h-4 animate-spin"
                    fill="none"
                    viewBox="0 0 24 24"
                >

                    <circle
                        class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4"
                    ></circle>

                    <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                    ></path>

                </svg>
            `;


            /*
            |--------------------------------------------------------------------------
            | Submit the actual Laravel form
            |--------------------------------------------------------------------------
            |
            | requestSubmit() allows the browser to perform the normal
            | form submission including:
            |
            | @csrf
            | @method('DELETE')
            |
            */

            selectedDeleteForm.requestSubmit();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | ESCAPE KEY
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                !modal.classList.contains('hidden')
            ) {

                closeDeleteModal();

            }

        }
    );

});

</script>

@endsection