<div class="tenpoMs view">
<h2><?php  echo __('Tenpo M'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tenpoM['TenpoM']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($tenpoM['TenpoM']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kaiten Time'); ?></dt>
		<dd>
			<?php echo h($tenpoM['TenpoM']['kaiten_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Heiten Time'); ?></dt>
		<dd>
			<?php echo h($tenpoM['TenpoM']['heiten_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Twenty Four Flg'); ?></dt>
		<dd>
			<?php echo h($tenpoM['TenpoM']['twenty_four_flg']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($tenpoM['TenpoM']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($tenpoM['TenpoM']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tenpo M'), array('action' => 'edit', $tenpoM['TenpoM']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tenpo M'), array('action' => 'delete', $tenpoM['TenpoM']['id']), null, __('Are you sure you want to delete # %s?', $tenpoM['TenpoM']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tenpo Ms'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tenpo M'), array('action' => 'add')); ?> </li>
	</ul>
</div>
