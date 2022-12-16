<?php

namespace App\Services;

use App\Exceptions\ClientErrorException;
use Illuminate\Http\Request;
use App\Services\AbstractService;
use App\Repositories\GlobalSettingsRepository;

class GlobalSettingsService extends AbstractService
{
    protected $repository = GlobalSettingsRepository::class;

    public function allOrByLangId($langId = null)
    {
        if (empty($langId)) {
            return $this->all();
        }
        return $this->repository::allByLangId($langId);
    }

    public function allByLangId($langId = null, $useDefaultLang = false)
    {
        if (is_null($langId) && !$useDefaultLang) {
            throw new ClientErrorException('Language Id is not set.');
        }

        if (is_null($langId)) {
            $appSettings = (new AppSettingsService)->getSettings();
            $langId = $appSettings->default_lang_id;
        }

        return $this->repository::allByLangId($langId);
    }

    public function delete($settingId)
    {
        throw new ClientErrorException("Can not delete");
    }

    public function create($data)
    {
        return $this->repository::create($data);
    }

    public function update($data, $settingId)
    {
        $settings = $this->findByIdOrFail($settingId);
        return $this->repository::update($data, $settings);
    }

    public function getDefault()
    {
        return GlobalSettingsRepository::getDefault();
    }

    public function deleteByLangId($langId)
    {
        return GlobalSettingsRepository::deleteByLangId($langId);
    }
}
