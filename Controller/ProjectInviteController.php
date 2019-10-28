<?php

namespace Kanboard\Plugin\KanboardProjectInvitation\Controller;

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
        $url = 'project/' . $values['project_id'] . '/permissions';

        if (! filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
            $this->flash->failure('Please enter a valid email.');
            return $this->response->redirect($url);
        }

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

        return $this->response->redirect($url);
    }
}
