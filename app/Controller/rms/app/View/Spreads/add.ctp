<div class="spreads form">
<?php echo $this->Form->create('Spread'); ?>
	<fieldset>
		<legend><?php echo __('Add Spread'); ?></legend>
	<?php
		echo $this->Form->input('main_item_id');
		echo $this->Form->input('item_id');
		echo $this->Form->input('main_item_name');
		echo $this->Form->input('item_name');
		echo $this->Form->input('supplier_count');
		echo $this->Form->input('supplier_total');
		echo $this->Form->input('profit_count');
		echo $this->Form->input('profit_total');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Spreads'), array('action' => 'index')); ?></li>
	</ul>
</div>
