<?php

namespace App\Models;

use App\Traits\LanguageTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use LanguageTrait;

    protected $fillable = [
        'title',
        'type',
        'lang_id',
        'lang_group_id',
        'image_id',
    ];

    public function image()
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function children()
    {
        return $this->belongsToMany(Category::class, CategoryRel::class, 'parent_id', 'child_id');
    }
    public function parent()
    {
        return $this->belongsToMany(Category::class, CategoryRel::class, 'child_id', 'parent_id');
    }

    public function isTypeOf($type)
    {
        return $this->type === $type;
    }
}
