<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\CategoryRel;
use App\Repositories\AbstractRepository;

class CategoryRelRepository extends AbstractRepository
{
    protected static $model = CategoryRel::class;

    public static function getOrderForChild($parentId)
    {
        $category = CategoryRel::where('parent_id', $parentId)->orderBy('order', 'desc')->first();
        return $category ? $category->order + 1 : 1;
    }

    public static function updateOrCreateParent($parentId, Category $category)
    {
        $rel = self::findByFields([
            ['child_id', '=', $category->id],
            ['parent_id', '=', $parentId]
        ]);

        if(! $rel) {
            $opositRelation = self::findByFields([
                ['parent_id', '=', $category->id],
                ['child_id', '=', $parentId]
            ]);

            if($opositRelation) { // delete if oposite relation exists
               self::delete($opositRelation);
            }

            //delete if it was child of other category
            self::$model::where(['child_id' => $category->id])->delete();

            $order = self::getOrderForChild($parentId);
            $rel = self::$model::create([
                'parent_id' => $parentId,
                'child_id' => $category->id,
                'order' => $order
            ]);
        }

        return $rel;
    }

    public static function deleteByCategoryId($categoryId)
    {
        return self::$model::where('child_id', $categoryId)
            ->orWhere('parent_id', $categoryId)
            ->delete();
    }
}
