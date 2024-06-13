<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- bootsrap  --}}

                    <div class="card my-4">
                        <div class="card-header">
                            <h4>View Transaction</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><b>Customer</b></h4>
                                    <p>Name: {{ $order->user->name }}</p>
                                    <p>Email: {{ $order->user->email }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h4>Transaction</h4>
                                    <p>Order Number: {{ $order->id }}</p>
                                    <p>Product Name: {{ $order->product->name }}</p>
                                    <p>Quantity: {{ $order->quantity }}</p>
                                    <p>Total Price: Rp. {{ $order->total_price }}</p>
                                </div>
                            </div>
                            <div class="text-right mt-4">
                                <a class="btn btn-primary" href="{{ route('admin.view.transaction') }}"> Back</a>
                            </div>
                        </div>
                    </div>
                    {{-- end bootsrap  --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
