<nav class="w-full border-b border-[#A8C0B6] bg-[#B8CEC5]">

    <div class="flex min-h-20 items-center justify-between px-4 py-3 sm:px-6 md:min-h-24 md:px-8 lg:min-h-28 lg:px-12">

        {{-- LOGO --}}
        <a href="/" class="flex shrink-0 items-center">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="S.T.A Coding Team Logo"
                class="h-16 w-auto object-contain transition duration-300 hover:scale-105 sm:h-20 md:h-24 lg:h-28"
            >
        </a>


        {{-- DESKTOP NAVIGATION --}}
        <div class="hidden items-center gap-5 md:flex lg:gap-8 xl:gap-10">

            <a href="/"
               class="text-sm font-semibold text-[#29483D] transition hover:text-[#4F806D] lg:text-base">
                Home
            </a>

            <a href="/about"
               class="text-sm font-semibold text-[#29483D] transition hover:text-[#4F806D] lg:text-base">
                About
            </a>

            <a href="{{ route('projects.index') }}"
               class="text-sm font-semibold text-[#29483D] transition hover:text-[#4F806D] lg:text-base">
                Projects
            </a>

            <a href="/contact"
               class="text-sm font-semibold text-[#29483D] transition hover:text-[#4F806D] lg:text-base">
                Contact
            </a>


            @auth

                {{-- DESKTOP NOTIFICATION CENTER --}}
                @php
                    $latestNotifications = auth()->user()
                        ->notifications()
                        ->latest()
                        ->take(5)
                        ->get();

                    $unreadCount = auth()->user()
                        ->unreadNotifications()
                        ->count();
                @endphp

                <div class="relative">

                    <button
                        type="button"
                        onclick="toggleNotificationDropdown()"
                        class="relative flex h-11 w-11 items-center justify-center rounded-full text-[#29483D] transition hover:bg-white/40 hover:text-[#4F806D]"
                        aria-label="Notifications"
                    >
                        <i class="bi bi-bell text-xl"></i>

                        @if($unreadCount > 0)
                            <span
                                class="absolute -right-0.5 -top-0.5 flex min-h-5 min-w-5 items-center justify-center rounded-full bg-[#A45F2C] px-1 text-[10px] font-bold text-white"
                            >
                                {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                            </span>
                        @endif
                    </button>


                    {{-- NOTIFICATION DROPDOWN --}}
                    <div
                        id="notificationDropdown"
                        class="absolute right-0 top-14 z-50 hidden w-80 overflow-hidden rounded-2xl border border-[#D8D0C3] bg-[#F5F1E8] shadow-xl"
                    >

                        <div class="flex items-center justify-between border-b border-[#D8D0C3] px-4 py-3">

                            <div>
                                <h3 class="font-bold text-[#29483D]">
                                    Notifications
                                </h3>

                                @if($unreadCount > 0)
                                    <p class="text-xs text-[#6B756F]">
                                        {{ $unreadCount }} unread
                                    </p>
                                @else
                                    <p class="text-xs text-[#6B756F]">
                                        You're all caught up
                                    </p>
                                @endif
                            </div>

                            @if($unreadCount > 0)
                                <form
                                    method="POST"
                                    action="{{ route('notifications.read-all') }}"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="text-xs font-semibold text-[#4F806D] transition hover:text-[#29483D]"
                                    >
                                        Mark all read
                                    </button>
                                </form>
                            @endif

                        </div>


                        {{-- NOTIFICATIONS --}}
                        <div class="max-h-96 overflow-y-auto">

                            @forelse($latestNotifications as $notification)

                                @php
                                    $data = $notification->data;
                                    $isUnread = is_null($notification->read_at);
                                @endphp

                                <div
                                    class="border-b border-[#E2DCD2] px-4 py-3 transition hover:bg-white/50 {{ $isUnread ? 'bg-white/40' : '' }}"
                                >

                                    <div class="flex gap-3">

                                        {{-- ICON --}}
                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full
                                            {{ ($data['type'] ?? '') === 'follow'
                                                ? 'bg-[#DDEAE3] text-[#4F806D]'
                                                : 'bg-[#E8E0D5] text-[#A45F2C]' }}"
                                        >
                                            @if(($data['type'] ?? '') === 'follow')
                                                <i class="bi bi-person-plus"></i>
                                            @else
                                                <i class="bi bi-bell"></i>
                                            @endif
                                        </div>


                                        {{-- CONTENT --}}
                                        <div class="min-w-0 flex-1">

                                            <p class="text-sm leading-5 text-[#29483D]">
                                                {{ $data['message'] ?? 'You have a new notification.' }}
                                            </p>

                                            <p class="mt-1 text-xs text-[#7A827D]">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>

                                            @if(($data['type'] ?? '') === 'follow' && !empty($data['follower_username']))

                                                <a
                                                    href="{{ route('profile.show', $data['follower_username']) }}"
                                                    class="mt-2 inline-block text-xs font-semibold text-[#4F806D] hover:text-[#29483D]"
                                                >
                                                    View Profile
                                                </a>

                                            @endif

                                        </div>


                                        {{-- MARK AS READ --}}
                                        @if($isUnread)

                                            <form
                                                method="POST"
                                                action="{{ route('notifications.read', $notification->id) }}"
                                                class="shrink-0"
                                            >
                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="text-xs font-semibold text-[#4F806D] hover:text-[#29483D]"
                                                    title="Mark as read"
                                                >
                                                    <i class="bi bi-check2"></i>
                                                </button>
                                            </form>

                                        @endif

                                    </div>

                                </div>

                            @empty

                                <div class="px-5 py-10 text-center">

                                    <i class="bi bi-bell-slash text-3xl text-[#A8B5AE]"></i>

                                    <p class="mt-3 text-sm font-semibold text-[#29483D]">
                                        No notifications yet
                                    </p>

                                    <p class="mt-1 text-xs text-[#7A827D]">
                                        New activity will appear here.
                                    </p>

                                </div>

                            @endforelse

                        </div>


                        {{-- VIEW ALL --}}
                        <div class="border-t border-[#D8D0C3] p-3">

                            <a
                                href="{{ route('notifications.index') }}"
                                onclick="closeNotificationDropdown()"
                                class="block rounded-xl bg-[#4F806D] px-4 py-2.5 text-center text-sm font-semibold text-white transition hover:bg-[#3E735F]"
                            >
                                View All Notifications
                            </a>

                        </div>

                    </div>

                </div>


                {{-- DASHBOARD --}}
                <a
                    href="{{ route('dashboard') }}"
                    class="text-sm font-semibold text-[#29483D] transition hover:text-[#4F806D] lg:text-base"
                >
                    Dashboard
                </a>


                {{-- LOGOUT --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="rounded-full bg-[#4F806D] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#3E735F] lg:px-6"
                    >
                        Logout
                    </button>
                </form>

            @endauth


            @guest

                <a
                    href="{{ route('login') }}"
                    class="text-sm font-semibold text-[#29483D] transition hover:text-[#4F806D] lg:text-base"
                >
                    Login
                </a>

                <a
                    href="{{ route('register') }}"
                    class="rounded-full bg-[#4F806D] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#3E735F] lg:px-6"
                >
                    Sign Up
                </a>

            @endguest

        </div>


        {{-- MOBILE RIGHT SIDE --}}
        <div class="flex items-center gap-2 md:hidden">

            @auth

                {{-- MOBILE NOTIFICATION BUTTON --}}
                @php
                    $mobileUnreadCount = auth()->user()
                        ->unreadNotifications()
                        ->count();
                @endphp

                <a
                    href="{{ route('notifications.index') }}"
                    class="relative flex h-11 w-11 items-center justify-center rounded-full text-[#29483D] transition hover:bg-white/40 hover:text-[#4F806D]"
                    aria-label="Notifications"
                >
                    <i class="bi bi-bell text-xl"></i>

                    @if($mobileUnreadCount > 0)
                        <span
                            class="absolute -right-0.5 -top-0.5 flex min-h-5 min-w-5 items-center justify-center rounded-full bg-[#A45F2C] px-1 text-[10px] font-bold text-white"
                        >
                            {{ $mobileUnreadCount > 99 ? '99+' : $mobileUnreadCount }}
                        </span>
                    @endif

                </a>

            @endauth


            {{-- MOBILE MENU BUTTON --}}
            <button
                type="button"
                onclick="openMobileSidebar()"
                class="flex h-11 w-11 items-center justify-center rounded-full text-[#29483D] transition hover:bg-white/40 hover:text-[#4F806D]"
                aria-label="Open navigation"
            >
                <i class="bi bi-list text-2xl"></i>
            </button>

        </div>

    </div>
</nav>


{{-- NOTIFICATION DROPDOWN JAVASCRIPT --}}
@auth
<script>
    function toggleNotificationDropdown() {
        const dropdown = document.getElementById('notificationDropdown');

        if (!dropdown) {
            return;
        }

        dropdown.classList.toggle('hidden');
    }

    function closeNotificationDropdown() {
        const dropdown = document.getElementById('notificationDropdown');

        if (!dropdown) {
            return;
        }

        dropdown.classList.add('hidden');
    }

    document.addEventListener('click', function (event) {

        const dropdown = document.getElementById('notificationDropdown');

        if (!dropdown) {
            return;
        }

        const notificationButton = event.target.closest(
            '[onclick="toggleNotificationDropdown()"]'
        );

        const notificationContainer = dropdown.parentElement;

        if (
            !notificationContainer.contains(event.target) &&
            !notificationButton
        ) {
            dropdown.classList.add('hidden');
        }

    });
</script>
@endauth
