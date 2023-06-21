<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    protected $model = Movie::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // Other attributes...
            'title' => $this->faker->sentence(3, true),
            'summary' => $this->faker->paragraph(3, true),
            'authors' => json_encode($this->faker->words(3, false)),
            'genres' => json_encode($this->faker->words(3, false)),
            'tags' => json_encode($this->faker->words(3, false)),
            'pdf_download_link' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'imdb_rating' => $this->faker->numberBetween(1, 10),
        ];
    }


}
