<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Genre;
use App\Models\Tag;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    use HttpResponses;

    public function getTags()
    {
        $tags = Tag::all();
        return $this->success($tags, 'Tags List');
    }

    public function getGenres()
    {
        $genres = Genre::all();
        return $this->success($genres, 'Genres List');
    }

    public function getAuthors()
    {
        $authors = Author::all();
        return $this->success($authors, 'Authors List');
    }
}
