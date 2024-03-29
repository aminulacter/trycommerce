<?php

 function presentPrice($price)
 {
     return ('$' . number_format($price / 100, 2, ".", ","));
 }

 function setActiveCategory($slug)
 {
     return request()->category == $slug ? 'active' : '';
 }

 function productImage($path)
 {
     return  $path && file_exists('storage/'.$path) ?  asset('storage/'.$path) : asset('img/not-found.jpg');
 }

 function getNumbers()
 {
     $tax = config('cart.tax') / 100;
     $discount = session()->get('coupon')['discount'] ?? 0;
     $code = session()->get('coupon')['name'] ?? null;
     $newSubtotal = (Cart::subtotal() - $discount);
     if ($newSubtotal < 0) {
         $newSubtotal = 0;
     }
     $newTax = $newSubtotal * $tax;
     $newTotal = $newSubtotal * (1 + $tax);
     return collect([
        'tax' => $tax,
        'discount' => $discount,
        'code' => $code,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
    ]);
 }

function getStockLevel($quantity)
{
    $checkValue =  setting('site.stock_threshold')? : 5;
    // dd($quantity);
    if ($quantity > $checkValue) {
        $stockLevel = '<div class="badge badge-success">In Stock</div>';
    } elseif ($quantity <= $checkValue && $quantity > 0) {
        $stockLevel = '<div class="badge badge-warning">Low Stock</div>';
    } else {
        $stockLevel = '<div class="badge badge-danger">Not available</div>';
    }
    //dd(setting('site.stock_threshold'));
    return $stockLevel;
}
