<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'facebook',
        'twitter',
        'youtube',
        'pinterest',
        'instagram',
        'linkedin',
        'discord',
        'address',
        'phone',
        'twitter_username',
        'email',
        'email_public',
        'facebook_app_id',
        'header_scripts',
        'sitename',
        'author',
        'status_message',
        'copyright',
        'footer_text',
        'default_social_image_id',
    ];

    public function defaultSocilaImage()
    {
        return $this->belongsTo(File::class, 'default_social_image_id');
    }
}
