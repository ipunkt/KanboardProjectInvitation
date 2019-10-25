<!--User Invitation -->
<div class="panel">
    <form method="post"
          action="<?= $this->url->href('ProjectInviteController', 'inviteUser',
              array('plugin' => 'ProjectInvitation', 'project_id' => $project['id'])) ?>"
          autocomplete="off" class="form-inline">
        <?= $this->form->csrf() ?>
        <?= $this->form->hidden('project_id', array('project_id' => $project['id'])) ?>
        <?= $this->form->label(t('Invite User'), 'invite_user') ?>
        <?= $this->form->text('email', $values, $errors, array(
            'required',
            'placeholder="' . t('Enter user email...') . '"',
            'title="' . t('Enter user email...') . '"'
        )) ?>

        <button type="submit" class="btn btn-blue"><?= t('Invite') ?></button>
    </form>
    <p class="form-help"><?= t('Enter one email address per invite.') ?></p>
</div>
