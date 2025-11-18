<?php

namespace Database\Seeders;

use App\Models\ConnectMoviesActors;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Connect_Movies_ActorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adatok = array();


        $handle = fopen(("database\seeders\data\movies_actors.txt"), "r");

        while (($line = fgets($handle)) !== false) {
            $data = explode(';', trim($line)); // Trim, hogy eltávolítsuk az extra whitespace-t

            

            $szineszek[] = [  // Helyes tömb hozzáadás
                'movies_id' => $data[0] ?? null,  
                'actors_id' => $data[1] ?? null,
                
            ];  
        }

        fclose($handle);
        
        

        foreach ($adatok as $adat) {
            $connect_movies_actors = new ConnectMoviesActors();
            $connect_movies_actors->studio_id = $adat['movies_id'];
            $connect_movies_actors->movies_id = $adat['actors_id'];
            $connect_movies_actors->save();
            
        }
    }
}
