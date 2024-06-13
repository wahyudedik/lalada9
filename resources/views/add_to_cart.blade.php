<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add To Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- bootsrap --}}
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="card mb-3" style="max-width: 100%;">
                        <div class="row no-gutters col-lg-12">
                            <div class="col-md-7">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="card-img" style="width: 100%; height: auto;">
                            </div>
                            <div class="col-md-5">
                                <div class="card-body">
                                    <h1 class="card-title"><b>{{ $product->name }}</b></h1>
                                    <p class="card-text">Price: {{ $product->sale_price }} <strike>{{ $product->price }}</strike></p>
                                    <p class="card-text">Quantity: {{ $product->quantity }}</p>
                                    <p class="card-text">Category: {{ $product->category->name }}</p>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <div class="row">
                                        <form action="{{ route('dashboard.cart.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="col-md-5">
                                                <label for="quantity" class="form-label">Quantity :</label>
                                                <input type="number" name="quantity" id="quantity" class="form-control" required>
                                            </div>
                                            <div class="col-md-5 mt-3">
                                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end bootsrap --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
