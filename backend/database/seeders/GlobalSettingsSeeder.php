<?php

namespace Database\Seeders;

use App\Models\GlobalSettings;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GlobalSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GlobalSettings::create([
            'sitename' => 'DF Template',
            'email' => 'test@test.com',
        ]);
    }
}
