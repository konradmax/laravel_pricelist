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

                        <div class="pt-2">Edit Name</div>
                        <input type="text" name="name" class="form-control" value="{{$product->name}}" placeholder="name">
                        <div class="pt-2">Edit Description</div>
                        <input type="text" name="desc" class="form-control mb-2" value="{{$product->desc}}" placeholder="description">

                        <x-button>submit</x-button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
