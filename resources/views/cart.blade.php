<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- bootsrap --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="card mb-3" style="max-width: 100%;">
                        <div class="row no-gutters col-lg-12">
                            @foreach ($products as $product)
                                <div class="col-md-7">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="card-img"
                                        style="width: 100%; height: auto;">
                                </div>
                                <div class="col-md-5">
                                    <div class="card-body">
                                        <h1 class="card-title"><b>{{ $product->name }}</b></h1>
                                        <p class="card-text">Price: {{ $product->sale_price }}
                                            <strike>{{ $product->price }}</strike></p>
                                        <p class="card-text">Quantity: {{ $product->quantity }}</p>
                                        <p class="card-text">{{ $product->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card mb-3 mt-3" style="max-width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Cart Summary</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->sale_price }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ $product->sale_price * $product->quantity }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" class="text-right">Total</td>
                                        <td>{{ $total }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right"></td>
                                        <td colspan="4" class="text-right">
                                            <form action="{{ route('dashboard.place.order') }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Place Order</button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- end bootsrap --}}
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
