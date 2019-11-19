<?php

namespace App\Http\Controllers\Api;

use App\CartItem;
use App\Http\Controllers\Controller;
use App\VariationValue;
use Illuminate\Http\Request;

class CartItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->fresh();

        // dd($user->cartItems);

        $cartItems = $user->cartItems;

        return response()->json(compact('cartItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer'
        ]);

        $cartItem = CartItem::create([
            'menu_item_id' => $request->menu_item_id,
            'quantity' => $request->quantity,
            'user_id' => auth()->id()
        ]);

        if ($request->variations) {
            foreach ($request->variations as $variation) {
                $cartItem->variationValues()->create([
                    'cart_item_id' => $cartItem->id,
                    'variation_id' => $variation['variation_id'],
                    'option_id' => $variation['variation_option']
                ]);
            }
            $cartItem = CartItem::find($cartItem->id);
        }
        return response()->json(compact('cartItem'), 200, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CartItem $cartItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartItem $cartItem)
    {
        //
    }
}
