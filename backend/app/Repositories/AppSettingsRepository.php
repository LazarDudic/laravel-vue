<?php

namespace App\Repositories;

use App\Models\AppSettings;

class AppSettingsRepository extends AbstractRepository
{
    protected static $model = AppSettings::class;

    public static function create($data)
    {
    }
    public static function delete($data)
    {
    }
    public static function getSettings()
    {
        return AppSettings::first();
    }
}
