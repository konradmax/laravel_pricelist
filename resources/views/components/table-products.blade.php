<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="py-2">
            <x-form-filter :filterCategory="$filterCategory" :categories="$categories" :sortBy="$sortBy" :sortDir="$sortDir" />
        </div>
        <table class="w-full">

            <td class="border" style="text-align: center">ID</td>
            <td class="border p-2">
                <span>SKU</span>
                <span style="float: right">
                        <a href="/products?page=1&sort_by=sku&sort_dir=asc&filter[category_id]={{ $filterCategory }}">
                            <i class="fa fa-arrow-up px-1"></i>
                        </a>
                        <a href="/products?page=1&sort_by=sku&sort_dir=desc&filter[category_id]={{ $filterCategory }}">
                            <i class="fa fa-arrow-down"></i>
                        </a>
                    </span>
            </td>
            <td class="border p-2">
                <span>NAME</span>
                <span style="float: right">
                        <a href="/products?page=1&sort_by=product_name&sort_dir=asc&filter[category_id]={{ $filterCategory }}">
                            <i class="fa fa-arrow-up px-1"></i>
                        </a>
                        <a href="/products?page=1&sort_by=product_name&sort_dir=desc&filter[category_id]={{ $filterCategory }}">
                            <i class="fa fa-arrow-down"></i>
                        </a>
                    </span>
            </td>
            <td class="border p-2">
                <span>PRICE</span>
                <span style="float: right">
                        <a href="/products?page=1&sort_by=price&sort_dir=asc&filter[category_id]={{ $filterCategory }}">
                            <i class="fa fa-arrow-up px-1"></i>
                        </a>
                        <a href="/products?page=1&sort_by=price&sort_dir=desc&filter[category_id]={{ $filterCategory }}">
                            <i class="fa fa-arrow-down"></i>
                        </a>
                    </span>
            </td>
            <td class="border p-2">
                <span>CATEGORY</span>
                <span style="float: right">
                        <a href="/products?page=1&sort_by=category_name&sort_dir=asc&filter[category_id]={{ $filterCategory }}">
                            <i class="fa fa-arrow-up px-1"></i>
                        </a>
                        <a href="/products?page=1&sort_by=category_name&sort_dir=desc&filter[category_id]={{ $filterCategory }}">
                            <i class="fa fa-arrow-down"></i>
                        </a>
                    </span>
            </td>


        @foreach($data as $product)
                <tr>
                    <td class="border" style="text-align: center">{{$product->id}}</td>
                    <td class="border p-2">{{$product->sku}}</td>
                    <td class="border p-2">{{$product->product_name}}</td>
                    <td class="border p-2">{{$product->price . ' PLN'}}</td>
                    <td class="border p-2">{{$product->category_name}}</td>

                    <td>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-button style="float: right">Delete</x-button>
                        </form>
                        <a class="px-1" style="line-height: 2" href="{{ route('products.show', $product->id) }}">Show</a>/
                        <a class="px-1" href="{{ route('products.edit', $product->id) }}">Edit</a>

                    </td>
                </tr>
            @endforeach

        </table>

    </div>
</div>
