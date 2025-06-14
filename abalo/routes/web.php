<?php

use App\Events\ArticleOfferedEvent;
use App\Events\ArticleSoldEvent;
use App\Events\MaintenanceEvent;
use App\Http\Controllers\AbTestDataController;
use App\Models\ab_articles;
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


//send alert http://127.0.0.1:8000/broadcast-maintenance
Route::get('/broadcast-maintenance', function () {
    broadcast(new MaintenanceEvent());
    return 'Maintenance-Event wurde gesendet.';
});

Route::post('/articles/{id}/offer', function ($id) {
    // jetzt kannst du findOrFail nutzen:
    $article = ab_articles::findOrFail($id);

    broadcast(new ArticleOfferedEvent(
        $article->id,
        $article->ab_name
    ));

    return ['status' => 'ok'];
});

//send alert http://127.0.0.1:8000/test-sold
Route::get('/test-sold', function () {
    // simuliert: userId = 1, Artikelname = "Test"
    broadcast(new ArticleSoldEvent(1, 'Test'));
    return 'Event an user.1 geschickt';
});
