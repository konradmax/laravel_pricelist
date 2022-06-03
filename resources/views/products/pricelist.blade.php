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
                    <form action="{{ route('products.storeprice') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="text" name="price" class="form-control" placeholder="price">
                        <input type="text" name="sku" class="form-control" placeholder="SKU">
                        <x-button>create</x-button>
                    </form>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="w-full">

                        <td class="border" style="text-align: center"><b>ID</b></td>
                        <td class="border" style="text-align: center"><b>SKU</b></td>
                        <td class="border p-2"><b>PRICE</b><span style="float: right; cursor: pointer"><i class="fa fa-arrow-up px-1"></i><i class="fa fa-arrow-down text-gray-400 "></i></span></td>

                        @foreach($data as $price)
                            <tr>
                                <td class="border" style="text-align: center">{{$price->id}}</td>
                                <td class="border" style="text-align: center">{{$price->sku}}</td>
                                <td class="border p-2">{{$price->price}}</td>
                                <td>
                                    <form action="{{ route('products.destroyprice', $price->id) }}" method="POST">                                        @csrf
                                        @method('DELETE')
                                        <x-button style="float: right">Delete</x-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
