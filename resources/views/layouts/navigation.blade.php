<nav x-data="{ open: false }" style="background: #2d5000; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 1.1rem; color: #ffffff; text-decoration: none; letter-spacing: 0.5px; display: flex; align-items: center; gap: 0.5rem;">
                        <span style="background: rgba(255,255,255,0.15); padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.7rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;">Admin</span>
                        DragonMorphs
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex" style="margin-left: 2.5rem; gap: 0.25rem;">
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-3 py-1.5 text-sm font-semibold rounded transition duration-150 ease-in-out"
                       style="{{ request()->routeIs('dashboard') ? 'background: rgba(255,255,255,0.2); color: #ffffff;' : 'color: rgba(255,255,255,0.75);' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.dragons.index') }}"
                       class="inline-flex items-center px-3 py-1.5 text-sm font-semibold rounded transition duration-150 ease-in-out"
                       style="{{ request()->routeIs('admin.dragons.*') ? 'background: rgba(255,255,255,0.2); color: #ffffff;' : 'color: rgba(255,255,255,0.75);' }}">
                        Manage Dragons
                    </a>
                    <a href="/" target="_blank"
                       class="inline-flex items-center px-3 py-1.5 text-sm font-semibold rounded transition duration-150 ease-in-out"
                       style="color: rgba(255,255,255,0.75);">
                        View Site &#8599;
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-1.5 text-sm font-semibold rounded focus:outline-none transition ease-in-out duration-150" style="color: rgba(255,255,255,0.85); background: rgba(255,255,255,0.1);">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md transition duration-150 ease-in-out" style="color: rgba(255,255,255,0.8);">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background: #24420a; border-top: 1px solid rgba(255,255,255,0.1);">
        <div class="py-2 space-y-1 px-3">
            <a href="{{ route('dashboard') }}" class="block py-2 px-3 rounded text-sm font-semibold transition duration-150 ease-in-out" style="{{ request()->routeIs('dashboard') ? 'background: rgba(255,255,255,0.15); color: #ffffff;' : 'color: rgba(255,255,255,0.75);' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.dragons.index') }}" class="block py-2 px-3 rounded text-sm font-semibold transition duration-150 ease-in-out" style="{{ request()->routeIs('admin.dragons.*') ? 'background: rgba(255,255,255,0.15); color: #ffffff;' : 'color: rgba(255,255,255,0.75);' }}">
                Manage Dragons
            </a>
            <a href="/" target="_blank" class="block py-2 px-3 rounded text-sm font-semibold transition duration-150 ease-in-out" style="color: rgba(255,255,255,0.75);">
                View Site &#8599;
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="py-3 px-3" style="border-top: 1px solid rgba(255,255,255,0.1);">
            <div class="px-3 mb-2">
                <div class="font-semibold text-sm text-white">{{ Auth::user()->name }}</div>
                <div class="text-xs" style="color: rgba(255,255,255,0.5);">{{ Auth::user()->email }}</div>
            </div>

            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}" class="block py-2 px-3 rounded text-sm font-semibold transition duration-150 ease-in-out" style="color: rgba(255,255,255,0.75);">
                    Profile
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block py-2 px-3 rounded text-sm font-semibold transition duration-150 ease-in-out" style="color: rgba(255,255,255,0.75);">
                        Log Out
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
