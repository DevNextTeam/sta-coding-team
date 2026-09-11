@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F5F1E8] py-8 sm:py-10">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-[#0F3F4A] sm:text-4xl">
                    Notifications
                </h1>

                <p class="mt-1 text-sm text-gray-600">
                    Stay updated with what's happening on DevNext.
                </p>
            </div>

            @if($notifications->count())
                <form method="POST" action="{{ route('notifications.read-all') }}">
                    @csrf

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-[#0F3F4A] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#29483D]"
                    >
                        Mark all as read
                    </button>
                </form>
            @endif
        </div>

        {{-- Notifications --}}
        <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-black/5">

            @forelse($notifications as $notification)

                @php
                    $data = $notification->data;
                    $type = $data['type'] ?? 'general';

                    $message = $data['message'] ?? 'You have a new notification.';

                    $username = $data['follower_username'] ?? null;

                    $url = $username
                        ? route('profile.show', $username)
                        : '#';
                @endphp

                <div
                    class="border-b border-gray-100 last:border-b-0
                    {{ is_null($notification->read_at) ? 'bg-[#F7FBF9]' : 'bg-white' }}"
                >
                    <div class="flex gap-4 p-4 sm:p-5">

                        {{-- Icon --}}
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full
                            {{ $type === 'follow'
                                ? 'bg-[#E2F0EA] text-[#3E735F]'
                                : 'bg-gray-100 text-gray-600' }}">
                            
                            @if($type === 'follow')
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 19a3 3 0 00-6 0m9-8a3 3 0 11-6 0 3 3 0 016 0zm-9 0a3 3 0 11-6 0 3 3 0 016 0zm-3 8a3 3 0 00-3-3m15 3a3 3 0 003-3"
                                    />
                                </svg>
                            @else
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                                    />
                                </svg>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="min-w-0 flex-1">

                            <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">

                                <div>
                                    @if($type === 'follow' && $username)
                                        <a
                                            href="{{ $url }}"
                                            class="font-semibold text-[#0F3F4A] hover:text-[#3E735F]"
                                        >
                                            {{ $message }}
                                        </a>
                                    @else
                                        <p class="font-semibold text-[#0F3F4A]">
                                            {{ $message }}
                                        </p>
                                    @endif

                                    <p class="mt-1 text-xs text-gray-500">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </div>

                                {{-- Unread indicator --}}
                                @if(is_null($notification->read_at))
                                    <span class="inline-flex w-fit items-center rounded-full bg-[#3E735F] px-2.5 py-1 text-xs font-semibold text-white">
                                        New
                                    </span>
                                @endif

                            </div>

                            {{-- Mark as read --}}
                            @if(is_null($notification->read_at))
                                <form
                                    method="POST"
                                    action="{{ route('notifications.read', $notification->id) }}"
                                    class="mt-3"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="text-xs font-semibold text-[#3E735F] transition hover:text-[#0F3F4A]"
                                    >
                                        Mark as read
                                    </button>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>

            @empty

                <div class="px-6 py-16 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#E2F0EA] text-[#3E735F]">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-7 w-7"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                            />
                        </svg>
                    </div>

                    <h2 class="mt-5 text-lg font-semibold text-[#0F3F4A]">
                        No notifications yet
                    </h2>

                    <p class="mx-auto mt-2 max-w-md text-sm text-gray-500">
                        When developers interact with you or your projects,
                        you'll see their activity here.
                    </p>
                </div>

            @endforelse

        </div>

        {{-- Pagination --}}
        @if($notifications->hasPages())
            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        @endif

    </div>
</div>
@endsection