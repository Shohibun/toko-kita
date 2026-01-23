<x-app-layout>
    <div class="flex justify-center items-center mb-8 mt-28">
        <div class="w-10/12 md:w-8/12">
            <!-- Mengecek apakah ada flash session "success" || Dikirim lewat controller -->
            @if(session()->has('success'))
            <x-alert message="{{ session('success') }}" />
            @endif

            <div class="mt-6 flex justify-between items-center">
                <h2 class="font-bold text-xl">
                    List Products
                </h2>

                <a href="{{ route('products.create') }}">
                    <button class="bg-gray-100 px-10 py-2 rounded-lg font-semibold hover:bg-gray-200">
                        Add
                    </button>
                </a>
            </div>

            <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
                <!-- Melakukan perulangan sebanyak jumlah products -->
                @foreach ($products as $product)
                <div class="col-span-1 rounded-lg shadow-lg mt-4">
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        class="w-full h-96 object-cover rounded-lg"
                        alt="{{ $product->name }}">


                    <div class="flex justify-between px-6 pb-4">
                        <div class="mt-2">
                            <p class="text-xl font-light">
                                {{ $product->name }}
                            </p>

                            <p class="font-semibold text-gray-400">
                                Rp. {{ number_format($product->price) }}
                            </p>
                        </div>

                        <a href="{{ route('products.edit', $product) }}">
                            <button class="w-full mt-2 bg-gray-100 px-10 py-2 rounded-lg font-semibold hover:bg-gray-200">
                                Edit
                            </button>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-4">
                <!-- Pagination (12) -->
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>