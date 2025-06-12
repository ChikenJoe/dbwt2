<?php

namespace App\Http\Controllers;

use App\Models\ab_shoppingcart;
use App\Models\ab_shoppingcart_item;
use Illuminate\Http\Request;

class ApiShoppingCart extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* -- Laravel automatically parses incoming JSON requests -- */

        //  Extract data from request
        $articleId = $request->input('articleId');

        //  Create attributes
        $createDate = now();

        $shoppingCart = ab_shoppingcart::find(1);
        if (!$shoppingCart) {
            $shoppingCart = ab_shoppingcart::create(['id'    => 1,
                'ab_creator_id'  => 1,
                'ab_createdate'  => $createDate]);
        }



        $shoppingCartItem = new ab_shoppingcart_item();
        $lastShoppingCartItemId = (ab_shoppingcart_item::max('id')+1) ?? 0;

        $shoppingCartItem->id = $lastShoppingCartItemId;
        $shoppingCartItem->ab_shoppingcart_id = $shoppingCart->id;
        $shoppingCartItem->ab_article_id = $articleId;
        $shoppingCartItem->ab_createdate = $createDate;
        $shoppingCartItem->save();

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ab_shoppingcart $ab_shoppingcart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ab_shoppingcart $ab_shoppingcart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($shoppingcartId, $articleId)
    {
       //
        ab_shoppingcart_item::where('ab_article_id', $articleId)
            ->where('ab_shoppingcart_id', $shoppingcartId)->delete();
    }
}
