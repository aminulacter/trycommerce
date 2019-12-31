<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::inRAndomOrder()->take(8)->get();
        $products = Product::where('featured', true)->inRAndomOrder()->take(8)->get();

        return view('landing-page')->with('products', $products);
    }
}
