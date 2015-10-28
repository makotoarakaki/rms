<div class="suppliers form">
<?php echo $this->Form->create('Supplier'); ?>
	<fieldset>
		<legend><?php echo __('経費修正'); ?></legend>
		<h4><?php echo $this->Form->label($this->data['Supplier']['main_item_name'].' -> '.$this->data['Supplier']['item_name']); ?></h4>
	<?php
		echo $this->Form->input('business_day', array(
								'label' => __('営業日', true),
								'timeFormat' => '24',
								'dateFormat' => 'YMD',
								'monthNames' => false,
								'empty' => false,
								'separator' => '/',
								'maxYear' => date('Y'),
		));	
		echo $this->Form->input('item_count', array('label' => '数量'));
		if($this->data['Item']['no_cost'] == 1) {
			echo $this->Form->input('total', array('label' => '合計'));
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('保存')); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('経費一覧'), array('action' => 'index')); ?></li>
	</ul>
</div>
