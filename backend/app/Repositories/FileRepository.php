<?php

namespace App\Repositories;

use App\Models\File;

class FileRepository extends AbstractRepository
{
    protected static $model = File::class;

    public static function searchFiles($data = [])
    {
        $query =  File::query();

        if (isset($data['sort']) && $data['sort'] === 'old') {
            $query->orderBy('created_at', 'asc');
        } else if (isset($data['sort']) &&  $data['sort'] === 'name') {
            $query->orderBy('name', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        if (isset($data['search'])) {
            $query->where('name', 'LIKE', '%' . $data['search'] . '%');
        }

        return $query->paginate(1);
    }

    static public function updateImage($data, File $file)
    {
        $file->path = $data['path'];
        $file->thumb_path = $data['thumb_path'];
        $file->alt = $data['alt'];

        $file->save();
        return $file;
    }
}
