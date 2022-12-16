<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Services\AbstractService;
use App\Repositories\AppSettingsRepository;

class AppSettingsService extends AbstractService
{
    protected $repository = AppSettingsRepository::class;

    public function update($data)
    {
        $settings = $this->getSettings();

        return AppSettingsRepository::update($data, $settings);
    }

    public function getSettings()
    {
        return AppSettingsRepository::getSettings();
    }
}
