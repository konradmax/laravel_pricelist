<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pricelist') }}
        </h2>
    </x-slot>
    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> There were problems with your input.<br><br>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">Add new price</h2>

                    <form action="{{ route('products.storeprice') }}" method="POST">
                        @csrf
                        @method('POST')
                        <select name="sku" class="form-control mb-2" >
                            <option hidden value="">Select product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->sku }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="price" class="form-control mb-2" placeholder="Price">

                        <x-button>create</x-button>
                    </form>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">Delete prices</h2>

                    <table class="w-full">

                        <td class="border" style="text-align: center">ID</td>
                        <td class="border p-2">SKU</td>
                        <td class="border p-2">PRICE</td>

                        @foreach($data as $price)
                            <tr>
                                <td class="border" style="text-align: center">{{$price->id}}</td>
                                <td class="border p-2">{{$price->sku}}</td>
                                <td class="border p-2">{{$price->price . ' PLN'}}</td>
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
