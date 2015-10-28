<div class="suppliers view">
<h2><?php  echo __('経費詳細'); ?></h2>
	<dl>
		<dt><?php echo __('営業日'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['business_day']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('項目'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['main_item_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('品目'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['item_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('数量'); ?></dt>
		<dd>
			<?php echo h(number_format($supplier['Supplier']['item_count'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('合計'); ?></dt>
		<dd>
			<?php echo h(number_format($supplier['Supplier']['total'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('登録日'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('更新日'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('仕入一覧'), array('action' => 'index')); ?></li>
	</ul>
</div>
