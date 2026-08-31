@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    <section class="grid lg:grid-cols-5
                    overflow-hidden
                    rounded-[2.5rem]
                    border border-[#E5E0D7]
                    shadow-lg
                    bg-[#FFFDFC]">


        {{-- ================= LEFT SIDE ================= --}}

        <div class="lg:col-span-2
                    bg-[#29483D]
                    p-8 sm:p-10 lg:p-12
                    flex flex-col justify-between">

            <div>

                <p class="text-sm uppercase
                          tracking-[0.3em]
                          font-semibold
                          text-[#B8CEC5]">

                    Get in Touch

                </p>

                <h1 class="text-4xl sm:text-5xl
                           font-bold
                           text-white
                           mt-4">

                    Let's talk.

                </h1>

                <p class="mt-5
                          text-[#D8E1DD]
                          leading-relaxed">

                    Have a question, suggestion, or message?
                    Send us a message and we'll get back to you.

                </p>

            </div>


            <div class="mt-12 space-y-5">

                <div class="flex items-center gap-4">

                    <div class="w-11 h-11
                                rounded-xl
                                bg-white/10
                                flex items-center justify-center">

                        ✉

                    </div>

                    <div>

                        <p class="text-xs
                                  uppercase
                                  tracking-wider
                                  text-[#B8CEC5]">

                            Email

                        </p>

                        <p class="text-white
                                  font-medium
                                  mt-1">

                            devnextteam@gmail.com

                        </p>

                    </div>

                </div>


                <div class="flex items-center gap-4">

                    <div class="w-11 h-11
                                rounded-xl
                                bg-white/10
                                flex items-center justify-center">

                        💻

                    </div>

                    <div>

                        <p class="text-xs
                                  uppercase
                                  tracking-wider
                                  text-[#B8CEC5]">

                            Projects

                        </p>

                        <p class="text-white
                                  font-medium
                                  mt-1">

                            Explore our work

                        </p>

                    </div>

                </div>

            </div>

        </div>



        {{-- ================= RIGHT SIDE ================= --}}

        <div class="lg:col-span-3
                    p-8 sm:p-10 lg:p-12">

            <div class="mb-8">

                <h2 class="text-2xl
                           font-bold
                           text-[#29483D]">

                    Send us a message

                </h2>

                <p class="mt-2
                          text-[#587067]">

                    Fill out the form below and let us know
                    how we can help.

                </p>

            </div>


            {{-- SUCCESS --}}

            @if(session('success'))

                <div class="mb-6
                            rounded-2xl
                            border border-[#C8DED4]
                            bg-[#E5F0EB]
                            px-5 py-4
                            text-[#29483D]">

                    <div class="font-semibold">

                        Message sent successfully.

                    </div>

                    <div class="text-sm mt-1">

                        Thank you for contacting the S.T.A Coding Team.

                    </div>

                </div>

            @endif



            {{-- ERRORS --}}

            @if($errors->any())

                <div class="mb-6
                            rounded-2xl
                            border border-red-200
                            bg-red-50
                            px-5 py-4
                            text-red-700">

                    <p class="font-semibold mb-2">

                        Please fix the following:

                    </p>

                    <ul class="list-disc list-inside text-sm space-y-1">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif



            <form action="/contact"
                  method="POST"
                  class="space-y-6">

                @csrf


                {{-- NAME --}}

                <div>

                    <label
                        for="name"
                        class="block text-sm
                               font-semibold
                               text-[#29483D]
                               mb-2">

                        Name

                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Your name"
                        class="w-full
                               px-4 py-3.5
                               rounded-2xl
                               bg-[#F8F6F1]
                               border border-[#E4DDD0]
                               text-[#29483D]
                               placeholder-[#8A9891]
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#B8CEC5]
                               focus:border-[#4F806D]
                               transition">

                </div>



                {{-- EMAIL --}}

                <div>

                    <label
                        for="email"
                        class="block text-sm
                               font-semibold
                               text-[#29483D]
                               mb-2">

                        Email

                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="you@example.com"
                        class="w-full
                               px-4 py-3.5
                               rounded-2xl
                               bg-[#F8F6F1]
                               border border-[#E4DDD0]
                               text-[#29483D]
                               placeholder-[#8A9891]
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#B8CEC5]
                               focus:border-[#4F806D]
                               transition">

                </div>



                {{-- MESSAGE --}}

                <div>

                    <label
                        for="message"
                        class="block text-sm
                               font-semibold
                               text-[#29483D]
                               mb-2">

                        Message

                    </label>

                    <textarea
                        id="message"
                        name="message"
                        rows="6"
                        placeholder="Tell us what's on your mind..."
                        class="w-full
                               px-4 py-3.5
                               rounded-2xl
                               bg-[#F8F6F1]
                               border border-[#E4DDD0]
                               text-[#29483D]
                               placeholder-[#8A9891]
                               resize-none
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#B8CEC5]
                               focus:border-[#4F806D]
                               transition">{{ old('message') }}</textarea>

                </div>



                {{-- BUTTON --}}

                <button
                    type="submit"
                    class="w-full sm:w-auto
                           inline-flex
                           items-center
                           justify-center
                           gap-2
                           px-7 py-3.5
                           rounded-full
                           bg-[#4F806D]
                           text-white
                           font-semibold
                           shadow-sm
                           hover:bg-[#3F6D5B]
                           hover:-translate-y-0.5
                           hover:shadow-md
                           transition">

                    Send Message

                    <span>→</span>

                </button>

            </form>

        </div>

    </section>

</div>

@endsection