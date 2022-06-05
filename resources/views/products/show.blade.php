<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($product->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Prices:</h2>
                    @foreach($data as $price)
                        <tr>
                            <td class="border" style="text-align: center">{{$price->price . ' PLN'}}</td></br>
                        </tr>
                    @endforeach
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Description:</h2>
                        @foreach($description as $desc)
                            <tr>
                                <td class="border" style="text-align: center">{{$desc->desc}}</td></br>
                            </tr>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
