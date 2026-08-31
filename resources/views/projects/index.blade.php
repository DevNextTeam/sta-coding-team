@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-6 py-16">

    {{-- Header --}}
    <div class="text-center mb-12">

        <p class="text-sm tracking-[0.4em] text-[#C47A45] uppercase">
            Our Work
        </p>

        <h1 class="text-4xl font-bold text-[#003B4A] mt-2">
            Projects
        </h1>

        <p class="text-[#245A73] mt-3">
            Explore the projects and applications created by the S.T.A Coding Team.
        </p>

    </div>


    {{-- Projects --}}
    @if ($projects->count())

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach ($projects as $project)

                <div class="bg-white rounded-2xl border border-[#D8E2DD]
                            shadow-sm overflow-hidden
                            hover:shadow-lg transition duration-300">

                    {{-- Image --}}
                    @if ($project->image)

                        <img
                            src="{{ asset('storage/' . $project->image) }}"
                            alt="{{ $project->title }}"
                            class="w-full h-48 object-cover"
                        >

                    @else

                        <div class="w-full h-48 bg-[#E4F0EC]
                                    flex items-center justify-center">

                            <span class="text-[#4F806D]">
                                No Image
                            </span>

                        </div>

                    @endif


                    {{-- Content --}}
                    <div class="p-6">

                        @if ($project->category)

                            <p class="text-xs tracking-widest uppercase
                                      text-[#C47A45] mb-2">
                                {{ $project->category }}
                            </p>

                        @endif


                        <h2 class="text-xl font-bold text-[#003B4A]">
                            {{ $project->title }}
                        </h2>


                        <p class="text-[#245A73] mt-3 line-clamp-3">
                            {{ $project->description }}
                        </p>


                        {{-- Premium / Free --}}
                        <div class="mt-4">

                            @if ($project->is_premium)

                                <span class="inline-flex items-center gap-1
                                             px-3 py-1 rounded-full text-xs
                                             bg-[#F5E6D8] text-[#A85D2F]">

                                    🔒 Premium

                                </span>

                            @else

                                <span class="inline-block px-3 py-1
                                             rounded-full text-xs
                                             bg-[#DCEDE7] text-[#397B67]">

                                    ✓ Free Project

                                </span>

                            @endif

                        </div>


                        {{-- Button --}}
                        <a
                            href="{{ route('projects.show', $project) }}"
                            class="inline-block mt-5
                                   bg-[#518A77] text-white
                                   px-5 py-2 rounded-xl
                                   font-medium
                                   hover:bg-[#407260]
                                   transition"
                        >
                            View Project →
                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="bg-white rounded-2xl border border-[#D8E2DD]
                    p-12 text-center">

            <h2 class="text-2xl font-bold text-[#003B4A]">
                No projects yet
            </h2>

            <p class="text-[#245A73] mt-2">
                Our projects will appear here soon.
            </p>

        </div>

    @endif

</div>

@endsection