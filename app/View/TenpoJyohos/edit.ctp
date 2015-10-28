<div class="tenpoJyohos form">
<?php echo $this->Form->create('TenpoJyoho'); ?>
	<fieldset>
		<legend><?php echo __('Edit Tenpo Jyoho'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tenpo_id');
		echo $this->Form->input('zaseki_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('TenpoJyoho.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('TenpoJyoho.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tenpo Jyohos'), array('action' => 'index')); ?></li>
	</ul>
</div>
