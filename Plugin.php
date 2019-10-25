<?php

namespace Kanboard\Plugin\ProjectInvitation;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base
{
    public function initialize()
    {
//        if(APP_VERSION < '1.2.12')
//            $this->template->setTemplateOverride('project_permission/users', 'ProjectInvitation:users-override');
//        else
        $this->template->hook->attach('template:project-permission:after-adduser',
            'ProjectInvitation:users');

    }

    public function getClasses()
    {
        return array(
            'Plugin\ProjectInvitation\Controller' => array(
                'ProjectInviteController',
            )
        );
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
