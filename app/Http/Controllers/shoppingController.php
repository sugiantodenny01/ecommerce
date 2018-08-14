<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Support\Facades\Session;
use App\product;
use Illuminate\Http\Request;


class shoppingController extends Controller
{
    public function add_to_cart()
    {
        $pdt = product::find(request()->prdct_id);

        $cartItem = Cart::add([
            'id' => $pdt->id,
            'name' => $pdt->name,
            'qty' => \request()->qty,
            'price' => $pdt->price
        ]);

        Cart::associate($cartItem->rowId, 'App\product');

        Session::flash('success', 'Purchase Successful. Wait for our email');

//        dd(Cart::content());
        return redirect()->route('cart');

    }


    public function rapid_add($id)
    {

        $pdt = product::find($id);

        $cartItem = Cart::add([
            'id' => $pdt->id,
            'name' => $pdt->name,
            'qty' => 1,
            'price' => $pdt->price
        ]);
        Cart::associate($cartItem->rowId, 'App\product');

        Session::flash('success', 'Product added to cart');

//        dd(Cart::content());
        return redirect()->route('cart');
    }

    public function cart()
    {
//        Cart::destroy();
        return view('cart');
    }

    public function cart_delete($id)
    {
//
        Cart::remove($id);
        Session::flash('success', 'Product Remove From Cart');
        return redirect()->back();
    }

    public function increment($id, $qty)
    {

        Cart::update($id, $qty + 1);
        Session::flash('success', 'Product Quantity Updated');
        return redirect()->back();
    }

    public function decrement($id, $qty)
    {

        Cart::update($id, $qty - 1);
        Session::flash('success', 'Product Quantity Updated');
        return redirect()->back();
    }


}
