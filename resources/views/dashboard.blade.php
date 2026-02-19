<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #407200;">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome -->
            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p class="text-sm text-gray-500 mt-1">Manage your dragons, update listings, and keep your site up to date.</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Dragons</div>
                        <div class="mt-1 text-3xl font-bold" style="color: #407200;">{{ $totalDragons }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Available</div>
                        <div class="mt-1 text-3xl font-bold" style="color: #5ea700;">{{ $availableDragons }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Sold</div>
                        <div class="mt-1 text-3xl font-bold text-gray-600">{{ $soldDragons }}</div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('admin.dragons.index') }}" class="block bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-200">
                    <div class="p-6 flex items-center">
                        <div class="shrink-0 rounded-lg p-3" style="background-color: rgba(64, 114, 0, 0.1);">
                            <svg class="w-6 h-6" style="color: #407200;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                            </svg>
                        </div>
                        <div class="ms-4">
                            <div class="text-base font-semibold text-gray-800">Manage Dragons</div>
                            <div class="text-sm text-gray-500">View, edit, and manage all dragon listings</div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.dragons.create') }}" class="block bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-200">
                    <div class="p-6 flex items-center">
                        <div class="shrink-0 rounded-lg p-3" style="background-color: rgba(94, 167, 0, 0.1);">
                            <svg class="w-6 h-6" style="color: #5ea700;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                        <div class="ms-4">
                            <div class="text-base font-semibold text-gray-800">Add New Dragon</div>
                            <div class="text-sm text-gray-500">Create a new dragon listing</div>
                        </div>
                    </div>
                </a>

                <a href="/" target="_blank" class="block bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-200">
                    <div class="p-6 flex items-center">
                        <div class="shrink-0 rounded-lg p-3 bg-gray-100">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>
                        </div>
                        <div class="ms-4">
                            <div class="text-base font-semibold text-gray-800">View Site</div>
                            <div class="text-sm text-gray-500">Open the public-facing website</div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}" class="block bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-200">
                    <div class="p-6 flex items-center">
                        <div class="shrink-0 rounded-lg p-3 bg-gray-100">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <div class="ms-4">
                            <div class="text-base font-semibold text-gray-800">Profile Settings</div>
                            <div class="text-sm text-gray-500">Update your account details and password</div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
