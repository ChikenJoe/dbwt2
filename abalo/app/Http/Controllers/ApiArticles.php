<?php

namespace App\Http\Controllers;

use App\Models\ab_articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiArticles extends Controller
{
    /**
     * Display article search
     */
    public function articlesearchbox(Request $request){
        /*
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        if (!empty($search)) {
            $articles = ab_articles::where('ab_name', 'LIKE', '%' . $search . '%')->get();
        } else {
            $articles = [];
        }

        return response()->json($articles);
        */

        $search = $request->query('search');

        if (strlen($search) < 3) { return response()->json([]); }

        $results = ab_articles::where('ab_name', 'ILIKE', '%' . $search . '%')
            ->limit(5)
            ->get();

        return response()->json($results);
    }

    /**
     * Display all articles
     * */
    public function articles(Request $request){

        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $offset = isset($_GET['page']) ? $_GET['page'] : 0;

        if (!empty($search)) {
            $articles = ab_articles::where('ab_name', 'ILIKE', '%' . $search . '%')
                ->with('category')
                ->skip($offset * 2)
                ->take(2)
                ->get();
        } else {
            $articles = ab_articles::with('image')->get();
        }

        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
            return response()->json(['id' => $article->id]);
        } catch (\Exception $e) {
            return response()->json(['error' =>'Fehler: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ab_articles $ab_articles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ab_articles $ab_articles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        $article = ab_articles::find($id);

        if (!$article)
            return response()->json(['message' => 'Article not found']);

        $article->delete();
        return response()->json(['message' => 'Article deleted']);
    }

}
