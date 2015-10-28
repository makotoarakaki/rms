<div class="mainItems index">
	<h2><?php echo __('項目一覧'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('main_item_name', '項目'); ?></th>
			<th><?php echo $this->Paginator->sort('created', '登録日'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', '更新日'); ?></th>
	</tr>
	<?php
	foreach ($mainItems as $mainItem): ?>
	<tr>
		<td><?php echo h($mainItem['MainItem']['main_item_name']); ?>&nbsp;</td>
		<td><?php echo h($mainItem['MainItem']['created']); ?>&nbsp;</td>
		<td><?php echo h($mainItem['MainItem']['modified']); ?>&nbsp;</td>
    <?php if ($_SESSION['role'] == 'admin') { ?>
		<td class="actions">
			<?php echo $this->Html->link(__('修正'), array('action' => 'edit', $mainItem['MainItem']['id'])); ?>
			<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $mainItem['MainItem']['id']), null, __('削除してもよろしいですか?', $mainItem['MainItem']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
    <?php if ($_SESSION['role'] == 'admin') { ?>
	<ul>
		<li><?php echo $this->Html->link(__('項目追加'), array('action' => 'add')); ?></li>
	</ul>
    <?php } ?>
</div>
