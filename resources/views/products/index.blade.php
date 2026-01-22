<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 mb-8 mt-28">
        @if(session()->has('success'))
        <x-alert message="{{ session('success') }}" />
        @endif

        <div class="mt-6 flex justify-between items-center">
            <h2 class="font-bold text-xl">
                List Products
            </h2>

            <a href="{{ route('products.create') }}">
                <button class="bg-gray-100 px-10 py-2 rounded-lg font-semibold">
                    Add
                </button>
            </a>
        </div>

        <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
            @foreach ($products as $product)
            <div class="col-span-1 mt-4">
                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    class="w-full h-96 object-cover rounded-lg"
                    alt="{{ $product->name }}">


                <div class="mt-2">
                    <p class="text-xl font-light">
                        {{ $product->name }}
                    </p>

                    <p class="font-semibold text-gray-400">
                        Rp. {{ number_format($product->price) }}
                    </p>
                </div>

                <a href="{{ route('products.edit', $product) }}">
                    <button class="w-full mt-3 bg-gray-100 px-10 py-2 rounded-lg font-semibold">
                        Edit
                    </button>
                </a>
            </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>