<?php

namespace Database\Seeders;

use App\Models\AppSettings;
use Illuminate\Database\Seeder;

class AppSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppSettings::create([
            'version' => '1.0.0',
            'url_lang_prefix' => 'no',
            'default_lang_id' => 1,
        ]);
    }
}
