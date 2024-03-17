<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;

class DevicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Device::create([
            'device_name' => 'Smart PJU 1',
            'status' => 1, // 1 means online
            'id_sites' => 1,
        ]);

        Device::create([
            'device_name' => 'Smart PJU 2',
            'status' => 1, // 0 means offline
            'id_sites' => 1, 
        ]);

        Device::create([
            'device_name' => 'Smart PJU 3',
            'status' => 1, // 0 means offline
            'id_sites' => 1,
        ]);

        Device::create([
            'device_name' => 'Smart Fan 1',
            'status' => 0, // 0 means offline
            'id_sites' => 1,
        ]);

        Device::create([
            'device_name' => 'Smart AC 1',
            'status' => 0, // 0 means offline
            'id_sites' => 1,
        ]);
        Device::create([
            'device_name' => 'Smart Fan 1',
            'status' => 0, // 0 means offline
            'id_sites' => 2,
        ]);

        Device::create([
            'device_name' => 'Smart AC 1',
            'status' => 0, // 0 means offline
            'id_sites' => 2,
        ]);
        Device::create([
            'device_name' => 'Smart AC 2',
            'status' => 1, // 0 means offline
            'id_sites' => 2,
        ]);

        Device::create([
            'device_name' => 'Smart Fan 1',
            'status' => 0, // 0 means offline
            'id_sites' => 3,
        ]);

        Device::create([
            'device_name' => 'Smart AC 1',
            'status' => 0, // 0 means offline
            'id_sites' => 3,
        ]);
    }

}
