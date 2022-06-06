<x-guest-layout>
    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="shrink-0 flex items-center">
                <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
            </div>
        </div>
    </header>

    <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                            Please <a class="underline" href="{{ route('login') }}">log in</a> or <a class="underline" href="{{ route('register') }}">register</a> to sort, filter and update the pricelist!
                        </h2>
                        <table class="w-full">

                            <td class="border" style="text-align: center">ID</td>
                            <td class="border p-2">SKU</td>
                            <td class="border p-2">NAME</td>
                            <td class="border p-2">PRICE</td>
                            <td class="border p-2">CATEGORY</td>
                            <td class="border p-2">DESCRIPTION</td>

                            @foreach($data as $product)
                                <tr>
                                    <td class="border" style="text-align: center">{{$product->id}}</td>
                                    <td class="border p-2">{{$product->sku}}</td>
                                    <td class="border p-2">{{$product->name}}</td>
                                    <td class="border p-2">{{$product->price}}</td>
                                    <td class="border p-2">{{$product->category_name}}</td>
                                    <td class="border p-2">{{$product->desc}}</td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>

                <div class="py-2">{{ $data->links() }}</div>
            </div>
        </div>
    </x-guest-layout>
