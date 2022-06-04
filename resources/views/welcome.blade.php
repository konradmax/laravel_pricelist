<x-guest-layout>
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
                            <td class="border p-2"><b>CATEGORY</b></td>

                            @foreach($data as $product)
                                <tr>
                                    <td class="border" style="text-align: center">{{$product->id}}</td>
                                    <td class="border" style="text-align: center">{{$product->sku}}</td>
                                    <td class="border p-2">{{$product->name}}</td>
                                    <td class="border p-2">{{$product->price}}</td>
                                    <td class="border p-2">{{$product->category_name}}</td>
                                </tr>
                            @endforeach

                        </table>

                    </div>
                </div>

                <div class="py-2">{{ $data->links() }}</div>
            </div>
        </div>
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
    @endif
    </x-guest-layout>
