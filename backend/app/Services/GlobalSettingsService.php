<?php

namespace App\Services;

use App\Exceptions\ClientErrorException;
use Illuminate\Http\Request;
use App\Services\AbstractService;
use App\Repositories\GlobalSettingsRepository;

class GlobalSettingsService extends AbstractService
{
    protected $repository = GlobalSettingsRepository::class;

    public function delete($settingID)
    {
        throw new ClientErrorException("Can not delete");
    }

    public function update($data)
    {
        $settings = $this->getSettings();

        $settings =  GlobalSettingsRepository::update($data, $settings);
    }

    public function getSettings()
    {
        return GlobalSettingsRepository::getSettings();
    }
}
