<div class="yoyakucdMs view">
<h2><?php  echo __('Yoyakucd M'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($yoyakucdM['YoyakucdM']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($yoyakucdM['YoyakucdM']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($yoyakucdM['YoyakucdM']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($yoyakucdM['YoyakucdM']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Yoyakucd M'), array('action' => 'edit', $yoyakucdM['YoyakucdM']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Yoyakucd M'), array('action' => 'delete', $yoyakucdM['YoyakucdM']['id']), null, __('Are you sure you want to delete # %s?', $yoyakucdM['YoyakucdM']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Yoyakucd Ms'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Yoyakucd M'), array('action' => 'add')); ?> </li>
	</ul>
</div>
