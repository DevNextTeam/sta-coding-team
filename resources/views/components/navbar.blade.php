<nav class="sticky top-0 z-50 w-full border-b border-[#A8C0B6]/70 bg-[#B8CEC5]/95 shadow-sm backdrop-blur-md">

    <div class="mx-auto flex min-h-[76px] items-center justify-between px-4 sm:px-6 md:min-h-[82px] md:px-8 lg:px-10">

        {{-- ==========================================================
             LOGO
        =========================================================== --}}
        <a
            href="/"
            class="group flex shrink-0 items-center"
        >
            <img
                src="{{ asset('images/logo.png') }}"
                alt="S.T.A Coding Team Logo"
                class="h-14 w-auto object-contain transition duration-300 ease-out group-hover:scale-[1.04] sm:h-16 md:h-[68px]"
            >
        </a>


        {{-- ==========================================================
             DESKTOP NAVIGATION
        =========================================================== --}}
        <div class="hidden items-center gap-1 md:flex">

            {{-- HOME --}}
            <a
                href="/"
                class="group relative rounded-xl px-4 py-2.5 text-sm font-semibold text-[#29483D] transition duration-200 hover:bg-white/35 hover:text-[#3E735F] lg:px-5 lg:text-[15px]"
            >
                Home

                <span
                    class="absolute bottom-1 left-1/2 h-0.5 w-0 -translate-x-1/2 rounded-full bg-[#4F806D] transition-all duration-200 group-hover:w-5"
                ></span>
            </a>


            {{-- ABOUT --}}
            <a
                href="/about"
                class="group relative rounded-xl px-4 py-2.5 text-sm font-semibold text-[#29483D] transition duration-200 hover:bg-white/35 hover:text-[#3E735F] lg:px-5 lg:text-[15px]"
            >
                About

                <span
                    class="absolute bottom-1 left-1/2 h-0.5 w-0 -translate-x-1/2 rounded-full bg-[#4F806D] transition-all duration-200 group-hover:w-5"
                ></span>
            </a>


            {{-- PROJECTS --}}
            <a
                href="{{ route('projects.index') }}"
                class="group relative rounded-xl px-4 py-2.5 text-sm font-semibold text-[#29483D] transition duration-200 hover:bg-white/35 hover:text-[#3E735F] lg:px-5 lg:text-[15px]"
            >
                Projects

                <span
                    class="absolute bottom-1 left-1/2 h-0.5 w-0 -translate-x-1/2 rounded-full bg-[#4F806D] transition-all duration-200 group-hover:w-5"
                ></span>
            </a>


            {{-- CONTACT --}}
            <a
                href="/contact"
                class="group relative rounded-xl px-4 py-2.5 text-sm font-semibold text-[#29483D] transition duration-200 hover:bg-white/35 hover:text-[#3E735F] lg:px-5 lg:text-[15px]"
            >
                Contact

                <span
                    class="absolute bottom-1 left-1/2 h-0.5 w-0 -translate-x-1/2 rounded-full bg-[#4F806D] transition-all duration-200 group-hover:w-5"
                ></span>
            </a>


            @auth

                {{-- ==================================================
                     NOTIFICATIONS
                =================================================== --}}
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

                <div class="relative ml-2">

                    <button
                        type="button"
                        onclick="toggleNotificationDropdown()"
                        class="relative flex h-11 w-11 items-center justify-center rounded-xl text-[#29483D] transition duration-200 hover:bg-white/45 hover:text-[#3E735F] active:scale-95"
                        aria-label="Notifications"
                        aria-expanded="false"
                    >
                        <i class="bi bi-bell text-[19px]"></i>

                        @if($unreadCount > 0)
                            <span
                                class="absolute right-0 top-0 flex min-h-[19px] min-w-[19px] -translate-y-0.5 translate-x-0.5 items-center justify-center rounded-full bg-[#A45F2C] px-1 text-[9px] font-bold leading-none text-white shadow-sm"
                            >
                                {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                            </span>
                        @endif

                    </button>


                    {{-- ==================================================
                         NOTIFICATION DROPDOWN
                    =================================================== --}}
                    <div
                        id="notificationDropdown"
                        class="absolute right-0 top-[54px] z-50 hidden w-[340px] overflow-hidden rounded-2xl border border-[#D8D0C3] bg-[#F5F1E8] shadow-[0_15px_40px_rgba(41,72,61,0.16)]"
                    >

                        {{-- HEADER --}}
                        <div class="flex items-center justify-between border-b border-[#D8D0C3] px-4 py-3.5">

                            <div>
                                <h3 class="text-sm font-bold text-[#29483D]">
                                    Notifications
                                </h3>

                                @if($unreadCount > 0)

                                    <p class="mt-0.5 text-[11px] text-[#7A827D]">
                                        {{ $unreadCount }} unread notification{{ $unreadCount === 1 ? '' : 's' }}
                                    </p>

                                @else

                                    <p class="mt-0.5 text-[11px] text-[#7A827D]">
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
                                        class="rounded-lg px-2 py-1 text-[11px] font-semibold text-[#4F806D] transition hover:bg-[#DDEAE3] hover:text-[#29483D]"
                                    >
                                        Mark all read
                                    </button>
                                </form>

                            @endif

                        </div>


                        {{-- NOTIFICATIONS --}}
                        <div class="max-h-[380px] overflow-y-auto">

                            @forelse($latestNotifications as $notification)

                                @php
                                    $data = $notification->data;
                                    $isUnread = is_null($notification->read_at);
                                @endphp

                                <div
                                    class="border-b border-[#E2DCD2] px-4 py-3.5 transition duration-200 hover:bg-white/55 {{ $isUnread ? 'bg-white/35' : '' }}"
                                >

                                    <div class="flex gap-3">

                                        {{-- ICON --}}
                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
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

                                            <p class="mt-1 text-[11px] text-[#7A827D]">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>


                                            @if(
                                                ($data['type'] ?? '') === 'follow' &&
                                                !empty($data['follower_username'])
                                            )

                                                <a
                                                    href="{{ route('profile.show', $data['follower_username']) }}"
                                                    class="mt-2 inline-flex items-center gap-1 text-[11px] font-semibold text-[#4F806D] transition hover:text-[#29483D]"
                                                >
                                                    View Profile
                                                    <i class="bi bi-arrow-right text-[10px]"></i>
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
                                                    class="flex h-7 w-7 items-center justify-center rounded-lg text-[#4F806D] transition hover:bg-[#DDEAE3] hover:text-[#29483D]"
                                                    title="Mark as read"
                                                    aria-label="Mark as read"
                                                >
                                                    <i class="bi bi-check2 text-sm"></i>
                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </div>

                            @empty

                                <div class="px-5 py-10 text-center">

                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[#DDEAE3]">
                                        <i class="bi bi-bell-slash text-xl text-[#4F806D]"></i>
                                    </div>

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
                        <div class="border-t border-[#D8D0C3] bg-[#F1ECE3] p-3">

                            <a
                                href="{{ route('notifications.index') }}"
                                onclick="closeNotificationDropdown()"
                                class="flex items-center justify-center gap-2 rounded-xl bg-[#4F806D] px-4 py-2.5 text-center text-sm font-semibold text-white shadow-sm transition duration-200 hover:bg-[#3E735F] hover:shadow-md active:scale-[0.98]"
                            >
                                View All Notifications
                                <i class="bi bi-arrow-right text-xs"></i>
                            </a>

                        </div>

                    </div>

                </div>


                {{-- ==================================================
                     DASHBOARD
                =================================================== --}}
                <a
                    href="{{ route('dashboard') }}"
                    class="group relative ml-1 rounded-xl px-4 py-2.5 text-sm font-semibold text-[#29483D] transition duration-200 hover:bg-white/35 hover:text-[#3E735F] lg:px-5 lg:text-[15px]"
                >
                    Dashboard

                    <span
                        class="absolute bottom-1 left-1/2 h-0.5 w-0 -translate-x-1/2 rounded-full bg-[#4F806D] transition-all duration-200 group-hover:w-5"
                    ></span>
                </a>


                {{-- ==================================================
                     LOGOUT
                =================================================== --}}
                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="ml-2"
                >
                    @csrf

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-[#4F806D] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition duration-200 hover:bg-[#3E735F] hover:shadow-md active:scale-[0.97] lg:px-5"
                    >
                        <i class="bi bi-box-arrow-right text-sm"></i>
                        Logout
                    </button>
                </form>

            @endauth


            @guest

                {{-- ==================================================
                     LOGIN
                =================================================== --}}
                <a
                    href="{{ route('login') }}"
                    class="ml-2 rounded-xl px-4 py-2.5 text-sm font-semibold text-[#29483D] transition duration-200 hover:bg-white/35 hover:text-[#3E735F] lg:px-5 lg:text-[15px]"
                >
                    Login
                </a>


                {{-- ==================================================
                     SIGN UP
                =================================================== --}}
                <a
                    href="{{ route('register') }}"
                    class="ml-1 inline-flex items-center gap-2 rounded-xl bg-[#4F806D] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition duration-200 hover:bg-[#3E735F] hover:shadow-md active:scale-[0.97] lg:px-5"
                >
                    Sign Up
                    <i class="bi bi-arrow-right text-xs"></i>
                </a>

            @endguest

        </div>


        {{-- ==========================================================
             MOBILE RIGHT SIDE
        =========================================================== --}}
        <div class="flex items-center gap-1.5 md:hidden">

            @auth

                @php
                    $mobileUnreadCount = auth()->user()
                        ->unreadNotifications()
                        ->count();
                @endphp


                {{-- MOBILE NOTIFICATIONS --}}
                <a
                    href="{{ route('notifications.index') }}"
                    class="relative flex h-11 w-11 items-center justify-center rounded-xl text-[#29483D] transition duration-200 hover:bg-white/45 hover:text-[#3E735F] active:scale-95"
                    aria-label="Notifications"
                >
                    <i class="bi bi-bell text-[19px]"></i>

                    @if($mobileUnreadCount > 0)

                        <span
                            class="absolute right-0 top-0 flex min-h-[19px] min-w-[19px] -translate-y-0.5 translate-x-0.5 items-center justify-center rounded-full bg-[#A45F2C] px-1 text-[9px] font-bold leading-none text-white shadow-sm"
                        >
                            {{ $mobileUnreadCount > 99 ? '99+' : $mobileUnreadCount }}
                        </span>

                    @endif

                </a>

            @endauth


            {{-- MOBILE MENU --}}
            <button
                type="button"
                onclick="openMobileSidebar()"
                class="flex h-11 w-11 items-center justify-center rounded-xl text-[#29483D] transition duration-200 hover:bg-white/45 hover:text-[#3E735F] active:scale-95"
                aria-label="Open navigation"
            >
                <i class="bi bi-list text-[24px]"></i>
            </button>

        </div>

    </div>

</nav>


{{-- ================================================================
     NOTIFICATION JAVASCRIPT
================================================================ --}}
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
