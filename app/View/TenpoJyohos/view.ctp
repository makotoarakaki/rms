<div class="tenpoJyohos view">
<h2><?php  echo __('Tenpo Jyoho'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tenpoJyoho['TenpoJyoho']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tenpo Id'); ?></dt>
		<dd>
			<?php echo h($tenpoJyoho['TenpoJyoho']['tenpo_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zaseki Id'); ?></dt>
		<dd>
			<?php echo h($tenpoJyoho['TenpoJyoho']['zaseki_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($tenpoJyoho['TenpoJyoho']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($tenpoJyoho['TenpoJyoho']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tenpo Jyoho'), array('action' => 'edit', $tenpoJyoho['TenpoJyoho']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tenpo Jyoho'), array('action' => 'delete', $tenpoJyoho['TenpoJyoho']['id']), null, __('Are you sure you want to delete # %s?', $tenpoJyoho['TenpoJyoho']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tenpo Jyohos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tenpo Jyoho'), array('action' => 'add')); ?> </li>
	</ul>
</div>
