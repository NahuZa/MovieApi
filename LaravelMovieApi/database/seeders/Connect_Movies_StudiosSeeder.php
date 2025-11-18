<?php

namespace Database\Seeders;

use App\Models\ConnectCategoriesStudios;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Connect_Movies_StudiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adatok = array();


        $handle = fopen(("database\seeders\data\movies_studios.txt"), "r");

        while (($line = fgets($handle)) !== false) {
            $data = explode(';', trim($line)); // Trim, hogy eltávolítsuk az extra whitespace-t

            

            $szineszek[] = [  // Helyes tömb hozzáadás
                'studio_id' => $data[0] ?? null,  
                'movies_id' => $data[1] ?? null,
                
            ];  
        }

        fclose($handle);
        
        

        foreach ($adatok as $adat) {
            $connect_movies_studios = new ConnectCategoriesStudios();
            $connect_movies_studios->studio_id = $adat['studio_id'];
            $connect_movies_studios->movies_id = $adat['movies_id'];
            $connect_movies_studios->save();
            
        }
    }
}
