<div class="yoyakuJyohos index">
	<h2><?php echo __('予約情報一覧'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Paginator->sort('id', '予約ID'); ?></th>
		<th><?php echo $this->Paginator->sort('user_name', 'お客様名'); ?></th>
		<th><?php echo $this->Paginator->sort('renrakusaki', '連絡先'); ?></th>
		<th><?php echo $this->Paginator->sort('yoyaku_day', '予約日'); ?></th>
		<th><?php echo $this->Paginator->sort('raiten_time', '来店時間'); ?></th>
		<th><?php echo $this->Paginator->sort('taiten_time', '退店時間'); ?></th>
		<th><?php echo $this->Paginator->sort('ninzu', '人数'); ?></th>
		<th><?php echo $this->Paginator->sort('tenpo_name', '店舗'); ?></th>
		<th><?php echo $this->Paginator->sort('zaseki', '座席'); ?></th>
		<th><?php echo $this->Paginator->sort('yoyaku_code', '予約コード'); ?></th>
		<th><?php echo $this->Paginator->sort('yoyaku_note', '予約ノート'); ?></th>
		<th><?php echo $this->Paginator->sort('gesuto_code', 'ゲストコード'); ?></th>
		<th><?php echo $this->Paginator->sort('gesuto_note', 'ゲストノート'); ?></th>
		<th><?php echo $this->Paginator->sort('created', '登録日'); ?></th>
		<th><?php echo $this->Paginator->sort('modified', '更新日'); ?></th>
	</tr>
	<?php
	foreach ($yoyakuJyohos as $yoyakuJyoho): ?>
	<tr>
		<td><?php echo h($yoyakuJyoho['YoyakuJyoho']['id']); ?>&nbsp;</td>
		<td><?php echo h($yoyakuJyoho['YoyakuJyoho']['user_name']); ?>&nbsp;</td>
		<td><?php echo h($yoyakuJyoho['YoyakuJyoho']['renrakusaki']); ?>&nbsp;</td>
		<td><?php echo h($yoyakuJyoho['YoyakuJyoho']['yoyaku_day']); ?>&nbsp;</td>
		<td><?php echo h($yoyakuJyoho['YoyakuJyoho']['raiten_time']); ?>&nbsp;</td>
		<td><?php echo h($yoyakuJyoho['YoyakuJyoho']['taiten_time']); ?>&nbsp;</td>
		<td><?php echo h($yoyakuJyoho['YoyakuJyoho']['ninzu']); ?>&nbsp;</td>
		<td><?php echo h($yoyakuJyoho['YoyakuJyoho']['tenpo_name']); ?>&nbsp;</td>
		<td><?php echo h($yoyakuJyoho['YoyakuJyoho']['zaseki']); ?>&nbsp;</td>
		<td><?php echo h($yoyakuJyoho['YoyakuJyoho']['yoyaku_code']); ?>&nbsp;</td>
		<td><?php echo h($yoyakuJyoho['YoyakuJyoho']['yoyaku_note']); ?>&nbsp;</td>
		<td><?php echo h($yoyakuJyoho['YoyakuJyoho']['gesuto_code']); ?>&nbsp;</td>
		<td><?php echo h($yoyakuJyoho['YoyakuJyoho']['gesuto_note']); ?>&nbsp;</td>
		<td><?php echo h($yoyakuJyoho['YoyakuJyoho']['created']); ?>&nbsp;</td>
		<td><?php echo h($yoyakuJyoho['YoyakuJyoho']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('修正'), array('action' => 'edit', $yoyakuJyoho['YoyakuJyoho']['id'])); ?>
			<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $yoyakuJyoho['YoyakuJyoho']['id']), null, __('削除してもよろしいですか?', $yoyakuJyoho['YoyakuJyoho']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('予約情報登録'), array('action' => 'add')); ?></li>
	</ul>
	
</div>
