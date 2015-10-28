<div class="gesutocdMs view">
<h2><?php  echo __('Gesutocd M'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($gesutocdM['GesutocdM']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($gesutocdM['GesutocdM']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($gesutocdM['GesutocdM']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($gesutocdM['GesutocdM']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Gesutocd M'), array('action' => 'edit', $gesutocdM['GesutocdM']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Gesutocd M'), array('action' => 'delete', $gesutocdM['GesutocdM']['id']), null, __('Are you sure you want to delete # %s?', $gesutocdM['GesutocdM']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Gesutocd Ms'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gesutocd M'), array('action' => 'add')); ?> </li>
	</ul>
</div>
