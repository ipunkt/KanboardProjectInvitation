<?php

namespace Kanboard\Plugin\ProjectInvitation\Controller;

use Kanboard\Controller\BaseController;
use SimpleValidator\Validator;

/**
 * Class UserInviteController
 *
 * @package Kanboard\Controller
 * @author  Frederic Guillot
 */
class ProjectInviteController extends BaseController
{
    public function inviteUser()
    {
        $values = $this->request->getValues();

        $email = $values['email'];
        $subject = e('Kanboard Invitation');
        $body = $this->template->render('ProjectInvitation:email', array('plugin' => 'ProjectInvitation'));


//         ODO CHECK EMAIL IN DB, IF NOT EXISTET; SEND MAIL OTHERWISE THROW EXCEPTION

        if (!empty($values['email'])) {

            $this->emailClient->send(
                $email,
                $email,
                $subject,
                $body
            );

            $this->flash->success(t('Invitation to User has been sent successfully.'));

        } else {
            $this->flash->failure(t('User is already invited.'));
        }

       return $this->response->redirect('project/1/permissions');
    }

}
