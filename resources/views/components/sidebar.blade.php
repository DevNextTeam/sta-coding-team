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
            class="
                group flex items-center gap-3
                rounded-2xl
                px-4 py-3
                transition-all duration-200
                hover:translate-x-1

                {{ request()->routeIs('home')
                    || request()->is('/')
                    ? 'bg-[#B8CEC5] text-[#29483D] shadow-sm'
                    : 'text-[#29483D] hover:bg-[#B8CEC5]'
                }}
            "
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
            class="
                group flex items-center gap-3
                rounded-2xl
                px-4 py-3
                transition-all duration-200
                hover:translate-x-1

                {{ request()->is('about')
                    ? 'bg-[#B8CEC5] text-[#29483D] shadow-sm'
                    : 'text-[#29483D] hover:bg-[#B8CEC5]'
                }}
            "
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
            class="
                group flex items-center gap-3
                rounded-2xl
                px-4 py-3
                transition-all duration-200
                hover:translate-x-1

                {{ request()->routeIs('projects.*')
                    ? 'bg-[#B8CEC5] text-[#29483D] shadow-sm'
                    : 'text-[#29483D] hover:bg-[#B8CEC5]'
                }}
            "
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
            class="
                group flex items-center gap-3
                rounded-2xl
                px-4 py-3
                transition-all duration-200
                hover:translate-x-1

                {{ request()->is('contact')
                    ? 'bg-[#B8CEC5] text-[#29483D] shadow-sm'
                    : 'text-[#29483D] hover:bg-[#B8CEC5]'
                }}
            "
        >

            <span class="font-medium">
                Contact
            </span>

        </a>


        {{-- =====================================================
        AUTHENTICATED USER
        ====================================================== --}}

        @auth


            {{-- =================================================
            DIVIDER
            ================================================== --}}

            <div class="py-3">

                <div class="border-t border-[#D0C9BC]"></div>

            </div>


            {{-- =================================================
            DASHBOARD
            ================================================== --}}

            <a
                href="{{ route('dashboard') }}"
                class="
                    group flex items-center gap-3
                    rounded-2xl
                    px-4 py-3
                    transition-all duration-200
                    hover:translate-x-1

                    {{ request()->routeIs('dashboard')
                        ? 'bg-[#B8CEC5] text-[#29483D] shadow-sm'
                        : 'text-[#29483D] hover:bg-[#B8CEC5]'
                    }}
                "
            >

                <span class="font-medium">
                    Dashboard
                </span>

            </a>


            {{-- =================================================
            NORMAL USER NAVIGATION
            ================================================== --}}

            @if(!auth()->user()->is_admin)


                {{-- =================================================
                MY PROFILE
                ================================================== --}}

                <a
                    href="{{ route('profile.show', auth()->user()->profile->username) }}"
                    class="
                        group flex items-center gap-3
                        rounded-2xl
                        px-4 py-3
                        transition-all duration-200
                        hover:translate-x-1

                        {{ request()->routeIs('profile.show')
                            ? 'bg-[#B8CEC5] text-[#29483D] shadow-sm'
                            : 'text-[#29483D] hover:bg-[#B8CEC5]'
                        }}
                    "
                >

                    <span class="font-medium">
                        My Profile
                    </span>

                </a>


                {{-- =================================================
                MY PROJECTS
                ================================================== --}}
                <a
                    href="{{ route('saved-projects.index') }}"
                    class="group flex items-center gap-3 rounded-2xl px-4 py-3 transition-all duration-200 hover:translate-x-1 {{ request()->routeIs('saved-projects.*') ? 'bg-[#B8CEC5] text-[#29483D] shadow-sm' : 'text-[#29483D] hover:bg-[#B8CEC5]' }}"
                >
                    <span class="font-medium">Saved Projects</span>
                </a>
                <a
                    href="{{ route('developer.projects.index') }}"
                    class="
                        group flex items-center gap-3
                        rounded-2xl
                        px-4 py-3
                        transition-all duration-200
                        hover:translate-x-1

                        {{ request()->routeIs('developer.projects.*')
                            ? 'bg-[#B8CEC5] text-[#29483D] shadow-sm'
                            : 'text-[#29483D] hover:bg-[#B8CEC5]'
                        }}
                    "
                >

                    <span class="font-medium">
                        My Projects
                    </span>

                </a>


            @endif


            {{-- =================================================
            ADMIN NAVIGATION
            ================================================== --}}

            @if(auth()->user()->is_admin)


                {{-- =================================================
                ADMIN DASHBOARD
                ================================================== --}}

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="
                        group flex items-center gap-3
                        rounded-2xl
                        px-4 py-3
                        transition-all duration-200
                        hover:translate-x-1

                        {{ request()->routeIs('admin.dashboard')
                            ? 'bg-[#B8CEC5] text-[#29483D] shadow-sm'
                            : 'text-[#29483D] hover:bg-[#B8CEC5]'
                        }}
                    "
                >

                    <span class="font-medium">
                        Admin Dashboard
                    </span>

                </a>


                {{-- =================================================
                MANAGE USERS
                ================================================== --}}

                <a
                    href="{{ route('admin.users.index') }}"
                    class="
                        group flex items-center gap-3
                        rounded-2xl
                        px-4 py-3
                        transition-all duration-200
                        hover:translate-x-1

                        {{ request()->routeIs('admin.users.*')
                            ? 'bg-[#B8CEC5] text-[#29483D] shadow-sm'
                            : 'text-[#29483D] hover:bg-[#B8CEC5]'
                        }}
                    "
                >

                    <span class="font-medium">
                        Manage Users
                    </span>

                </a>


                {{-- =================================================
                MANAGE PROJECTS
                ================================================== --}}

                <a
                    href="{{ route('admin.projects.index') }}"
                    class="
                        group flex items-center gap-3
                        rounded-2xl
                        px-4 py-3
                        transition-all duration-200
                        hover:translate-x-1

                        {{ request()->routeIs('admin.projects.*')
                            ? 'bg-[#B8CEC5] text-[#29483D] shadow-sm'
                            : 'text-[#29483D] hover:bg-[#B8CEC5]'
                        }}
                    "
                >

                    <span class="font-medium">
                        Manage Projects
                    </span>

                </a>


            @endif


        @endauth


    </nav>

</aside>