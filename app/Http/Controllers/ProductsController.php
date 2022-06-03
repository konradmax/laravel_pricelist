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
    public function index()
    {
        $data = Product::join('prices', 'products.sku', '=', 'prices.sku')
            ->join('categories', 'products.category_id', '=', 'categories.category_id')
            ->paginate(5, ['products.name', 'prices.price', 'products.id', 'products.desc', 'products.sku', 'categories.name AS category_name', 'categories.category_id AS category_id']);


        $categories = Category::all();

        return view('products.index', compact('data', 'categories'));
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
           'price' => 'required',
        ]);

        Product::create($request->only(['name', 'sku', 'desc','category_id']));
        Price::create($request->only(['sku', 'price']));

        return redirect()->route('products.index')
            ->with('success', 'product created successfully');
    }

    public function storeprice(Request $request)
    {
        $request->validate([
            'sku' => 'required',
            'price' => 'required',
        ]);

        Price::create($request->only(['sku', 'price']));

        return redirect()->route('products.pricelist')
            ->with('success', 'price created successfully');
    }

    public function pricelist()
    {
        $products = Product::all();
        $data = Price::all();

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
    public function update(Request $request, Product $product, Price $price)
    {
        $request->validate([

        ]);
        $product->update($request->only('name'));
        $price->where('sku', $product->sku)->update($request->only('price'));

        return redirect()->route('products.index')
            ->with('success','Product updated');
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
            ->with('success','Product Deleted');
    }

    public function destroyprice($priceId, Price $price)
    {
        $price->destroy($priceId);

        return redirect()->route('products.pricelist')
            ->with('success','Price Deleted');
    }



    public function filter(Request $request)
    {
        $categoryId = $request->filter['category_id'];
        if($categoryId === 'all') {
            $data = Product::join('prices', 'products.sku', '=', 'prices.sku')
                ->join('categories', 'products.category_id', '=', 'categories.category_id')
                ->paginate(5, ['products.name', 'prices.price', 'products.id', 'products.desc', 'products.sku', 'categories.name AS category_name', 'categories.category_id AS category_id']);

        } else {
            // category is selected
            $data = Product::where('products.category_id', $categoryId)
                ->join('prices', 'products.sku', '=', 'prices.sku')
                ->join('categories', 'products.category_id', '=', 'categories.category_id')
                ->paginate(5, ['products.name', 'prices.price', 'products.id', 'products.desc', 'products.sku', 'categories.name AS category_name', 'categories.category_id AS category_id']);

        }
        $categories = Category::all();

        return view('products.filter', compact('data', 'categories'));
    }
}


