@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- ===================================================== --}}
    {{-- ABOUT HEADER --}}
    {{-- ===================================================== --}}

    <section
        class="bg-[#FFFDFC]
               rounded-[2rem]
               border border-[#E5E0D7]
               shadow-sm
               px-7 sm:px-10 lg:px-14
               py-8 sm:py-10
               mb-5">

        <p class="text-[10px]
                  sm:text-xs
                  uppercase
                  tracking-[0.35em]
                  font-semibold
                  text-[#B58A5A]">

            About Us

        </p>


        <h1 class="text-3xl
                   sm:text-4xl
                   lg:text-5xl
                   leading-[1.05]
                   font-bold
                   text-[#29483D]
                   mt-2
                   max-w-2xl">

            We build, learn,
            <span class="text-[#4F806D]">
                and grow
            </span>
            together.

        </h1>


        <p class="text-sm
                  sm:text-base
                  text-[#587067]
                  leading-relaxed
                  mt-4
                  max-w-3xl">

            S.T.A Coding Team is a three-member web development team focused on improving our
            programming skills, creating meaningful projects, and exploring modern technologies.

        </p>

    </section>



    {{-- ===================================================== --}}
    {{-- MISSION + APPROACH --}}
    {{-- ===================================================== --}}

    <section class="grid
                    grid-cols-1
                    lg:grid-cols-2
                    gap-3
                    mb-5">


        {{-- MISSION --}}

        <div class="bg-[#29483D]
                    rounded-[1.2rem]
                    px-6 sm:px-7
                    py-6
                    text-white">

            <p class="text-[9px]
                      sm:text-[10px]
                      uppercase
                      tracking-[0.3em]
                      font-semibold
                      text-[#B8CEC5]">

                Our Mission

            </p>


            <h2 class="text-xl
                       sm:text-2xl
                       font-bold
                       mt-2">

                Create with purpose.

            </h2>


            <p class="text-sm
                      sm:text-[15px]
                      text-[#E5F0EB]
                      leading-relaxed
                      mt-3
                      max-w-xl">

                Our mission is to combine creativity and technology to create simple,
                responsive, and user-friendly web solutions while continuously improving
                our skills.

            </p>

        </div>



        {{-- APPROACH --}}

        <div class="bg-[#E5F0EB]
                    rounded-[1.2rem]
                    border border-[#D4E4DD]
                    px-6 sm:px-7
                    py-6">

            <p class="text-[9px]
                      sm:text-[10px]
                      uppercase
                      tracking-[0.3em]
                      font-semibold
                      text-[#4F806D]">

                Our Approach

            </p>


            <h2 class="text-xl
                       sm:text-2xl
                       font-bold
                       text-[#29483D]
                       mt-2">

                Learn by doing.

            </h2>


            <p class="text-sm
                      sm:text-[15px]
                      text-[#587067]
                      leading-relaxed
                      mt-3
                      max-w-xl">

                Instead of only studying concepts, we believe that building actual projects
                helps us understand technology and develop practical skills.

            </p>

        </div>

    </section>



    {{-- ===================================================== --}}
    {{-- TEAM HEADER --}}
    {{-- ===================================================== --}}

    <section class="mb-3">

        <p class="text-[9px]
                  sm:text-[10px]
                  uppercase
                  tracking-[0.3em]
                  font-semibold
                  text-[#B58A5A]">

            The Team

        </p>


        <h2 class="text-2xl
                   sm:text-3xl
                   lg:text-4xl
                   font-bold
                   text-[#29483D]
                   mt-1">

            Meet S.T.A.

        </h2>

    </section>



    {{-- ===================================================== --}}
    {{-- TEAM --}}
    {{-- ===================================================== --}}

    <section class="grid
                    grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-3
                    gap-5
                    pb-12">



        {{-- ================================================= --}}
        {{-- ARIEL --}}
        {{-- ================================================= --}}

        <div class="relative pt-36">


            {{-- IMAGE BEHIND CARD --}}

            <div class="absolute
                        top-0
                        left-1/2
                        -translate-x-1/2
                        z-0
                        w-52
                        h-52
                        sm:w-56
                        sm:h-56
                        lg:w-60
                        lg:h-60
                        pointer-events-none
                        flex
                        items-end
                        justify-center">

                <img
                    src="{{ asset('images/team/Sarong.png') }}"
                    alt="Ariel"
                    class="w-full
                           h-full
                           object-contain
                           object-bottom
                           mix-blend-multiply
                           opacity-95"
                >

            </div>



            {{-- CARD --}}

            <div class="relative
                        z-10
                        bg-[#FFFDFC]
                        rounded-[1.3rem]
                        border border-[#E5E0D7]
                        shadow-sm
                        p-5 sm:p-6
                        min-h-[155px]
                        hover:-translate-y-1
                        hover:shadow-md
                        transition
                        duration-300">


                <h3 class="text-xl
                           sm:text-2xl
                           font-bold
                           text-[#29483D]">

                    Ariel (Sarong)

                </h3>


                <p class="text-xs
                          sm:text-sm
                          text-[#B58A5A]
                          font-medium
                          mt-0.5">

                    Frontend & UI Design

                </p>


                <p class="text-sm
                          sm:text-[15px]
                          text-[#587067]
                          leading-relaxed
                          mt-3
                          max-w-xs">

                    Focused on creating clean interfaces and responsive user experiences.

                </p>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- CHERY --}}
        {{-- ================================================= --}}

        <div class="relative pt-36">


            {{-- IMAGE BEHIND CARD --}}

            <div class="absolute
                        top-0
                        left-1/2
                        -translate-x-1/2
                        z-0
                        w-52
                        h-52
                        sm:w-56
                        sm:h-56
                        lg:w-60
                        lg:h-60
                        pointer-events-none
                        flex
                        items-end
                        justify-center">

                <img
                    src="{{ asset('images/team/Tallie.png') }}"
                    alt="Chery"
                    class="w-full
                           h-full
                           object-contain
                           object-bottom
                           mix-blend-multiply
                           opacity-95"
                >

            </div>



            {{-- CARD --}}

            <div class="relative
                        z-10
                        bg-[#FFFDFC]
                        rounded-[1.3rem]
                        border border-[#E5E0D7]
                        shadow-sm
                        p-5 sm:p-6
                        min-h-[155px]
                        hover:-translate-y-1
                        hover:shadow-md
                        transition
                        duration-300">


                <h3 class="text-xl
                           sm:text-2xl
                           font-bold
                           text-[#29483D]">

                    Chery (Tallie)

                </h3>


                <p class="text-xs
                          sm:text-sm
                          text-[#B58A5A]
                          font-medium
                          mt-0.5">

                    Web Development

                </p>


                <p class="text-sm
                          sm:text-[15px]
                          text-[#587067]
                          leading-relaxed
                          mt-3
                          max-w-xs">

                    Focused on developing functional and practical web solutions.

                </p>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- ANGEL --}}
        {{-- ================================================= --}}

        <div class="relative pt-36">


            {{-- IMAGE BEHIND CARD --}}

            <div class="absolute
                        top-0
                        left-1/2
                        -translate-x-1/2
                        z-0
                        w-52
                        h-52
                        sm:w-56
                        sm:h-56
                        lg:w-60
                        lg:h-60
                        pointer-events-none
                        flex
                        items-end
                        justify-center">

                <img
                    src="{{ asset('images/team/Angulo.png') }}"
                    alt="Angel"
                    class="w-full
                           h-full
                           object-contain
                           object-bottom
                           mix-blend-multiply
                           opacity-95"
                >

            </div>



            {{-- CARD --}}

            <div class="relative
                        z-10
                        bg-[#FFFDFC]
                        rounded-[1.3rem]
                        border border-[#E5E0D7]
                        shadow-sm
                        p-5 sm:p-6
                        min-h-[155px]
                        hover:-translate-y-1
                        hover:shadow-md
                        transition
                        duration-300">


                <h3 class="text-xl
                           sm:text-2xl
                           font-bold
                           text-[#29483D]">

                    Angel (Angulo)

                </h3>


                <p class="text-xs
                          sm:text-sm
                          text-[#B58A5A]
                          font-medium
                          mt-0.5">

                    Backend & Support

                </p>


                <p class="text-sm
                          sm:text-[15px]
                          text-[#587067]
                          leading-relaxed
                          mt-3
                          max-w-xs">

                    Focused on backend development, support, and project functionality.

                </p>

            </div>

        </div>


    </section>

</div>

@endsection