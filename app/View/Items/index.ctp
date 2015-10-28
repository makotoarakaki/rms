<div class="items index">
	<h2><?php echo __('品目一覧'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('main_item_id', '項目'); ?></th>
			<th><?php echo $this->Paginator->sort('item_name', '品目'); ?></th>
			<th><?php echo $this->Paginator->sort('cost', '原価'); ?></th>
			<th><?php echo $this->Paginator->sort('unit_price', '単価'); ?></th>
			<th><?php echo $this->Paginator->sort('tax', '消費税'); ?></th>
			<th><?php echo $this->Paginator->sort('created', '登録日'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', '更新日'); ?></th>
	</tr>
	<?php
	foreach ($items as $item): ?>
	<tr>
		<td><?php echo h($item['Main']['main_item_name']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['item_name']); ?>&nbsp;</td>
		<td><?php echo h(number_format($item['Item']['cost'])); ?>&nbsp;</td>
		<td><?php echo h(number_format($item['Item']['unit_price'])); ?>&nbsp;</td>
		<td><?php echo h(number_format($item['Item']['tax'])); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['created']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['modified']); ?>&nbsp;</td>
    <?php if ($_SESSION['role'] == 'admin') { ?>
		<td class="actions">
			<?php echo $this->Html->link(__('修正'), array('action' => 'edit', $item['Item']['id'])); ?>
			<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $item['Item']['id']), null, __('削除してもよろしいですか?', $item['Item']['id'])); ?>
		</td>
    <?php } ?>
	</tr>
<?php endforeach; ?>
	</table>

<?php /*?>	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('前へ'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('次へ') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
<?php */?></div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
    <?php if ($_SESSION['role'] == 'admin') { ?>
	<ul>
		<li><?php echo $this->Html->link(__('品目追加'), array('action' => 'add')); ?></li>
	</ul>
    <?php } ?>
</div>
