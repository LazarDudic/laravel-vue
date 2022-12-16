<?php

namespace App\Libraries;

class StaticHelpPageContent
{
    public static $pageDefaultJsonContent = null;
    public static function init()
    {
        self::$pageDefaultJsonContent  = (object)[
            "title" => (object)[
                "title" => "Title",
                "default_value" => "Page title",
                "type" => "string",
                "rules" => ["string", "max:190", "required"],
                "editable" => true,
            ],
            "menuTitle" => (object)[
                "title" => "Menu Title",
                "default_value" => "Page title",
                "type" => "string",
                "rules" => ["string", "max:190", "required"],
                "editable" => true,
            ],
            "metaTitle" => (object)[
                "title" => "Meta Title",
                "default_value" => "Page title",
                "type" => "string",
                "rules" => ["string", "max:190", "required"],
                "editable" => true,
            ],
            "metaDesc" => (object)[
                "title" => "Meta Description",
                "default_value" => "Page description",
                "type" => "text",
                "rules" => ["string", "max:500", "required"],
                "editable" => true,
            ],
            "content" => (object)[
                "title" => "Text",
                "default_value" => '<p style="text-align: center; " class="">Hello World</p>',
                "type" => "richtext",
                "rules" => ["string", "nullable"],
                "editable" => true,
            ],
            "socialImageID" => (object)[
                "title" => "Social Image(1200x1200)",
                "default_value" => null,
                "type" => "image",
                "rules" => ["integer", "nullable", 'exists:files,id'],
                "editable" => true,
            ],
        ];
    }
}
StaticHelpPageContent::init();
