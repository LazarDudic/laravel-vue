<?php

namespace App\Models;

use App\Traits\LanguageTrait;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use LanguageTrait;

    protected $table = 'pages';
    public $timestamps = true;

    private $contentParsedValues = null;
    private $contentParsedRules = null;

    protected $fillable = [
        'name',
        'route',
        'json_rules',
        'json_values',
        'lang_id',
        'lang_group_id',
        'main_menu_show',
        'footer_menu_show',
        'can_delete'
    ];

    public function canDelete()
    {
        return $this->can_delete === 'yes';
    }

    public function getContentValues()
    {
        if (!isset($this->contentParsedValues)) {
            if (isset($this->json_values)) {
                $this->contentParsedValues = json_decode($this->json_values);
            } else {
                $this->contentParsedValues = (object)[];
            }
        }

        return $this->contentParsedValues;
    }
    public function getContentRules()
    {
        if (!isset($this->contentParsedRules)) {
            if (isset($this->json_rules)) {
                $this->contentParsedRules = json_decode($this->json_rules);
            } else {
                $this->contentParsedRules = (object)[];
            }
        }

        return $this->contentParsedRules;
    }

    public function getValidationRules()
    {
        $rules = [];
        foreach ($this->getContentRules() as $key => $value) {
            if (!$value->editable) continue;
            $rules[$key] = $value->rules;
        }
        return $rules;
    }


    public function getFieldValue($name)
    {
        $pageContentValues = $this->getContentValues();
        if (isset($pageContentValues->$name)) return $pageContentValues->$name;
        return null;
    }
}
