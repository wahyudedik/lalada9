<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- css bootsrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        {{-- <div class="shrink-0 flex items-center">
                                <a href="{{ route('dashboard') }}">
                                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                                </a>
                            </div> --}}

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            {{-- nav link user --}}
                            <x-nav-link :href="route('welcomee')" :active="request()->routeIs('welcomee')">
                                {{ __('Product') }}
                            </x-nav-link>
                            <x-nav-link :href="route('guest.category')" :active="request()->routeIs('guest.category')">
                                {{ __('Category') }}
                            </x-nav-link>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>Welcome</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @auth
                                    <a @if (Auth::user()->usertype == 'admin') href="{{ url('/admin/dashboard') }}"
                                        @else
                                            href="{{ url('/dashboard') }}" @endif
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Dashboard
                                    </a>
                                @else
                                    <x-dropdown-link :href="route('login')">
                                        {{ __('Login') }}
                                    </x-dropdown-link>

                                    @if (Route::has('register'))
                                        <x-dropdown-link :href="route('register')">
                                            {{ __('Register') }}
                                        </x-dropdown-link>
                                    @endif
                                @endauth
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('welcomee')" :active="request()->routeIs('welcomee')">
                        {{ __('Product') }}
                    </x-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">Welcome</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        @auth
                            <a @if (Auth::user()->usertype == 'admin') href="{{ url('/admin/dashboard') }}"
                                        @else
                                            href="{{ url('/dashboard') }}" @endif
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Dashboard
                            </a>
                        @else
                            <x-dropdown-link :href="route('login')">
                                {{ __('Login') }}
                            </x-dropdown-link>

                            @if (Route::has('register'))
                                <x-dropdown-link :href="route('register')">
                                    {{ __('Register') }}
                                </x-dropdown-link>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>


        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Product') }}
                </h2>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{-- bootsrap --}}
                            <div class="raw col-lg-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Search Product"
                                                aria-label="Search Product" aria-describedby="button-addon2"
                                                id="searchInput">
                                            <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                                                onclick="searchProduct()">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="raw col-lg-12">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-md-3 mb-3 product-card">
                                            <div class="card" style="width: 18rem;">
                                                <img src="{{ asset($product->image) }}" class="card-img-top"
                                                    alt="{{ $product->name }}">
                                                <div class="card-body">
                                                    <h5 class="card-title"><strong>{{ $product->name }}</strong>
                                                    </h5>
                                                    <p class="card-text">
                                                        {{ Str::limit($product->description, 50) }}
                                                        <a href="{{ route('admin.product.show', $product->id) }}"
                                                            class="text-primary">read more...</a>
                                                    </p>
                                                    <p class="card-text">Price: {{ $product->sale_price }}
                                                        <strike>{{ $product->price }}</strike>
                                                    </p>
                                                    <p class="card-text">Quantity: {{ $product->quantity }}</p>
                                                    <p class="card-text">Category: {{ $product->category->name }}
                                                    </p>
                                                </div>
                                                <div class="card-footer d-flex flex-column align-items-start">
                                                    <a href="{{ route('login') }}"
                                                        class="btn btn-secondary mb-2">
                                                        See Product
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-3">
                                {{ $products->links() }}
                            </div>

                            <script>
                                function searchProduct() {
                                    let searchInput = document.getElementById('searchInput').value.toLowerCase();
                                    let productCards = document.getElementsByClassName('product-card');

                                    for (let i = 0; i < productCards.length; i++) {
                                        let productName = productCards[i].getElementsByTagName('h5')[0].textContent.toLowerCase();
                                        let productDescription = productCards[i].getElementsByTagName('p')[0].textContent.toLowerCase();

                                        if (productName.includes(searchInput) || productDescription.includes(searchInput)) {
                                            productCards[i].style.display = 'block';
                                        } else {
                                            productCards[i].style.display = 'none';
                                        }
                                    }
                                }
                            </script>

                            {{-- end bootsrap --}}
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    {{-- js bootsrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
