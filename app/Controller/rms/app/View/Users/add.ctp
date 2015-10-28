<!-- app/View/Users/add.ctp -->
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('ユーザー登録'); ?></legend>
    <?php
        echo $this->Form->input('username', array('label' => 'ユーザーID'));
        echo $this->Form->input('password', array('label' => 'パスワード'));
        echo $this->Form->input('email', array('label' => 'E-MAIL'));
		echo $this->Form->radio('send_mail', 
			array(
			      0 => '送信',
			      1 => '未送信'
		    ),
			array(
			      'default' => 0,
				  'legend' => 'メール送信'
		    ));
        echo $this->Form->input('role', array('label' => '権限',
            'options' => array('admin' => 'Admin', 'author' => 'Author')
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('登 録')); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('ユーザー一覧'), array('action' => 'index')); ?></li>
	</ul>
</div>
