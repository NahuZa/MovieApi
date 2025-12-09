<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\MovieRequest;

class MovieController extends Controller
{
    public function index(Request $request)
    {
    $category = $request->get('category');
    $url = $category ? "movies?category=" . urlencode($category) : "movies";

    $response = Http::api()->get($url);

    if ($response->failed()) {
        $message = $response->json('message') ?? 'Ismeretlen hiba történt.';
        return redirect()->route('movies.index')->with('error', "Hiba történt: $message");
    }

    $movies = $this->getMovies($response);

    return view('movies.index', [
        'entities' => $movies,
        'isAuthenticated' => $this->isAuthenticated()
    ]);
    }

    public function show($id)
{
    $response = Http::api()->get("/movies/$id");

    if ($response->failed()) {
        $message = $response->json('message') ?? 'A film nem található vagy hiba történt.';
        return redirect()->route('movies.index')->with('error', "Hiba: $message");
    }

    $movie = $this->getMovie($response);

    return view('movies.show', ['entity' => $movie]);
}

    public function store(MovieRequest $request)
{
    $data = $request->validated();

    $response = Http::api()
        ->withToken($this->token)
        ->post('/movies', $data);

    if ($response->failed()) {
        $message = $response->json('message') ?? 'Nem sikerült létrehozni a filmet.';
        return redirect()->route('movies.index')->with('error', "Hiba: $message");
    }

    return redirect()->route('movies.index')->with('success', "{$data['name']} film sikeresen létrehozva!");
}

    public function edit($id)
{
    $response = Http::api()->get("/movies/$id");
    $movie = $this->getMovie($response);

    return view('movies.edit', ['entity' => $movie]);
}

public function update(MovieRequest $request, $id)
{
    $data = $request->validated();

    $response = Http::api()
        ->withToken($this->token)
        ->put("/movies/$id", $data);

    if ($response->successful()) {
        return redirect()->route('movies.index')->with('success', "{$data['name']} film sikeresen frissítve!");
    }

    $errorMessage = $response->json('message') ?? 'Ismeretlen hiba történt.';
    return redirect()->route('movies.index')->with('error', "Hiba történt: $errorMessage");
}

    public function destroy($id)
{
    $response = Http::api()
        ->withToken($this->token)
        ->delete("/movies/$id");

    if ($response->failed()) {
        $message = $response->json('message') ?? 'Nem sikerült törölni a filmet.';
        return redirect()->route('movies.index')->with('error', "Hiba: $message");
    }

    return redirect()->route('movies.index')->with('success', "Film sikeresen törölve!");
}

    private function getMovies($response)
{
    $responseBody = json_decode($response->body(), false);
    return $responseBody->movies ?? [];
}

private function getMovie($response)
{
    $responseBody = json_decode($response->body(), false);
    return $responseBody->movie ?? [];
}


}
