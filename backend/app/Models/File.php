<?php

namespace App\Models;

use App\Libraries\StorageManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'thumb_path',
        'public',
        'extension',
        'width',
        'height',
        'size',
        'alt',
    ];

    public function getPath()
    {
        return StorageManager::getUrl($this->path);
    }
    public function getThumbPath()
    {
        return StorageManager::getUrl($this->thumb_path);
    }
}
