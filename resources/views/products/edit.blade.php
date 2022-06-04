<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit: '. $product->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('products.update',$product->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="text" name="name" class="form-control" value="{{$product->name}}" placeholder="name">

                        @foreach($data as $prices)
                        <input type="text" name="{{$prices->id}}" class="form-control" value="{{$prices->price}}" placeholder="price">
                        @endforeach
                        <x-button>submit</x-button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
