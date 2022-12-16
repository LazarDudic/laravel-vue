<?php

namespace App\Repositories;

use App\Models\LangGroup;
use App\Repositories\AbstractRepository;

class LangGroupRepository
{
    public static function getId($model)
    {
        $model = $model::select('id')->latest('id')->first();
        return $model ? $model->id + 1: 1;
    }

    public static function exists($langGroupId, $langId, $model)
    {
        if(! $langGroupId || !$langId) {
            return false;
        }

        return $model::where('lang_group_id', $langGroupId)
            ->where('lang_id', $langId)
            ->exists();
    }
}
