<div class="zasekiMs view">
<h2><?php  echo __('Zaseki M'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($zasekiM['ZasekiM']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($zasekiM['ZasekiM']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Teiin'); ?></dt>
		<dd>
			<?php echo h($zasekiM['ZasekiM']['teiin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($zasekiM['ZasekiM']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($zasekiM['ZasekiM']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Zaseki M'), array('action' => 'edit', $zasekiM['ZasekiM']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Zaseki M'), array('action' => 'delete', $zasekiM['ZasekiM']['id']), null, __('Are you sure you want to delete # %s?', $zasekiM['ZasekiM']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Zaseki Ms'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Zaseki M'), array('action' => 'add')); ?> </li>
	</ul>
</div>
