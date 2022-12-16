<?php

namespace App\Services;

use App\Models\AppSettings;
use Illuminate\Http\Request;
use App\Models\GlobalSettings;
use Illuminate\Support\Facades\DB;
use App\Services\GlobalSettingsService;
use App\Exceptions\ClientErrorException;
use App\Repositories\LanguageRepository;

class LanguageService extends AbstractService
{
    protected $repository = LanguageRepository::class;

    public function create($data)
    {
        return DB::transaction(function () use ($data) {
            $lang = LanguageRepository::create($data);
            $globalSettings = (new GlobalSettingsService())->getDefault();
            $filtered = $globalSettings->only([ 'sitename', 'facebook', 'twitter', 'lang_group_id',
                'youtube', 'pinterest', 'instagram', 'discord', 'linkedin', 'twitter_username',
                'facebook_app_id',  'email', 'email_public', 'header_scripts', 'copyright', 'author',
                 'address', 'phone', 'footer_text', 'status_message', 'default_social_image_id',
            ]);

            $merge = array_merge(['lang_id' => $lang->id], $filtered);

            $globalSettings->create($merge);

            return $lang;
        });

    }

    public function update($data, $id)
    {
        $lang = $this->findByIdOrFail($id);
        return LanguageRepository::update($data, $lang);
    }

    public function delete($id)
    {
        $lang = $this->findByIdOrFail($id);
        $settings = (new AppSettingsService())->getSettings();
        if((int) $id === $settings->default_lang_id) {
            throw new ClientErrorException('This language is default.');
        }
        (new GlobalSettingsService)->deleteByLangId($lang->id);
        return LanguageRepository::delete($lang);
    }
}
