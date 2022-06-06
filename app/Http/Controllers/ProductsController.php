<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Price;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $sortBy = $request->input('sort_by','name');
        $sortDir = $request->input('sort_dir','asc');

        $filterInput = $request->input('filter',['category_id'=>'all']);

        $filterCategory = $filterInput['category_id'];

        switch($sortBy) {
            case 'price':
                $sortByCol = "prices." . $sortBy;
                break;
            case 'product_name':
                $sortByCol = "products.name";
                break;
            case 'category_name':
                $sortByCol = "categories.name";
                break;
            default:
                $sortByCol = "products." . $sortBy;
        }

        if($filterCategory !== 'all') {
            $data = Product::select([
                'products.name as product_name',
                'prices.price',
                'products.id',
                'products.desc',
                'products.sku',
                'categories.name AS category_name',
                'categories.category_id AS category_id'
            ])
                ->join('prices', 'products.sku', '=', 'prices.sku')
                ->join('categories', 'products.category_id', '=', 'categories.category_id')
                ->orderBy($sortByCol, $sortDir)
                ->where('categories.category_id', $filterCategory)
                ->paginate(
                    100,
                    [
                        'products.name as product_name',
                        'prices.price',
                        'products.id',
                        'products.desc',
                        'products.sku as product_sku',
                        'categories.name AS category_name',
                        'categories.category_id AS category_id'
                    ]
                );
        } else {
            $data = Product::select([
                'products.name as product_name',
                'prices.price',
                'products.id',
                'products.desc',
                'products.sku',
                'categories.name AS category_name',
                'categories.category_id AS category_id'
            ])
                ->join('prices', 'products.sku', '=', 'prices.sku')
                ->join('categories', 'products.category_id', '=', 'categories.category_id')
                ->orderBy($sortByCol, $sortDir)
                ->paginate(
                    100,
                    [
                        'products.name as product_name',
                        'prices.price',
                        'products.id',
                        'products.desc',
                        'products.sku as product_sku',
                        'categories.name AS category_name',
                        'categories.category_id AS category_id'
                    ]
                );
        }
        $categories = Category::all();

        return view('products.index',
            compact(
                'data',
                'categories',
                'filterCategory',
                'sortBy',
                'sortDir'
            )
        );
    }

    public function welcome()
    {
        $data = Product::join('prices', 'products.sku', '=', 'prices.sku')
            ->join('categories', 'products.category_id', '=', 'categories.category_id')
            ->paginate(5, ['products.name', 'prices.price', 'products.id', 'products.desc', 'products.sku', 'categories.name AS category_name', 'categories.category_id AS category_id']);


        $categories = Category::all();

        return view('welcome', compact('data', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('products.create',compact( 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products,sku',
            'price' => 'required|numeric',
        ]);

        Product::create($request->only(['name', 'sku', 'desc','category_id']));
        Price::create($request->only(['sku', 'price']));

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function storeprice(Request $request)
    {
        $request->validate([
            'sku' => 'required',
            'price' => 'required|numeric',
        ]);

        Price::create($request->only(['sku', 'price']));

        return redirect()->route('products.pricelist')
            ->with('success', 'price created successfully');
    }

    public function pricelist()
    {
        $products = Product::all();
        $data = Price::paginate(5);

        return view('products.pricelist', compact('data','products'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $data = Price::where('sku', $product->sku)->get();
        $description = Product::where('sku', $product->sku)->get('desc');

        return view('products.show', compact('product','data', 'description'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data = Price::where('sku', $product->sku)->get();
        $description = Product::where('sku', $product->sku)->get('desc');

        return view('products.edit', compact('product', 'data', 'description'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([

        ]);

        $product->update($request->only('name', 'desc'));


        return redirect()->route('products.index')
            ->with('success','Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Price $price)
    {
        $product->delete();
        $price->delete();

        return redirect()->route('products.index')
            ->with('success','Product deleted successfully.');
    }

    public function destroyprice($priceId, Price $price)
    {
        $price->destroy($priceId);

        return redirect()->route('products.pricelist')
            ->with('success','Price deleted successfully.');
    }



    public function filter(Request $request)
    {
        $categoryId = $request->filter['category_id'];
        $sortBy = $request->filter['sort_by'];
        $sortDir = $request->filter['sort_dir'];
        $filterInput = $request->input('filter');
        $filterCategory = $filterInput['category_id'];

        switch($sortBy) {
            case 'price':
                $sortByCol = "prices." . $sortBy;
                break;
            case 'product_name':
                $sortByCol = "products.name";
                break;
            case 'category_name':
                $sortByCol = "categories.name";
                break;
            default:
                $sortByCol = "products." . $sortBy;
        }

        $sortDir = $request->input('sort_dir','asc');
        if($categoryId === 'all') {
            $data = Product::select([
                'products.name as product_name',
                'prices.price',
                'products.id',
                'products.desc',
                'products.sku',
                'categories.name AS category_name',
                'categories.category_id AS category_id'
            ])
                ->join('prices', 'products.sku', '=', 'prices.sku')
                ->join('categories', 'products.category_id', '=', 'categories.category_id')
                ->orderBy($sortByCol,$sortDir)
                ->paginate(
                    100,
                    [
                        'products.name as product_name',
                        'prices.price',
                        'products.id',
                        'products.desc',
                        'products.sku as product_sku',
                        'categories.name AS category_name',
                        'categories.category_id AS category_id'
                    ]
                )
            ;
        } else {
            // category is selected
            $data = Product::select([
                'products.name as product_name',
                'prices.price',
                'products.id',
                'products.desc',
                'products.sku',
                'categories.name AS category_name',
                'categories.category_id AS category_id'
            ])
                ->join('prices', 'products.sku', '=', 'prices.sku')
                ->join('categories', 'products.category_id', '=', 'categories.category_id')
                ->where('products.category_id', $categoryId)
                ->orderBy($sortByCol,$sortDir)
                ->paginate(
                    100,
                    [
                        'products.name as product_name',
                        'prices.price',
                        'products.id',
                        'products.desc',
                        'products.sku as product_sku',
                        'categories.name AS category_name',
                        'categories.category_id AS category_id'
                    ]
                )
            ;
        }
        $categories = Category::all();

        return view('products.index',
            compact(
                'data',
                'categories',
                'filterCategory',
                'sortBy',
                'sortDir'
            )
        );
    }
}
