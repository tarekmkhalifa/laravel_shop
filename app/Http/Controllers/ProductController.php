<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->where('status', 1);
        return view('shop.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::where('status', 1)->findOrFail($id);
        return view('shop.show', compact('product'));
    }


    // Dashboard Crud Operations

    public function dashboard()
    {
        return view('dashboard.index');
    }
    public function showAllProducts()
    {
        $products = Product::all();
        return view('dashboard.products.all', compact('products'));
    }
    public function showActiveProducts()
    {
        $products = Product::all()->where('status', 1);
        return view('dashboard.products.active', compact('products'));
    }

    public function showDeactivatedProducts()
    {
        $products = Product::all()->where('status', 2);
        return view('dashboard.products.deactivated', compact('products'));
    }

    public function showDeletedProducts()
    {
        $products = Product::all()->where('status', 3);
        return view('dashboard.products.deleted', compact('products'));
    }

    public function addNewProduct()
    {
        return view('dashboard.products.create');
    }

    public function showEditProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.products.edit', compact('product'));
    }

    public function softDeleteProduct($id)
    {
        $product = product::find($id);
        $product->status = 3;
        $product->save();
        return redirect()->back();
    }


    public function restoreProduct($id)
    {
        $product = product::find($id);
        $product->status = 1;
        $product->save();
        return redirect()->back();
    }

    public function deleteProductCompletely($id)
    {
        $product = Product::find($id)->delete();
        return redirect()->back();
    }

    public function insertNewProduct(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required|string|unique:products,name',
            'details' => 'required|string',
            'price' => 'required|numeric',
            'shipping_cost' => 'required|numeric',
            'brand' => 'required|string',
            'status' => 'required|integer|min:1|max:2',
            'description' => 'required|string',
            'image' => 'required|mimes:png,jpg,jpeg|max:1000'
        ]);

        $photoName = $request->file('image')->getClientOriginalName();
        $photoExt = $request->file('image')->getClientOriginalExtension();
        $photoName = 'product' . $photoName . '.' . $photoExt;

        $request->file('image')->storeAs('public/', $photoName);
        $product = new Product;
        $product->name = $request->name;
        $product->details = $request->details;
        $product->price = $request->price;
        $product->shipping_cost = $request->shipping_cost;
        $product->brand = $request->brand;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->image_path = 'storage/' . $photoName;
        $product->save();


        if ($request->has('add')) {
            return redirect()->route('all.products')->with('success','Product has beed added successfulyy');

        }elseif($request->has('add&new')) {
            return redirect()->back()->with('success', 'The Product Has Been Inserted Successfully');
        }
    }



    public function updateProduct(Request $request,$id){

        // validate
        $request->validate([
            'name' => 'required|string|unique:products,name,'.$id,
            'details' => 'required|string',
            'price' => 'required|numeric',
            'shipping_cost' => 'required|numeric',
            'brand' => 'required|string',
            'status' => 'required|integer|min:1|max:3',
            'description' => 'required|string',
        ]);
        $product = Product::find($id);
        if($request->has('image')){
            $request->validate([
                'image' => 'required|mimes:png,jpg,jpeg|max:1000'
            ]);
            $photoName = $request->file('image')->getClientOriginalName();
            $photoExt = $request->file('image')->getClientOriginalExtension();
            $photoName = 'product' . $photoName . '.' . $photoExt;
            $request->file('image')->storeAs('public/', $photoName);
            $product->image_path = 'storage/' . $photoName;
        }

        $product->name = $request->name;
        $product->details = $request->details;
        $product->price = $request->price;
        $product->shipping_cost = $request->shipping_cost;
        $product->brand = $request->brand;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->save();

        return redirect()->route('all.products')->with('success','Product has beed updated successfulyy');

    }

}

