<?php

use App\Events\ArticleOfferedEvent;
use App\Events\ArticleSoldEvent;
use App\Http\Controllers\ApiArticles;
use App\Http\Controllers\ApiShoppingCart;
use App\Http\Controllers\ApiShoppingCartItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::get('/articles', [ApiArticles::class, 'articlesearchbox']);
Route::get('/articles', [ApiArticles::class, 'articles']);
Route::post('/articles', [ApiArticles::class, 'store']);
Route::delete('/articles/{id}', [ApiArticles::class, 'destroy']);

Route::get('/shoppingcart', [ApiShoppingCart::class, 'index']);
Route::post('/shoppingcart', [ApiShoppingCart::class, 'store']);
Route::delete('/shoppingcart/{shoppingcartid}/articles/{articleId}', [ApiShoppingCart::class, 'destroy']);

Route::get('/shoppingcartitems', [ApiShoppingCartItems::class, 'index']);


