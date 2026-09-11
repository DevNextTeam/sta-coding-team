@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F5F1E8] py-8 px-4 sm:px-6 lg:px-8">

    <div class="max-w-4xl mx-auto">

        {{-- Back --}}
        <a href="{{ route('profile.show', $profile->username) }}"
           class="inline-flex items-center gap-2 text-[#4F806D] hover:text-[#3E735F] font-semibold mb-6 transition">
            ← Back to Profile
        </a>

        {{-- Header --}}
        <div class="bg-white rounded-3xl shadow-sm border border-[#E6DED1] p-6 sm:p-8 mb-6">

            <div class="flex items-center gap-4">

                {{-- Avatar --}}
                @if($profile->avatar)
                    <img
                        src="{{ asset('storage/' . $profile->avatar) }}"
                        alt="{{ $profile->username }}"
                        class="w-16 h-16 sm:w-20 sm:h-20 rounded-full object-cover border-2 border-[#B8CEC5]"
                    >
                @else
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-[#B8CEC5] flex items-center justify-center text-[#29483D] text-2xl font-bold">
                        {{ strtoupper(substr($profile->username, 0, 1)) }}
                    </div>
                @endif

                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-[#29483D]">
                        {{ $profile->username }} is Following
                    </h1>

                    <p class="text-gray-500 mt-1">
                        {{ $users->count() }} {{ Str::plural('developer', $users->count()) }}
                    </p>
                </div>

            </div>
        </div>

        {{-- Following --}}
        <div class="bg-white rounded-3xl shadow-sm border border-[#E6DED1] overflow-hidden">

            @forelse($users as $user)

                <a href="{{ route('profile.show', $user->profile->username) }}"
                   class="flex items-center gap-4 p-5 sm:p-6 border-b border-[#EEE7DC] last:border-b-0 hover:bg-[#F8F5EF] transition">

                    {{-- Avatar --}}
                    @if($user->profile->avatar)
                        <img
                            src="{{ asset('storage/' . $user->profile->avatar) }}"
                            alt="{{ $user->profile->username }}"
                            class="w-14 h-14 rounded-full object-cover border border-[#D7E2DC]"
                        >
                    @else
                        <div class="w-14 h-14 rounded-full bg-[#B8CEC5] flex items-center justify-center text-[#29483D] text-xl font-bold flex-shrink-0">
                            {{ strtoupper(substr($user->profile->username, 0, 1)) }}
                        </div>
                    @endif

                    {{-- User Info --}}
                    <div class="min-w-0 flex-1">

                        <h2 class="font-bold text-[#29483D] truncate">
                            {{ $user->name }}
                        </h2>

                        <p class="text-sm text-[#4F806D] truncate">
                            {{ '@' . $user->profile->username }}
                        </p>

                        @if($user->profile->headline)
                            <p class="text-sm text-gray-500 mt-1 truncate">
                                {{ $user->profile->headline }}
                            </p>
                        @endif

                    </div>

                    {{-- Arrow --}}
                    <span class="text-gray-400 text-xl">
                        →
                    </span>

                </a>

            @empty

                <div class="p-10 text-center">

                    <div class="text-5xl mb-4">
                        👥
                    </div>

                    <h2 class="text-xl font-bold text-[#29483D]">
                        Not Following Anyone Yet
                    </h2>

                    <p class="text-gray-500 mt-2">
                        This developer isn't following anyone yet.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>
@endsection
