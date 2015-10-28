<div class="yoyakucdMs index">
	<h2><?php echo __('予約コード一覧'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', '予約コードID'); ?></th>
			<th><?php echo $this->Paginator->sort('name', '名称'); ?></th>
			<th><?php echo $this->Paginator->sort('created', '登録日'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', '更新日'); ?></th>

	</tr>
	<?php
	foreach ($yoyakucdMs as $yoyakucdM): ?>
	<tr>
		<td><?php echo h($yoyakucdM['YoyakucdM']['id']); ?>&nbsp;</td>
		<td><?php echo h($yoyakucdM['YoyakucdM']['name']); ?>&nbsp;</td>
		<td><?php echo h($yoyakucdM['YoyakucdM']['created']); ?>&nbsp;</td>
		<td><?php echo h($yoyakucdM['YoyakucdM']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('修正'), array('action' => 'edit', $yoyakucdM['YoyakucdM']['id'])); ?>
			<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $yoyakucdM['YoyakucdM']['id']), null, __('削除してもよろしいですか?', $yoyakucdM['YoyakucdM']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('予約コード登録'), array('action' => 'add')); ?></li>
	</ul>
</div>
