<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now()
        // ]);


        $sourceDirectory  = base_path() . '/images_for_seeding';
        $destinationPath = 'public/images';

        $filesystem = new Filesystem();
        $imageFiles = $filesystem->files($sourceDirectory);
        $coverImageArray = [];

        foreach ($imageFiles as $file) {
            $filename = $file->getFilename();
            Storage::putFileAs($destinationPath, $file, $filename);
            array_push($coverImageArray, $filename);
        }

        Movie::factory()
        ->count(20)
        ->create();
    }
}
