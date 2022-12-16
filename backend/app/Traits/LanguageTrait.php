<?php
namespace App\Traits;

use App\Models\Language;

trait LanguageTrait {

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }
}
