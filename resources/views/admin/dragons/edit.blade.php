<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Dragon: {{ $dragon->name ?? 'Unnamed' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.dragons.update', $dragon) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name (Optional)</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $dragon->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Sex -->
                            <div>
                                <label for="sex" class="block text-sm font-medium text-gray-700">Sex *</label>
                                <select name="sex" id="sex" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">Select...</option>
                                    <option value="male" {{ old('sex', $dragon->sex) === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('sex', $dragon->sex) === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('sex') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- DOB -->
                            <div>
                                <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth *</label>
                                <input type="date" name="dob" id="dob" value="{{ old('dob', $dragon->dob->format('Y-m-d')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('dob') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Morph -->
                            <div>
                                <label for="morph" class="block text-sm font-medium text-gray-700">Morph *</label>
                                <select name="morph" id="morph" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">Select...</option>
                                    @foreach($morphs as $morph)
                                        <option value="{{ $morph }}" {{ old('morph', $dragon->morph) === $morph ? 'selected' : '' }}>{{ $morph }}</option>
                                    @endforeach
                                </select>
                                @error('morph') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Weight -->
                            <div>
                                <label for="weight" class="block text-sm font-medium text-gray-700">Weight (grams)</label>
                                <input type="number" step="0.01" name="weight" id="weight" value="{{ old('weight', $dragon->weight) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('weight') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Price -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Price (£)</label>
                                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $dragon->price) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                                <select name="status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="available" {{ old('status', $dragon->status) === 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="reserved" {{ old('status', $dragon->status) === 'reserved' ? 'selected' : '' }}>Reserved</option>
                                    <option value="sold" {{ old('status', $dragon->status) === 'sold' ? 'selected' : '' }}>Sold</option>
                                    <option value="breeding_stock" {{ old('status', $dragon->status) === 'breeding_stock' ? 'selected' : '' }}>Breeding Stock</option>
                                </select>
                                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Clutch ID -->
                            <div>
                                <label for="clutch_id" class="block text-sm font-medium text-gray-700">Clutch ID</label>
                                <input type="text" name="clutch_id" id="clutch_id" value="{{ old('clutch_id', $dragon->clutch_id) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('clutch_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Parent Male -->
                            <div>
                                <label for="parent_male_id" class="block text-sm font-medium text-gray-700">Parent Male</label>
                                <select name="parent_male_id" id="parent_male_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">None</option>
                                    @foreach($dragons->where('sex', 'male') as $male)
                                        <option value="{{ $male->id }}" {{ old('parent_male_id', $dragon->parent_male_id) == $male->id ? 'selected' : '' }}>
                                            {{ $male->name ?? 'Unnamed' }} - {{ $male->morph }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_male_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Parent Female -->
                            <div>
                                <label for="parent_female_id" class="block text-sm font-medium text-gray-700">Parent Female</label>
                                <select name="parent_female_id" id="parent_female_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">None</option>
                                    @foreach($dragons->where('sex', 'female') as $female)
                                        <option value="{{ $female->id }}" {{ old('parent_female_id', $dragon->parent_female_id) == $female->id ? 'selected' : '' }}>
                                            {{ $female->name ?? 'Unnamed' }} - {{ $female->morph }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_female_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Date Listed -->
                            <div>
                                <label for="date_listed" class="block text-sm font-medium text-gray-700">Date Listed</label>
                                <input type="date" name="date_listed" id="date_listed" value="{{ old('date_listed', $dragon->date_listed?->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('date_listed') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Date Sold -->
                            <div>
                                <label for="date_sold" class="block text-sm font-medium text-gray-700">Date Sold</label>
                                <input type="date" name="date_sold" id="date_sold" value="{{ old('date_sold', $dragon->date_sold?->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('date_sold') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Hidden -->
                            <div class="flex items-center">
                                <input type="checkbox" name="is_hidden" id="is_hidden" value="1" {{ old('is_hidden', $dragon->is_hidden) ? 'checked' : '' }} class="rounded border-gray-300">
                                <label for="is_hidden" class="ml-2 text-sm font-medium text-gray-700">Hidden from public</label>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $dragon->description) }}</textarea>
                            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Notes -->
                        <div class="mt-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Private Notes</label>
                            <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('notes', $dragon->notes) }}</textarea>
                            @error('notes') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Current Images -->
                        @if($dragon->images->count() > 0)
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Current Images</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @foreach($dragon->images as $image)
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Dragon image" class="w-full h-32 object-cover rounded">
                                            @if($image->is_primary)
                                                <span class="absolute top-1 right-1 bg-green-500 text-white text-xs px-2 py-1 rounded">Primary</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Add New Images -->
                        <div class="mt-6">
                            <label for="images" class="block text-sm font-medium text-gray-700">Add New Images</label>
                            <input type="file" name="images[]" id="images" multiple accept="image/*" class="mt-1 block w-full">
                            @error('images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mt-6 flex gap-4">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                                Update Dragon
                            </button>
                            <a href="{{ route('admin.dragons.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>