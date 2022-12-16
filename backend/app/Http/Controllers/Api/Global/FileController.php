<?php

namespace App\Http\Controllers\Api\Global;

use Illuminate\Http\Request;
use App\Services\FileService;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileResource;
use App\Http\Requests\Global\File\StoreFileRequest;
use App\Http\Requests\Global\File\UpdateFileRequest;

class FileController extends Controller
{
    public function __construct(protected FileService $fileServ){}

    public function list(Request $request)
    {
        $files = $this->fileServ->searchFiles($request->all());
        return FileResource::collection($files);
    }

    public function findById($fileId)
    {
        return FileResource::make($this->fileServ->findById($fileId));
    }

    public function store(StoreFileRequest $request)
    {
        $file = $this->fileServ->create($request->validated());
        return response()->json(['success' => 'File has been stored.'], 200);
    }

    public function update($fileId, UpdateFileRequest $request)
    {
        $this->fileServ->update($request->validated(), $fileId);
        return response()->json(['success' => 'File has been updated.'], 200);
    }

    public function delete($fileId)
    {
        $this->fileServ->delete($fileId);
        return response()->json(['success' => 'File has been deleted.'], 200);
    }
}
