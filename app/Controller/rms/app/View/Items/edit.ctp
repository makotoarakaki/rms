<div class="items form">
<?php echo $this->Form->create('Item'); ?>
	<fieldset>
		<legend><?php echo __('品目修正'); ?></legend>
	<?php
		echo $this->Form->input('main_item_id', array('type' => 'select', 'options' => $mainItemList, 'empty' => __('----', true), 'label' => '品目'));
		echo $this->Form->input('item_name', array('label' => '品目'));
		echo $this->Form->input('cost', array('label' => '仕入単価'));
		echo $this->Form->input('unit_price', array('label' => '売上単価'));
		echo $this->Form->radio('bunrui', 
			array(
			      0 => '仕入・売上',
			      1 => '仕入',
				  2 => '売上'
		    ),
			array(
				  'legend' => '分類'
		    ));
		echo $this->Form->label('原価なし');
		echo $this->Form->checkbox('no_cost');
	?>
	</fieldset>
<?php echo $this->Form->end(__('保存')); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('品目一覧'), array('action' => 'index')); ?></li>
    </ul>
</div>
