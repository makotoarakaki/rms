<div class="yoyakuJyohos view">
<h2><?php  echo __('Yoyaku Jyoho'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($yoyakuJyoho['YoyakuJyoho']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Name'); ?></dt>
		<dd>
			<?php echo h($yoyakuJyoho['YoyakuJyoho']['user_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Renrakusaki'); ?></dt>
		<dd>
			<?php echo h($yoyakuJyoho['YoyakuJyoho']['renrakusaki']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Yoyaku Day'); ?></dt>
		<dd>
			<?php echo h($yoyakuJyoho['YoyakuJyoho']['yoyaku_day']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Raiten Time'); ?></dt>
		<dd>
			<?php echo h($yoyakuJyoho['YoyakuJyoho']['raiten_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Taiten Time'); ?></dt>
		<dd>
			<?php echo h($yoyakuJyoho['YoyakuJyoho']['taiten_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ninzu'); ?></dt>
		<dd>
			<?php echo h($yoyakuJyoho['YoyakuJyoho']['ninzu']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zaseki'); ?></dt>
		<dd>
			<?php echo h($yoyakuJyoho['YoyakuJyoho']['zaseki']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Yoyaku Code'); ?></dt>
		<dd>
			<?php echo h($yoyakuJyoho['YoyakuJyoho']['yoyaku_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Yoyaku Note'); ?></dt>
		<dd>
			<?php echo h($yoyakuJyoho['YoyakuJyoho']['yoyaku_note']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gesuto Code'); ?></dt>
		<dd>
			<?php echo h($yoyakuJyoho['YoyakuJyoho']['gesuto_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gesuto Note'); ?></dt>
		<dd>
			<?php echo h($yoyakuJyoho['YoyakuJyoho']['gesuto_note']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($yoyakuJyoho['YoyakuJyoho']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($yoyakuJyoho['YoyakuJyoho']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Yoyaku Jyoho'), array('action' => 'edit', $yoyakuJyoho['YoyakuJyoho']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Yoyaku Jyoho'), array('action' => 'delete', $yoyakuJyoho['YoyakuJyoho']['id']), null, __('Are you sure you want to delete # %s?', $yoyakuJyoho['YoyakuJyoho']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Yoyaku Jyohos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Yoyaku Jyoho'), array('action' => 'add')); ?> </li>
	</ul>
</div>
