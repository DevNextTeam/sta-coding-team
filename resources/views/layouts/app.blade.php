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


<body class="min-h-screen overflow-x-hidden bg-[#F5F1E8] text-[#29483D]">


    {{-- =========================================================
    NAVBAR
    ========================================================== --}}

    <header class="w-full">
        @include('components.navbar')
    </header>


    {{-- =========================================================
    MAIN AREA
    ========================================================== --}}

    <div class="flex min-h-[calc(100vh-112px)]">


        {{-- =====================================================
        DESKTOP SIDEBAR
        Hidden on mobile
        ====================================================== --}}

        <aside class="hidden w-64 shrink-0 md:block lg:w-72">

            @include('components.sidebar')

        </aside>


        {{-- =====================================================
        CONTENT
        ====================================================== --}}

        <main class="min-w-0 flex-1 px-4 py-6 sm:px-6 sm:py-8 md:p-8 lg:p-10">

            @yield('content')

        </main>

    </div>


    {{-- =========================================================
    MOBILE SIDEBAR
    ========================================================== --}}

    <div
        id="mobileSidebarOverlay"
        class="fixed inset-0 z-40 hidden bg-black/40 md:hidden"
        onclick="closeMobileSidebar()"
    ></div>


    <aside
        id="mobileSidebar"
        class="fixed left-0 top-0 z-50 h-full w-[82%] max-w-sm
               -translate-x-full
               overflow-y-auto
               bg-[#E8E3D8]
               shadow-2xl
               transition-transform duration-300 ease-in-out
               md:hidden"
    >

        {{-- Mobile sidebar header --}}

        <div class="flex items-center justify-between border-b border-[#D9D3C7] px-5 py-5">

            <div>

                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-[#B58A5A]">
                    Navigation
                </p>

                <p class="mt-1 text-sm text-[#29483D]/70">
                    S.T.A Coding Team
                </p>

            </div>


            <button
                type="button"
                onclick="closeMobileSidebar()"
                class="flex h-10 w-10 items-center justify-center rounded-full
                       bg-[#B8CEC5]
                       text-xl text-[#29483D]
                       transition
                       hover:bg-[#A8C0B6]"
                aria-label="Close navigation"
            >

                <i class="bi bi-x-lg"></i>

            </button>

        </div>


        {{-- Mobile navigation --}}

        <div class="p-4">

            @include('components.sidebar')

        </div>

    </aside>


    {{-- =========================================================
    MOBILE SIDEBAR JAVASCRIPT
    ========================================================== --}}

    <script>

        function openMobileSidebar() {

            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('mobileSidebarOverlay');

            if (!sidebar || !overlay) return;

            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');

            overlay.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');

        }


        function closeMobileSidebar() {

            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('mobileSidebarOverlay');

            if (!sidebar || !overlay) return;

            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');

            overlay.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');

        }


        // Close mobile sidebar when pressing Escape

        document.addEventListener('keydown', function (event) {

            if (event.key === 'Escape') {

                closeMobileSidebar();

            }

        });

    </script>


</body>

</html>