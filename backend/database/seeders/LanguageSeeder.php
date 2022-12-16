<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;


class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'title' => 'SR',
            'lang_code' => 'sr',
            'url_prefix' => '/',
            'html_lang' => 'sr',
            'status' => 'active',
        ]);

        Language::create([
            'title' => 'EN',
            'lang_code' => 'en',
            'url_prefix' => '/en',
            'html_lang' => 'en',
            'status' => 'active',
        ]);
    }
}
