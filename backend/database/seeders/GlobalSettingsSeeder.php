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
            'lang_id' => 1,
            'lang_group_id' => 1,
            'sitename' => 'DF Template',
            'email' => 'test@test.com',
        ]);
        GlobalSettings::create([
            'lang_id' => 2,
            'lang_group_id' => 1,
            'sitename' => 'DF Template EN',
            'email' => 'test@test.com',
        ]);
    }
}
