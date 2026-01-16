<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 mb-8">
        <div class="mt-6 flex justify-between items-center">
            <h2 class="font-bold text-xl">
                Edit Products
            </h2>
        </div>

        <div class="mt-4" x-data="{ imageUrl: '{{ asset('storage/' . $product->image) }}' }">
            <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="flex gap-8">
                @csrf
                @method('PUT')

                <div class="w-6/12">
                    <img :src="imageUrl" class="rounded-lg" alt="Image">
                </div>

                <div class="w-6/12">
                    <div class="mt-6">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$product->name" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input x-mask:dynamic="$money($input, ',')" id="price" class="block mt-1 w-full" type="text" name="price" :value="$product->price" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <x-text-area id="description" class="block mt-1 w-full" type="text" name="description">
                            {{ $product->description }}
                        </x-text-area>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Image')" />
                        <x-text-input accept="image/*" id="image" class="block mt-1 w-full border-2 p-2" type="file" name="image" :value="$product->image" @change="imageUrl = URL.createObjectURL($event.target.files[0])" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>


                    <x-primary-button class="flex justify-center w-full mt-8">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>