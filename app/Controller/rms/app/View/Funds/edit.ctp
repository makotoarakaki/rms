<div class="funds form">
<?php echo $this->Form->create('Fund'); ?>
	<fieldset>
		<legend><?php echo __('予算修正'); ?></legend>
	<?php
		echo $this->Form->input('fund', array('label' => '資金'));
		echo $this->Form->input('reserve', array('label' => '積立'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('更新')); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('予算一覧'), array('action' => 'index')); ?></li>
	</ul>
</div>
