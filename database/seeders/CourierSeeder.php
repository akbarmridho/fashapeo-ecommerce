<?php

namespace Database\Seeders;

use App\Models\Courier;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Jalur Nugraha Ekakurir (JNE)',
                'code' => 'jne', ],
            ['name' => 'POS Indonesia',
                'code' => 'pos', ],
            ['name' => 'TIKI',
                'code' => 'tiki', ],
        ];

        Courier::insert($data);
    }
}
