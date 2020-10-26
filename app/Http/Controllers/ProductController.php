<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validData = $this->validate($request, [
            'name' => 'required',
            'description' => 'required|min:10',
            'price' => 'required',
        ]);
        $validData['price'] *= 100;

        if ($file = $request->file('image')) {
            $path = $file->store('products');
            $validData['image_path'] = $path;
            $validData['image_name'] = $file->getClientOriginalName();
        }

        return ['product' => Product::create($validData)];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return [
            'product' => $product,
            'imagePath' => $product->image_path ? Storage::url($product->image_path) : null,
            'isRegistered' => auth()->user()->registered($product),
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validData = $this->validate($request, [
            'name' => 'required',
            'description' => 'required|min:10',
            'price' => 'required',
        ]);
        $validData['price'] *= 100;

        if ($request->input('remove_image') == 'true') {
            $validData['image_path'] = null;
            $validData['image_name'] = null;
        } elseif ($file = $request->file('image')) {
            $path = $file->store('products');
            $validData['image_path'] = $path;
            $validData['image_name'] = $file->getClientOriginalName();
        }

        $product->update($validData);

        return ['product' => $product];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return true;
    }
}
