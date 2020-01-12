<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 9;
        $categories = Category::all();

        if (request()->category) {
            $products = Category::where('slug', request()->category)->first()->products();
            $categoryName = optional(Category::where('slug', request()->category)->first())->name;

            if (request()->sort == 'low_high') {
                $products = $products->orderBy('price')->paginate($pagination);
            } elseif (request()->sort == 'high_low') {
                //dd(Category::where('slug', request()->category)->first()->products()->orderBy('price', 'desc'));
                $products = $products->orderBy('price', 'desc')->paginate($pagination);
            } else {
                $products = $products->paginate($pagination);
            }

            // $products = Product::with('categories')->whereHas('categories', function ($query) {
            //     $query->where('slug', request()->category);
            // })->get();
            // $products = Category::where('slug', request()->category)->first()->products()->paginate($pagination);
        } else {
            $categoryName ="Featured";
            $products = Product::where('featured', true)->paginate($pagination);
        }

        return view('shop')->with([
            'products'=> $products,
            'categories' => $categories,
            'categoryName' => $categoryName
        ]);
    }



    public function search()
    {
        $request->validate([
        'query' => 'required|min:3'
        ]);
        $query = $request->input('query');
        // $products = Product::where('name', 'like', '%$query%')
        //                     ->orWhere('details', 'like', '%$query%')
        //                     ->orWhere('description', 'like', '%$query%')
        //                     ->paginate(10);

        $products = Product::search($query)->paginate(10);
        return view('search-results', compact('products'));
    }

    public function searchAlgolia(Request $request)
    {
        return view('search-results-algolia');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $mightAlsoLike = Product::where('slug', '!=', $slug)->mightAlsoLike()->get();
        $stockLevel = getStockLevel($product->quantity);

        return view('product')->with(
            [
                'product' => $product,
                'stockLevel' => $stockLevel,
                'mightAlsoLike' => $mightAlsoLike
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
