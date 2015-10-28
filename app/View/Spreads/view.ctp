<div class="spreads view">
<h2><?php  echo __('Spread'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($spread['Spread']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Main Item Id'); ?></dt>
		<dd>
			<?php echo h($spread['Spread']['main_item_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item Id'); ?></dt>
		<dd>
			<?php echo h($spread['Spread']['item_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Main Item Name'); ?></dt>
		<dd>
			<?php echo h($spread['Spread']['main_item_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item Name'); ?></dt>
		<dd>
			<?php echo h($spread['Spread']['item_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Supplier Count'); ?></dt>
		<dd>
			<?php echo h($spread['Spread']['supplier_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Supplier Total'); ?></dt>
		<dd>
			<?php echo h($spread['Spread']['supplier_total']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Profit Count'); ?></dt>
		<dd>
			<?php echo h($spread['Spread']['profit_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Profit Total'); ?></dt>
		<dd>
			<?php echo h($spread['Spread']['profit_total']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($spread['Spread']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($spread['Spread']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Spread'), array('action' => 'edit', $spread['Spread']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Spread'), array('action' => 'delete', $spread['Spread']['id']), null, __('Are you sure you want to delete # %s?', $spread['Spread']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Spreads'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Spread'), array('action' => 'add')); ?> </li>
	</ul>
</div>
