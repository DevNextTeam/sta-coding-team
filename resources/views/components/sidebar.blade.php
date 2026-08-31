<aside class="h-full min-h-[180px] md:min-h-full
              bg-[#E8E3D8]
              border-r border-[#D9D3C7]
              px-5 sm:px-6
              py-6 md:py-8">

    {{-- ================= SIDEBAR HEADER ================= --}}

    <div class="mb-7">

        <p class="text-xs
                  uppercase
                  tracking-[0.25em]
                  text-[#B58A5A]
                  font-semibold">

            Navigation

        </p>

    </div>


    {{-- ================= NAVIGATION ================= --}}

    <nav class="space-y-2">


        {{-- Home --}}
        <a href="/"
           class="group flex items-center gap-3
                  px-4 py-3
                  rounded-2xl
                  transition-all duration-200
                  hover:bg-[#B8CEC5]
                  hover:translate-x-1
                  text-[#29483D]">


            <span class="font-medium">
                Home
            </span>

        </a>


        {{-- About --}}
        <a href="/about"
           class="group flex items-center gap-3
                  px-4 py-3
                  rounded-2xl
                  transition-all duration-200
                  hover:bg-[#B8CEC5]
                  hover:translate-x-1
                  text-[#29483D]">


            <span class="font-medium">
                About
            </span>

        </a>


        {{-- Projects --}}
        <a href="{{ route('projects.index') }}"
           class="group flex items-center gap-3
                  px-4 py-3
                  rounded-2xl
                  transition-all duration-200
                  hover:bg-[#B8CEC5]
                  hover:translate-x-1
                  text-[#29483D]">


            <span class="font-medium">
                Projects
            </span>

        </a>


        {{-- Contact --}}
        <a href="/contact"
           class="group flex items-center gap-3
                  px-4 py-3
                  rounded-2xl
                  transition-all duration-200
                  hover:bg-[#B8CEC5]
                  hover:translate-x-1
                  text-[#29483D]">

           

            <span class="font-medium">
                Contact
            </span>

        </a>


        {{-- ================= AUTHENTICATED ================= --}}

        @auth

            {{-- Divider --}}
            <div class="pt-4 pb-2">

                <div class="border-t border-[#D0C9BC]"></div>

            </div>


            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}"
               class="group flex items-center gap-3
                      px-4 py-3
                      rounded-2xl
                      transition-all duration-200
                      hover:bg-[#B8CEC5]
                      hover:translate-x-1
                      text-[#29483D]">

               

                <span class="font-medium">
                    Dashboard
                </span>

            </a>


            {{-- Admin Navigation --}}
            @if(auth()->user()->is_admin)

                <a href="{{ route('admin.dashboard') }}"
                   class="group flex items-center gap-3
                          px-4 py-3
                          rounded-2xl
                          transition-all duration-200
                          hover:bg-[#B8CEC5]
                          hover:translate-x-1
                          text-[#29483D]">


                    <span class="font-medium">
                        Admin Dashboard
                    </span>

                </a>


                <a href="{{ route('admin.users.index') }}"
                   class="group flex items-center gap-3
                          px-4 py-3
                          rounded-2xl
                          transition-all duration-200
                          hover:bg-[#B8CEC5]
                          hover:translate-x-1
                          text-[#29483D]">

                   

                    <span class="font-medium">
                        Manage Users
                    </span>

                </a>


                <a href="{{ route('admin.projects.index') }}"
                   class="group flex items-center gap-3
                          px-4 py-3
                          rounded-2xl
                          transition-all duration-200
                          hover:bg-[#B8CEC5]
                          hover:translate-x-1
                          text-[#29483D]">


                    <span class="font-medium">
                        Manage Projects
                    </span>

                </a>

            @endif

        @endauth

    </nav>

</aside>