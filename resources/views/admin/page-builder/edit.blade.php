@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#F5F1E8] py-8 px-6">

    <div class="max-w-7xl mx-auto">

        {{-- =========================================================
             PAGE HEADER
        ========================================================== --}}

        <div class="mb-8">

            <a
                href="{{ route('admin.dashboard') }}"
                class="text-sm text-[#4F806D] hover:underline"
            >
                ← Back to Admin Dashboard
            </a>

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mt-4">

                <div>

                    <p class="text-sm tracking-[0.3em] text-[#B87945] uppercase">
                        Page Builder
                    </p>

                    <h1 class="text-4xl font-bold text-[#0F3F4A] mt-2">
                        {{ $page->title }}
                    </h1>

                    <p class="text-[#315F6D] mt-2">
                        Build your page visually using drag and drop.
                    </p>

                </div>

                <div
                    class="px-4 py-2 rounded-full
                           bg-[#E8E3D8]
                           text-[#315F6D]
                           text-sm"
                >
                    Editing:
                    <strong>{{ ucfirst($page->slug) }}</strong>
                </div>

            </div>

        </div>


        {{-- =========================================================
             SUCCESS
        ========================================================== --}}

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


        {{-- =========================================================
             ERRORS
        ========================================================== --}}

        @if($errors->any())

            <div
                class="mb-6 p-4 rounded-xl
                       bg-[#F5E6D8]
                       border border-[#E5CDB8]
                       text-[#A45F2C]"
            >

                <ul class="list-disc ml-5">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- =========================================================
             MAIN FORM
        ========================================================== --}}

        <form
            method="POST"
            action="{{ route('admin.pages.update', $page->slug) }}"
            enctype="multipart/form-data"
            id="pageBuilderForm"
        >

            @csrf
            @method('PUT')


            {{-- =====================================================
                 PAGE TITLE
            ====================================================== --}}

            <div
                class="bg-white rounded-2xl
                       border border-[#D5DDD8]
                       shadow-sm
                       p-6
                       mb-6"
            >

                <label
                    for="title"
                    class="block text-sm font-semibold
                           text-[#0F3F4A]
                           mb-2"
                >
                    Page Title
                </label>

                <input
                    id="title"
                    type="text"
                    name="title"
                    value="{{ old('title', $page->title) }}"
                    required
                    class="w-full px-4 py-3
                           rounded-xl
                           border border-[#D5DDD8]
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#4F806D]"
                >

            </div>


            {{-- =====================================================
                 BUILDER
            ====================================================== --}}

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">


                {{-- =================================================
                     COMPONENT SIDEBAR
                ================================================== --}}

                <div class="lg:col-span-1">

                    <div
                        class="bg-white rounded-2xl
                               border border-[#D5DDD8]
                               shadow-sm
                               p-5
                               lg:sticky
                               lg:top-6
                               components-sidebar"
                    >

                        <p
                            class="text-xs uppercase
                                   tracking-[0.25em]
                                   text-[#B87945]"
                        >
                            Components
                        </p>

                        <h2
                            class="text-xl font-bold
                                   text-[#0F3F4A]
                                   mt-1"
                        >
                            Drag & Drop
                        </h2>

                        <p
                            class="text-sm text-gray-500
                                   mt-2 mb-5"
                        >
                            Drag a component into any section.
                        </p>


                        <div class="components-scroll-area">


                            {{-- TEXT --}}

                            <div
                                draggable="true"
                                data-component="text"
                                class="builder-component"
                            >

                                <div class="component-icon">
                                    <i class="bi bi-fonts"></i>
                                </div>

                                <div>

                                    <div class="font-semibold text-[#0F3F4A]">
                                        Text
                                    </div>

                                    <div class="text-xs text-gray-500">
                                        Paragraph text
                                    </div>

                                </div>

                            </div>


                            {{-- HEADING --}}

                            <div
                                draggable="true"
                                data-component="heading"
                                class="builder-component"
                            >

                                <div class="component-icon">
                                    <i class="bi bi-type-h1"></i>
                                </div>

                                <div>

                                    <div class="font-semibold text-[#0F3F4A]">
                                        Heading
                                    </div>

                                    <div class="text-xs text-gray-500">
                                        Large heading
                                    </div>

                                </div>

                            </div>


                            {{-- IMAGE --}}

                            <div
                                draggable="true"
                                data-component="image"
                                class="builder-component"
                            >

                                <div class="component-icon">
                                    <i class="bi bi-image"></i>
                                </div>

                                <div>

                                    <div class="font-semibold text-[#0F3F4A]">
                                        Image
                                    </div>

                                    <div class="text-xs text-gray-500">
                                        Upload an image
                                    </div>

                                </div>

                            </div>


                            {{-- BUTTON --}}

                            <div
                                draggable="true"
                                data-component="button"
                                class="builder-component"
                            >

                                <div class="component-icon">
                                    <i class="bi bi-hand-index-thumb"></i>
                                </div>

                                <div>

                                    <div class="font-semibold text-[#0F3F4A]">
                                        Button
                                    </div>

                                    <div class="text-xs text-gray-500">
                                        Action button
                                    </div>

                                </div>

                            </div>


                            {{-- DIVIDER --}}

                            <div
                                draggable="true"
                                data-component="divider"
                                class="builder-component"
                            >

                                <div class="component-icon">
                                    <i class="bi bi-dash-lg"></i>
                                </div>

                                <div>

                                    <div class="font-semibold text-[#0F3F4A]">
                                        Divider
                                    </div>

                                    <div class="text-xs text-gray-500">
                                        Horizontal line
                                    </div>

                                </div>

                            </div>


                            {{-- ICON --}}

                            <div
                                draggable="true"
                                data-component="icon"
                                class="builder-component"
                            >

                                <div class="component-icon">
                                    <i class="bi bi-stars"></i>
                                </div>

                                <div>

                                    <div class="font-semibold text-[#0F3F4A]">
                                        Icon
                                    </div>

                                    <div class="text-xs text-gray-500">
                                        Choose an icon
                                    </div>

                                </div>

                            </div>


                            {{-- GROUP --}}

                            <div
                                draggable="true"
                                data-component="group"
                                class="builder-component"
                            >

                                <div class="component-icon">
                                    <i class="bi bi-collection"></i>
                                </div>

                                <div>

                                    <div class="font-semibold text-[#0F3F4A]">
                                        Group / Container
                                    </div>

                                    <div class="text-xs text-gray-500">
                                        Container for multiple blocks
                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                 ICON LIBRARY
                            ================================================== --}}

                            <div class="icon-library">

                                <div class="icon-library-title">

                                    <i class="bi bi-grid-3x3-gap"></i>

                                    Icon Library

                                </div>

                                <div class="icon-library-grid">

                                    @php

                                        $libraryIcons = [

                                            'bi-house',
                                            'bi-person',
                                            'bi-heart',
                                            'bi-star',
                                            'bi-gear',
                                            'bi-search',
                                            'bi-envelope',
                                            'bi-phone',
                                            'bi-camera',
                                            'bi-image',
                                            'bi-cart',
                                            'bi-check-circle',
                                            'bi-x-circle',
                                            'bi-arrow-right',
                                            'bi-arrow-left',
                                            'bi-arrow-up',
                                            'bi-arrow-down',
                                            'bi-download',
                                            'bi-upload',
                                            'bi-github',
                                            'bi-facebook',
                                            'bi-instagram',
                                            'bi-youtube',
                                            'bi-discord',
                                            'bi-code-slash',
                                            'bi-terminal',
                                            'bi-laptop',
                                            'bi-database',
                                            'bi-cloud',
                                            'bi-lightning',
                                            'bi-lock',
                                            'bi-unlock',
                                            'bi-bell',
                                            'bi-calendar',
                                            'bi-chat',
                                            'bi-share',
                                            'bi-link',
                                            'bi-book',
                                            'bi-folder',
                                            'bi-file-earmark',
                                            'bi-play-circle',
                                            'bi-pause-circle',
                                            'bi-info-circle',
                                            'bi-question-circle'

                                        ];

                                    @endphp


                                    @foreach($libraryIcons as $icon)

                                        <span
                                            data-icon="{{ $icon }}"
                                            title="{{ $icon }}"
                                        >
                                            <i class="bi {{ $icon }}"></i>
                                        </span>

                                    @endforeach

                                </div>

                                <p class="text-[10px] text-gray-400 mt-3">
                                    Drag the Icon component above to use the icon picker.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     CANVAS
                ================================================== --}}

                <div class="lg:col-span-3">

                    <div
                        class="bg-white rounded-2xl
                               border border-[#D5DDD8]
                               shadow-sm
                               p-6"
                    >


                        {{-- =================================================
                             GROUP TOOLBAR
                        ================================================== --}}

                        <div
                            id="floatingGroupToolbar"
                            class="floating-group-toolbar"
                        >

                            <div class="floating-group-icon">

                                <i class="bi bi-collection"></i>

                            </div>

                            <div class="floating-group-info">

                                <div class="floating-group-title">
                                    Group Blocks
                                </div>

                                <div
                                    id="floatingGroupStatus"
                                    class="floating-group-status"
                                >
                                    Select blocks to group them together.
                                </div>

                            </div>

                            <div class="floating-group-actions">

                                <button
                                    type="button"
                                    id="floatingGroupButton"
                                    class="floating-group-primary"
                                    disabled
                                >
                                    <i class="bi bi-collection"></i>
                                    Group Selected
                                </button>

                                <button
                                    type="button"
                                    id="floatingUngroupButton"
                                    class="floating-group-secondary"
                                    disabled
                                >
                                    <i class="bi bi-box-arrow-up"></i>
                                    Ungroup
                                </button>

                                <button
                                    type="button"
                                    id="floatingGroupClearButton"
                                    class="floating-group-clear"
                                    disabled
                                >
                                    <i class="bi bi-x"></i>
                                    Clear
                                </button>

                            </div>

                        </div>


                        {{-- =================================================
                             CANVAS HEADER
                        ================================================== --}}

                        <div
                            class="flex items-center
                                   justify-between
                                   mb-6"
                        >

                            <div>

                                <p
                                    class="text-xs uppercase
                                           tracking-[0.25em]
                                           text-[#B87945]"
                                >
                                    Canvas
                                </p>

                                <h2
                                    class="text-xl font-bold
                                           text-[#0F3F4A]
                                           mt-1"
                                >
                                    Page Layout
                                </h2>

                            </div>

                            <span
                                class="px-3 py-1 rounded-full
                                       bg-[#E5EEF0]
                                       text-[#315F6D]
                                       text-xs font-semibold"
                            >
                                Fixed Layout
                            </span>

                        </div>

{{-- =================================================
     PAGE LAYOUT
================================================== --}}

@php
    $showSideContent =
        data_get(
            $page->content ?? [],
            'layout.show_side_content',
            !empty(data_get($page->content ?? [], 'side_content.blocks', []))
        );

    $showSideContent =
        $showSideContent === true ||
        $showSideContent === 1 ||
        $showSideContent === '1' ||
        $showSideContent === 'true';
@endphp

<div class="layout-settings-card">

    <div class="layout-settings-header">
        <div>
            <div class="layout-settings-title">
                <i class="bi bi-layout-sidebar-inset"></i>
                Page Layout
            </div>

            <div class="layout-settings-description">
                Choose whether the page uses a main content area with a sidebar.
            </div>
        </div>
    </div>

    {{-- Important:
         The hidden field guarantees Laravel receives false
         when the checkbox is turned off.
    --}}
    <input
        type="hidden"
        name="content[layout][show_side_content]"
        value="0"
    >

    <label class="layout-toggle">

        <input
            type="checkbox"
            name="content[layout][show_side_content]"
            value="1"
            id="showSideContent"
            {{ $showSideContent ? 'checked' : '' }}
        >

        <span class="layout-toggle-switch"></span>

        <span class="layout-toggle-text">
            <strong>Enable Side Content</strong>
            <small>
                Body content will use the main column and Side Content
                will appear in a sidebar.
            </small>
        </span>

    </label>

    <div
        id="layoutPreview"
        class="layout-preview {{ $showSideContent ? 'active' : '' }}"
    >

        <div class="layout-preview-main">
            <span>
                <i class="bi bi-layout-text-sidebar-reverse"></i>
                Main Content
            </span>
        </div>

        <div class="layout-preview-side">
            <span>
                <i class="bi bi-layout-sidebar"></i>
                Side Content
            </span>
        </div>

    </div>

</div>
                        {{-- =================================================
                             HEADER
                        ================================================== --}}

                        <div
    id="editorMainSideLayout"
    class="editor-main-side-layout {{ $showSideContent ? 'has-sidebar' : 'no-sidebar' }}"
>

    {{-- MAIN CONTENT COLUMN --}}
    <div class="editor-main-column">

        <div class="builder-section">
            <div class="section-label">
                <span>Body</span>

                <span class="section-description">
                    Main content
                </span>
            </div>

            <div
                class="drop-zone"
                data-zone="body"
            >
                @foreach(($page->content['body']['blocks'] ?? []) as $index => $block)

                    @include(
                        'admin.page-builder.block',
                        [
                            'block' => $block,
                            'section' => 'body',
                            'index' => $index,
                            'namePrefix' => "content[body][blocks][{$index}]",
                            'imagePrefix' => "images[body][{$index}]"
                        ]
                    )

                @endforeach

                @if(empty($page->content['body']['blocks']))
                    <div class="empty-zone">
                        Drop components here
                    </div>
                @endif
            </div>
        </div>

    </div>


    {{-- SIDEBAR COLUMN --}}
    <div
        id="editorSideColumn"
        class="editor-side-column"
        style="{{ $showSideContent ? '' : 'display:none;' }}"
    >

        <div class="builder-section">

            <div class="section-label">
                <span>Side Content</span>

                <span class="section-description">
                    Sidebar
                </span>
            </div>

            <div
                class="drop-zone"
                data-zone="side_content"
            >

                @foreach(($page->content['side_content']['blocks'] ?? []) as $index => $block)

                    @include(
                        'admin.page-builder.block',
                        [
                            'block' => $block,
                            'section' => 'side_content',
                            'index' => $index,
                            'namePrefix' => "content[side_content][blocks][{$index}]",
                            'imagePrefix' => "images[side_content][{$index}]"
                        ]
                    )

                @endforeach

                @if(empty($page->content['side_content']['blocks']))
                    <div class="empty-zone">
                        Drop components here
                    </div>
                @endif

            </div>

        </div>

    </div>

</div>


                        {{-- =================================================
                             BODY
                        ================================================== --}}

                        <div class="builder-section">

                            <div class="section-label">

                                <span>
                                    Body
                                </span>

                                <span class="section-description">
                                    Main content
                                </span>

                            </div>

                            <div
                                class="drop-zone"
                                data-zone="body"
                            >

                                @foreach(($page->content['body']['blocks'] ?? []) as $index => $block)

                                    @include(
                                        'admin.page-builder.block',
                                        [
                                            'block' => $block,
                                            'section' => 'body',
                                            'index' => $index,
                                            'namePrefix' => "content[body][blocks][{$index}]",
                                            'imagePrefix' => "images[body][{$index}]"
                                        ]
                                    )

                                @endforeach


                                @if(empty($page->content['body']['blocks']))

                                    <div class="empty-zone">
                                        Drop components here
                                    </div>

                                @endif

                            </div>

                        </div>


                        {{-- =================================================
                             SIDE CONTENT
                        ================================================== --}}

                        <div class="builder-section">

                            <div class="section-label">

                                <span>
                                    Side Content
                                </span>

                                <span class="section-description">
                                    Sidebar / additional content
                                </span>

                            </div>

                            <div
                                class="drop-zone"
                                data-zone="side_content"
                            >

                                @foreach(($page->content['side_content']['blocks'] ?? []) as $index => $block)

                                    @include(
                                        'admin.page-builder.block',
                                        [
                                            'block' => $block,
                                            'section' => 'side_content',
                                            'index' => $index,
                                            'namePrefix' => "content[side_content][blocks][{$index}]",
                                            'imagePrefix' => "images[side_content][{$index}]"
                                        ]
                                    )

                                @endforeach


                                @if(empty($page->content['side_content']['blocks']))

                                    <div class="empty-zone">
                                        Drop components here
                                    </div>

                                @endif

                            </div>

                        </div>


                        {{-- =================================================
                             FOOTER
                        ================================================== --}}

                        <div class="builder-section">

                            <div class="section-label">

                                <span>
                                    Footer
                                </span>

                                <span class="section-description">
                                    Bottom of page
                                </span>

                            </div>

                            <div
                                class="drop-zone"
                                data-zone="footer"
                            >

                                @foreach(($page->content['footer']['blocks'] ?? []) as $index => $block)

                                    @include(
                                        'admin.page-builder.block',
                                        [
                                            'block' => $block,
                                            'section' => 'footer',
                                            'index' => $index,
                                            'namePrefix' => "content[footer][blocks][{$index}]",
                                            'imagePrefix' => "images[footer][{$index}]"
                                        ]
                                    )

                                @endforeach


                                @if(empty($page->content['footer']['blocks']))

                                    <div class="empty-zone">
                                        Drop components here
                                    </div>

                                @endif

                            </div>

                        </div>


                        {{-- =================================================
                             SAVE
                        ================================================== --}}

                        <div class="flex justify-end mt-6">

                            <button
                                type="submit"
                                class="save-button"
                                id="savePageButton"
                            >

                                <i class="bi bi-check2-circle"></i>

                                Save Page

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>


{{-- =============================================================
     BOOTSTRAP ICONS
============================================================= --}}

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
>


<style>

/* =========================================================
   SIDEBAR
========================================================= */

.components-sidebar {
    height: calc(100vh - 180px);
    min-height: 500px;
}

.components-scroll-area {
    height: calc(100% - 105px);
    overflow-y: auto;
    padding-right: 6px;
}

.components-scroll-area::-webkit-scrollbar {
    width: 6px;
}

.components-scroll-area::-webkit-scrollbar-track {
    background: #F5F1E8;
    border-radius: 10px;
}

.components-scroll-area::-webkit-scrollbar-thumb {
    background: #BFD8CE;
    border-radius: 10px;
}

.components-scroll-area::-webkit-scrollbar-thumb:hover {
    background: #4F806D;
}


/* =========================================================
   COMPONENTS
========================================================= */

.builder-component {
    display: flex;
    align-items: center;
    gap: 12px;

    padding: 14px;
    margin-top: 10px;

    border: 1px solid #D5DDD8;
    border-radius: 12px;

    background: #FAF9F5;

    cursor: grab;
    user-select: none;
    -webkit-user-drag: element;

    transition:
        transform .15s ease,
        border-color .15s ease,
        box-shadow .15s ease,
        background .15s ease;
}

.builder-component:hover {
    border-color: #4F806D;
    transform: translateY(-2px);

    box-shadow:
        0 5px 15px rgba(0,0,0,.06);

    background: white;
}

.builder-component:active {
    cursor: grabbing;
    transform: scale(.98);
}

.builder-component.dragging-component {
    opacity: .5;
}


/* =========================================================
   COMPONENT ICON
========================================================= */

.component-icon {
    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: #E5EEF0;
    color: #0F3F4A;

    font-size: 19px;

    flex-shrink: 0;
}


/* =========================================================
   ICON LIBRARY
========================================================= */

.icon-library {
    margin-top: 20px;
    padding: 14px;

    border-radius: 14px;

    background: #F5F1E8;
    border: 1px solid #D5DDD8;
}

.icon-library-title {
    font-size: 11px;
    font-weight: 800;

    text-transform: uppercase;
    letter-spacing: .1em;

    color: #315F6D;

    display: flex;
    align-items: center;
    gap: 7px;

    margin-bottom: 12px;
}

.icon-library-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 6px;
}

.icon-library-grid span {
    display: flex;
    align-items: center;
    justify-content: center;

    height: 34px;

    border-radius: 8px;

    background: white;
    border: 1px solid #D5DDD8;

    color: #315F6D;

    font-size: 15px;

    cursor: pointer;

    transition:
        background .15s ease,
        border-color .15s ease,
        transform .15s ease;
}

.icon-library-grid span:hover {
    background: #E5EEF0;
    border-color: #4F806D;
    transform: translateY(-1px);
}


/* =========================================================
   BUILDER SECTIONS
========================================================= */

.builder-section {
    margin-bottom: 20px;

    border: 1px solid #D5DDD8;
    border-radius: 16px;

    overflow: visible;

    background: #FAF9F5;
}

.section-label {
    display: flex;
    justify-content: space-between;
    align-items: center;

    padding: 13px 16px;

    background: #E8E3D8;
    color: #29483D;

    font-size: 13px;
    font-weight: 700;

    text-transform: uppercase;
    letter-spacing: .12em;

    border-radius: 16px 16px 0 0;
}

.section-description {
    font-size: 10px;
    color: #8A9993;

    text-transform: none;
    letter-spacing: normal;

    font-weight: 500;
}


/* =========================================================
   DROP ZONES
========================================================= */

.drop-zone {
    min-height: 120px;

    padding: 16px;

    display: flex;
    flex-direction: column;

    gap: 12px;

    transition:
        background .15s ease,
        outline .15s ease;
}

.drop-zone.drag-over {
    background: #E5EEF0;

    outline: 2px dashed #4F806D;
    outline-offset: -8px;
}

.group-drop-zone {
    min-height: 90px;

    padding: 12px;

    display: flex;
    flex-direction: column;

    gap: 10px;
}

.group-drop-zone.drag-over {
    background: #E5EEF0;

    outline: 2px dashed #4F806D;
    outline-offset: -5px;
}


/* =========================================================
   EMPTY
========================================================= */

.empty-zone {
    border: 2px dashed #D5DDD8;
    border-radius: 12px;

    padding: 30px;

    text-align: center;

    color: #8A9993;

    pointer-events: none;
}

.group-drop-zone .empty-zone {
    padding: 22px;

    border: 2px dashed #C9DCD4;
    border-radius: 10px;

    text-align: center;

    color: #8A9993;

    font-size: 11px;
}


/* =========================================================
   BUILDER BLOCK
========================================================= */

.builder-block {
    position: relative;

    background: white;

    border: 1px solid #D5DDD8;
    border-radius: 14px;

    padding: 16px;

    cursor: grab;

    display: block;

    width: 100%;

    box-sizing: border-box;

    transition:
        border-color .15s ease,
        box-shadow .15s ease,
        opacity .15s ease;
}

.builder-block:hover {
    border-color: #4F806D;

    box-shadow:
        0 4px 14px rgba(0,0,0,.05);
}

.builder-block.dragging {
    opacity: .5;
}

.builder-block.selected {
    border-color: #4F806D;

    box-shadow:
        0 0 0 3px rgba(79,128,109,.13);
}


/* =========================================================
   BLOCK CONTENT
========================================================= */

.block-content {
    min-width: 0;
    width: var(--block-width, 100%);

    height: var(--block-height, auto);

    padding: var(--block-padding, 0);
    margin: var(--block-margin, 0);

    color: var(--block-color, inherit);
    background: var(--block-background, transparent);

    font-size: var(--block-font-size, inherit);
    font-weight: var(--block-font-weight, inherit);

    text-align: var(--block-text-align, inherit);

    border: var(--block-border, none);
    border-radius: var(--block-radius, 0);

    box-shadow: var(--block-shadow, none);

    transition: var(--block-transition, .2s);

    box-sizing: border-box;
}


/* =========================================================
   STYLE EDITOR
   IMPORTANT:
   NEVER MOVE THIS ELEMENT OUTSIDE THE FORM.
========================================================= */

.builder-block > .style-panel {
    display: none;
}

.builder-block > .style-panel.visible {
    display: block !important;
}

.style-panel {
    position: fixed !important;

    top: 120px;
    right: 24px;

    width: 360px;

    max-width: calc(100vw - 32px);
    max-height: calc(100vh - 140px);

    overflow-y: auto;

    box-sizing: border-box;

    padding: 16px;

    border-radius: 14px;

    background: #F5F1E8;

    border: 1px solid #D5DDD8;

    box-shadow:
        0 18px 45px rgba(0,0,0,.20);

    z-index: 999999;

    visibility: visible;

    opacity: 1;
}


/* =========================================================
   STYLE TITLE / DRAG HANDLE
========================================================= */

.style-title {
    cursor: move;
    user-select: none;

    padding: 10px 12px;

    margin: -4px -4px 15px -4px;

    border-radius: 10px;

    background: #E8E3D8;

    font-size: 13px;
    font-weight: 800;

    color: #0F3F4A;

    display: flex;
    align-items: center;

    gap: 8px;
}

.style-title .style-close-button {
    margin-left: auto;

    width: 28px;
    height: 28px;

    border: 0;

    border-radius: 7px;

    background: transparent;

    color: #6B7C75;

    cursor: pointer;

    display: inline-flex;

    align-items: center;
    justify-content: center;
}

.style-title .style-close-button:hover {
    background: #DCEAE4;
    color: #0F3F4A;
}


/* =========================================================
   STYLE SECTION
========================================================= */

.style-section-title {
    margin-top: 18px;
    margin-bottom: 10px;

    padding-bottom: 7px;

    border-bottom: 1px solid #D5DDD8;

    font-size: 11px;
    font-weight: 800;

    color: #315F6D;

    text-transform: uppercase;
    letter-spacing: .08em;
}

.style-field {
    margin-top: 12px;
}

.style-field label,
.four-grid label {
    display: block;

    margin-bottom: 6px;

    font-size: 11px;
    font-weight: 700;

    color: #315F6D;
}


/* =========================================================
   FORM CONTROLS
========================================================= */

.style-field input[type="text"],
.style-field input[type="number"],
.style-field select,
.four-grid input,
.four-grid select {

    width: 100%;

    padding: 9px 10px;

    border: 1px solid #D5DDD8;

    border-radius: 9px;

    background: white;

    color: #0F3F4A;

    font-size: 12px;

    outline: none;

    box-sizing: border-box;
}

.style-field input:focus,
.style-field select:focus,
.four-grid input:focus,
.four-grid select:focus {

    border-color: #4F806D;

    box-shadow:
        0 0 0 2px rgba(79,128,109,.12);
}


/* =========================================================
   COLOR
   SOLID COLOR ONLY
========================================================= */

.color-row {
    display: flex;
    align-items: center;

    gap: 8px;
}

.color-row input[type="color"] {

    width: 46px;
    height: 38px;

    padding: 2px;

    border: 1px solid #D5DDD8;

    border-radius: 8px;

    background: white;

    cursor: pointer;

    flex-shrink: 0;
}

.color-row input[type="text"] {
    flex: 1;
}


/* =========================================================
   GRID
========================================================= */

.four-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 10px;
}


/* =========================================================
   ICON PREVIEW
========================================================= */

.icon-preview {
    margin-top: 12px;

    width: 70px;
    height: 70px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 14px;

    background: #E5EEF0;

    color: #0F3F4A;

    font-size: 32px;

    border: 1px solid #D5DDD8;

    box-sizing: border-box;
}


/* =========================================================
   GROUP SELECTION
========================================================= */

.block-group-selection-controls {

    display: flex;

    align-items: center;

    gap: 7px;

    padding-bottom: 9px;

    margin-bottom: 12px;

    border-bottom: 1px solid #E6ECE9;

    font-size: 10px;

    color: #537269;

    cursor: pointer;
}

.block-selection-checkbox {

    width: 13px;
    height: 13px;

    accent-color: #4F806D;

    cursor: pointer;
}

.builder-block.group-selected {

    border-color: #B87945;

    box-shadow:
        0 0 0 3px rgba(184,121,69,.12);
}

.builder-block.group-selected::after {

    content: "";

    position: absolute;

    top: 7px;
    right: 7px;

    width: 9px;
    height: 9px;

    border-radius: 50%;

    background: #B87945;
}


/* =========================================================
   GROUP CONTAINER
========================================================= */

.builder-block.group-container {

    padding: 0;

    overflow: visible;

    border: 2px solid #A9C6BA;

    background: #F4F8F6;
}

.builder-block.group-container > .block-group-selection-controls {

    margin: 0;

    padding: 10px 14px;

    background: #EAF2EE;

    border-bottom: 1px solid #C9DCD4;
}

.group-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;

    padding: 11px 14px;

    background: #EAF2EE;

    border-bottom: 1px solid #C9DCD4;
}

.group-header-left {

    display: flex;

    align-items: center;

    gap: 8px;

    min-width: 0;
}

.group-header-icon {
    color: #4F806D;
}

.group-label-input {

    width: 220px;

    max-width: 100%;

    padding: 7px 9px;

    border: 1px solid #C9DCD4;

    border-radius: 8px;

    background: white;

    color: #0F3F4A;

    font-size: 12px;

    font-weight: 700;

    outline: none;
}

.group-label-input:focus {

    border-color: #4F806D;

    box-shadow:
        0 0 0 2px rgba(79,128,109,.10);
}

.group-header-actions {

    display: flex;

    gap: 6px;
}

.group-header-actions button {

    border: 0;

    background: transparent;

    color: #7D8C86;

    cursor: pointer;

    font-size: 11px;

    padding: 5px 7px;

    border-radius: 6px;
}

.group-header-actions button:hover {

    background: #DCEAE4;

    color: #315F6D;
}

.group-block-content {

    padding: 14px;

    border: 2px dashed #BFD8CE;

    border-radius: 12px;

    background: #F7FAF8;
}


/* =========================================================
   GROUP TOOLBAR
========================================================= */

.floating-group-toolbar {

    position: fixed;

    left: 50%;
    bottom: 25px;

    transform:
        translateX(-50%)
        translateY(30px);

    width:
        min(900px, calc(100vw - 40px));

    padding: 12px 14px;

    background: white;

    border: 1px solid #D5DDD8;

    border-radius: 15px;

    box-shadow:
        0 15px 40px rgba(0,0,0,.18);

    z-index: 99990;

    display: flex;

    align-items: center;

    gap: 12px;

    opacity: 0;

    visibility: hidden;

    pointer-events: none;

    transition:
        opacity .2s ease,
        transform .2s ease,
        visibility .2s ease;
}

.floating-group-toolbar.visible {

    opacity: 1;

    visibility: visible;

    pointer-events: auto;

    transform:
        translateX(-50%)
        translateY(0);
}

.floating-group-icon {

    width: 40px;
    height: 40px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #E5EEF0;

    color: #315F6D;

    flex-shrink: 0;
}

.floating-group-info {

    flex: 1;

    min-width: 0;
}

.floating-group-title {

    font-size: 13px;

    font-weight: 800;

    color: #0F3F4A;
}

.floating-group-status {

    margin-top: 2px;

    font-size: 11px;

    color: #8A9993;
}

.floating-group-actions {

    display: flex;

    align-items: center;

    gap: 7px;
}

.floating-group-actions button {

    border: 1px solid #D5DDD8;

    border-radius: 9px;

    padding: 9px 12px;

    font-size: 11px;

    font-weight: 700;

    display: inline-flex;

    align-items: center;

    gap: 6px;

    cursor: pointer;
}

.floating-group-actions button:disabled {

    opacity: .45;

    cursor: not-allowed;
}

.floating-group-primary {

    background: #4F806D;

    border-color: #4F806D !important;

    color: white;
}

.floating-group-primary:hover:not(:disabled) {
    background: #3E735F;
}

.floating-group-secondary {

    background: #F5F1E8;

    color: #315F6D;
}

.floating-group-clear {

    background: white;

    color: #8A5B45;
}


/* =========================================================
   SAVE
========================================================= */

.save-button {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding: 13px 24px;

    border-radius: 12px;

    background: #4F806D;

    color: white;

    font-weight: 700;

    border: 0;

    cursor: pointer;

    transition:
        background .2s ease,
        transform .2s ease,
        box-shadow .2s ease;
}

.save-button:hover {

    background: #3E735F;

    transform: translateY(-1px);

    box-shadow:
        0 5px 14px rgba(62,115,95,.25);
}

.save-button:disabled {

    opacity: .7;

    cursor: wait;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1024px) {

    .components-sidebar {

        height: auto;

        min-height: 0;
    }

    .components-scroll-area {

        height: auto;

        max-height: 450px;
    }

}

@media (max-width: 900px) {

    .style-panel {

        top: 15px;

        right: 10px;

        width:
            min(360px, calc(100vw - 20px));

        max-height:
            calc(100vh - 30px);
    }

    .floating-group-toolbar {

        flex-wrap: wrap;
    }

    .floating-group-actions {

        width: 100%;
    }

    .floating-group-actions button {

        flex: 1;

        justify-content: center;
    }

}

@media (max-width: 640px) {

    .four-grid {

        grid-template-columns: 1fr;
    }

    .floating-group-toolbar {

        width:
            calc(100vw - 20px);

        bottom: 10px;
    }

    .group-label-input {

        width: 150px;
    }

}
/* =========================================================
   PAGE LAYOUT SETTINGS
========================================================= */

.layout-settings-card {
    margin-bottom: 20px;

    padding: 18px;

    background: #FFFFFF;

    border: 1px solid #D5DDD8;

    border-radius: 14px;

    box-shadow:
        0 4px 14px rgba(0,0,0,0.04);
}

.layout-settings-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-bottom: 15px;
}

.layout-settings-title {
    display: flex;
    align-items: center;

    gap: 8px;

    color: #0F3F4A;

    font-size: 14px;
    font-weight: 800;
}

.layout-settings-title i {
    color: #4F806D;
    font-size: 16px;
}

.layout-settings-description {
    margin-top: 4px;

    color: #8A9993;

    font-size: 11px;
}

/* ---------------------------------------------------------
   TOGGLE
--------------------------------------------------------- */

.layout-toggle {
    display: flex;
    align-items: center;

    gap: 12px;

    padding: 12px;

    border: 1px solid #D5DDD8;

    border-radius: 11px;

    background: #FAF9F5;

    cursor: pointer;

    user-select: none;

    transition:
        border-color .2s ease,
        background .2s ease;
}

.layout-toggle:hover {
    border-color: #4F806D;

    background: #F5FAF7;
}

.layout-toggle input {
    position: absolute;

    opacity: 0;

    pointer-events: none;
}

.layout-toggle-switch {
    position: relative;

    width: 42px;
    height: 23px;

    flex-shrink: 0;

    border-radius: 999px;

    background: #C8D4CF;

    transition:
        background .2s ease;
}

.layout-toggle-switch::after {
    content: "";

    position: absolute;

    top: 3px;
    left: 3px;

    width: 17px;
    height: 17px;

    border-radius: 50%;

    background: #FFFFFF;

    box-shadow:
        0 1px 4px rgba(0,0,0,.15);

    transition:
        transform .2s ease;
}

.layout-toggle input:checked + .layout-toggle-switch {
    background: #4F806D;
}

.layout-toggle input:checked + .layout-toggle-switch::after {
    transform: translateX(19px);
}

.layout-toggle-text {
    display: flex;

    flex-direction: column;

    gap: 3px;
}

.layout-toggle-text strong {
    color: #0F3F4A;

    font-size: 12px;
    font-weight: 800;
}

.layout-toggle-text small {
    color: #8A9993;

    font-size: 10px;
}

/* ---------------------------------------------------------
   LAYOUT PREVIEW
--------------------------------------------------------- */

.layout-preview {
    display: grid;

    grid-template-columns: 1fr;

    gap: 8px;

    margin-top: 14px;

    transition:
        grid-template-columns .2s ease;
}

.layout-preview.active {
    grid-template-columns: 2fr 1fr;
}

.layout-preview-main,
.layout-preview-side {
    min-height: 55px;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 10px;

    border: 1px dashed #BFD8CE;

    border-radius: 9px;

    background: #F5F9F7;

    color: #4F806D;

    font-size: 10px;
    font-weight: 700;
}

.layout-preview-side {
    display: none;

    background: #F8F5EF;

    border-color: #D8CBB8;

    color: #B87945;
}

.layout-preview.active .layout-preview-side {
    display: flex;
}

.layout-preview span {
    display: inline-flex;

    align-items: center;

    gap: 5px;
}

/* ---------------------------------------------------------
   MOBILE
--------------------------------------------------------- */

@media (max-width: 640px) {

    .layout-preview.active {
        grid-template-columns: 1fr;
    }

}
.editor-main-side-layout {
    display: grid;
    grid-template-columns: minmax(0, 2fr) minmax(280px, 1fr);
    gap: 20px;
    align-items: start;
    margin-bottom: 20px;
}

.editor-main-side-layout.no-sidebar {
    grid-template-columns: minmax(0, 1fr);
}

.editor-main-column,
.editor-side-column {
    min-width: 0;
}

.editor-side-column {
    min-height: 100%;
}

.editor-side-column .builder-section {
    height: 100%;
}

.editor-side-column .drop-zone {
    min-height: 250px;
}

@media (max-width: 900px) {
    .editor-main-side-layout {
        grid-template-columns: 1fr;
    }
}
</style>


<script>

document.addEventListener('DOMContentLoaded', function () {

    'use strict';


    /* =========================================================
       STATE
    ========================================================== */

    let draggedComponent = null;

    let draggedBlock = null;

    let selectedStyleBlock = null;

    const selectedBlocks = new Set();


    /* =========================================================
       HELPERS
    ========================================================== */

    function createId() {

        return (
            Date.now().toString(36) +
            Math.random()
                .toString(36)
                .substring(2, 10)
        );

    }


    function isGroup(block) {

        return !!(
            block &&
            (
                block.dataset.blockType === 'group' ||
                block.dataset.isGroup === 'true' ||
                block.classList.contains('group-container')
            )
        );

    }


    function getGroupDropZone(group) {

        if (!group) {
            return null;
        }

        return group.querySelector(
            ':scope > .block-content > .group-block-content > .group-drop-zone'
        ) || group.querySelector(
            ':scope > .group-block-content > .group-drop-zone'
        ) || group.querySelector(
            ':scope > .group-drop-zone'
        );

    }


    function getParentDropZone(block) {

        if (!block) {
            return null;
        }

        return block.parentElement &&
            block.parentElement.classList.contains('drop-zone')
                ? block.parentElement
                : null;

    }


    function getDirectBlocks(container) {

        if (!container) {
            return [];
        }

        return Array.from(
            container.children
        ).filter(function (child) {

            return (
                child.classList &&
                child.classList.contains('builder-block')
            );

        });

    }


    function removeEmptyMessage(container) {

        if (!container) {
            return;
        }

        const empty =
            container.querySelector(
                ':scope > .empty-zone'
            );

        if (empty) {
            empty.remove();
        }

    }


    function addEmptyMessage(container) {

        if (!container) {
            return;
        }

        if (
            getDirectBlocks(container).length > 0
        ) {
            removeEmptyMessage(container);
            return;
        }

        if (
            container.querySelector(
                ':scope > .empty-zone'
            )
        ) {
            return;
        }

        const empty =
            document.createElement('div');

        empty.className =
            'empty-zone';

        empty.innerText =
            container.classList.contains(
                'group-drop-zone'
            )
                ? 'Drop components into this group'
                : 'Drop components here';

        container.appendChild(empty);

    }


    function getSectionFromGroup(container) {

        const group =
            container.closest(
                '.builder-block.group-container'
            );

        if (!group) {
            return 'body';
        }

        const outerZone =
            group.closest(
                '.drop-zone[data-zone]'
            );

        return (
            outerZone?.dataset.zone ||
            'body'
        );

    }


    /* =========================================================
       STYLE EDITOR
       IMPORTANT:
       THE PANEL IS NEVER MOVED OUT OF THE FORM.
    ========================================================== */

    function closeStyleEditor() {

        if (selectedStyleBlock) {

            selectedStyleBlock
                .classList
                .remove('selected');

        }

        document
            .querySelectorAll(
                '.builder-block.selected'
            )
            .forEach(function (block) {

                block.classList.remove(
                    'selected'
                );

            });

        document
            .querySelectorAll(
                '.builder-block > .style-panel.visible'
            )
            .forEach(function (panel) {

                panel.classList.remove(
                    'visible'
                );

            });

        selectedStyleBlock = null;

    }


    function openStyleEditor(block) {

        if (!block || isGroup(block)) {
            return;
        }

        const panel =
            block.querySelector(
                ':scope > .style-panel'
            );

        if (!panel) {

            console.warn(
                'Page Builder: Style Editor not found for block.',
                block
            );

            return;
        }

        document
            .querySelectorAll(
                '.builder-block.selected'
            )
            .forEach(function (item) {

                if (item !== block) {

                    item.classList.remove(
                        'selected'
                    );

                }

            });

        document
            .querySelectorAll(
                '.builder-block > .style-panel.visible'
            )
            .forEach(function (item) {

                if (item !== panel) {

                    item.classList.remove(
                        'visible'
                    );

                }

            });

        block.classList.add(
            'selected'
        );

        panel.classList.add(
            'visible'
        );

        selectedStyleBlock =
            block;

        syncStylePanelFromBlock(
            block,
            panel
        );

        setupStylePanelDragging(
            panel
        );

    }


    function selectBlockForStyle(block) {

        if (!block || isGroup(block)) {
            return;
        }

        openStyleEditor(block);

    }


    /* =========================================================
       STYLE VALUES
    ========================================================== */

    const styleVariableMap = {

        color:
            '--block-color',

        background:
            '--block-background',

        font_size:
            '--block-font-size',

        font_weight:
            '--block-font-weight',

        text_align:
            '--block-text-align',

        width:
            '--block-width',

        height:
            '--block-height',

        padding:
            '--block-padding',

        margin:
            '--block-margin',

        border:
            '--block-border',

        radius:
            '--block-radius',

        shadow:
            '--block-shadow',

        transition:
            '--block-transition'

    };


    function normalizeColor(value) {

        const valueString =
            String(value || '')
                .trim();

        if (
            /^#[0-9a-fA-F]{6}$/
                .test(valueString)
        ) {

            return valueString
                .toUpperCase();

        }

        return null;

    }


    function applyStyleToBlock(
        block,
        property,
        value
    ) {

        if (
            !block ||
            !property ||
            !styleVariableMap[property]
        ) {
            return;
        }

        const variable =
            styleVariableMap[property];

        block.style.setProperty(
            variable,
            value
        );


        const content =
            block.querySelector(
                ':scope > .block-content'
            );

        if (content) {

            content.style.setProperty(
                variable,
                value
            );

        }


        block
            .querySelectorAll(
                '.live-style-target'
            )
            .forEach(function (target) {

                if (
                    property === 'color'
                ) {

                    target.style.color =
                        value;

                }

                else if (
                    property === 'background'
                ) {

                    target.style.backgroundColor =
                        value;

                }

                else if (
                    property === 'font_size'
                ) {

                    target.style.fontSize =
                        value;

                }

                else if (
                    property === 'font_weight'
                ) {

                    target.style.fontWeight =
                        value;

                }

                else if (
                    property === 'text_align'
                ) {

                    target.style.textAlign =
                        value;

                }

                else if (
                    property === 'width'
                ) {

                    target.style.width =
                        value;

                }

                else if (
                    property === 'height'
                ) {

                    target.style.height =
                        value;

                }

                else if (
                    property === 'padding'
                ) {

                    target.style.padding =
                        value;

                }

                else if (
                    property === 'margin'
                ) {

                    target.style.margin =
                        value;

                }

                else if (
                    property === 'border'
                ) {

                    target.style.border =
                        value;

                }

                else if (
                    property === 'radius'
                ) {

                    target.style.borderRadius =
                        value;

                }

                else if (
                    property === 'shadow'
                ) {

                    target.style.boxShadow =
                        value;

                }

                else if (
                    property === 'transition'
                ) {

                    target.style.transition =
                        value;

                }

            });

    }


    function applyLiveStyle(input) {

        if (!input) {
            return;
        }

        const property =
            input.dataset.style;

        if (!property) {
            return;
        }

        const block =
            input.closest(
                '.builder-block'
            );

        /*
         * This is why the editor is NOT moved
         * outside the block anymore.
         */
        if (!block) {
            return;
        }

        let value =
            String(input.value ?? '')
                .trim();


        /*
         * COLOR
         */

        if (
            property === 'color' ||
            property === 'background'
        ) {

            const normalized =
                normalizeColor(value);

            if (!normalized) {
                return;
            }

            value =
                normalized;

            const row =
                input.closest(
                    '.color-row'
                );

            if (row) {

                const colorInput =
                    row.querySelector(
                        'input[type="color"]'
                    );

                const textInput =
                    row.querySelector(
                        'input[type="text"]'
                    );

                if (colorInput) {

                    colorInput.value =
                        normalized;

                }

                if (
                    textInput &&
                    textInput !== input
                ) {

                    textInput.value =
                        normalized;

                }

            }

        }


        /*
         * Apply immediately.
         */

        applyStyleToBlock(
            block,
            property,
            value
        );

    }


    window.applyLiveStyle =
        applyLiveStyle;


    window.applyLiveStyleInput =
        applyLiveStyle;


    /* =========================================================
       COLOR PICKER
    ========================================================== */

    function syncColor(colorInput) {

        if (!colorInput) {
            return;
        }

        const row =
            colorInput.closest(
                '.color-row'
            );

        if (!row) {
            return;
        }

        const textInput =
            row.querySelector(
                'input[type="text"]'
            );

        if (!textInput) {
            return;
        }

        textInput.value =
            colorInput.value
                .toUpperCase();

        applyLiveStyle(
            colorInput
        );

    }


    function syncColorText(textInput) {

        if (!textInput) {
            return;
        }

        const normalized =
            normalizeColor(
                textInput.value
            );

        if (!normalized) {
            return;
        }

        textInput.value =
            normalized;

        const row =
            textInput.closest(
                '.color-row'
            );

        if (!row) {
            return;
        }

        const colorInput =
            row.querySelector(
                'input[type="color"]'
            );

        if (colorInput) {

            colorInput.value =
                normalized;

        }

        applyLiveStyle(
            textInput
        );

    }


    window.syncColor =
        syncColor;

    window.syncColorText =
        syncColorText;


    /* =========================================================
       SYNC STYLE PANEL
    ========================================================== */

    function syncStylePanelFromBlock(
        block,
        panel
    ) {

        if (!block || !panel) {
            return;
        }

        const computed =
            getComputedStyle(
                block
            );


        panel
            .querySelectorAll(
                '[data-style]'
            )
            .forEach(function (input) {

                const property =
                    input.dataset.style;

                if (!property) {
                    return;
                }

                let value = '';


                if (
                    property === 'color'
                ) {

                    value =
                        block.style.getPropertyValue(
                            '--block-color'
                        ).trim();

                    if (!value) {

                        value =
                            computed.color;

                    }

                }

                else if (
                    property === 'background'
                ) {

                    value =
                        block.style.getPropertyValue(
                            '--block-background'
                        ).trim();

                }

                else {

                    const variable =
                        styleVariableMap[
                            property
                        ];

                    if (variable) {

                        value =
                            block.style
                                .getPropertyValue(
                                    variable
                                )
                                .trim();

                    }

                }


                if (
                    input.type === 'color'
                ) {

                    const color =
                        normalizeColor(
                            value
                        );

                    if (color) {

                        input.value =
                            color;

                    }

                    return;

                }


                if (
                    value !== ''
                ) {

                    input.value =
                        value;

                }

            });


        /*
         * Keep paired color text inputs
         * synchronized.
         */

        panel
            .querySelectorAll(
                '.color-row'
            )
            .forEach(function (row) {

                const colorInput =
                    row.querySelector(
                        'input[type="color"]'
                    );

                const textInput =
                    row.querySelector(
                        'input[type="text"]'
                    );

                if (
                    colorInput &&
                    textInput
                ) {

                    textInput.value =
                        colorInput.value
                            .toUpperCase();

                }

            });

    }


    /* =========================================================
       STYLE PANEL DRAGGING
    ========================================================== */

    function setupStylePanelDragging(panel) {

        if (!panel) {
            return;
        }

        if (
            panel.dataset.dragBound === 'true'
        ) {
            return;
        }

        panel.dataset.dragBound =
            'true';


        const title =
            panel.querySelector(
                '.style-title'
            );

        if (!title) {
            return;
        }


        /*
         * Close button.
         */

        if (
            !title.querySelector(
                '.style-close-button'
            )
        ) {

            const closeButton =
                document.createElement(
                    'button'
                );

            closeButton.type =
                'button';

            closeButton.className =
                'style-close-button';

            closeButton.title =
                'Close Style Editor';

            closeButton.innerHTML =
                '<i class="bi bi-x-lg"></i>';

            closeButton.addEventListener(
                'click',
                function (event) {

                    event.preventDefault();

                    event.stopPropagation();

                    closeStyleEditor();

                }
            );

            title.appendChild(
                closeButton
            );

        }


        let dragging = false;

        let startX = 0;
        let startY = 0;

        let startLeft = 0;
        let startTop = 0;


        title.addEventListener(
            'mousedown',
            function (event) {

                if (
                    event.target.closest(
                        'button'
                    ) ||
                    event.target.closest(
                        'input'
                    ) ||
                    event.target.closest(
                        'select'
                    )
                ) {
                    return;
                }

                event.preventDefault();

                const rect =
                    panel.getBoundingClientRect();

                dragging = true;

                startX =
                    event.clientX;

                startY =
                    event.clientY;

                startLeft =
                    rect.left;

                startTop =
                    rect.top;

                panel.style.right =
                    'auto';

                panel.style.left =
                    startLeft + 'px';

                panel.style.top =
                    startTop + 'px';

                document.body.style.userSelect =
                    'none';

            }
        );


        const mouseMoveHandler =
            function (event) {

                if (!dragging) {
                    return;
                }

                const left =
                    startLeft +
                    event.clientX -
                    startX;

                const top =
                    startTop +
                    event.clientY -
                    startY;

                const maxLeft =
                    Math.max(
                        0,
                        window.innerWidth -
                        panel.offsetWidth
                    );

                const maxTop =
                    Math.max(
                        0,
                        window.innerHeight -
                        panel.offsetHeight
                    );

                panel.style.left =
                    Math.max(
                        0,
                        Math.min(
                            left,
                            maxLeft
                        )
                    ) + 'px';

                panel.style.top =
                    Math.max(
                        0,
                        Math.min(
                            top,
                            maxTop
                        )
                    ) + 'px';

            };


        const mouseUpHandler =
            function () {

                if (!dragging) {
                    return;
                }

                dragging = false;

                document.body.style.userSelect =
                    '';

            };


        document.addEventListener(
            'mousemove',
            mouseMoveHandler
        );

        document.addEventListener(
            'mouseup',
            mouseUpHandler
        );

    }


    /* =========================================================
       BLOCK CLICK
    ========================================================== */

    document.addEventListener(
        'click',
        function (event) {

            const target =
                event.target;

            if (
                !target ||
                !target.closest
            ) {
                return;
            }


            /*
             * Do not treat Style Editor controls
             * as a new block click.
             */

            if (
                target.closest(
                    '.style-panel'
                )
            ) {
                return;
            }


            /*
             * Do not open editor from
             * buttons or selection checkbox.
             */

            if (
                target.closest(
                    'button'
                ) ||
                target.closest(
                    '.block-group-selection-controls'
                )
            ) {
                return;
            }


            const block =
                target.closest(
                    '.builder-block'
                );

            if (!block) {
                return;
            }


            /*
             * Groups themselves do not open
             * the Style Editor.
             */

            if (
                isGroup(block)
            ) {
                return;
            }


            selectBlockForStyle(
                block
            );

        }
    );


    /* =========================================================
       ESCAPE
    ========================================================== */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape'
            ) {

                closeStyleEditor();

            }

        }
    );


    /* =========================================================
       BLOCK DRAGGING
    ========================================================== */

    function setupBlockDragging(block) {

        if (!block) {
            return;
        }

        if (
            block.dataset.dragBound === 'true'
        ) {
            return;
        }

        block.dataset.dragBound =
            'true';


        block.addEventListener(
            'dragstart',
            function (event) {

                /*
                 * Do not start block dragging when
                 * interacting with inputs.
                 */

                if (
                    event.target.closest(
                        'input'
                    ) ||
                    event.target.closest(
                        'textarea'
                    ) ||
                    event.target.closest(
                        'select'
                    ) ||
                    event.target.closest(
                        'button'
                    )
                ) {

                    event.preventDefault();

                    return;

                }


                draggedBlock =
                    this;

                draggedComponent =
                    null;

                event.dataTransfer.effectAllowed =
                    'move';

                event.dataTransfer.setData(
                    'text/plain',
                    'existing-block'
                );

                this.classList.add(
                    'dragging'
                );

            }
        );


        block.addEventListener(
            'dragend',
            function () {

                this.classList.remove(
                    'dragging'
                );

                draggedBlock =
                    null;

                document
                    .querySelectorAll(
                        '.drop-zone.drag-over'
                    )
                    .forEach(function (zone) {

                        zone.classList.remove(
                            'drag-over'
                        );

                    });

            }
        );

    }


    /* =========================================================
       COMPONENT DRAGGING
    ========================================================== */

    document
        .querySelectorAll(
            '.builder-component'
        )
        .forEach(function (component) {

            component.addEventListener(
                'dragstart',
                function (event) {

                    draggedComponent =
                        this.dataset.component;

                    draggedBlock =
                        null;

                    event.dataTransfer.effectAllowed =
                        'copy';

                    event.dataTransfer.setData(
                        'text/plain',
                        draggedComponent
                    );

                    this.classList.add(
                        'dragging-component'
                    );

                }
            );


            component.addEventListener(
                'dragend',
                function () {

                    this.classList.remove(
                        'dragging-component'
                    );

                    draggedComponent =
                        null;

                }
            );

        });


    /* =========================================================
       DROP ZONE
    ========================================================== */

    function setupDropZone(zone) {

        if (!zone) {
            return;
        }

        if (
            zone.dataset.dropBound === 'true'
        ) {
            return;
        }

        zone.dataset.dropBound =
            'true';


        zone.addEventListener(
            'dragover',
            function (event) {

                event.preventDefault();

                event.dataTransfer.dropEffect =
                    draggedBlock
                        ? 'move'
                        : 'copy';

                this.classList.add(
                    'drag-over'
                );

            }
        );


        zone.addEventListener(
            'dragenter',
            function (event) {

                event.preventDefault();

                this.classList.add(
                    'drag-over'
                );

            }
        );


        zone.addEventListener(
            'dragleave',
            function (event) {

                if (
                    event.relatedTarget &&
                    this.contains(
                        event.relatedTarget
                    )
                ) {
                    return;
                }

                this.classList.remove(
                    'drag-over'
                );

            }
        );


        zone.addEventListener(
            'drop',
            function (event) {

                event.preventDefault();

                event.stopPropagation();

                this.classList.remove(
                    'drag-over'
                );


                /*
                 * MOVE EXISTING BLOCK
                 */

                if (draggedBlock) {

                    const movingBlock =
                        draggedBlock;

                    const oldParent =
                        movingBlock.parentElement;


                    /*
                     * Never put a group
                     * inside itself.
                     */

                    if (
                        movingBlock === this ||
                        movingBlock.contains(
                            this
                        )
                    ) {

                        draggedBlock =
                            null;

                        return;

                    }


                    removeEmptyMessage(
                        this
                    );


                    this.appendChild(
                        movingBlock
                    );


                    if (
                        oldParent &&
                        oldParent !== this
                    ) {

                        reindexContainer(
                            oldParent
                        );

                        addEmptyMessage(
                            oldParent
                        );

                    }


                    reindexContainer(
                        this
                    );


                    draggedBlock =
                        null;

                    return;

                }


                /*
                 * ADD NEW COMPONENT
                 */

                let componentType =
                    draggedComponent;

                if (!componentType) {

                    componentType =
                        event.dataTransfer.getData(
                            'text/plain'
                        );

                }


                if (!componentType) {
                    return;
                }


                if (
                    componentType === 'group'
                ) {

                    addGroupComponent(
                        this
                    );

                } else {

                    addBlock(
                        this,
                        componentType
                    );

                }


                draggedComponent =
                    null;

            }
        );

    }


    /* =========================================================
       REINDEX NORMAL CONTAINER
    ========================================================== */

    function reindexContainer(container) {

        if (!container) {
            return;
        }


        const blocks =
            getDirectBlocks(
                container
            );


        /*
         * NORMAL SECTION
         */

        if (
            container.classList.contains(
                'drop-zone'
            ) &&
            container.dataset.zone
        ) {

            const section =
                container.dataset.zone;


            blocks.forEach(
                function (block, index) {

                    const prefix =
                        `content[${section}][blocks][${index}]`;

                    const imagePrefix =
                        `images[${section}][${index}]`;


                    block.dataset.section =
                        section;

                    block.dataset.index =
                        index;


                    if (
                        isGroup(block)
                    ) {

                        reindexGroup(
                            block,
                            prefix,
                            imagePrefix
                        );

                    } else {

                        updateBlockFieldPrefix(
                            block,
                            prefix,
                            imagePrefix
                        );

                    }

                }
            );


            return;

        }


        /*
         * GROUP CONTAINER
         */

        if (
            container.classList.contains(
                'group-drop-zone'
            )
        ) {

            const group =
                container.closest(
                    '.builder-block.group-container'
                );

            if (group) {

                const outerZone =
                    group.closest(
                        '.drop-zone[data-zone]'
                    );

                const section =
                    outerZone?.dataset.zone ||
                    'body';

                const outerBlocks =
                    getDirectBlocks(
                        outerZone
                    );

                const groupIndex =
                    outerBlocks.indexOf(
                        group
                    );


                const groupPrefix =
                    `content[${section}][blocks][${groupIndex}]`;

                const groupImagePrefix =
                    `images[${section}][${groupIndex}]`;


                reindexGroup(
                    group,
                    groupPrefix,
                    groupImagePrefix
                );

            }

        }

    }


    /* =========================================================
       UPDATE FIELD PREFIX
    ========================================================== */

    function updateBlockFieldPrefix(
        block,
        prefix,
        imagePrefix
    ) {

        if (!block) {
            return;
        }


        block.dataset.fieldPrefix =
            prefix;


        block
            .querySelectorAll(
                '[name]'
            )
            .forEach(function (input) {

                const name =
                    input.getAttribute(
                        'name'
                    );

                if (!name) {
                    return;
                }


                /*
                 * Already correct?
                 */

                if (
                    name.startsWith(
                        prefix
                    )
                ) {
                    return;
                }


                /*
                 * CONTENT FIELD
                 */

                const contentMatch =
                    name.match(
                        /^content(?:\[[^\]]+\])+(?:\[blocks\])?(?:\[[^\]]+\])*(.*)$/
                    );


                if (
                    name.startsWith(
                        'content['
                    )
                ) {

                    const lastStyle =
                        name.match(
                            /(\[(?:style|text|url|type|icon)\].*)$/
                        );


                    if (lastStyle) {

                        input.name =
                            prefix +
                            lastStyle[1];

                    }

                }


                /*
                 * IMAGE
                 */

                if (
                    name.startsWith(
                        'images['
                    )
                ) {

                    input.name =
                        imagePrefix;

                }

            });

    }


    /* =========================================================
       REINDEX GROUP
    ========================================================== */

    function reindexGroup(
        group,
        prefix,
        imagePrefix
    ) {

        if (!group) {
            return;
        }


        group.classList.add(
            'group-container'
        );

        group.dataset.blockType =
            'group';

        group.dataset.isGroup =
            'true';

        group.dataset.fieldPrefix =
            prefix;


        /*
         * GROUP TYPE
         */

        const typeInput =
            group.querySelector(
                ':scope > .block-content input.group-type-input'
            ) ||
            group.querySelector(
                ':scope > .block-content input[type="hidden"][value="group"]'
            );

        if (typeInput) {

            typeInput.name =
                `${prefix}[type]`;

        }


        /*
         * GROUP LABEL
         */

        const labelInput =
            group.querySelector(
                ':scope > .block-content .group-label-input'
            );

        if (labelInput) {

            labelInput.name =
                `${prefix}[label]`;

        }


        /*
         * GROUP CHILDREN
         */

        const groupZone =
            getGroupDropZone(
                group
            );

        if (!groupZone) {
            return;
        }


        const children =
            getDirectBlocks(
                groupZone
            );


        children.forEach(
            function (child, index) {

                const childPrefix =
                    `${prefix}[children][${index}]`;

                const childImagePrefix =
                    `${imagePrefix}[children][${index}]`;


                child.dataset.index =
                    index;


                child.dataset.section =
                    group.dataset.section ||
                    '';


                if (
                    isGroup(child)
                ) {

                    reindexGroup(
                        child,
                        childPrefix,
                        childImagePrefix
                    );

                } else {

                    updateBlockFieldPrefix(
                        child,
                        childPrefix,
                        childImagePrefix
                    );

                }

            }
        );


        addEmptyMessage(
            groupZone
        );

    }


    /* =========================================================
       FULL REINDEX
    ========================================================== */

    function reindexAll() {

        document
            .querySelectorAll(
                '.drop-zone[data-zone]'
            )
            .forEach(function (zone) {

                reindexContainer(
                    zone
                );

            });

    }


    /* =========================================================
       GROUP SELECTION
    ========================================================== */

    function setupGroupSelection(block) {

        if (!block) {
            return;
        }


        let controls =
            block.querySelector(
                ':scope > .block-group-selection-controls'
            );


        if (!controls) {

            controls =
                document.createElement(
                    'label'
                );

            controls.className =
                'block-group-selection-controls';

            controls.innerHTML = `
                <input
                    type="checkbox"
                    class="block-selection-checkbox"
                >
                <span>Select for Group</span>
            `;

            block.insertBefore(
                controls,
                block.firstChild
            );

        }


        if (
            controls.dataset.bound === 'true'
        ) {
            return;
        }

        controls.dataset.bound =
            'true';


        const checkbox =
            controls.querySelector(
                '.block-selection-checkbox'
            );

        if (!checkbox) {
            return;
        }


        checkbox.addEventListener(
            'click',
            function (event) {

                event.stopPropagation();

            }
        );


        checkbox.addEventListener(
            'change',
            function (event) {

                event.stopPropagation();

                setGroupSelected(
                    block,
                    this.checked
                );

            }
        );

    }


    function setGroupSelected(
        block,
        selected
    ) {

        if (selected) {

            selectedBlocks.add(
                block
            );

            block.classList.add(
                'group-selected'
            );

        } else {

            selectedBlocks.delete(
                block
            );

            block.classList.remove(
                'group-selected'
            );

        }

        updateFloatingGroupToolbar();

    }


    function clearGroupSelection() {

        selectedBlocks.forEach(
            function (block) {

                block.classList.remove(
                    'group-selected'
                );


                const checkbox =
                    block.querySelector(
                        ':scope > .block-group-selection-controls .block-selection-checkbox'
                    );

                if (checkbox) {

                    checkbox.checked =
                        false;

                }

            }
        );


        selectedBlocks.clear();

        updateFloatingGroupToolbar();

    }


    /* =========================================================
       GROUP TOOLBAR
    ========================================================== */

    function updateFloatingGroupToolbar() {

        const toolbar =
            document.getElementById(
                'floatingGroupToolbar'
            );

        const groupButton =
            document.getElementById(
                'floatingGroupButton'
            );

        const ungroupButton =
            document.getElementById(
                'floatingUngroupButton'
            );

        const clearButton =
            document.getElementById(
                'floatingGroupClearButton'
            );

        const status =
            document.getElementById(
                'floatingGroupStatus'
            );


        if (
            !toolbar ||
            !groupButton ||
            !ungroupButton ||
            !clearButton ||
            !status
        ) {
            return;
        }


        const count =
            selectedBlocks.size;


        if (count === 0) {

            toolbar.classList.remove(
                'visible'
            );

            groupButton.disabled =
                true;

            ungroupButton.disabled =
                true;

            clearButton.disabled =
                true;

            status.innerText =
                'Select blocks to group them together.';

            return;

        }


        toolbar.classList.add(
            'visible'
        );


        groupButton.disabled =
            count < 2;


        ungroupButton.disabled =
            !Array.from(
                selectedBlocks
            ).some(
                function (block) {

                    return isGroup(
                        block
                    );

                }
            );


        clearButton.disabled =
            false;


        if (count === 1) {

            const block =
                Array.from(
                    selectedBlocks
                )[0];

            if (
                isGroup(block)
            ) {

                status.innerText =
                    'Group selected. You can ungroup it.';

            } else {

                status.innerText =
                    'Select at least one more block.';

            }

        } else {

            status.innerText =
                count +
                ' blocks selected. Ready to group.';

        }

    }


    /* =========================================================
       CREATE GROUP
    ========================================================== */

    function createGroup(blocks) {

        if (
            !blocks ||
            blocks.length < 2
        ) {

            alert(
                'Please select at least two blocks to create a group.'
            );

            return;

        }


        const parents =
            new Set(
                blocks.map(
                    function (block) {

                        return getParentDropZone(
                            block
                        );

                    }
                )
            );


        if (
            parents.size !== 1
        ) {

            alert(
                'Please select blocks from the same section or group.'
            );

            return;

        }


        const parent =
            blocks[0].parentElement;

        if (!parent) {
            return;
        }


        /*
         * Preserve visual order.
         */

        blocks.sort(
            function (a, b) {

                return (
                    Array.from(
                        parent.children
                    ).indexOf(a) -
                    Array.from(
                        parent.children
                    ).indexOf(b)
                );

            }
        );


        const group =
            document.createElement(
                'div'
            );

        group.className =
            'builder-block group-container';

        group.draggable =
            true;

        group.dataset.blockType =
            'group';

        group.dataset.isGroup =
            'true';

        group.dataset.groupId =
            createId();


        group.innerHTML = `

            <label class="block-group-selection-controls">

                <input
                    type="checkbox"
                    class="block-selection-checkbox"
                >

                <span>
                    Select for Group
                </span>

            </label>


            <div class="block-content">

                <div class="group-header">

                    <div class="group-header-left">

                        <i class="bi bi-collection group-header-icon"></i>

                        <input
                            type="text"
                            class="group-label-input"
                            value=""
                            placeholder="Group name"
                        >

                    </div>

                    <div class="group-header-actions">

                        <button
                            type="button"
                            class="group-ungroup-button"
                            title="Ungroup"
                        >
                            <i class="bi bi-box-arrow-up"></i>
                            Ungroup
                        </button>

                        <button
                            type="button"
                            class="group-remove-button"
                            title="Remove group"
                        >
                            <i class="bi bi-trash"></i>
                            Remove
                        </button>

                    </div>

                </div>


                <div class="group-block-content">

                    <div
                        class="group-drop-zone"
                        data-group-zone="true"
                    >

                        <div class="empty-zone">
                            Drop components into this group
                        </div>

                    </div>

                </div>


                <input
                    type="hidden"
                    class="group-type-input"
                    value="group"
                >

            </div>

        `;


        parent.insertBefore(
            group,
            blocks[0]
        );


        const groupZone =
            getGroupDropZone(
                group
            );

        if (!groupZone) {

            group.remove();

            return;

        }


        blocks.forEach(
            function (block) {

                groupZone.appendChild(
                    block
                );

            }
        );


        setupGroupContainer(
            group
        );


        clearGroupSelection();


        reindexAll();

    }


    /* =========================================================
       ADD GROUP COMPONENT
    ========================================================== */

    function addGroupComponent(
        container
    ) {

        removeEmptyMessage(
            container
        );


        const group =
            document.createElement(
                'div'
            );

        group.className =
            'builder-block group-container';

        group.draggable =
            true;

        group.dataset.blockType =
            'group';

        group.dataset.isGroup =
            'true';

        group.dataset.groupId =
            createId();


        group.innerHTML = `

            <label class="block-group-selection-controls">

                <input
                    type="checkbox"
                    class="block-selection-checkbox"
                >

                <span>
                    Select for Group
                </span>

            </label>


            <div class="block-content">

                <div class="group-header">

                    <div class="group-header-left">

                        <i class="bi bi-collection group-header-icon"></i>

                        <input
                            type="text"
                            class="group-label-input"
                            value=""
                            placeholder="Group name"
                        >

                    </div>

                    <div class="group-header-actions">

                        <button
                            type="button"
                            class="group-ungroup-button"
                        >
                            <i class="bi bi-box-arrow-up"></i>
                            Ungroup
                        </button>

                        <button
                            type="button"
                            class="group-remove-button"
                        >
                            <i class="bi bi-trash"></i>
                            Remove
                        </button>

                    </div>

                </div>


                <div class="group-block-content">

                    <div
                        class="group-drop-zone"
                        data-group-zone="true"
                    >

                        <div class="empty-zone">
                            Drop components into this group
                        </div>

                    </div>

                </div>


                <input
                    type="hidden"
                    class="group-type-input"
                    value="group"
                >

            </div>

        `;


        container.appendChild(
            group
        );


        setupGroupContainer(
            group
        );


        reindexAll();

    }


    /* =========================================================
       SETUP GROUP
    ========================================================== */

    function setupGroupContainer(
        group
    ) {

        if (!group) {
            return;
        }


        group.classList.add(
            'group-container'
        );

        group.dataset.blockType =
            'group';

        group.dataset.isGroup =
            'true';


        setupBlockDragging(
            group
        );

        setupGroupSelection(
            group
        );


        const zone =
            getGroupDropZone(
                group
            );

        if (zone) {

            setupDropZone(
                zone
            );

        }


        const labelInput =
            group.querySelector(
                ':scope > .block-content .group-label-input'
            );

        if (labelInput) {

            labelInput.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();

                }
            );

            labelInput.addEventListener(
                'mousedown',
                function (event) {

                    event.stopPropagation();

                }
            );

        }


        const ungroupButton =
            group.querySelector(
                ':scope > .block-content .group-ungroup-button'
            );

        if (ungroupButton) {

            ungroupButton.addEventListener(
                'click',
                function (event) {

                    event.preventDefault();

                    event.stopPropagation();

                    ungroupGroup(
                        group
                    );

                }
            );

        }


        const removeButton =
            group.querySelector(
                ':scope > .block-content .group-remove-button'
            );

        if (removeButton) {

            removeButton.addEventListener(
                'click',
                function (event) {

                    event.preventDefault();

                    event.stopPropagation();


                    if (
                        !confirm(
                            'Remove this group and all blocks inside it?'
                        )
                    ) {

                        return;

                    }


                    const parent =
                        group.parentElement;


                    group.remove();

                    selectedBlocks.delete(
                        group
                    );


                    if (parent) {

                        reindexAll();

                        addEmptyMessage(
                            parent
                        );

                    }


                    updateFloatingGroupToolbar();

                }
            );

        }


        if (zone) {

            getDirectBlocks(
                zone
            ).forEach(
                function (child) {

                    setupBlockDragging(
                        child
                    );

                    setupGroupSelection(
                        child
                    );

                    setupIconPreview(
                        child
                    );

                    setupStylePanel(
                        child
                    );

                    if (
                        isGroup(child)
                    ) {

                        setupGroupContainer(
                            child
                        );

                    }

                }
            );

        }

    }


    /* =========================================================
       REMOVE BLOCK
    ========================================================== */

    window.removeBlock =
        function (button) {

            if (!button) {
                return;
            }


            const block =
                button.closest(
                    '.builder-block'
                );

            if (!block) {
                return;
            }


            const parent =
                block.parentElement;


            if (
                selectedStyleBlock ===
                block
            ) {

                closeStyleEditor();

            }


            selectedBlocks.delete(
                block
            );


            block.remove();


            if (parent) {

                reindexAll();

                addEmptyMessage(
                    parent
                );

            }


            updateFloatingGroupToolbar();

        };


    /* =========================================================
       ADD NORMAL BLOCK
    ========================================================== */

    function addBlock(
        container,
        type
    ) {

        removeEmptyMessage(
            container
        );


        const block =
            document.createElement(
                'div'
            );

        block.className =
            'builder-block';

        block.draggable =
            true;

        block.dataset.blockType =
            type;

        block.dataset.blockId =
            createId();


        const section =
            container.dataset.zone ||
            getSectionFromGroup(
                container
            );


        const insideGroup =
            container.classList.contains(
                'group-drop-zone'
            );


        const index =
            getDirectBlocks(
                container
            ).length;


        const prefix =
            insideGroup
                ? `content[temporary][children][${index}]`
                : `content[${section}][blocks][${index}]`;


        const imagePrefix =
            insideGroup
                ? `images[temporary][children][${index}]`
                : `images[${section}][${index}]`;


        block.innerHTML =
            buildNewBlockHTML(
                type,
                prefix,
                imagePrefix
            );


        container.appendChild(
            block
        );


        setupBlockDragging(
            block
        );

        setupGroupSelection(
            block
        );

        setupIconPreview(
            block
        );

        setupStylePanel(
            block
        );


        reindexAll();


        /*
         * Select newly created block.
         */

        if (
            !isGroup(block)
        ) {

            selectBlockForStyle(
                block
            );

        }

    }


    /* =========================================================
       NEW BLOCK HTML
    ========================================================== */

    function buildNewBlockHTML(
        type,
        prefix,
        imagePrefix
    ) {

        let html = '';


        if (
            type === 'text'
        ) {

            html = `

                <div class="block-content">

                    <div class="flex justify-between items-center">

                        <strong class="text-[#0F3F4A]">

                            <i class="bi bi-fonts mr-1"></i>

                            Text Block

                        </strong>

                        <button
                            type="button"
                            onclick="removeBlock(this)"
                            class="text-red-500 text-sm hover:underline"
                        >
                            Remove
                        </button>

                    </div>


                    <textarea
                        name="${prefix}[text]"
                        class="mt-3 w-full px-4 py-3 border border-[#D5DDD8] rounded-xl live-style-target"
                        rows="5"
                        placeholder="Write your text..."
                        style="
                            color: var(--block-color);
                            background-color: var(--block-background);
                            font-size: var(--block-font-size);
                            font-weight: var(--block-font-weight);
                            text-align: var(--block-text-align);
                            width: var(--block-width);
                            min-height: var(--block-height);
                            padding: var(--block-padding);
                            margin: var(--block-margin);
                            border: var(--block-border);
                            border-radius: var(--block-radius);
                            box-shadow: var(--block-shadow);
                            transition: var(--block-transition);
                        "
                    ></textarea>


                    <input
                        type="hidden"
                        name="${prefix}[type]"
                        value="text"
                    >

                </div>

                ${styleEditorHTML(prefix)}

            `;

        }


        if (
            type === 'heading'
        ) {

            html = `

                <div class="block-content">

                    <div class="flex justify-between items-center">

                        <strong class="text-[#0F3F4A]">

                            <i class="bi bi-type-h1 mr-1"></i>

                            Heading Block

                        </strong>

                        <button
                            type="button"
                            onclick="removeBlock(this)"
                            class="text-red-500 text-sm hover:underline"
                        >
                            Remove
                        </button>

                    </div>


                    <input
                        type="text"
                        name="${prefix}[text]"
                        class="mt-3 w-full px-4 py-3 border border-[#D5DDD8] rounded-xl live-style-target"
                        placeholder="Heading..."
                        style="
                            color: var(--block-color);
                            background-color: var(--block-background);
                            font-size: var(--block-font-size);
                            font-weight: var(--block-font-weight);
                            text-align: var(--block-text-align);
                            width: var(--block-width);
                            height: var(--block-height);
                            padding: var(--block-padding);
                            margin: var(--block-margin);
                            border: var(--block-border);
                            border-radius: var(--block-radius);
                            box-shadow: var(--block-shadow);
                            transition: var(--block-transition);
                        "
                    >

                    <input
                        type="hidden"
                        name="${prefix}[type]"
                        value="heading"
                    >

                </div>

                ${styleEditorHTML(prefix)}

            `;

        }


        if (
            type === 'image'
        ) {

            html = `

                <div class="block-content">

                    <div class="flex justify-between items-center">

                        <strong class="text-[#0F3F4A]">

                            <i class="bi bi-image mr-1"></i>

                            Image Block

                        </strong>

                        <button
                            type="button"
                            onclick="removeBlock(this)"
                            class="text-red-500 text-sm hover:underline"
                        >
                            Remove
                        </button>

                    </div>


                    <label
                        class="mt-3 block text-sm font-medium text-[#0F3F4A]"
                    >
                        Upload Image
                    </label>


                    <input
                        type="file"
                        name="${imagePrefix}"
                        accept="image/jpeg,image/png,image/webp"
                        class="mt-2 w-full text-sm"
                    >


                    <p class="text-xs text-gray-500 mt-2">
                        JPG, PNG or WEBP. Maximum 5MB.
                    </p>


                    <input
                        type="hidden"
                        name="${prefix}[type]"
                        value="image"
                    >

                </div>

                ${styleEditorHTML(prefix)}

            `;

        }


        if (
            type === 'button'
        ) {

            html = `

                <div class="block-content">

                    <div class="flex justify-between items-center">

                        <strong class="text-[#0F3F4A]">

                            <i class="bi bi-hand-index-thumb mr-1"></i>

                            Button Block

                        </strong>

                        <button
                            type="button"
                            onclick="removeBlock(this)"
                            class="text-red-500 text-sm hover:underline"
                        >
                            Remove
                        </button>

                    </div>


                    <input
                        type="text"
                        name="${prefix}[text]"
                        class="mt-3 w-full px-4 py-3 border border-[#D5DDD8] rounded-xl live-style-target"
                        placeholder="Button text"
                        style="
                            color: var(--block-color);
                            background-color: var(--block-background);
                            font-size: var(--block-font-size);
                            font-weight: var(--block-font-weight);
                            text-align: var(--block-text-align);
                            width: var(--block-width);
                            height: var(--block-height);
                            padding: var(--block-padding);
                            margin: var(--block-margin);
                            border: var(--block-border);
                            border-radius: var(--block-radius);
                            box-shadow: var(--block-shadow);
                            transition: var(--block-transition);
                        "
                    >


                    <input
                        type="text"
                        name="${prefix}[url]"
                        class="mt-3 w-full px-4 py-3 border border-[#D5DDD8] rounded-xl"
                        placeholder="Button URL"
                    >


                    <input
                        type="hidden"
                        name="${prefix}[type]"
                        value="button"
                    >

                </div>

                ${styleEditorHTML(prefix)}

            `;

        }


        if (
            type === 'divider'
        ) {

            html = `

                <div class="block-content">

                    <div class="flex justify-between items-center">

                        <strong class="text-[#0F3F4A]">

                            <i class="bi bi-dash-lg mr-1"></i>

                            Divider

                        </strong>

                        <button
                            type="button"
                            onclick="removeBlock(this)"
                            class="text-red-500 text-sm hover:underline"
                        >
                            Remove
                        </button>

                    </div>


                    <hr
                        class="my-4 live-style-target"
                        style="
                            color: var(--block-color);
                            background-color: var(--block-background);
                            width: var(--block-width);
                            height: var(--block-height);
                            margin: var(--block-margin);
                            border: var(--block-border);
                            border-radius: var(--block-radius);
                            box-shadow: var(--block-shadow);
                            transition: var(--block-transition);
                        "
                    >


                    <input
                        type="hidden"
                        name="${prefix}[type]"
                        value="divider"
                    >

                </div>

                ${styleEditorHTML(prefix)}

            `;

        }


        if (
            type === 'icon'
        ) {

            html = `

                <div class="block-content">

                    <div class="flex justify-between items-center">

                        <strong class="text-[#0F3F4A]">

                            <i class="bi bi-stars mr-1"></i>

                            Icon Block

                        </strong>

                        <button
                            type="button"
                            onclick="removeBlock(this)"
                            class="text-red-500 text-sm hover:underline"
                        >
                            Remove
                        </button>

                    </div>


                    <div class="style-field">

                        <label>
                            Choose Icon
                        </label>

                        <select
                            name="${prefix}[icon]"
                            class="icon-select"
                        >

                            ${iconOptions()}

                        </select>

                    </div>


                    <div
                        class="icon-preview live-style-target"
                        style="
                            color: var(--block-color);
                            background-color: var(--block-background);
                            font-size: var(--block-font-size);
                            font-weight: var(--block-font-weight);
                            text-align: var(--block-text-align);
                            width: var(--block-width);
                            height: var(--block-height);
                            padding: var(--block-padding);
                            margin: var(--block-margin);
                            border: var(--block-border);
                            border-radius: var(--block-radius);
                            box-shadow: var(--block-shadow);
                            transition: var(--block-transition);
                        "
                    >

                        <i class="bi bi-house"></i>

                    </div>


                    <input
                        type="hidden"
                        name="${prefix}[type]"
                        value="icon"
                    >

                </div>

                ${styleEditorHTML(prefix)}

            `;

        }


        return html;

    }


    /* =========================================================
       STYLE EDITOR HTML FOR NEW BLOCKS
    ========================================================== */

    function styleEditorHTML(
        prefix
    ) {

        return `

            <div class="style-panel">

                <div class="style-title">

                    <i class="bi bi-palette"></i>

                    <span>
                        Style Editor
                    </span>

                </div>


                <div class="style-section-title">
                    Colors
                </div>


                <div class="style-field">

                    <label>
                        Text Color
                    </label>

                    <div class="color-row">

                        <input
                            type="color"
                            value="#0F3F4A"
                            data-style="color"
                            oninput="syncColor(this)"
                        >

                        <input
                            type="text"
                            name="${prefix}[style][color]"
                            value="#0F3F4A"
                            data-style="color"
                            oninput="syncColorText(this)"
                        >

                    </div>

                </div>


                <div class="style-field">

                    <label>
                        Background Color
                    </label>

                    <div class="color-row">

                        <input
                            type="color"
                            value="#FFFFFF"
                            data-style="background"
                            oninput="syncColor(this)"
                        >

                        <input
                            type="text"
                            name="${prefix}[style][background]"
                            value="#FFFFFF"
                            data-style="background"
                            oninput="syncColorText(this)"
                        >

                    </div>

                </div>


                <div class="style-section-title">
                    Typography
                </div>


                <div class="four-grid">

                    <div>

                        <label>
                            Font Size
                        </label>

                        <input
                            type="text"
                            name="${prefix}[style][font_size]"
                            value="16px"
                            data-style="font_size"
                            oninput="applyLiveStyle(this)"
                            placeholder="16px"
                        >

                    </div>


                    <div>

                        <label>
                            Font Weight
                        </label>

                        <select
                            name="${prefix}[style][font_weight]"
                            data-style="font_weight"
                            onchange="applyLiveStyle(this)"
                        >

                            <option value="400">
                                Normal
                            </option>

                            <option value="500">
                                Medium
                            </option>

                            <option value="600">
                                Semi Bold
                            </option>

                            <option value="700">
                                Bold
                            </option>

                            <option value="800">
                                Extra Bold
                            </option>

                        </select>

                    </div>

                </div>


                <div class="style-field">

                    <label>
                        Text Alignment
                    </label>

                    <select
                        name="${prefix}[style][text_align]"
                        data-style="text_align"
                        onchange="applyLiveStyle(this)"
                    >

                        <option value="left">
                            Left
                        </option>

                        <option value="center">
                            Center
                        </option>

                        <option value="right">
                            Right
                        </option>

                    </select>

                </div>


                <div class="style-section-title">
                    Size
                </div>


                <div class="four-grid">

                    <div>

                        <label>
                            Width
                        </label>

                        <input
                            type="text"
                            name="${prefix}[style][width]"
                            value="auto"
                            data-style="width"
                            oninput="applyLiveStyle(this)"
                            placeholder="auto, 100%, 300px"
                        >

                    </div>


                    <div>

                        <label>
                            Height
                        </label>

                        <input
                            type="text"
                            name="${prefix}[style][height]"
                            value="auto"
                            data-style="height"
                            oninput="applyLiveStyle(this)"
                            placeholder="auto, 300px"
                        >

                    </div>

                </div>


                <div class="style-section-title">
                    Spacing
                </div>


                <div class="four-grid">

                    <div>

                        <label>
                            Padding
                        </label>

                        <input
                            type="text"
                            name="${prefix}[style][padding]"
                            value="16px"
                            data-style="padding"
                            oninput="applyLiveStyle(this)"
                            placeholder="16px"
                        >

                    </div>


                    <div>

                        <label>
                            Margin
                        </label>

                        <input
                            type="text"
                            name="${prefix}[style][margin]"
                            value="0"
                            data-style="margin"
                            oninput="applyLiveStyle(this)"
                            placeholder="0"
                        >

                    </div>

                </div>


                <div class="style-section-title">
                    Border
                </div>


                <div class="four-grid">

                    <div>

                        <label>
                            Border
                        </label>

                        <input
                            type="text"
                            name="${prefix}[style][border]"
                            value="none"
                            data-style="border"
                            oninput="applyLiveStyle(this)"
                            placeholder="1px solid #000"
                        >

                    </div>


                    <div>

                        <label>
                            Border Radius
                        </label>

                        <input
                            type="text"
                            name="${prefix}[style][radius]"
                            value="12px"
                            data-style="radius"
                            oninput="applyLiveStyle(this)"
                            placeholder="12px"
                        >

                    </div>

                </div>


                <div class="style-section-title">
                    Effects
                </div>


                <div class="style-field">

                    <label>
                        Box Shadow
                    </label>

                    <input
                        type="text"
                        name="${prefix}[style][shadow]"
                        value="none"
                        data-style="shadow"
                        oninput="applyLiveStyle(this)"
                        placeholder="0 4px 12px rgba(0,0,0,.1)"
                    >

                </div>


                <div class="style-field">

                    <label>
                        Transition
                    </label>

                    <input
                        type="text"
                        name="${prefix}[style][transition]"
                        value="0.2s"
                        data-style="transition"
                        oninput="applyLiveStyle(this)"
                        placeholder="0.2s"
                    >

                </div>

            </div>

        `;

    }


    /* =========================================================
       ICON OPTIONS
    ========================================================== */

    function iconOptions() {

        const icons = [

            ['bi-house', 'House'],
            ['bi-person', 'Person'],
            ['bi-heart', 'Heart'],
            ['bi-star', 'Star'],
            ['bi-gear', 'Settings'],
            ['bi-search', 'Search'],
            ['bi-envelope', 'Email'],
            ['bi-phone', 'Phone'],
            ['bi-camera', 'Camera'],
            ['bi-image', 'Image'],
            ['bi-cart', 'Cart'],
            ['bi-check-circle', 'Check'],
            ['bi-x-circle', 'Close'],
            ['bi-arrow-right', 'Arrow Right'],
            ['bi-arrow-left', 'Arrow Left'],
            ['bi-arrow-up', 'Arrow Up'],
            ['bi-arrow-down', 'Arrow Down'],
            ['bi-download', 'Download'],
            ['bi-upload', 'Upload'],
            ['bi-github', 'GitHub'],
            ['bi-facebook', 'Facebook'],
            ['bi-instagram', 'Instagram'],
            ['bi-youtube', 'YouTube'],
            ['bi-discord', 'Discord'],
            ['bi-code-slash', 'Code'],
            ['bi-terminal', 'Terminal'],
            ['bi-laptop', 'Laptop'],
            ['bi-database', 'Database'],
            ['bi-cloud', 'Cloud'],
            ['bi-lightning', 'Lightning'],
            ['bi-lock', 'Lock'],
            ['bi-unlock', 'Unlock'],
            ['bi-bell', 'Bell'],
            ['bi-calendar', 'Calendar'],
            ['bi-chat', 'Chat'],
            ['bi-share', 'Share'],
            ['bi-link', 'Link'],
            ['bi-book', 'Book'],
            ['bi-folder', 'Folder'],
            ['bi-file-earmark', 'File'],
            ['bi-play-circle', 'Play'],
            ['bi-pause-circle', 'Pause'],
            ['bi-info-circle', 'Info'],
            ['bi-question-circle', 'Question']

        ];


        return icons
            .map(function (item) {

                return `
                    <option value="${item[0]}">
                        ${item[1]}
                    </option>
                `;

            })
            .join('');

    }


    /* =========================================================
       ICON PREVIEW
    ========================================================== */

    function setupIconPreview(block) {

        if (!block) {
            return;
        }

        const select =
            block.querySelector(
                '.icon-select'
            );

        const preview =
            block.querySelector(
                '.icon-preview i'
            );

        if (
            !select ||
            !preview
        ) {
            return;
        }


        if (
            select.dataset.iconBound ===
            'true'
        ) {
            return;
        }

        select.dataset.iconBound =
            'true';


        function update() {

            preview.className =
                'bi ' +
                select.value;

        }


        select.addEventListener(
            'change',
            update
        );


        update();

    }


    window.updateIconPreview =
        function (select) {

            setupIconPreview(
                select.closest(
                    '.builder-block'
                )
            );

            const preview =
                select
                    .closest(
                        '.builder-block'
                    )
                    ?.querySelector(
                        '.icon-preview i'
                    );

            if (preview) {

                preview.className =
                    'bi ' +
                    select.value;

            }

        };


    /* =========================================================
       STYLE PANEL SETUP
    ========================================================== */

    function setupStylePanel(block) {

        if (!block) {
            return;
        }


        const panel =
            block.querySelector(
                ':scope > .style-panel'
            );

        if (!panel) {
            return;
        }


        if (
            panel.dataset.liveBound !==
            'true'
        ) {

            panel.dataset.liveBound =
                'true';


            panel
                .querySelectorAll(
                    '[data-style]'
                )
                .forEach(function (input) {

                    /*
                     * The inline HTML handlers above
                     * handle normal events.
                     *
                     * These listeners provide a
                     * second reliable path for
                     * dynamically-created blocks.
                     */

                    input.addEventListener(
                        'input',
                        function () {

                            if (
                                this.type ===
                                'color'
                            ) {

                                syncColor(
                                    this
                                );

                            } else {

                                applyLiveStyle(
                                    this
                                );

                            }

                        }
                    );


                    input.addEventListener(
                        'change',
                        function () {

                            if (
                                this.type ===
                                'color'
                            ) {

                                syncColor(
                                    this
                                );

                            } else {

                                applyLiveStyle(
                                    this
                                );

                            }

                        }
                    );

                });

        }


        setupStylePanelDragging(
            panel
        );

    }


    /* =========================================================
       INITIALIZE EXISTING BLOCKS
    ========================================================== */

    document
        .querySelectorAll(
            '.builder-block'
        )
        .forEach(function (block) {

            if (
                !block.dataset.blockId
            ) {

                block.dataset.blockId =
                    createId();

            }


            setupBlockDragging(
                block
            );

            setupGroupSelection(
                block
            );

            setupIconPreview(
                block
            );

            setupStylePanel(
                block
            );


            if (
                isGroup(block)
            ) {

                setupGroupContainer(
                    block
                );

            }

        });


    /* =========================================================
       INITIALIZE DROP ZONES
    ========================================================== */

    document
        .querySelectorAll(
            '.drop-zone'
        )
        .forEach(function (zone) {

            setupDropZone(
                zone
            );

        });


    /* =========================================================
       INITIAL REINDEX
    ========================================================== */

    reindexAll();


    /* =========================================================
       GROUP BUTTONS
    ========================================================== */

    const groupButton =
        document.getElementById(
            'floatingGroupButton'
        );

    if (groupButton) {

        groupButton.addEventListener(
            'click',
            function () {

                createGroup(
                    Array.from(
                        selectedBlocks
                    )
                );

            }
        );

    }


    const ungroupButton =
        document.getElementById(
            'floatingUngroupButton'
        );

    if (ungroupButton) {

        ungroupButton.addEventListener(
            'click',
            function () {

                const groups =
                    Array.from(
                        selectedBlocks
                    ).filter(
                        function (block) {

                            return isGroup(
                                block
                            );

                        }
                    );


                groups.forEach(
                    function (group) {

                        ungroupGroup(
                            group
                        );

                    }
                );

            }
        );

    }


    const clearGroupButton =
        document.getElementById(
            'floatingGroupClearButton'
        );

    if (clearGroupButton) {

        clearGroupButton.addEventListener(
            'click',
            function () {

                clearGroupSelection();

            }
        );

    }


    /* =========================================================
       UNGROUP
    ========================================================== */

    function ungroupGroup(group) {

        if (!group) {
            return;
        }


        const parent =
            group.parentElement;

        const groupZone =
            getGroupDropZone(
                group
            );

        if (
            !parent ||
            !groupZone
        ) {
            return;
        }


        const children =
            getDirectBlocks(
                groupZone
            );


        children.forEach(
            function (child) {

                parent.insertBefore(
                    child,
                    group
                );

            }
        );


        group.remove();


        selectedBlocks.delete(
            group
        );


        clearGroupSelection();


        reindexAll();


        addEmptyMessage(
            parent
        );

    }


    /* =========================================================
       CLICK OUTSIDE
    ========================================================== */

    document.addEventListener(
        'click',
        function (event) {

            if (
                event.target.closest(
                    '.style-panel'
                )
            ) {
                return;
            }

            if (
                event.target.closest(
                    '.builder-block'
                )
            ) {
                return;
            }

            if (
                event.target.closest(
                    '.builder-component'
                )
            ) {
                return;
            }

            if (
                event.target.closest(
                    '.floating-group-toolbar'
                )
            ) {
                return;
            }


            closeStyleEditor();

        }
    );


    /* =========================================================
       SAVE
    ========================================================== */

    const form =
        document.getElementById(
            'pageBuilderForm'
        );

    if (form) {

        form.addEventListener(
            'submit',
            function () {

                /*
                 * This is important.
                 *
                 * All current DOM positions are
                 * converted into the proper Laravel
                 * content[...] field names before
                 * the browser serializes the form.
                 */

                reindexAll();


                /*
                 * Make sure dynamically-created
                 * groups have the proper names.
                 */

                document
                    .querySelectorAll(
                        '.group-container'
                    )
                    .forEach(function (group) {

                        /*
                         * The normal reindex already
                         * handles this, but this ensures
                         * group fields are not omitted.
                         */

                        const zone =
                            getGroupDropZone(
                                group
                            );

                        if (zone) {

                            addEmptyMessage(
                                zone
                            );

                        }

                    });


                const button =
                    document.getElementById(
                        'savePageButton'
                    );

                if (button) {

                    button.disabled =
                        true;

                    button.innerHTML = `
                        <i class="bi bi-arrow-repeat"></i>
                        Saving...
                    `;

                }

            }
        );

    }


    /* =========================================================
       INITIAL GROUP TOOLBAR
    ========================================================== */

    updateFloatingGroupToolbar();


});
/* =========================================================
   PAGE LAYOUT TOGGLE
========================================================= */
const editorLayout =
    document.getElementById('editorMainSideLayout');
const sideContentToggle =
    document.getElementById('showSideContent');

const layoutPreview =
    document.getElementById('layoutPreview');
const editorSideColumn =
    document.getElementById('editorSideColumn');

if (sideContentToggle) {

    sideContentToggle.addEventListener(
        'change',
        function () {

            const enabled =
                this.checked;

            if (layoutPreview) {

                layoutPreview.classList.toggle(
                    'active',
                    enabled
                );

            }

            if (editorLayout) {

                editorLayout.classList.toggle(
                    'has-sidebar',
                    enabled
                );

                editorLayout.classList.toggle(
                    'no-sidebar',
                    !enabled
                );

            }

            if (editorSideColumn) {

                editorSideColumn.style.display =
                    enabled
                        ? ''
                        : 'none';

            }

        }
    );

}
</script>

@endsection