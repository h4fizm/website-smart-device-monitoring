<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Site;

class SitesSeeder extends Seeder
{
    // database/seeders/SitesSeeder.php
    public function run()
    {
        Site::create([
            'name' => 'Tanjung Perak',
            'latitude' => -7.2167,
            'longitude' => 112.7382,
        ]);

        Site::create([
            'name' => 'Teluk Lamong',
            'latitude' => -7.1852,
            'longitude' => 112.6586,
        ]);

    }

}
