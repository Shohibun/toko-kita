<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 mb-8">
        <div class="mt-6 flex justify-between items-center">
            <h2 class="font-bold text-xl">
                Add Products
            </h2>
        </div>

        <div class="mt-4">
            <form method="POST" action="{{ route('products.store') }}">
                @csrf

                <div class="mt-6">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="price" :value="__('Price')" />
                    <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <x-text-area id="description" class="block mt-1 w-full" type="text" name="description">
                        {{ old('description') }}
                    </x-text-area>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>


                <x-primary-button class="flex justify-center w-full mt-8">
                    {{ __('Submit') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>