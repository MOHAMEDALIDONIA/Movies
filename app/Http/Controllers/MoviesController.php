<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    public function index()  {
        $popularmovies= Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/popular')->json()['results'];
 
        $genres=Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/movie/list')
        ->json()['genres'];
        $nowPlayingMovies= Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/now_playing')->json()['results'];
        $viewModel = new MoviesViewModel(
            $popularmovies,
            $nowPlayingMovies,
            $genres,
        );
      
        return view('Frontend.welcome',$viewModel);
    }
    public function show($movie_id){
        $movie= Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/'.$movie_id.'?append_to_response=credits,videos,images')->json();  
     
        $genres= collect($movie['genres'])->mapWithKeys(function($genre){
              return [$genre['id']=>$genre['name']];
        }); 
        // dump($movie);
        return view('Frontend.movie.show',compact('movie','genres'));
    }
}
