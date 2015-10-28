<div class="humanCosts form">
<?php echo $this->Form->create('HumanCost'); ?>
	<fieldset>
		<legend><?php echo __('人経費修正'); ?></legend>
		<h3><?php echo $this->Form->label($humanCost['HumanCost']['name']); ?></h3>
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
		echo $this->Form->input('time', array('label' => '勤務時間'));
		echo $this->Form->input('salary', array('label' => '給料'));
		echo $this->Form->input('designate', array('label' => '指名料'));
        echo $this->Form->input('staff_id', array('type' => 'hidden', 'value' => $humanCost['HumanCost']['staff_id']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('保存'), $humanCost['HumanCost']['staff_id']); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('人経費一覧'), array('action' => 'index', $humanCost['HumanCost']['staff_id'])); ?></li>
	</ul>
</div>
