<div class="funds view">
<h2><?php  echo __('Fund'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($fund['Fund']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fund'); ?></dt>
		<dd>
			<?php echo h($fund['Fund']['fund']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stock'); ?></dt>
		<dd>
			<?php echo h($fund['Fund']['stock']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reserve'); ?></dt>
		<dd>
			<?php echo h($fund['Fund']['reserve']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($fund['Fund']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($fund['Fund']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fund'), array('action' => 'edit', $fund['Fund']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Fund'), array('action' => 'delete', $fund['Fund']['id']), null, __('Are you sure you want to delete # %s?', $fund['Fund']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Funds'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fund'), array('action' => 'add')); ?> </li>
	</ul>
</div>
