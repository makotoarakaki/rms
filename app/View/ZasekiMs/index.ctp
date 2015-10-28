<div class="zasekiMs index">
	<h2><?php echo __('座席一覧'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', '座席ID'); ?></th>
			<th><?php echo $this->Paginator->sort('name', '名称'); ?></th>
			<th><?php echo $this->Paginator->sort('teiin', '定員'); ?></th>
			<th><?php echo $this->Paginator->sort('created', '登録日'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', '更新日'); ?></th>

	</tr>
	<?php
	foreach ($zasekiMs as $zasekiM): ?>
	<tr>
		<td><?php echo h($zasekiM['ZasekiM']['id']); ?>&nbsp;</td>
		<td><?php echo h($zasekiM['ZasekiM']['name']); ?>&nbsp;</td>
		<td><?php echo h($zasekiM['ZasekiM']['teiin']); ?>&nbsp;</td>
		<td><?php echo h($zasekiM['ZasekiM']['created']); ?>&nbsp;</td>
		<td><?php echo h($zasekiM['ZasekiM']['modified']); ?>&nbsp;</td>
		<td class="actions">
			
			<?php echo $this->Html->link(__('修正'), array('action' => 'edit', $zasekiM['ZasekiM']['id'])); ?>
			<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $zasekiM['ZasekiM']['id']), null, __('削除してもよろしいですか?', $zasekiM['ZasekiM']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

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
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('座席登録'), array('action' => 'add')); ?></li>
	</ul>
</div>
