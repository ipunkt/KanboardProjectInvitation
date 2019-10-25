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
        $user = $this->userModel->getByEmail($values['email']);
        $emails_number = substr_count($values['email'], '@');

        if (!($emails_number > 1)) {
            if ($user['email'] !== $values['email']) {
                $this->inviteModel->createInvites(array($values['email']), $values['project_id']);
                $this->flash->success(t('Invitation to user has been sent successfully.'));
            } else {
                $this->flash->failure(t('User is already registered.'));
            }
        } else {
            $this->flash->failure(t('You can add only one email per one invitation.'));
        }
        $url = 'project/' . $values['project_id'] . '/permissions';

        return $this->response->redirect($url);
    }
}
