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

            <div
                class="mb-6 p-4 rounded-xl
                       bg-[#DCEAE4]
                       border border-[#BFD8CE]
                       text-[#3E735F]"
            >

                {{ session('success') }}

            </div>

        @endif


        {{-- ========================================= --}}
        {{-- ERROR MESSAGE --}}
        {{-- ========================================= --}}

        @if(session('error'))

            <div
                class="mb-6 p-4 rounded-xl
                       bg-[#F5E6D8]
                       border border-[#E5C8AE]
                       text-[#A45F2C]"
            >

                {{ session('error') }}

            </div>

        @endif


        {{-- ========================================= --}}
        {{-- PROJECT LIST --}}
        {{-- ========================================= --}}

        <div class="space-y-5">

            @forelse($projects as $project)

                <div
                    class="bg-white rounded-2xl
                           border border-[#D5DDD8]
                           shadow-sm
                           overflow-hidden"
                >

                    <div class="p-6">

                        <div
                            class="flex flex-col lg:flex-row
                                   lg:items-center
                                   lg:justify-between
                                   gap-6"
                        >


                            {{-- ================================= --}}
                            {{-- PROJECT INFORMATION --}}
                            {{-- ================================= --}}

                            <div
                                class="flex items-start gap-5
                                       min-w-0"
                            >


                                {{-- ================================= --}}
                                {{-- PROJECT IMAGE --}}
                                {{-- ================================= --}}

                                @if($project->image)

                                    <img
                                        src="{{ asset('storage/' . $project->image) }}"
                                        alt="{{ $project->title }}"
                                        class="w-24 h-24
                                               rounded-xl
                                               object-cover
                                               shrink-0
                                               border border-[#D5DDD8]"
                                    >

                                @else

                                    <div
                                        class="w-24 h-24
                                               rounded-xl
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


                                {{-- ================================= --}}
                                {{-- INFORMATION --}}
                                {{-- ================================= --}}

                                <div class="min-w-0">

                                    <h2
                                        class="text-xl font-bold
                                               text-[#0F3F4A]
                                               break-words"
                                    >
                                        {{ $project->title }}
                                    </h2>


                                    <p class="text-sm text-[#315F6D] mt-1">
                                        {{ $project->category ?? 'Uncategorized' }}
                                    </p>


                                    {{-- ================================= --}}
                                    {{-- BADGES --}}
                                    {{-- ================================= --}}

                                    <div
                                        class="flex flex-wrap
                                               gap-2 mt-3"
                                    >


                                        {{-- Premium / Free --}}

                                        @if($project->is_premium)

                                            <span
                                                class="px-3 py-1
                                                       rounded-full
                                                       text-xs
                                                       font-semibold
                                                       bg-[#F1E3D4]
                                                       text-[#A45F2C]"
                                            >
                                                🔒 Premium
                                            </span>

                                        @else

                                            <span
                                                class="px-3 py-1
                                                       rounded-full
                                                       text-xs
                                                       font-semibold
                                                       bg-[#DCEAE4]
                                                       text-[#3E735F]"
                                            >
                                                ✓ Free
                                            </span>

                                        @endif


                                        {{-- Published --}}

                                        @if($project->published_at)

                                            <span
                                                class="px-3 py-1
                                                       rounded-full
                                                       text-xs
                                                       font-semibold
                                                       bg-[#DCEAE4]
                                                       text-[#3E735F]"
                                            >
                                                Published
                                            </span>

                                        @else

                                            <span
                                                class="px-3 py-1
                                                       rounded-full
                                                       text-xs
                                                       font-semibold
                                                       bg-gray-100
                                                       text-gray-600"
                                            >
                                                Draft
                                            </span>

                                        @endif


                                        {{-- Resources --}}

                                        <span
                                            class="px-3 py-1
                                                   rounded-full
                                                   text-xs
                                                   font-semibold
                                                   bg-[#F5F1E8]
                                                   text-[#315F6D]"
                                        >
                                            {{ $project->resources->count() }}

                                            {{ $project->resources->count() === 1
                                                ? 'Resource'
                                                : 'Resources'
                                            }}
                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- ================================= --}}
                            {{-- ACTIONS --}}
                            {{-- ================================= --}}

                            <div
                                class="flex flex-wrap
                                       gap-2
                                       shrink-0"
                            >


                                {{-- ================================= --}}
                                {{-- VIEW --}}
                                {{-- ================================= --}}

                                <a
                                    href="{{ route('projects.show', $project) }}"
                                    class="px-4 py-2
                                           rounded-xl
                                           border border-[#D5DDD8]
                                           text-[#315F6D]
                                           hover:bg-[#F5F1E8]
                                           transition"
                                >
                                    View
                                </a>


                                {{-- ================================= --}}
                                {{-- EDIT --}}
                                {{-- ================================= --}}

                                <a
                                    href="{{ route('admin.projects.edit', $project) }}"
                                    class="px-4 py-2
                                           rounded-xl
                                           bg-[#E4EEF0]
                                           text-[#0F3F4A]
                                           hover:opacity-80
                                           transition"
                                >
                                    Edit
                                </a>


                                {{-- ================================= --}}
                                {{-- DELETE --}}
                                {{-- ================================= --}}

                                <button
                                    type="button"

                                    data-delete-url="{{ route('admin.projects.destroy', $project) }}"

                                    data-project-title="{{ $project->title }}"

                                    data-project-category="{{ $project->category ?? 'Uncategorized' }}"

                                    data-project-image="{{ $project->image ? asset('storage/' . $project->image) : '' }}"

                                    class="delete-project-button
                                           px-4 py-2
                                           rounded-xl
                                           bg-[#F5E6D8]
                                           text-[#A45F2C]
                                           hover:bg-[#EEDAC8]
                                           transition"
                                >
                                    Delete
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                {{-- ========================================= --}}
                {{-- NO PROJECTS --}}
                {{-- ========================================= --}}

                <div
                    class="bg-white
                           rounded-2xl
                           p-12
                           text-center
                           border border-[#D5DDD8]
                           shadow-sm"
                >

                    <div class="text-4xl mb-4">
                        📁
                    </div>

                    <h2
                        class="text-xl
                               font-bold
                               text-[#0F3F4A]"
                    >
                        No projects yet
                    </h2>

                    <p class="text-[#315F6D] mt-2">
                        Create your first project to get started.
                    </p>


                    <a
                        href="{{ route('admin.projects.create') }}"
                        class="inline-block
                               mt-6
                               px-5 py-3
                               rounded-xl
                               bg-[#4F806D]
                               text-white
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


{{-- ========================================================= --}}
{{-- DELETE PROJECT MODAL --}}
{{-- ========================================================= --}}

<div
    id="deleteProjectModal"
    class="fixed inset-0 z-[100]
           hidden
           items-center justify-center
           p-4"
    aria-hidden="true"
>


    {{-- ========================================= --}}
    {{-- BACKDROP --}}
    {{-- ========================================= --}}

    <div
        id="deleteProjectBackdrop"
        class="absolute inset-0
               bg-[#0F3F4A]/50
               backdrop-blur-sm
               opacity-0
               transition-opacity duration-200"
    ></div>


    {{-- ========================================= --}}
    {{-- MODAL --}}
    {{-- ========================================= --}}

    <div
        id="deleteProjectDialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="deleteProjectTitle"
        class="relative
               w-full
               max-w-md
               bg-white
               rounded-3xl
               border border-[#D5DDD8]
               shadow-2xl
               overflow-hidden
               opacity-0
               scale-95
               transition-all duration-200"
    >


        {{-- ========================================= --}}
        {{-- TOP ACCENT --}}
        {{-- ========================================= --}}

        <div
            class="h-2
                   bg-[#B87945]"
        ></div>


        {{-- ========================================= --}}
        {{-- MODAL CONTENT --}}
        {{-- ========================================= --}}

        <div class="p-6 sm:p-7">


            {{-- ========================================= --}}
            {{-- WARNING ICON --}}
            {{-- ========================================= --}}

            <div
                class="w-14 h-14
                       mx-auto
                       rounded-full
                       bg-[#F5E6D8]
                       flex items-center justify-center"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    class="w-7 h-7 text-[#A45F2C]"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v3.75m0 3.75h.007v.007H12v-.007ZM10.29 3.86 2.82 17a1.75 1.75 0 0 0 1.52 2.63h15.32A1.75 1.75 0 0 0 21.18 17L13.71 3.86a1.97 1.97 0 0 0-3.42 0Z"
                    />
                </svg>

            </div>


            {{-- ========================================= --}}
            {{-- TITLE --}}
            {{-- ========================================= --}}

            <h2
                id="deleteProjectTitle"
                class="mt-5
                       text-xl
                       sm:text-2xl
                       font-bold
                       text-[#0F3F4A]
                       text-center"
            >
                Delete Project?
            </h2>


            {{-- ========================================= --}}
            {{-- PROJECT PREVIEW --}}
            {{-- ========================================= --}}

            <div
                class="mt-5
                       rounded-2xl
                       border border-[#D5DDD8]
                       bg-[#F8F6F0]
                       p-4"
            >

                <div class="flex items-center gap-4">


                    {{-- Project Image --}}

                    <div
                        id="deleteProjectImageWrapper"
                        class="w-16 h-16
                               rounded-xl
                               overflow-hidden
                               shrink-0
                               border border-[#D5DDD8]
                               bg-[#E8EEE9]
                               flex items-center justify-center"
                    >

                        <img
                            id="deleteProjectImage"
                            src=""
                            alt=""
                            class="hidden
                                   w-full
                                   h-full
                                   object-cover"
                        >

                        <span
                            id="deleteProjectImageFallback"
                            class="text-[#4F806D]
                                   text-xl
                                   font-bold"
                        >
                            ?
                        </span>

                    </div>


                    {{-- Project Details --}}

                    <div class="min-w-0">

                        <p
                            id="deleteProjectName"
                            class="font-bold
                                   text-[#0F3F4A]
                                   truncate"
                        >
                            Project Name
                        </p>

                        <p
                            id="deleteProjectCategory"
                            class="mt-1
                                   text-sm
                                   text-[#6B7773]"
                        >
                            Category
                        </p>

                    </div>

                </div>

            </div>


            {{-- ========================================= --}}
            {{-- WARNING MESSAGE --}}
            {{-- ========================================= --}}

            <div
                class="mt-5
                       rounded-xl
                       bg-[#FFF7EF]
                       border border-[#EBD3BC]
                       p-4"
            >

                <p
                    class="text-sm
                           leading-6
                           text-[#7A4B2A]"
                >
                    <span class="font-bold">
                        Warning:
                    </span>

                    This action will permanently delete this project
                    and its associated project data. This cannot be undone.
                </p>

            </div>


            {{-- ========================================= --}}
            {{-- ACTION BUTTONS --}}
            {{-- ========================================= --}}

            <div
                class="mt-6
                       flex flex-col-reverse
                       sm:flex-row
                       sm:justify-end
                       gap-3"
            >


                {{-- Cancel --}}

                <button
                    id="cancelDeleteProject"
                    type="button"
                    class="w-full
                           sm:w-auto
                           px-5 py-3
                           rounded-xl
                           border border-[#D5DDD8]
                           bg-white
                           text-[#315F6D]
                           font-semibold
                           hover:bg-[#F5F1E8]
                           transition"
                >
                    Cancel
                </button>


                {{-- Confirm Delete --}}

                <button
                    id="confirmDeleteProject"
                    type="button"
                    class="w-full
                           sm:w-auto
                           px-5 py-3
                           rounded-xl
                           bg-[#A45F2C]
                           text-white
                           font-semibold
                           hover:bg-[#8F4F25]
                           transition
                           shadow-sm"
                >
                    Delete Project
                </button>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- HIDDEN DELETE FORM --}}
{{-- ========================================================= --}}

<form
    id="deleteProjectForm"
    method="POST"
    class="hidden"
>

    @csrf

    @method('DELETE')

</form>


{{-- ========================================================= --}}
{{-- DELETE MODAL JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('deleteProjectModal');

    const backdrop = document.getElementById('deleteProjectBackdrop');

    const dialog = document.getElementById('deleteProjectDialog');

    const cancelButton = document.getElementById('cancelDeleteProject');

    const confirmButton = document.getElementById('confirmDeleteProject');

    const deleteForm = document.getElementById('deleteProjectForm');

    const projectName = document.getElementById('deleteProjectName');

    const projectCategory = document.getElementById('deleteProjectCategory');

    const projectImage = document.getElementById('deleteProjectImage');

    const projectImageFallback =
        document.getElementById('deleteProjectImageFallback');


    let deleteUrl = null;


    // =========================================
    // OPEN MODAL
    // =========================================

    function openDeleteModal(button) {

        deleteUrl = button.dataset.deleteUrl;

        const title =
            button.dataset.projectTitle || 'Project';

        const category =
            button.dataset.projectCategory || 'Uncategorized';

        const image =
            button.dataset.projectImage || '';


        // Set project information

        projectName.textContent = title;

        projectCategory.textContent = category;


        // Set project image

        if (image) {

            projectImage.src = image;

            projectImage.alt = title;

            projectImage.classList.remove('hidden');

            projectImageFallback.classList.add('hidden');

        } else {

            projectImage.src = '';

            projectImage.alt = '';

            projectImage.classList.add('hidden');

            projectImageFallback.textContent =
                title.charAt(0).toUpperCase();

            projectImageFallback.classList.remove('hidden');

        }


        // Show modal

        modal.classList.remove('hidden');

        modal.classList.add('flex');

        modal.setAttribute('aria-hidden', 'false');


        // Prevent background scrolling

        document.body.classList.add('overflow-hidden');


        // Animate

        requestAnimationFrame(function () {

            backdrop.classList.remove('opacity-0');

            backdrop.classList.add('opacity-100');

            dialog.classList.remove(
                'opacity-0',
                'scale-95'
            );

            dialog.classList.add(
                'opacity-100',
                'scale-100'
            );

        });


        // Focus cancel button

        setTimeout(function () {

            cancelButton.focus();

        }, 100);

    }


    // =========================================
    // CLOSE MODAL
    // =========================================

    function closeDeleteModal() {

        backdrop.classList.remove('opacity-100');

        backdrop.classList.add('opacity-0');

        dialog.classList.remove(
            'opacity-100',
            'scale-100'
        );

        dialog.classList.add(
            'opacity-0',
            'scale-95'
        );


        modal.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('overflow-hidden');


        setTimeout(function () {

            modal.classList.add('hidden');

            modal.classList.remove('flex');

            deleteUrl = null;

        }, 200);

    }


    // =========================================
    // DELETE BUTTONS
    // =========================================

    document
        .querySelectorAll('.delete-project-button')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                openDeleteModal(button);

            });

        });


    // =========================================
    // CANCEL
    // =========================================

    cancelButton.addEventListener(
        'click',
        function () {

            closeDeleteModal();

        }
    );


    // =========================================
    // BACKDROP CLICK
    // =========================================

    backdrop.addEventListener(
        'click',
        function () {

            closeDeleteModal();

        }
    );


    // =========================================
    // ESCAPE KEY
    // =========================================

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


    // =========================================
    // CONFIRM DELETE
    // =========================================

    confirmButton.addEventListener(
        'click',
        function () {

            if (!deleteUrl) {
                return;
            }


            // Prevent multiple clicks

            confirmButton.disabled = true;


            confirmButton.textContent =
                'Deleting...';


            confirmButton.classList.add(
                'opacity-70',
                'cursor-not-allowed'
            );


            // Set form action

            deleteForm.action = deleteUrl;


            // Submit DELETE request

            deleteForm.submit();

        }
    );

});

</script>

@endsection