<x-app-layout>
    <div class="flex justify-center items-center mb-8 mt-28">
        <div class="w-10/12 md:w-8/12">
            <h2 class="font-bold text-xl">
                Add Products
            </h2>

            <div class="mt-4" x-data="{ imageUrl: '{{ asset('storage/noimage.png') }}' }">
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf

                    <div class="col-span-1">
                        <img :src="imageUrl" class="rounded-lg" alt="Image">
                    </div>

                    <div class="col-span-1">
                        <div class="">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input x-mask:dynamic="$money($input, ',')" id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-area id="description" class="block mt-1 w-full" type="text" name="description">
                                {{ old('description') }}
                            </x-text-area>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Image')" />
                            <x-text-input accept="image/*" id="image" class="block mt-1 w-full border-2 p-2" type="file" name="image" :value="old('image')" @change="imageUrl = URL.createObjectURL($event.target.files[0])" required />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>


                        <x-primary-button class="flex justify-center w-full mt-8">
                            {{ __('Submit') }}
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>