<div class="mainItems form">
<?php echo $this->Form->create('MainItem'); ?>
	<fieldset>
		<legend><?php echo __('項目修正'); ?></legend>
	<?php
		echo $this->Form->input('main_item_name', array('label' => '項目'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('更新')); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('項目一覧'), array('action' => 'index')); ?></li>
	</ul>
</div>
