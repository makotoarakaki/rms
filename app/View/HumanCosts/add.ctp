<div class="humanCosts form">
<?php echo $this->Form->create('HumanCost'); ?>
	<fieldset>
		<legend><?php echo __('人件費登録'); ?></legend><br />
		<h3><?php echo $this->Form->label($staff['Staff']['name']); ?></h3>
	<?php
		echo $this->Form->input('business_day', array(
								'label' => __('営業日', true),
								'default' => date('Y-M-D'),
								'timeFormat' => '24',
								'dateFormat' => 'YMD',
								'monthNames' => false,
								'empty' => false,
								'separator' => '/',
								'maxYear' => date('Y'),
		));	
		echo $this->Form->input('time', array('label' => '勤務時間'));
		echo $this->Form->input('designate', array('label' => '指名料'));
        echo $this->Form->hidden('staff_id', array('type' => 'hidden', 'value' => $staff['Staff']['id']));
        echo $this->Form->hidden('name', array('type' => 'hidden', 'value' => $staff['Staff']['name']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('登録')); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('人件費一覧'), array('action' => 'index', $staff['Staff']['id'])); ?></li>
	</ul>
</div>
