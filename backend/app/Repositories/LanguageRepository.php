<?php

namespace App\Repositories;

use App\Models\Language;
use App\Repositories\AbstractRepository;

class LanguageRepository extends AbstractRepository
{
    protected static $model = Language::class;

    public static function getByLangCode($langCode)
    {
        return static::$model::where('lang_code', $langCode)->first();
    }

}
