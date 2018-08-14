<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Cart;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;

class checkOutController extends Controller
{
    //
    public function index(){

        if (Cart::content()->count() == 0){
            Session::flash('info','Your Cart is Still Empty');
            return redirect()->back();
        }
        return view('checkout');
    }

    public function pay(){
//        dd(\request()->all());

       Stripe::setApiKey("sk_test_X2qZiXTTQm7uzg0CvQpKl9cn");

       $token=\request()->stripeToken;

       $charge= Charge::create([
           "amount" => Cart::total()*100,
           "currency" => "usd",
           "description" => "Book Store",
           "source" => $token,
       ]);

      Session::flash('success', 'Purchase Successful. Wait for our email');

      Cart::destroy();

      Mail::to(\request()->stripeEmail)->send(new \App\Mail\PurchaseSuccessful());

      return redirect('/');
    }
}
