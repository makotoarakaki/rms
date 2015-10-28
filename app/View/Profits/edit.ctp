<div class="profits form">
<?php echo $this->Form->create('Profit'); ?>
	<fieldset>
		<legend><?php echo __('売上修正'); ?></legend>
		<h4><?php echo $this->Form->label($this->data['Profit']['main_item_name'].' -> '.$this->data['Profit']['item_name']); ?></h4>
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
		<li><?php echo $this->Html->link(__('売上一覧'), array('action' => 'index')); ?></li>
	</ul>
</div>
