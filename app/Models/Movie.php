<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title' , 'summary' ,'genres','authors','tags','pdf_download_link','imdb_rating','cover_image'];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'movie_id');
    }
}
