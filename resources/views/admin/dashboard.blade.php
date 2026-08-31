@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#F5F1E8] py-12 px-6">

    <div class="max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="mb-10">

            <p class="text-sm tracking-[0.3em] text-[#B87945] uppercase">
                Admin
            </p>

            <h1 class="text-4xl font-bold text-[#0F3F4A] mt-2">
                Admin Dashboard
            </h1>

            <p class="text-[#315F6D] mt-2">
                Manage your DevNext website.
            </p>

        </div>


        {{-- Statistics --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- Users --}}
            <div class="bg-white rounded-2xl border border-[#D5DDD8]
                        shadow-sm p-6">

                <p class="text-sm uppercase tracking-wider text-[#B87945]">
                    Total Users
                </p>

                <p class="text-4xl font-bold text-[#0F3F4A] mt-3">
                    {{ $totalUsers }}
                </p>

            </div>


            {{-- Projects --}}
            <div class="bg-white rounded-2xl border border-[#D5DDD8]
                        shadow-sm p-6">

                <p class="text-sm uppercase tracking-wider text-[#B87945]">
                    Total Projects
                </p>

                <p class="text-4xl font-bold text-[#0F3F4A] mt-3">
                    {{ $totalProjects }}
                </p>

            </div>


            {{-- Active Subscriptions --}}
            <div class="bg-white rounded-2xl border border-[#D5DDD8]
                        shadow-sm p-6">

                <p class="text-sm uppercase tracking-wider text-[#B87945]">
                    Active Subscriptions
                </p>

                <p class="text-4xl font-bold text-[#3E735F] mt-3">
                    {{ $activeSubscriptions }}
                </p>

            </div>

        </div>


        {{-- Project Statistics --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">

            {{-- Premium --}}
            <div class="bg-white rounded-2xl border border-[#D5DDD8]
                        shadow-sm p-6">

                <p class="text-sm uppercase tracking-wider text-[#B87945]">
                    Premium Projects
                </p>

                <p class="text-3xl font-bold text-[#A45F2C] mt-3">
                    {{ $premiumProjects }}
                </p>

            </div>


            {{-- Free --}}
            <div class="bg-white rounded-2xl border border-[#D5DDD8]
                        shadow-sm p-6">

                <p class="text-sm uppercase tracking-wider text-[#B87945]">
                    Free Projects
                </p>

                <p class="text-3xl font-bold text-[#3E735F] mt-3">
                    {{ $freeProjects }}
                </p>

            </div>

        </div>


        {{-- Quick Actions --}}
        <div class="bg-white rounded-2xl border border-[#D5DDD8]
                    shadow-sm p-8 mt-8">

            <p class="text-sm tracking-[0.3em] text-[#B87945] uppercase">
                Management
            </p>

            <h2 class="text-2xl font-bold text-[#0F3F4A] mt-2">
                Quick Actions
            </h2>

            <div class="flex flex-wrap gap-4 mt-6">

                <a
                    href="{{ route('admin.projects.index') }}"
                    class="px-6 py-3 rounded-xl
                           bg-[#0F3F4A] text-white
                           hover:opacity-90 transition"
                >
                    Manage Projects
                </a>

                <a
                    href="{{ route('admin.projects.create') }}"
                    class="px-6 py-3 rounded-xl
                           bg-[#4F806D] text-white
                           hover:bg-[#3E735F] transition"
                >
                    + Add Project
                </a>
                 <a
                    href="{{ route('admin.users.index') }}"
                    class="px-6 py-3 rounded-xl
                            bg-[#B87945] text-white
                            hover:opacity-90 transition"
                    >
                     Manage Users
    </a>
            </div>

        </div>

    </div>

</div>

@endsection