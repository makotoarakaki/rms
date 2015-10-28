<div class="zasekiMs form">
<?php echo $this->Form->create('ZasekiM'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Zaseki M'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('teiin');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ZasekiM.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ZasekiM.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Zaseki Ms'), array('action' => 'index')); ?></li>
	</ul>
</div>
