<div class="zasekiMs form">
<?php echo $this->Form->create('ZasekiM'); ?>
	<fieldset>
		<legend><?php echo __('座席登録'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => '名称'));
		echo $this->Form->input('teiin', array('label' => '定員'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('登 録')); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('座席一覧'), array('action' => 'index')); ?></li>
	</ul>
</div>
