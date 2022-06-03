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

                        @foreach($data as $products)
                        <input type="text" name="price" class="form-control" value="{{$products->price}}" placeholder="price">
                        @endforeach
                        <x-button>submit</x-button>

                    </form>

                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('products.storeprice') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="text" name="price" class="form-control" placeholder="price">
                        <input type="text" name="sku" class="form-control" placeholder="{{ $product->sku }}">
                        <x-button>create</x-button>
                    </form>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
