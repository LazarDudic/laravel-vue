<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $table = 'news_categories';

    protected $fillable = [
        'main_category',
        'news_id',
        'category_id',
    ];

    public function news(){
        return $this->hasMany(News::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
