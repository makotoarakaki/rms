<div class="tenpoMs index">
	<h2><?php echo __('店舗一覧'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', '店舗ID'); ?></th>
			<th><?php echo $this->Paginator->sort('name', '名称'); ?></th>
			<th><?php echo $this->Paginator->sort('kaiten_time', '開店時間'); ?></th>
			<th><?php echo $this->Paginator->sort('heiten_time', '閉店時間'); ?></th>
			<th><?php echo $this->Paginator->sort('twenty_four_flg', '24時間営業'); ?></th>
			<th><?php echo $this->Paginator->sort('created', '登録日'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', '更新日'); ?></th>
			
	</tr>
	<?php
	foreach ($tenpoMs as $tenpoM): ?>
	<tr>
		<td><?php echo h($tenpoM['TenpoM']['id']); ?>&nbsp;</td>
		<td><?php echo h($tenpoM['TenpoM']['name']); ?>&nbsp;</td>
		<td><?php echo h($tenpoM['TenpoM']['kaiten_time']); ?>&nbsp;</td>
		<td><?php echo h($tenpoM['TenpoM']['heiten_time']); ?>&nbsp;</td>
		<td>
			<?php
			if($tenpoM['TenpoM']['twenty_four_flg'] == 1){
				echo '<font size=3px>○</font>';
			}else{
				echo '×';
			}
			?>
		</td>
		<td><?php echo h($tenpoM['TenpoM']['created']); ?>&nbsp;</td>
		<td><?php echo h($tenpoM['TenpoM']['modified']); ?>&nbsp;</td>
		<td class="actions">
			
			<?php echo $this->Html->link(__('修正'), array('action' => 'edit', $tenpoM['TenpoM']['id'])); ?>
			<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $tenpoM['TenpoM']['id']), null, __('削除してもよろしいですか?', $tenpoM['TenpoM']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('店舗登録'), array('action' => 'add')); ?></li>
	</ul>
</div>
