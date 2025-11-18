<?php

namespace Database\Seeders;

use App\Models\ConnectDirectorsMovies;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Connect_Directors_MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adatok = array();


        $handle = fopen(("database\seeders\data\movies_directors.txt"), "r");

        while (($line = fgets($handle)) !== false) {
            $data = explode(';', trim($line)); // Trim, hogy eltávolítsuk az extra whitespace-t

            

            $szineszek[] = [  // Helyes tömb hozzáadás
                'movies_id' => $data[0] ?? null,  
                'directors_id' => $data[1] ?? null,
                
            ];  
        }

        fclose($handle);
        
        

        foreach ($adatok as $adat) {
            $connect_movies_directors= new ConnectDirectorsMovies();
            $connect_movies_directors->studio_id = $adat['movies_id'];
            $connect_movies_directors->movies_id = $adat['directors_id'];
            $connect_movies_directors->save();
            
        }
    }
}
