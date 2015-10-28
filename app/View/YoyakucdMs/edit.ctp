<div class="yoyakucdMs form">
<?php echo $this->Form->create('YoyakucdM'); ?>
	<fieldset>
		<legend><?php echo __('予約コード更新'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' => '名称'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('更新')); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('予約コード一覧'), array('action' => 'index')); ?></li>
	</ul>
</div>
