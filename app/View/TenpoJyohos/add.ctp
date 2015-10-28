<div class="tenpoJyohos form">
<?php echo $this->Form->create('TenpoJyoho'); ?>
	<fieldset>
		<legend><?php echo __('店舗情報登録'); ?></legend>
	<p>
	<?php
		echo $this->Form->input('tenpo_id', array('label'=>'店舗', 'type'=>'select', 'options'=> $tenpoIds, 'div'=>true));
	?>
	</p>
	<p>
	<?php
		echo $this->Form->input('zaseki_id', array('label'=>'座席', 'type'=>'select', 'multiple'=>'checkbox', 'options'=>$zasekiIds, 'div'=>true));
	?>
	</p>
	</fieldset>
<?php echo $this->Form->end(__('登録')); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('店舗情報一覧'), array('action' => 'index')); ?></li>
	</ul>
</div>
