<div class="tenpoJyohos index">
	<h2><?php echo __('店舗情報一覧'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
			<th><?php echo $this->Paginator->sort('tenpo_id', '店舗名'); ?></th>
			<th><?php echo $this->Paginator->sort('zaseki_id', '座席'); ?></th>
			<th><?php echo $this->Paginator->sort('created', '登録日時'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', '更新日時'); ?></th>
	</tr>
	<?php
	foreach ($tenpoJyohos as $tenpoJyoho): ?>
	<tr>
		<td><?php echo h($tenpoJyoho['TenpoJyoho']['id']); ?>&nbsp;</td>
		<td>
			<?php
			foreach($ary_tenpos as $key => $value){
				if($key == $tenpoJyoho['TenpoJyoho']['tenpo_id']){
					echo h($value). '&nbsp;';
				}
			}
			?>
		</td>
		<td>
			<?php
			foreach($ary_zasekis as $key => $value){
				if($key == $tenpoJyoho['TenpoJyoho']['zaseki_id']){
					echo h($value). '&nbsp;';
				}
			}
			?>
		</td>
		<td><?php echo h($tenpoJyoho['TenpoJyoho']['created']); ?>&nbsp;</td>
		<td><?php echo h($tenpoJyoho['TenpoJyoho']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('修正'), array('action' => 'edit', $tenpoJyoho['TenpoJyoho']['id'])); ?>
			<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $tenpoJyoho['TenpoJyoho']['id']), null, __('削除してもよろしいですか?', $tenpoJyoho['TenpoJyoho']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('店舗情報登録'), array('action' => 'add')); ?></li>
	</ul>
</div>
