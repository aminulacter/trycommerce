<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use App\Jobs\UpdateCoupon;
//use Gloudemans\Shoppingcart\Facades\Cart;

class CouponsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        if (!$coupon) {
            return redirect()->route('checkout.index')->withErrors('Invalid Cupon Code, Please try again');
        }
        dispatch_now(new UpdateCoupon($coupon));
        return redirect()->route('checkout.index')->with('success_message', 'Coupon has been applied!');
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
    public function destroy()
    {
        session()->forget('coupon');
        return redirect()->route('checkout.index')->with('success_message', 'Coupon has been removed.');
    }
}
