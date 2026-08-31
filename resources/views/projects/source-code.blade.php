@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#F5F1E8] py-12 px-6">

    <div class="max-w-6xl mx-auto">

        {{-- Back --}}
        <a
            href="{{ route('projects.show', $project) }}"
            class="inline-flex items-center
                   text-[#4F806D]
                   hover:text-[#3E735F]
                   hover:underline
                   transition"
        >
            ← Back to Project
        </a>


        {{-- Header --}}
        <div class="mt-6 mb-6">

            <p class="text-sm
                      uppercase
                      tracking-[0.3em]
                      text-[#B87945]">

                SOURCE CODE

            </p>

            <h1 class="text-3xl
                       sm:text-4xl
                       font-bold
                       text-[#0F3F4A]
                       mt-1">

                {{ $resource->name }}

            </h1>

            <p class="text-[#315F6D] mt-2">

                {{ $project->title }}

            </p>

        </div>


        {{-- Source Code Container --}}
        <div
            class="bg-[#0F1720]
                   rounded-2xl
                   overflow-hidden
                   border border-[#263640]
                   shadow-lg"
        >

            {{-- Code Header --}}
            <div
                class="flex items-center
                       justify-between
                       gap-4
                       px-5 py-4
                       bg-[#16232B]
                       border-b border-[#263640]"
            >

                <div class="flex items-center gap-3">

                    <span
                        class="w-3 h-3
                               rounded-full
                               bg-red-400"
                    ></span>

                    <span
                        class="w-3 h-3
                               rounded-full
                               bg-yellow-400"
                    ></span>

                    <span
                        class="w-3 h-3
                               rounded-full
                               bg-green-400"
                    ></span>

                </div>


                <a
                    href="{{ route(
                        'project-resources.download',
                        $resource
                    ) }}"
                    class="shrink-0
                           px-4 py-2
                           rounded-lg
                           bg-[#4F806D]
                           text-white
                           text-sm
                           hover:bg-[#3E735F]
                           transition"
                >
                    Download
                </a>

            </div>


            {{-- Code --}}
            <div
                class="overflow-x-auto
                       p-6"
            >

                <pre
                    class="text-sm
                           leading-6
                           text-[#E5F0EB]
                           font-mono
                           whitespace-pre"
                ><code>{{ $content }}</code></pre>

            </div>

        </div>


        {{-- File Information --}}
        <div
            class="mt-5
                   bg-white
                   rounded-2xl
                   border border-[#D5DDD8]
                   p-5"
        >

            <div class="flex flex-wrap gap-x-8 gap-y-3">

                <div>

                    <p class="text-xs
                              uppercase
                              tracking-wider
                              text-gray-400">

                        File Type

                    </p>

                    <p class="text-sm
                              font-semibold
                              text-[#0F3F4A]
                              mt-1">

                        {{ $resource->file_type ?? 'Source File' }}

                    </p>

                </div>


                @if($resource->file_size)

                    <div>

                        <p class="text-xs
                                  uppercase
                                  tracking-wider
                                  text-gray-400">

                            File Size

                        </p>

                        <p class="text-sm
                                  font-semibold
                                  text-[#0F3F4A]
                                  mt-1">

                            {{ number_format($resource->file_size / 1024, 1) }} KB

                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection