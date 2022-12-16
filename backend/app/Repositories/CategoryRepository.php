<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\AbstractRepository;

class CategoryRepository extends AbstractRepository
{
    protected static $model = Category::class;

    public static function allByLangId($langId = null)
    {
        return self::$model::where('lang_id', $langId)->get();
    }

    public static function getByType($type, $langId = null)
    {
        return self::$model::where('type', $type)
        ->when($langId, function($q) use ($langId) {
            $q->where('lang_id', $langId);
        })
        ->get();
    }
}
