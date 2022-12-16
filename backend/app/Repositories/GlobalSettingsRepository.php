<?php

namespace App\Repositories;

use App\Models\GlobalSettings;
use App\Services\AppSettingsService;

class GlobalSettingsRepository extends AbstractRepository
{
    protected static $model = GlobalSettings::class;

    public static function allByLangId($langId = null)
    {
        return self::$model::where('lang_id', $langId)->get();
    }

    public static function getDefault()
    {
        $appSettings = (new AppSettingsService())->getSettings();

        return GlobalSettings::where('lang_id', $appSettings->default_lang_id)->first();
    }

    public static function deleteByLangId($langId)
    {
        return GlobalSettings::where('lang_id', $langId)->delete();
    }
}
