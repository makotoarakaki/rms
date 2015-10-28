<div class="yoyakuJyohos form">
<?php echo $this->Form->create('YoyakuJyoho'); ?>
	<fieldset>
		<legend><?php echo __('予約情報更新'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tenpo_name', array('label'=>'店舗', 'type'=>'select', 'options'=> $ary_tenpos, 'div'=>true));
		
		echo $this->Form->input('user_name', array('label' => 'お客様名'));
		echo $this->Form->input('renrakusaki', array('label' => '連絡先'));
		
		echo $this->Form->label('来店日');
		echo $this->DatePicker->datepicker('yoyaku_day', array('type' => 'text', 'label' => false, 'readonly' => true));
		
		echo $this->Form->label('来店時間');
		echo $this->Form->hour('raiten_time', '24', array('empty' => false)). '時';
		echo $this->Form->minute('raiten_time', array('empty' => false, 'interval' => 30)). '分';
		
		echo $this->Form->label('退店時間');
		echo $this->Form->hour('taiten_time', '24', array('empty' => false)). '時';
		echo $this->Form->minute('taiten_time', array('empty' => false, 'interval' => 30)). '分';
		
		echo $this->Form->input('ninzu', array('label'=>'人数', 'after'=>'名様'));
		echo $this->Form->input('zaseki', array('label'=>'座席', 'type'=>'select', 'multiple'=>'checkbox', 'options'=>$ary_zasekis, 'div'=>true));
		echo $this->Form->input('yoyaku_code', array('label'=>'予約コード', 'type'=>'select', 'multiple'=>'checkbox', 'options'=>$ary_yoyaku_cds, 'div'=>true));
		echo $this->Form->input('yoyaku_note', array('label' => '予約ノート'));
		echo $this->Form->input('gesuto_code', array('label'=>'ゲストコード', 'type'=>'select', 'multiple'=>'checkbox', 'options'=>$ary_gesuto_cds, 'div'=>true));
		echo $this->Form->input('gesuto_note', array('label' => 'ゲストノート'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('更 新')); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('予約情報一覧'), array('action' => 'index')); ?></li>
	</ul>
</div>
