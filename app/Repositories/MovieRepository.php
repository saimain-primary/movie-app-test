<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Contracts\MovieInterface;
use App\Http\Resources\MovieResource;
use App\Models\Author;
use App\Models\Genre;

class MovieRepository implements MovieInterface
{
    public function all(Request $request)
    {
        $limit = $request->query('limit', 10);

        $query = Movie::query();

        $query->with('comments');
        $query->orderBy('created_at', 'desc');

        $data = $query->paginate($limit);

        return MovieResource::collection($data)
            ->additional([
                'meta' => [
                    'total_page' => (int) ceil($data->total() / $data->perPage()),
                ],
            ])
            ->response()
            ->getData();
    }

    public function get($id)
    {
        $movie = Movie::find($id);

        $authors = json_decode($movie->authors, true);
        $genres = json_decode($movie->genres, true);
        $tags = json_decode($movie->tags, true);

        // $relatedMovies = Movie::whereJsonContains('authors', $authors)
        //                         ->orWhereJsonContains("tags", $tags)
        //                         ->orWhereJsonContains('genres', $genres)
        //                         ->limit(6)
        //                         ->get();

        $relatedMovies = Movie::orWhere(function ($query) use ($tags) {
            foreach ($tags as $value) {
                $query->orWhereJsonContains('tags', $value);
            }
        })
            ->orWhere(function ($query) use ($authors) {
                foreach ($authors as $value) {
                    $query->orWhereJsonContains('authors', $value);
                }
            })
            ->orWhere(function ($query) use ($genres) {
                foreach ($genres as $value) {
                    $query->orWhereJsonContains('genres', $value);
                }
            })->limit(6)
            ->get();

        $movie['related_movies'] = $relatedMovies;

        return new MovieResource($movie);
    }

    public function store(array $data)
    {
        foreach ($data['tags'] as $tag) {
            $checkExist = Tag::where('name', $tag)->exists();
            if (!$checkExist) {
                Tag::create([
                    'slug' => Str::slug($tag),
                    'name' => $tag,
                ]);
            }
        }

        foreach ($data['authors'] as $author) {
            $checkExist = Author::where('name', $author)->exists();
            if (!$checkExist) {
                Author::create([
                    'name' => $author,
                ]);
            }
        }

        foreach ($data['genres'] as $genre) {
            $checkExist = Genre::where('name', $genre)->exists();
            if (!$checkExist) {
                Genre::create([
                    'name' => $tag,
                ]);
            }
        }

        Movie::create([
            'title' => $data['title'],
            'summary' => $data['summary'],
            'imdb_rating' => $data['imdb_rating'],
            'pdf_download_link' => $data['pdf_download_link'],
            'tags' => json_encode($data['tags']),
            'authors' => json_encode($data['authors']),
            'genres' => json_encode($data['genres']),
            'cover_image' => $data['cover_image'],
        ]);
    }

    public function update($id, array $data)
    {
        if ($data['tags']) {
            foreach ($data['tags'] as $tag) {
                $checkExist = Tag::where('name', $tag)->exists();
                if (!$checkExist) {
                    Tag::create([
                        'slug' => Str::slug($tag),
                        'name' => $tag,
                    ]);
                }
            }
        }

        if ($data['authors']) {
            foreach ($data['authors'] as $author) {
                $checkExist = Author::where('name', $author)->exists();
                if (!$checkExist) {
                    Author::create([
                        'name' => $author,
                    ]);
                }
            }
        }

        if ($data['genres']) {
            foreach ($data['genres'] as $genre) {
                $checkExist = Genre::where('name', $genre)->exists();
                if (!$checkExist) {
                    Genre::create([
                        'name' => $tag,
                    ]);
                }
            }
        }

        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->summary = $data['summary'];
        $movie->imdb_rating = $data['imdb_rating'];
        $movie->pdf_download_link = $data['pdf_download_link'];
        $movie->tags = json_encode($data['tags']);
        $movie->authors = json_encode($data['authors']);
        $movie->genres = json_encode($data['genres']);
        $movie->cover_image = $data['cover_image'] ?? $movie->cover_image;
        $movie->update();

        return $movie;
    }

    public function delete($id)
    {
    }
}
