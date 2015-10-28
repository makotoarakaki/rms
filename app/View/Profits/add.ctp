<div class="profits form">
<?php echo $this->Form->create('Profit'); ?>
	<fieldset>
		<legend><?php echo __('売上登録'); ?></legend>
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
	?>
    <div class="submit"><input  type="submit" name="add1" value="登録"/></div>
	<table cellpadding="0" cellspacing="0">
	<?php
	$main_id = 0;
	foreach ($profits as $key => $profit):
    	if ($main_id != $profit['main_item_id']) { ?>
        <tr>
            <th><?php echo $this->Form->label($profit['main_item_name']); ?></th>
        </tr>
    <?php 
		} 
	?>
        <tr>
            <td><?php echo $this->Form->input("{$key}.item_count" , array('label' => $profit['item_name'], 'style'=>'width:80px; height:15px;')); ?>
				<?php 
					if ($profit['no_cost'] == 1) {
						echo $this->Form->input("{$key}.total" , array('label' => '値段', 'div' => 'red', 'style'=>'width:80px; height:15px;'));
				?>
			<?php	} ?>
            </td>
        </tr>
        <?php echo $this->Form->input("{$key}.main_item_id", array('type' => 'hidden', 'value' => $profit['main_item_id'])); ?>
        <?php echo $this->Form->input("{$key}.main_item_name", array('type' => 'hidden', 'value' => $profit['main_item_name'])); ?>
        <?php echo $this->Form->hidden("{$key}.item_id", array('type' => 'hidden', 'value' => $profit['item_id'])); ?>
        <?php echo $this->Form->hidden("{$key}.item_name", array('type' => 'hidden', 'value' => $profit['item_name'])); ?>
        <?php echo $this->Form->hidden("{$key}.unit_price", array('type' => 'hidden', 'value' => $profit['unit_price'])); ?>
    <?php
    	$main_id = $profit['main_item_id'];
	endforeach; 
    ?>
	</table>
	</fieldset>
    <div class="submit"><input  type="submit" name="add2" value="登録"/></div>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('売上一覧'), array('action' => 'index')); ?></li>
	</ul>
</div>
