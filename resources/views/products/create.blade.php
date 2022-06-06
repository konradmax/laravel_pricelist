<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <strong>Error!</strong> There were problems with your input.<br><br>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   <form action="{{ route('products.store') }}" method="POST">
                       @csrf
                       @method('POST')
                    <input type="text" name="name" class="form-control mb-2" placeholder="name">
                    <input type="text" name="price" class="form-control mb-2" placeholder="price">
                    <input type="text" name="sku" class="form-control mb-2" placeholder="sku">
                    <input type="text" name="desc" class="form-control mb-2" placeholder="description">
                   <select name="category_id">
                   @foreach($categories as $category)
                           <option value="{{ $category->category_id }}">{{ $category->name }}</option>                   @endforeach
                   </select>
                       <x-button>create</x-button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
