<?php

namespace App\Models;

use App\Traits\LanguageTrait;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use LanguageTrait;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'desc',
        'content',
        'status',
        'owner_id',
        'image_id',
        'lang_id',
        'lang_group_id',

    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i',
        'updated_at' => 'datetime:d-m-Y H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function image()
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'news_categories');
    }

    public function mainCategory()
    {
        return $this->belongsToMany(Category::class, 'news_categories')->wherePivot('main_category', 'yes');
    }

    public function isPublished()
    {
        if ($this->status == 'published') return true;
        return false;
    }
}
