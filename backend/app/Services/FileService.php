<?php

namespace App\Services;

use Exception;
use PDOException;
use Illuminate\Http\Request;
use App\Libraries\StorageManager;
use Illuminate\Support\Facades\DB;
use App\Repositories\FileRepository;
use App\Exceptions\ClientErrorException;

class FileService extends AbstractService
{
    protected $repository = FileRepository::class;

    public function paginate($paginate = 15, $data = [])
    {
        return FileRepository::paginate($paginate, $data);
    }
    public function get($imageID)
    {
        $image = FileRepository::findById($imageID);
        if (!isset($image)) throw new ClientErrorException("Image does not exist!");

        return $image;
    }

    public function upload($data, $folder = 'public/files')
    {
        $file =  $data['file'];
        try {
            [$width, $height] = getimagesize($file);
            $size = $file->getSize();

            $uploaded = StorageManager::putFile($folder, $file);
            $thumbnail = StorageManager::makeThumbnailDesired($folder, $uploaded[1], $uploaded[2], $file);

            $fileInfo = pathinfo($uploaded[0]);
            $data = [
                'path' => $uploaded[0],
                'thumb_path' => $thumbnail,
                'public' => 'yes',
                'extension' => $uploaded[2],
                'width' => $width,
                'height' => $height,
                'size' => $size,
                'alt' => $data['alt'],
                'name' => $data['name'] ?? str_replace('-', ' ', $fileInfo['filename'])
            ];

            return $data;
        } catch (Exception $e) {
            if (isset($uploaded)) {
                StorageManager::deleteFile($uploaded[0]);
            }
            if (isset($thumbnail)) {
                StorageManager::deleteFile($thumbnail);
            }

            throw $e;
        }
    }

    public function create($requestData, $folder = 'public/files')
    {
        $data = $this->upload($requestData, $folder);

        return FileRepository::create($data);
    }

    public function update($data, $fileId, $folder = 'public/files')
    {
        $file = $this->findByIdOrFail($fileId);

        if(isset($data['file'])) {
            $data = $this->upload($data, $folder);
            StorageManager::deleteFile($file->path);
            StorageManager::deleteFile($file->thumb_path);
        }

        return FileRepository::update($data, $file);
    }
    public function delete($fileId)
    {
        $file = $this->findByIdOrFail($fileId);
        DB::beginTransaction();
        try {
            FileRepository::delete($file);
            StorageManager::deleteFile($file->path);
            StorageManager::deleteFile($file->thumb_path);
            DB::commit();
            return $file;
        } catch (Exception $e) {
            DB::rollBack();
            if ($e instanceof PDOException) {
                throw new ClientErrorException($e->errorInfo[2]);
            }
            throw $e;
        }
    }

    public function searchFiles($data)
    {
        return FileRepository::searchFiles($data);
    }
}
