<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SearchController extends Controller
{
    private function getSpotifyWebAPIClient()
    {
        return new Client([
            // Base URI is used with relative requests
            'base_uri' => '',
            // You can set any number of default request options.
            'timeout' => 10.0,
        ]);
    }

    public function index()
    {
        return view('index');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        if ($query == null)
            return view('index', ['message' => 'Please provide a search term.']);

        $request->session()->flash('query', $query);

        return redirect()->away('https://accounts.spotify.com/authorize' .
            '?client_id=' . env('SPOTIFY_CLIENT_ID') .
            '&response_type=' . 'token' .
            '&redirect_uri=' . 'http://localhost:8000/searchCallback' .
            '&scope=' . 'user-library-read');
    }

    public function searchCallback(Request $request)
    {
        $query = $request->session()->pull('query');
        return view('search', ['searchTerm' => $query]);
    }

    public function searchSpotify(Request $request)
    {
        $query = $request->get('query');
        $token = $request->get('access_token');

        // Hit Spotify's web API here.
        $this->getSpotifyWebAPIClient();

        return view('search', ['searchTerm' => $query]);
    }
}
