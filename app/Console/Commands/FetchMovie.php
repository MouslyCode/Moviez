<?php

namespace App\Console\Commands;

use App\Models\Activity;
use App\Models\Genre;
use App\Models\Movie;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class FetchMovie extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-movie';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetching a Movie';

    /**
     * Execute the console command.
     */
    public function handle() : void
    {
        $client = new Client();
        $urlMovie = 'https://api.themoviedb.org/3/discover/movie';

        $apiKey = env('TMDB_API_KEY');

        $responseMovies = $client->request("GET", $urlMovie, [
            'headers' => [
                'Authorization' => 'Bearer '.$apiKey,
                'accept' => 'application/json',
            ],
        ]);

        $contentMovies =  $responseMovies->getBody()->getContents();
        $movieArray = json_decode($contentMovies,true);
        $movieData = collect($movieArray['results'])->random();

        $movie = Movie::create([
            'title' => $movieData['title'],
            'date' => Carbon::now()
        ]);

        $genreIds = $movieData['genre_ids'];
        $genres = Genre::whereIn('id',$genreIds)-> get();

        Activity::create([
            'action' => 'Add',
            'movie_id' => $movie->id
        ]);
        

        if($genres->isEmpty()){
            $this->error("No matching genres found for movie: {$movieData['title']}");
        } else {
            $movie->genres()->attach($genres->pluck('id'));
            $this->info("Attached genres for movie: {$movieData['title']}");
        }
    }
}
