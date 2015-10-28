<div class="funds index">
	<h2><?php echo __('資金一覧'); ?></h2>
    <div class="seach">
    <hr />
	<table cellpadding="0" cellspacing="0">
    <h4><?php echo __('最新値へ更新'); ?></h4>
        <?php echo $this->Form->postButton('更新', array('action' => 'index')); ?>
    </table>
    <hr />
    </div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('fund', '資金'); ?></th>
			<th><?php echo $this->Paginator->sort('reserve', '積立'); ?></th>
			<th><?php echo $this->Paginator->sort('created', '登録日'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', '更新日'); ?></th>
	</tr>
	<?php
	foreach ($funds as $fund): ?>
	<tr>
		<td><?php echo h(number_format($fund['Fund']['fund'])); ?>&nbsp;</td>
		<td><?php echo h(number_format($fund['Fund']['reserve'])); ?>&nbsp;</td>
		<td><?php echo h($fund['Fund']['created']); ?>&nbsp;</td>
		<td><?php echo h($fund['Fund']['modified']); ?>&nbsp;</td>
    <?php if ($_SESSION['role'] == 'admin') { ?>
		<td class="actions">
			<?php echo $this->Html->link(__('修正'), array('action' => 'edit', $fund['Fund']['id'])); ?>
			<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $fund['Fund']['id']), null, __('削除してもよろしいですか?', $fund['Fund']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('予算追加'), array('action' => 'add')); ?></li>
	</ul>
    <?php } ?>
</div>
