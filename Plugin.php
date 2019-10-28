<?php

namespace Kanboard\Plugin\KanboardProjectInvitation;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {

        if (APP_VERSION < 'v1.2.11') {
            $this->template->setTemplateOverride('project_permission/users', 'KanboardProjectInvitation:users-override');
        } else {
            $this->template->hook->attachCallable('template:project-permission:after-adduser',
                'KanboardProjectInvitation:users',
                function ($project, $values, $errors) {
                    $project_id = $this->request->getIntegerParam('project_id', $project['project_id']);
                    return array(
                        'project_id' => $project_id,
                        'values' => $values,
                        'errors' => $errors
                    );
                });
        }
    }

    public function getClasses()
    {
        return array(
            'Plugin\KanboardProjectInvitation\Controller' => array(
                'ProjectInviteController',
            )
        );
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__ . '/Locale');
    }

    public function getPluginName()
    {
        return 'ProjectInvitation';
    }

    public function getPluginDescription()
    {
        return t("Plugin is used to invite new users to actual Project by typing user's email. Input for invitation is located in `Project Settings->Permissions`.");
    }

    public function getPluginAuthor()
    {
        return 'Andrei Volgin / Hussein Khalil, ipunkt Business Solutions';
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
