<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Dragons
            </h2>
            <a href="{{ route('admin.dragons.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Add New Dragon
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($dragons as $dragon)
                            <div class="border rounded-lg overflow-hidden shadow">
                                @if($dragon->primaryImage)
                                    <img src="{{ asset('storage/' . $dragon->primaryImage->image_path) }}" alt="{{ $dragon->name }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400">No Image</span>
                                    </div>
                                @endif
                                
                                <div class="p-4">
                                    <h3 class="font-bold text-lg">{{ $dragon->name ?? 'Unnamed' }}</h3>
                                    <p class="text-sm text-gray-600">{{ $dragon->morph }} - {{ ucfirst($dragon->sex) }}</p>
                                    <p class="text-sm text-gray-600">Age: {{ $dragon->age }}</p>
                                    
                                    <div class="mt-2">
                                        <span class="inline-block px-2 py-1 text-xs rounded
                                            @if($dragon->status === 'available') bg-green-100 text-green-800
                                            @elseif($dragon->status === 'reserved') bg-yellow-100 text-yellow-800
                                            @elseif($dragon->status === 'sold') bg-red-100 text-red-800
                                            @else bg-blue-100 text-blue-800
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $dragon->status)) }}
                                        </span>
                                        
                                        @if($dragon->is_hidden)
                                            <span class="inline-block px-2 py-1 text-xs rounded bg-gray-100 text-gray-800">Hidden</span>
                                        @endif
                                    </div>

                                    @if($dragon->price)
                                        <p class="font-bold text-green-600 mt-2">£{{ number_format($dragon->price, 2) }}</p>
                                    @endif

                                    <div class="flex gap-2 mt-4">
                                        <a href="{{ route('admin.dragons.edit', $dragon) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.dragons.destroy', $dragon) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 text-center py-8 text-gray-500">
                                No dragons yet. Add your first one!
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>