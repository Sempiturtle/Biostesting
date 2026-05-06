<header class="school-header">
    <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()" class="lg:hidden text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
        <h2 class="text-xl font-bold text-slate-800 hidden md:block">
            {{ $title ?? 'AISAT Portal' }}
        </h2>
    </div>

    <div class="flex items-center gap-6">
        <!-- Notifications -->
        <button class="relative text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
        </button>

        <!-- User Dropdown -->
        <div class="flex items-center gap-3 border-l pl-6 border-gray-200">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-semibold text-slate-900">{{ Auth::user()->name }}</div>
                <div class="text-xs text-slate-500 capitalize">{{ Auth::user()->role ?? 'Student' }}</div>
            </div>
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                        <img class="h-10 w-10 rounded-full object-cover shadow-sm" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ Auth::user()->name }}" />
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</header>
