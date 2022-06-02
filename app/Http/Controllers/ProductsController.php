<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        $products = Product::latest()->paginate(5);

        $data = Product::join('prices', 'products.sku', '=', 'prices.sku')
            ->paginate(5, ['products.name', 'prices.price', 'products.id', 'products.desc', 'products.sku']);

        return view('products.index', compact('products','data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
           'sku' => 'required',
           'price' => 'required',
        ]);

        Product::create($request->only(['name', 'sku', 'desc']));
        Price::create($request->only(['sku', 'price']));

        return redirect()->route('products.index')
            ->with('success', 'product created successfully');
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

    public function filter(Product $product, Price $price, Request $request)
    {
        $data = Product::where('name', $request->name);

        return view('products.index', compact('products','data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
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
        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success','Product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success','Product Deleted');
    }
}
