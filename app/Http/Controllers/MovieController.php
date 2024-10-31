<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Genre;
use App\Models\Movie;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with('genres')->orderBy('updated_at', 'desc')->get(); // Load genres with each movie
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('movies.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genres' => 'array',
            'genres.*' => 'exists:genres,id',
        ]);

        $movie = Movie::create([
            'title' => $request->title,
            'date' => now(),
        ]);

        if ($request->genres) {
            $movie->genres()->attach($request->genres);
        }

        Activity::create([
            'action' => 'Add',
            'movie_id' => $movie->id
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie Created');
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        return view('movies.edit', compact('movie', 'genres'));
    }

    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genres' => 'array',
            'genres.*' => 'exists:genres,id'
        ]);

        $movie->update([
            'title' => $request->title,
            'date' => now()
        ]);

        if ($request->genres) {
            $movie->genres()->sync($request->genres);
        }

        Activity::create([
            'action' => 'Edit',
            'movie_id' => $movie->id
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie Updated');
    }

    public function destroy(Movie $movie)
    {
        Activity::create([
            'action' => 'Delete',
            'movie_id' => $movie->id
        ]);

        $movie->genres()->detach();
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie Deleted');
    }

    public function dashboard()
    {
        $genres = Genre::withCount('movies')->get();
        $labels = $genres->pluck('name')->toArray();
        $data = $genres->pluck('movies_count')->toArray();

        $activities = Activity::select(DB::raw('DATE(created_at) as date'), DB::Raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        $activityCounts = [];
        foreach ($activities as $activity) {
            $date = $activity->date;
            $activityCounts[$date] = $activity->total;
        }

        $activityDates = array_keys($activityCounts);
        $totalActivityCounts = array_values($activityCounts);

        return view('dashboard', compact('labels', 'data', 'activityDates', 'totalActivityCounts'));
    }
}
