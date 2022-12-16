<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSettings extends Model
{
    protected $table = 'app_settings';

    protected $fillable = [
        'version',
        'default_lang_id',
        'url_lang_prefix',
        'created_at',
        'updated_at',
    ];

    public function defaultLang()
    {
        return $this->belongsTo(Language::class, 'default_lang_id');
    }
}
