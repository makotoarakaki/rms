<div class="gesutocdMs form">
<?php echo $this->Form->create('GesutocdM'); ?>
	<fieldset>
		<legend><?php echo __('ゲストコード登録'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => '名称'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('登 録')); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('ゲストコード一覧'), array('action' => 'index')); ?></li>
	</ul>
</div>
