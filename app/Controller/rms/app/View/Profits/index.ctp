<div class="profits index">
<?php echo $this->Form->create('Profit'); ?>
	<h2><?php echo __('売上一覧'); ?></h2>
    <div class="seach">
    <hr />
	<table cellpadding="0" cellspacing="0">
    <h4><?php echo __('営業日'); ?></h4>
    	<?php
		$option = array('value' => array('day' => date('d'), 'month' => date('m'), 'year' => date('Y')));
		echo $this->Form->dateTime(
				'business_day', 
				'YMD', 
				null, 
				array(
					'empty' => false,
					'minYear' => 2010,
					'maxYear' => date('Y'),
					'interval' => 0,
					'monthNames' => false,
					'separator' => ' / ',
					'default' => date('Y-M-D')
				)
		);
        ?>&nbsp;&nbsp;<?php echo $this->Form->postButton('検索', array('action' => 'index')); ?>
    </table>
    <hr />
    </div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('business_day', '営業日'); ?></th>
			<th><?php echo $this->Paginator->sort('main_item_id', '項目'); ?></th>
			<th><?php echo $this->Paginator->sort('item_id', '品目'); ?></th>
			<th><?php echo $this->Paginator->sort('item_count', '数量'); ?></th>
			<th><?php echo $this->Paginator->sort('total', '合計'); ?></th>
			<th><?php echo $this->Paginator->sort('created', '登録日'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', '更新日'); ?></th>
	</tr>
	<?php
	foreach ($profits as $profit): ?>
	<tr>
		<td><?php echo h($profit['Profit']['business_day']); ?>&nbsp;</td>
		<td><?php echo h($profit['Profit']['main_item_name']); ?>&nbsp;</td>
		<td><?php echo h($profit['Profit']['item_name']); ?>&nbsp;</td>
		<td><?php echo h(number_format($profit['Profit']['item_count'])); ?>&nbsp;</td>
		<td><?php echo h(number_format($profit['Profit']['total'])); ?>&nbsp;</td>
		<td><?php echo h($profit['Profit']['created']); ?>&nbsp;</td>
		<td><?php echo h($profit['Profit']['modified']); ?>&nbsp;</td>
    <?php if ($_SESSION['role'] == 'admin') { ?>
		<td class="actions">
			<?php echo $this->Html->link(__('詳細'), array('action' => 'view', $profit['Profit']['id'])); ?>
			<?php echo $this->Html->link(__('修正'), array('action' => 'edit', $profit['Profit']['id'], $profit['Profit']['item_id'])); ?>
			<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $profit['Profit']['id']), null, __('削除してもよろしいですか?', $profit['Profit']['id'])); ?>
		</td>
    <?php } ?>
	</tr>
<?php endforeach; ?>
	</table>

</div>
<?php echo $this->Form->end(); ?>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
    <?php if ($_SESSION['role'] == 'admin' && empty($profits)) { ?>
	<ul>
		<li><?php echo $this->Html->link(__('売上登録'), array('action' => 'add')); ?></li>
	</ul>
    <?php } ?>
</div>
