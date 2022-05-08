<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(){
        // dd(session('cartItems'));
        return view('cart.cart');
    }

    public function addToCart($id)
    {
        // session()->flush();

        $product = Product::findOrFail($id);
        $cartItems = session()->get('cartItems', []);

        if(isset($cartItems[$id])){
            $cartItems[$id]['quantity']++;
        }else {
            $cartItems[$id] = [
                "image_path" => $product->image_path,
                "name" => $product->name ,
                "details" => $product->details ,
                "brand" => $product->brand,
                "price" => $product->price ,
                "quantity" => 1
            ];
        }

        session()->put('cartItems', $cartItems);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function deleteFromCart(Request $request){

        if($request->id){
            $cartItems = session()->get('cartItems');

            if(isset($cartItems[$request->id])){
                unset($cartItems[$request->id]);
                session()->put('cartItems',$cartItems);
            }

            return redirect()->back()->with('success', 'Product deleted from your cart');
        }

    }

    public function updateCartQuantity(Request $request)
    {
        if($request->id && $request->quantity){
            $cartItems = session()->get('cartItems');
            $cartItems[$request->id]["quantity"] = $request->quantity;
            session()->put('cartItems', $cartItems);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

}
