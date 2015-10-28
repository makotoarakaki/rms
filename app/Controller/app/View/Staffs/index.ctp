<div class="staffs index">
	<h2><?php echo __('スタッフ一覧'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
    		<td width="60"></td>
			<th><?php echo $this->Paginator->sort('name', '名前'); ?></th>
			<th><?php echo $this->Paginator->sort('hourly_wage', '時給'); ?></th>
			<th><?php echo $this->Paginator->sort('created', '登録日'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', '更新日'); ?></th>
	</tr>
	<?php
	foreach ($staffs as $staff): ?>
	<tr>
		<td class="actions">
			<?php echo $this->Html->link(__('人経費管理'), array('controller' => 'HumanCosts', 'action' => 'index' , $staff['Staff']['id'])); ?>
		</td>
		<td><?php echo h($staff['Staff']['name']); ?>&nbsp;</td>
		<td><?php echo h(number_format($staff['Staff']['hourly_wage'])); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['created']); ?>&nbsp;</td>
		<td><?php echo h($staff['Staff']['modified']); ?>&nbsp;</td>
    <?php if ($_SESSION['role'] == 'admin') { ?>
		<td class="actions">
			<?php echo $this->Html->link(__('詳細'), array('action' => 'view', $staff['Staff']['id'])); ?>
			<?php echo $this->Html->link(__('修正'), array('action' => 'edit', $staff['Staff']['id'])); ?>
			<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $staff['Staff']['id']), null, __('削除します。よろしいですか?', $staff['Staff']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('スタッフ情報登録'), array('action' => 'add')); ?></li>
	</ul>
    <?php } ?>
</div>
