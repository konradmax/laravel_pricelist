<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   <div class="py-2">
                       <form action="{{ route('products.filter') }}" method="POST">
                           @csrf
                           @method('POST')
                           <select name="filter[category_id]">
                               <option value="all">All</option>
                               @foreach($categories as $category)
                                   <option value="{{ $category->id }}">{{ $category->name }}</option>
                               @endforeach
                           </select>

                           <x-button>Filter</x-button>
                       </form>
                   </div>
                    <table class="w-full">

                        <td class="border" style="text-align: center"><b>ID</b></td>
                        <td class="border" style="text-align: center"><b>SKU</b></td>
                        <td class="border p-2"><b>NAME</b><span wire:click="sortBy('name')" style="float: right; cursor: pointer"><i class="fa fa-arrow-up px-1"></i><i class="fa fa-arrow-down text-gray-400 "></i></span> </td>
                        <td class="border p-2"><b>PRICE</b><span style="float: right; cursor: pointer"><i class="fa fa-arrow-up px-1"></i><i class="fa fa-arrow-down text-gray-400 "></i></span></td>

                        @foreach($data as $product)
                            <tr>
                                <td class="border" style="text-align: center">{{$product->id}}</td>
                                <td class="border" style="text-align: center">{{$product->sku}}</td>
                                <td class="border p-2">{{$product->name}}</td>
                                <td class="border p-2">{{$product->price}}</td>
                                <td class="border p-2">{{$product->category_name}}</td>

                                <td>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        <a class="px-1" style="line-height: 2" href="{{ route('products.show', $product->id) }}">Show</a>/
                                        <a class="px-1" href="{{ route('products.edit', $product->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <x-button style="float: right">Delete</x-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </table>

                </div>
            </div>

            <div class="py-2">{{ $data->links() }}</div>
        </div>
    </div>

</x-app-layout>



