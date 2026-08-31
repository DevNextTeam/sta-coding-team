<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'DevNext')
    </title>


    {{-- =========================================================
         FAVICON
    ========================================================== --}}

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('favicon.png') }}"
    >


    {{-- =========================================================
         BOOTSTRAP ICONS
         Used by the Page Builder and Public Pages
    ========================================================== --}}

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    {{-- =========================================================
         TAILWIND / VITE
    ========================================================== --}}

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="min-h-screen bg-[#F5F1E8] text-[#29483D]">


    {{-- =========================================================
         NAVBAR
    ========================================================== --}}

    <header class="w-full">

        @include('components.navbar')

    </header>


    {{-- =========================================================
         MAIN AREA
    ========================================================== --}}

    <div class="flex flex-col md:flex-row min-h-[calc(100vh-112px)]">


        {{-- =====================================================
             SIDEBAR
        ====================================================== --}}

        <aside class="w-full md:w-64 lg:w-72 shrink-0">

            @include('components.sidebar')

        </aside>


        {{-- =====================================================
             CONTENT
        ====================================================== --}}

        <main class="flex-1 min-w-0 p-4 sm:p-6 md:p-8 lg:p-10">

            @yield('content')

        </main>


    </div>


</body>

</html>