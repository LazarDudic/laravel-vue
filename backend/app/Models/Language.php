<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'title',
        'url_prefix',
        'html_lang',
        'lang_code',
    ];


    public function isActive()
    {
        return $this->status === 'active' ?: false;
    }
}
