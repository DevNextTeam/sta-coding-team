<aside
    class="min-h-full
           bg-[#E8E3D8]
           px-4 py-6
           sm:px-5
           md:px-6 md:py-8"
>


    {{-- =========================================================
    SIDEBAR HEADER
    ========================================================== --}}

    <div class="mb-6">

        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-[#B58A5A]">
            Navigation
        </p>

    </div>


    {{-- =========================================================
    NAVIGATION
    ========================================================== --}}

    <nav class="space-y-1">


        {{-- =====================================================
        HOME
        ====================================================== --}}

        <a
            href="/"
            class="group flex items-center gap-3
                   rounded-2xl
                   px-4 py-3
                   text-[#29483D]
                   transition-all duration-200
                   hover:translate-x-1
                   hover:bg-[#B8CEC5]"
        >

            <span class="font-medium">
                Home
            </span>

        </a>


        {{-- =====================================================
        ABOUT
        ====================================================== --}}

        <a
            href="/about"
            class="group flex items-center gap-3
                   rounded-2xl
                   px-4 py-3
                   text-[#29483D]
                   transition-all duration-200
                   hover:translate-x-1
                   hover:bg-[#B8CEC5]"
        >

            <span class="font-medium">
                About
            </span>

        </a>


        {{-- =====================================================
        PROJECTS
        ====================================================== --}}

        <a
            href="{{ route('projects.index') }}"
            class="group flex items-center gap-3
                   rounded-2xl
                   px-4 py-3
                   text-[#29483D]
                   transition-all duration-200
                   hover:translate-x-1
                   hover:bg-[#B8CEC5]"
        >

            <span class="font-medium">
                Projects
            </span>

        </a>


        {{-- =====================================================
        CONTACT
        ====================================================== --}}

        <a
            href="/contact"
            class="group flex items-center gap-3
                   rounded-2xl
                   px-4 py-3
                   text-[#29483D]
                   transition-all duration-200
                   hover:translate-x-1
                   hover:bg-[#B8CEC5]"
        >

            <span class="font-medium">
                Contact
            </span>

        </a>


        {{-- =====================================================
        AUTHENTICATED USER
        ====================================================== --}}

        @auth


            {{-- Divider --}}

            <div class="py-3">

                <div class="border-t border-[#D0C9BC]"></div>

            </div>


            {{-- =================================================
            DASHBOARD
            ================================================== --}}

            <a
                href="{{ route('dashboard') }}"
                class="group flex items-center gap-3
                       rounded-2xl
                       px-4 py-3
                       text-[#29483D]
                       transition-all duration-200
                       hover:translate-x-1
                       hover:bg-[#B8CEC5]"
            >

                <span class="font-medium">
                    Dashboard
                </span>

            </a>


            {{-- =================================================
            ADMIN NAVIGATION
            ================================================== --}}

            @if(auth()->user()->is_admin)


                {{-- Admin Dashboard --}}

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="group flex items-center gap-3
                           rounded-2xl
                           px-4 py-3
                           text-[#29483D]
                           transition-all duration-200
                           hover:translate-x-1
                           hover:bg-[#B8CEC5]"
                >

                    <span class="font-medium">
                        Admin Dashboard
                    </span>

                </a>


                {{-- Manage Users --}}

                <a
                    href="{{ route('admin.users.index') }}"
                    class="group flex items-center gap-3
                           rounded-2xl
                           px-4 py-3
                           text-[#29483D]
                           transition-all duration-200
                           hover:translate-x-1
                           hover:bg-[#B8CEC5]"
                >

                    <span class="font-medium">
                        Manage Users
                    </span>

                </a>


                {{-- Manage Projects --}}

                <a
                    href="{{ route('admin.projects.index') }}"
                    class="group flex items-center gap-3
                           rounded-2xl
                           px-4 py-3
                           text-[#29483D]
                           transition-all duration-200
                           hover:translate-x-1
                           hover:bg-[#B8CEC5]"
                >

                    <span class="font-medium">
                        Manage Projects
                    </span>

                </a>


            @endif


        @endauth


    </nav>

</aside>