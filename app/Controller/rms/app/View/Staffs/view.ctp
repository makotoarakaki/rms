<div class="staffs view">
<h2><?php  echo __('スタッフ詳細'); ?></h2>
	<dl>
		<dt><?php echo __('名前'); ?></dt>
		<dd>
			<?php echo h($staff['Staff']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('時給'); ?></dt>
		<dd>
			<?php echo h(number_format($staff['Staff']['hourly_wage'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('登録日'); ?></dt>
		<dd>
			<?php echo h($staff['Staff']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('更新日'); ?></dt>
		<dd>
			<?php echo h($staff['Staff']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('スタッフ一覧'), array('action' => 'index')); ?></li>
	</ul>
</div>
