<?php

namespace App\Http\Controllers;

use App\product;
use Illuminate\Http\Request;

class frontController extends Controller
{
    //
    public function index(){
        return view('index',['products'=>product::paginate(6)]);
    }

    public function singleProduct($id){
        return view('single',['product'=>product::find($id)]);
    }
}
