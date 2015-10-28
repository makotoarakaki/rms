<div class="humanCosts view">
<h2><?php  echo __('人経費詳細'); ?></h2>
	<dl>
		<dt><?php echo __('名前'); ?></dt>
		<dd>
			<?php echo h($humanCost['HumanCost']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('営業日'); ?></dt>
		<dd>
			<?php echo h($humanCost['HumanCost']['business_day']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('勤務時間'); ?></dt>
		<dd>
			<?php echo h(number_format($humanCost['HumanCost']['time'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('給料'); ?></dt>
		<dd>
			<?php echo h(number_format($humanCost['HumanCost']['salary'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('指名料'); ?></dt>
		<dd>
			<?php echo h(number_format($humanCost['HumanCost']['designate'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('登録日'); ?></dt>
		<dd>
			<?php echo h($humanCost['HumanCost']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('更新日'); ?></dt>
		<dd>
			<?php echo h($humanCost['HumanCost']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('人経費一覧'), array('action' => 'index', $humanCost['HumanCost']['staff_id'])); ?></li>
	</ul>
</div>
