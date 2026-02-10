<nav x-data="{ open: false }" style="background: linear-gradient(135deg, #407200 0%, #5ea700 100%);">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 1.25rem; color: #ffffff; text-decoration: none; letter-spacing: 1px;">
                        DragonMorphs
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out {{ request()->routeIs('dashboard') ? 'text-white border-b-2 border-white' : 'text-green-100 hover:text-white border-b-2 border-transparent hover:border-green-200' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.dragons.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out {{ request()->routeIs('admin.dragons.*') ? 'text-white border-b-2 border-white' : 'text-green-100 hover:text-white border-b-2 border-transparent hover:border-green-200' }}">
                        Manage Dragons
                    </a>
                    <a href="/" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-green-100 hover:text-white border-b-2 border-transparent hover:border-green-200 transition duration-150 ease-in-out" target="_blank">
                        View Site &#8599;
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-green-100 focus:outline-none transition ease-in-out duration-150" style="background: transparent;">
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
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-green-100 hover:text-white focus:outline-none focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background-color: rgba(0,0,0,0.1);">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 text-base font-medium transition duration-150 ease-in-out {{ request()->routeIs('dashboard') ? 'border-white text-white' : 'border-transparent text-green-100 hover:text-white hover:border-green-200' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.dragons.index') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 text-base font-medium transition duration-150 ease-in-out {{ request()->routeIs('admin.dragons.*') ? 'border-white text-white' : 'border-transparent text-green-100 hover:text-white hover:border-green-200' }}">
                Manage Dragons
            </a>
            <a href="/" target="_blank" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-base font-medium text-green-100 hover:text-white hover:border-green-200 transition duration-150 ease-in-out">
                View Site &#8599;
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t" style="border-color: rgba(255,255,255,0.2);">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-green-200">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-base font-medium text-green-100 hover:text-white hover:border-green-200 transition duration-150 ease-in-out">
                    Profile
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-base font-medium text-green-100 hover:text-white hover:border-green-200 transition duration-150 ease-in-out">
                        Log Out
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
