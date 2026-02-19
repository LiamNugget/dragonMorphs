<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight" style="color: #407200;">
                Manage Dragons
            </h2>
            <a href="{{ route('admin.dragons.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Add New Dragon
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @php
                $sections = [
                    'available' => ['label' => 'Available', 'color' => '#16a34a', 'bg' => '#f0fdf4', 'border' => '#bbf7d0'],
                    'reserved' => ['label' => 'Reserved', 'color' => '#ca8a04', 'bg' => '#fefce8', 'border' => '#fef08a'],
                    'breeding_stock' => ['label' => 'Breeding Stock', 'color' => '#2563eb', 'bg' => '#eff6ff', 'border' => '#bfdbfe'],
                    'sold' => ['label' => 'Sold', 'color' => '#dc2626', 'bg' => '#fef2f2', 'border' => '#fecaca'],
                ];
            @endphp

            @foreach($sections as $status => $config)
                @php $statusDragons = $dragons->where('status', $status); @endphp

                <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- Section Header -->
                    <div class="px-5 py-3 flex items-center justify-between" style="background: {{ $config['bg'] }}; border-bottom: 2px solid {{ $config['border'] }};">
                        <div class="flex items-center gap-3">
                            <div class="w-2.5 h-2.5 rounded-full" style="background: {{ $config['color'] }};"></div>
                            <h3 class="font-bold text-base" style="color: {{ $config['color'] }};">{{ $config['label'] }}</h3>
                        </div>
                        <span class="text-sm font-bold px-2.5 py-0.5 rounded-full" style="background: {{ $config['border'] }}; color: {{ $config['color'] }};">{{ $statusDragons->count() }}</span>
                    </div>

                    @if($statusDragons->count() > 0)
                        <div class="p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($statusDragons as $dragon)
                                    <div class="border rounded-lg overflow-hidden shadow-sm">
                                        @if($dragon->primaryImage)
                                            <img src="{{ asset('storage/' . $dragon->primaryImage->image_path) }}" alt="{{ $dragon->name }}" class="w-full h-44 object-cover">
                                        @else
                                            <div class="w-full h-44 bg-gray-100 flex items-center justify-center">
                                                <span class="text-gray-400 text-sm">No Image</span>
                                            </div>
                                        @endif

                                        <div class="p-4">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h4 class="font-bold text-base">{{ $dragon->name ?? 'Unnamed' }}</h4>
                                                    <p class="text-sm text-gray-500">{{ $dragon->morph }} &middot; {{ ucfirst($dragon->sex) }}</p>
                                                </div>
                                                @if($dragon->is_hidden)
                                                    <span class="text-xs px-2 py-0.5 rounded bg-gray-200 text-gray-600 font-medium">Hidden</span>
                                                @endif
                                            </div>

                                            <p class="text-xs text-gray-400 mt-1">{{ $dragon->age }}</p>

                                            @if($dragon->parentMale || $dragon->parentFemale)
                                                <p class="text-xs text-gray-400 mt-0.5">
                                                    Parents:
                                                    @if($dragon->parentMale) {{ $dragon->parentMale->name ?? 'Unnamed' }} (M)@endif
                                                    @if($dragon->parentMale && $dragon->parentFemale) &times; @endif
                                                    @if($dragon->parentFemale) {{ $dragon->parentFemale->name ?? 'Unnamed' }} (F)@endif
                                                </p>
                                            @endif

                                            @if($dragon->price)
                                                <p class="font-bold mt-2" style="color: #407200;">£{{ number_format($dragon->price, 2) }}</p>
                                            @endif

                                            <div class="flex gap-2 mt-3 pt-3 border-t border-gray-100">
                                                <a href="{{ route('admin.dragons.edit', $dragon) }}" class="text-white px-3 py-1 rounded text-sm font-medium" style="background-color: #407200;">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.dragons.destroy', $dragon) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this dragon?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm font-medium">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="p-6 text-center text-gray-400 text-sm">
                            No {{ strtolower($config['label']) }} dragons
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
