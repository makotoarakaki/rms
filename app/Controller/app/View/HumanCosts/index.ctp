<div class="humanCosts index">
	<h2><?php echo __('人経費一覧');?></h2><br />
	<h3><?php echo __($staff['Staff']['name']);?></h3>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('business_day', '営業日'); ?></th>
			<th><?php echo $this->Paginator->sort('hourly_wage', '時給'); ?></th>
			<th><?php echo $this->Paginator->sort('time', '勤務時間'); ?></th>
			<th><?php echo $this->Paginator->sort('salary', '給料'); ?></th>
			<th><?php echo $this->Paginator->sort('designate', '指名料'); ?></th>
			<th><?php echo $this->Paginator->sort('created', '登録日'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', '更新日'); ?></th>
	</tr>
	<?php
	foreach ($humanCosts as $humanCost): ?>
	<tr>
		<td><?php echo h($humanCost['HumanCost']['business_day']); ?>&nbsp;</td>
		<td><?php echo h(number_format($humanCost['Staff']['hourly_wage'])); ?>&nbsp;</td>
		<td><?php echo h($humanCost['HumanCost']['time']); ?>&nbsp;</td>
		<td><?php echo h(number_format($humanCost['HumanCost']['salary'])); ?>&nbsp;</td>
		<td><?php echo h($humanCost['HumanCost']['designate']); ?>&nbsp;</td>
		<td><?php echo h($humanCost['HumanCost']['created']); ?>&nbsp;</td>
		<td><?php echo h($humanCost['HumanCost']['modified']); ?>&nbsp;</td>
    <?php if ($_SESSION['role'] == 'admin') { ?>
		<td class="actions">
			<?php echo $this->Html->link(__('詳細'), array('action' => 'view', $humanCost['HumanCost']['id'])); ?>
			<?php echo $this->Html->link(__('修正'), array('action' => 'edit', $humanCost['HumanCost']['id'])); ?>
			<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $humanCost['HumanCost']['id']), null, __('削除してもよろしいですか?', $humanCost['HumanCost']['id'])); ?>
		</td>
    <?php } ?>
	</tr>
<?php endforeach; ?>
	</table>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('前へ'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('次へ') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('スタッフ一覧'), array('controller' => 'Staffs', 'action' => 'index')); ?></li>
	</ul>
    <?php if ($_SESSION['role'] == 'admin') { ?>
	<ul>
		<li><?php echo $this->Html->link(__('人経費登録'), array('action' => 'add', $staff['Staff']['id'])); ?></li>
	</ul>
    <?php } ?>
</div>
