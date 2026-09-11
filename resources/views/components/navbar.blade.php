<nav class="w-full border-b border-[#A8C0B6] bg-[#B8CEC5]">

    <div class="flex min-h-20 items-center justify-between px-4 py-3 sm:px-6 md:min-h-24 md:px-8 lg:min-h-28 lg:px-12">


        {{-- =====================================================
        LOGO
        ====================================================== --}}

        <a
            href="/"
            class="flex shrink-0 items-center"
        >

            <img
                src="{{ asset('images/logo.png') }}"
                alt="S.T.A Coding Team Logo"
                class="h-16 w-auto object-contain
                       transition duration-300
                       hover:scale-105
                       sm:h-20
                       md:h-24
                       lg:h-28"
            >

        </a>


        {{-- =====================================================
        DESKTOP NAVIGATION
        ====================================================== --}}

        <div class="hidden items-center gap-5 md:flex lg:gap-8 xl:gap-10">


            {{-- Home --}}

            <a
                href="/"
                class="relative px-2 py-2 font-medium text-white
                       transition duration-200
                       hover:text-[#4F806D]
                       after:absolute
                       after:bottom-0
                       after:left-0
                       after:h-[2px]
                       after:w-0
                       after:bg-[#4F806D]
                       after:transition-all
                       hover:after:w-full"
            >
                Home
            </a>


            {{-- About --}}

            <a
                href="/about"
                class="relative px-2 py-2 font-medium text-white
                       transition duration-200
                       hover:text-[#4F806D]
                       after:absolute
                       after:bottom-0
                       after:left-0
                       after:h-[2px]
                       after:w-0
                       after:bg-[#4F806D]
                       after:transition-all
                       hover:after:w-full"
            >
                About
            </a>


            {{-- Projects --}}

            <a
                href="{{ route('projects.index') }}"
                class="relative px-2 py-2 font-medium text-white
                       transition duration-200
                       hover:text-[#4F806D]
                       after:absolute
                       after:bottom-0
                       after:left-0
                       after:h-[2px]
                       after:w-0
                       after:bg-[#4F806D]
                       after:transition-all
                       hover:after:w-full"
            >
                Projects
            </a>


            {{-- Contact --}}

            <a
                href="/contact"
                class="relative px-2 py-2 font-medium text-white
                       transition duration-200
                       hover:text-[#4F806D]
                       after:absolute
                       after:bottom-0
                       after:left-0
                       after:h-[2px]
                       after:w-0
                       after:bg-[#4F806D]
                       after:transition-all
                       hover:after:w-full"
            >
                Contact
            </a>


            {{-- =================================================
            AUTHENTICATED USER
            ================================================== --}}

            @auth

                {{-- Dashboard --}}

                <a
                    href="{{ route('dashboard') }}"
                    class="relative px-2 py-2 font-medium text-white
                           transition duration-200
                           hover:text-[#4F806D]
                           after:absolute
                           after:bottom-0
                           after:left-0
                           after:h-[2px]
                           after:w-0
                           after:bg-[#4F806D]
                           after:transition-all
                           hover:after:w-full"
                >
                    Dashboard
                </a>


                {{-- Logout --}}

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="rounded-full bg-[#4F806D]
                               px-4 py-2
                               font-semibold text-white
                               transition duration-200
                               hover:bg-[#3F6D5B]
                               hover:shadow-md"
                    >
                        Logout
                    </button>

                </form>

            @endauth


            {{-- =================================================
            GUEST USER
            ================================================== --}}

            @guest

                {{-- Login --}}

                <a
                    href="{{ route('login') }}"
                    class="relative px-2 py-2 font-medium text-white
                           transition duration-200
                           hover:text-[#4F806D]
                           after:absolute
                           after:bottom-0
                           after:left-0
                           after:h-[2px]
                           after:w-0
                           after:bg-[#4F806D]
                           after:transition-all
                           hover:after:w-full"
                >
                    Login
                </a>


                {{-- Sign Up --}}

                <a
                    href="{{ route('register') }}"
                    class="rounded-full bg-[#4F806D]
                           px-5 py-2
                           font-semibold text-white
                           transition duration-200
                           hover:bg-[#3F6D5B]
                           hover:shadow-md"
                >
                    Sign Up
                </a>

            @endguest

        </div>


        {{-- =====================================================
        MOBILE MENU BUTTON
        ====================================================== --}}

        <button
            type="button"
            onclick="openMobileSidebar()"
            class="flex h-11 w-11 items-center justify-center
                   rounded-xl
                   bg-[#4F806D]
                   text-xl text-white
                   shadow-sm
                   transition
                   hover:bg-[#3F6D5B]
                   md:hidden"
            aria-label="Open navigation"
        >

            <i class="bi bi-list"></i>

        </button>

    </div>

</nav>