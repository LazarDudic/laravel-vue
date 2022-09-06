<?php

namespace App\Repositories;

use App\Models\GlobalSettings;

class GlobalSettingsRepository extends AbstractRepository
{
    protected static $model = GlobalSettings::class;

    public static function getSettings()
    {
        return GlobalSettings::first();
    }
}
