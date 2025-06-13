<?php

use App\Http\Controllers\AbTestDataController;
use Illuminate\Support\Facades\Route;
use App\Events\MessageEvent;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/testdata', [AbTestDataController::class, 'getTestData']);

//AUTH
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/isloggedin', [App\Http\Controllers\AuthController::class, 'isloggedin'])->name('haslogin');

//
Route::get('/articles', [AbTestDataController::class, 'getArticleData']);
Route::post('/articles', [AbTestDataController::class, 'store']);
Route::get('/newarticle', [AbTestDataController::class, 'newArticle']);

//js views
Route::get('/a5', function(){ return view('M2_A5');});

Route::get('/test', function(){ return view('testview');});

Route::get('/newsite', [AbTestDataController::class, 'getArticleData2'] );
//Route::get('createUsers', [AbTestDataController::class, 'generateUsers']);
//user sollen noch nicht generiert werden, so wie ich es verstanden habe


//send msg http://127.0.0.1:8000/send/Hallo
//Route::get('/send/{msg}', function (string $msg) {
//    broadcast(new MessageEvent($msg));
//    return "Broadcasted: {$msg}";
//});
Route::get('/send/{message}/{id}', function (string $message, string $id) {
    broadcast(new MessageEvent($message, $id));
    return "Sent: {$message} (ID: {$id})";
});
