<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function search(Request $request)
    {
        $query = $request->get('query');

        if($query == null)
            return view('index', ['message' => 'Please provide a search term.']);

        return view('search', ['searchTerm' => $query]);
    }
}
