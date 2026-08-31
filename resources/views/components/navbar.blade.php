<nav class="w-full bg-[#B8CEC5] border-b border-[#A8C0B6]">

    <div class="min-h-28 px-5 sm:px-8 lg:px-12
                flex flex-col sm:flex-row
                items-center justify-between
                gap-4 py-4 sm:py-0">

        {{-- Logo --}}
        <a href="/"
           class="flex items-center shrink-0">

            <img
                src="{{ asset('images/logo.png') }}"
                alt="S.T.A Coding Team Logo"
                class="h-20 sm:h-24 lg:h-28
                       w-auto object-contain
                       transition duration-300
                       hover:scale-105"
            >

        </a>


        {{-- Navigation --}}
        <div class="flex items-center
                    gap-5 sm:gap-7 lg:gap-10
                    pb-2 sm:pb-0">

            {{-- Home --}}
            <a href="/"
               class="relative px-2 py-2
                      text-white
                      font-medium
                      transition duration-200
                      hover:text-[#4F806D]
                      after:absolute
                      after:left-0
                      after:bottom-0
                      after:h-[2px]
                      after:w-0
                      after:bg-[#4F806D]
                      after:transition-all
                      hover:after:w-full">

                Home

            </a>


            {{-- About --}}
            <a href="/about"
               class="relative px-2 py-2
                      text-white
                      font-medium
                      transition duration-200
                      hover:text-[#4F806D]
                      after:absolute
                      after:left-0
                      after:bottom-0
                      after:h-[2px]
                      after:w-0
                      after:bg-[#4F806D]
                      after:transition-all
                      hover:after:w-full">

                About

            </a>


            {{-- Projects --}}
            <a href="{{ route('projects.index') }}"
               class="relative px-2 py-2
                      text-white
                      font-medium
                      transition duration-200
                      hover:text-[#4F806D]
                      after:absolute
                      after:left-0
                      after:bottom-0
                      after:h-[2px]
                      after:w-0
                      after:bg-[#4F806D]
                      after:transition-all
                      hover:after:w-full">

                Projects

            </a>


            {{-- Contact --}}
            <a href="/contact"
               class="relative px-2 py-2
                      text-white
                      font-medium
                      transition duration-200
                      hover:text-[#4F806D]
                      after:absolute
                      after:left-0
                      after:bottom-0
                      after:h-[2px]
                      after:w-0
                      after:bg-[#4F806D]
                      after:transition-all
                      hover:after:w-full">

                Contact

            </a>


            {{-- AUTHENTICATED USER --}}
            @auth

                {{-- Dashboard --}}
                <a href="{{ route('dashboard') }}"
                   class="relative px-2 py-2
                          text-white
                          font-medium
                          transition duration-200
                          hover:text-[#4F806D]
                          after:absolute
                          after:left-0
                          after:bottom-0
                          after:h-[2px]
                          after:w-0
                          after:bg-[#4F806D]
                          after:transition-all
                          hover:after:w-full">

                    Dashboard

                </a>


                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button
                        type="submit"
                        class="px-4 py-2
                               rounded-full
                               bg-[#4F806D]
                               text-white
                               font-semibold
                               transition duration-200
                               hover:bg-[#3F6D5B]
                               hover:shadow-md">

                        Logout

                    </button>

                </form>

            @endauth


            {{-- GUEST USER --}}
            @guest

                {{-- Login --}}
                <a href="{{ route('login') }}"
                   class="relative px-2 py-2
                          text-white
                          font-medium
                          transition duration-200
                          hover:text-[#4F806D]
                          after:absolute
                          after:left-0
                          after:bottom-0
                          after:h-[2px]
                          after:w-0
                          after:bg-[#4F806D]
                          after:transition-all
                          hover:after:w-full">

                    Login

                </a>


                {{-- Sign Up --}}
                <a href="{{ route('register') }}"
                   class="px-5 py-2
                          rounded-full
                          bg-[#4F806D]
                          text-white
                          font-semibold
                          transition duration-200
                          hover:bg-[#3F6D5B]
                          hover:shadow-md">

                    Sign Up

                </a>

            @endguest

        </div>

    </div>

</nav>