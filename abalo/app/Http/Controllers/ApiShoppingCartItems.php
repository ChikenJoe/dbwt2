<?php

namespace App\Http\Controllers;

use App\Models\ab_shoppingcart_item;
use Illuminate\Http\Request;

class ApiShoppingCartItems extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Fetch all records from shoppingcart 1
        $results = ab_shoppingcart_item::where('ab_shoppingcart_id', 1)->get();
        return response()->json($results);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
