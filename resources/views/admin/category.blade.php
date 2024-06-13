<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- bootsrap --}}
                    <div class="row">
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search Category"
                                    aria-label="Search Category" aria-describedby="button-addon2" id="searchInput">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                                    onclick="searchCategories()">Search</button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a href="/admin/category/create" class="btn btn-primary float-right">Add Category</a>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif


                    <div class="row">
                        @foreach ($categories->chunk(3) as $chunkOfCategories)
                            @foreach ($chunkOfCategories as $category)
                                <div class="col-md-3 mb-3 category-card" style="display: block;">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><strong>{{ $category->name }}</strong></h5>
                                            <p class="card-text">{{ $category->description }}</p>
                                        </div>
                                        <div class="card-footer d-flex flex-column align-items-start">
                                            <a href="{{ route('admin.category.show', $category->id) }}" class="btn btn-primary mb-2">See Products</a>
                                            <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-secondary mb-2">Update Category</a>
                                            <form action="{{ route('admin.category.destroy', $category->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mb-2"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus
                                                    Kategori</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>

                    <div class="mt-3">
                        {{ $categories->links() }}
                    </div>

                    <script>
                        function searchCategories() {
                            let searchInput = document.getElementById('searchInput').value.toLowerCase();
                            let categoryCards = document.getElementsByClassName('category-card');

                            for (let i = 0; i < categoryCards.length; i++) {
                                let categoryName = categoryCards[i].getElementsByTagName('h5')[0].textContent.toLowerCase();
                                let categoryDescription = categoryCards[i].getElementsByTagName('p')[0].textContent.toLowerCase();

                                if (categoryName.includes(searchInput) || categoryDescription.includes(searchInput)) {
                                    categoryCards[i].style.display = 'block';
                                } else {
                                    categoryCards[i].style.display = 'none';
                                }
                            }
                        }
                    </script>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
