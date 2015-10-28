<div class="staffs form">
<?php echo $this->Form->create('Staff'); ?>
	<fieldset>
		<legend><?php echo __('スタッフ修正'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => '名前'));
		echo $this->Form->input('hourly_wage', array('label' => '時給'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('保存')); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('スタッフ一覧'), array('action' => 'index')); ?></li>
    </ul>
</div>
