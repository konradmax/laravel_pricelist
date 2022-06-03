<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   <form action="{{ route('products.store') }}" method="POST">
                       @csrf
                       @method('POST')
                    <input type="text" name="name" class="form-control" placeholder="name">
                    <input type="text" name="price" class="form-control" placeholder="price">
                    <input type="text" name="sku" class="form-control" placeholder="sku">
                    <input type="text" name="desc" class="form-control" placeholder="description">
                   <select name="category_id">
                       <option value="0">None</option>
                   @foreach($categories as $category)
                       <option value="{{ $category->id }}">{{ $category->name }}</option>
                   @endforeach
                   </select>
                       <x-button>create</x-button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
