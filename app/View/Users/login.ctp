<div class="users form">
<!--<?php echo $this->Session->flash('auth'); ?>-->
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('ユーザーID、パスワードを入力して下さい。'); ?></legend>
    <?php
        echo $this->Form->input('username', array('label' => 'ユーザーID'));
        echo $this->Form->input('password', array('label' => 'パスワード'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('ログイン')); ?>
<?php echo debug($_SESSION, $showHTML = true, $showFrom = true);?>
</div>