<?php

namespace App\Http\Controllers;

use App\Models\ab_articles;
use App\Models\ab_shoppingcart;
use App\Models\ab_shoppingcart_item;
use App\Models\ab_testdata;
use App\Models\ab_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbTestDataController extends Controller
{
    public function getTestData(){
        $data = ab_testdata::all();

        //return as json ??
        return response()->json($data);
    }

    public function getArticleData(Request $request){
        $nameQuery = $request->get('search');
        $articles = collect();
        $shoppingcartitems = ab_shoppingcart_item::where('ab_shoppingcart_id', 1)->get();
        if (empty($nameQuery))
            $articles = ab_articles::with('image')->get();
        else
            $articles = ab_articles::with('image')->where('ab_name', 'ILIKE', '%' . $nameQuery . '%')->get();
        return view('start', [ 'articles' => $articles,
                                    'shoppingcartitems' => $shoppingcartitems]);
    }

    public function getArticleData2(Request $request){
        $nameQuery = $request->get('search');
        $articles = collect();
        $shoppingcartitems = ab_shoppingcart_item::where('ab_shoppingcart_id', 1)->get();
        if (empty($nameQuery))
            $articles = ab_articles::with('image')->get();
        else
            $articles = ab_articles::with('image')->where('ab_name', 'ILIKE', '%' . $nameQuery . '%')->get();
        return view('newsite', [ 'articles' => $articles,
            'shoppingcartitems' => $shoppingcartitems]);
    }

    public function generateUsers(){
        $anzahl_benutzer = 10000;
        $last_id = ab_user::max('id') ?? 0;

        for ($i = 0; $i < $anzahl_benutzer; $i++) {
            ab_user::create(['id' => $last_id + $i + 1,
                'ab_name' => 'Name_' . $last_id + $i + 1,
                'ab_password' => 'Password_' . $last_id + $i + 1,
                'ab_mail' => 'benutzer_' . $last_id + $i + 1 . '@abalo.example.com',]);
        }

        return response()->json(['message' => "$anzahl_benutzer Benutzer erfolgreich in die Datenbank eingefügt."]);
    }

    public function newArticle(Request $request){
        return view ('newarticle');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        try {
            $lastId = DB::table('ab_article')->max('id');

            $article = new ab_articles();
            $article->id = $lastId+1;
            $article->ab_name = $request->input('name');
            $article->ab_price = $request->input('price');
            $article->ab_description = $request->input('description');
            $article->ab_creator_id = 1;
            $article->ab_createdate = now();

            $article->save(); // Speichern in Tabelle 'ab_article'

            return response('Artikel gespeichert', 201);
        } catch (\Exception $e) {
            return response('Fehler: ' . $e->getMessage(), 500);
        }
    }
}

