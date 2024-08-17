<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorViewModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    public function index($page = 1 ){
        abort_if($page > 500, 204);
        $popularActors = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/popular?page='.$page)
        ->json()['results'];
        $popularActors = collect($popularActors)->map(function($actor) {
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path']
                    ? 'https://image.tmdb.org/t/p/w235_and_h235_face'.$actor['profile_path']
                    : 'https://ui-avatars.com/api/?size=235&name='.$actor['name'],
                'known_for' => collect($actor['known_for'])->where('media_type', 'movie')->pluck('title')->union(
                    collect($actor['known_for'])->where('media_type', 'tv')->pluck('name')
                )->implode(', '),
            ])->only([
                'name', 'id', 'profile_path', 'known_for',
            ]);
        });

        return view('Frontend.actor.index' ,['popularActors'=>$popularActors]);
    
    }
    public function show($actor_id){
        $actor = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'.$actor_id)
        ->json();

        $social = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'.$actor_id.'/external_ids')
        ->json();

        
        $credits = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$actor_id.'/combined_credits')
            ->json();

         $viewModel = new ActorViewModel($actor, $social, $credits);
      return view('Frontend.actor.show',$viewModel);
    }
}
