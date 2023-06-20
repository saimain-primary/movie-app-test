<?php

namespace App\Http\Resources;

use App\Http\Resources\CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->summary,
            'imdb_rating' => $this->imdb_rating,
            'cover_image' => $this->cover_image,
            'pdf_download_link' => $this->pdf_download_link,
            'genres' => json_decode($this->genres, true),
            'authors' => json_decode($this->authors, true),
            'tags' => json_decode($this->tags, true),
            'comments' => CommentResource::collection($this->comments),
            'related_movies' => $this->related_movies ? MovieResource::collection($this->related_movies) : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->created_at,
        ];
    }
}
