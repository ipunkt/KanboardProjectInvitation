<?php

namespace Kanboard\Plugin\ProjectInvitation\Controller;

use Kanboard\Controller\BaseController;

/**
 * Class ProjectInviteController
 * @package Kanboard\Plugin\ProjectInvitation\Controller
 */
class ProjectInviteController extends BaseController
{
    public function inviteUser()
    {
        $values = $this->request->getValues();

        if (!empty($values['email'])) {
            $this->inviteModel->createInvites(array($values['email']), $values['project_id']);

            $this->flash->success(t('Invitation to User has been sent successfully.'));

        } else {
            $this->flash->failure(t('User is already invited.'));
        }

        $url = 'project/' . $values['project_id'] . '/permissions';

        return $this->response->redirect($url);
    }

}