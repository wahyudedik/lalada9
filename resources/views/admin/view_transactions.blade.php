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

                    @foreach ($transactions as $transaction)
                        <div class="card mb-3" style="max-width: 100%;">
                            <div class="row no-gutters col-lg-12">
                                <div class="col-md-7">
                                    <h5 class="card-title"><b>Transaction Date: {{ $transaction->created_at }}</b></h5>
                                    <img src="{{ asset($transaction->product->image) }}" alt="{{ $transaction->product->name }}" class="card-img" style="width: 100%; height: auto;">
                                </div>
                                <div class="col-md-5">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Order Number: {{ $transaction->id }}</b></h5>
                                        <p class="card-text">Total Amount: Rp. {{ $transaction->total_price }}</p>
                                        <a href="{{ route('admin.view.transaction.show', $transaction->id) }}" class="btn btn-secondary">View Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- end bootsrap  --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
