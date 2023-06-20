<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Contracts\MovieInterface;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;

class MovieController extends Controller
{
    use HttpResponses;
    protected $interface;

    public function __construct(MovieInterface $interface)
    {
        $this->interface = $interface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->interface->all($request);
        return $this->success($data, 'Movies List');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovieRequest $request)
    {

        $data = [
            'title' => $request->title,
            'summary' => $request->summary,
            'imdb_rating' => $request->imdb_rating,
            'pdf_download_link' => $request->pdf_download_link,
            'tags' => explode(',', $request->tags),
            'genres' => explode(',', $request->genres),
            'authors' => explode(',', $request->authors)
        ];


        if($request->file('cover_image')) {
            $name = time() . '-' . $request->file('cover_image')->getClientOriginalName();
            // $path = $request->file('cover_image')->store('/images');
            $request->file('cover_image')->storeAs('public/images', $name);
            $data['cover_image'] = $name;
        }

        $save = $this->interface->store($data);

        return $this->success($save, 'Successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::find($id);
        if(!$movie) {
            return $this->error(null, 'Movie not found', 404);
        }
        $data = $this->interface->get($id);
        return $this->success($data, 'Movie Detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovieRequest $request, $id)
    {
        $movie = Movie::find($id);
        if(!$movie) {
            return $this->error(null, 'Movie not found', 404);
        }

        $data = [
            'title' => $request->title ?? $movie->title,
            'summary' => $request->summary ?? $movie->summary,
            'imdb_rating' => $request->imdb_rating ?? $movie->imdb_rating,
            'pdf_download_link' => $request->pdf_download_link ?? $movie->pdf_download_link,
            'tags' => $request->tags ? explode(',', $request->tags) : $movie->tags,
            'genres' => $request->genres ? explode(',', $request->genres) : $movie->genres,
            'authors' => $request->authors ? explode(',', $request->authors) : $movie->authors
        ];

        if($request->file('cover_image')) {
            $name = time() . '-' . $request->file('cover_image')->getClientOriginalName();
            // $path = $request->file('cover_image')->store('/images');
            $request->file('cover_image')->storeAs('public/images', $name);
            $data['cover_image'] = $name;
        }

        $data = $this->interface->update($id, $data);
        return $this->success($data, 'Successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        if(!$movie) {
            return $this->error(null, 'Movie not found', 404);
        }

        $movie->delete();
        return $this->success(null, 'Movie deleted successfully');
    }

    public function addComment(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'text' => 'required'
        ]);

        $comment  = new Comment();
        $comment->movie_id = $id;
        $comment->email = $request->email;
        $comment->name = $request->name;
        $comment->text = $request->text;
        $comment->save();
        return $this->success($comment, 'Successfully commented');

    }
}
