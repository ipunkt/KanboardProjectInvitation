<?php

namespace Kanboard\Plugin\ProjectInvitation;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base
{
    public function initialize()
    {
    }

    public function onStartup()
    {
//        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__ . '/Locale');
    }
    public function getPluginName()
    {
        return 'ProjectInvitation';
    }

    public function getPluginDescription()
    {
        //@ TODO ADD DESCRIPTION
//        return t('');
    }

    public function getPluginAuthor()
    {
        //@ TODO ADD INFO
        return 'Andrei Volgin, ipunkt Business Solutions';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getPluginHomepage()
    {
        return 'https://www.ipunkt.biz/unternehmen/opensource';
    }
}
