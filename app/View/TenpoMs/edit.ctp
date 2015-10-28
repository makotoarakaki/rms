<div class="tenpoMs form">
<?php echo $this->Form->create('TenpoM'); ?>
	<fieldset>
		<legend><?php echo __('店舗更新'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' => '名称'));
		
		echo $this->Form->label('開店時間');
		echo $this->Form->hour('kaiten_time', '24', array('empty' => false)). '時';
		echo $this->Form->minute('kaiten_time', array('empty' => false, 'interval' => 30)). '分';
		
		echo $this->Form->label('閉店時間');
		echo $this->Form->hour('heiten_time', '24', array('empty' => false)). '時';
		echo $this->Form->minute('heiten_time', array('empty' => false, 'interval' => 30)). '分';
		
		echo $this->Form->input('twenty_four_flg', array('label' => '24時間営業'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('更新')); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('店舗一覧'), array('action' => 'index')); ?></li>
	</ul>
</div>
