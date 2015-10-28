<div class="spreads index">
<?php echo $this->Form->create('Spread'); ?>
	<h2><?php echo __('集計'); ?></h2>
    <div class="seach">
    <hr />
	<table cellpadding="0" cellspacing="0">
    <h4><?php echo __('集計期間'); ?></h4>
    	<?php
		$option = array('value' => array('day' => date('d'), 'month' => date('m'), 'year' => date('Y')));
		echo $this->Form->dateTime(
				'from_date', 
				'YMD', 
				null, 
				array(
					'empty' => false,
					'minYear' => 2010,
					'maxYear' => date('Y'),
					'interval' => 0,
					'monthNames' => false,
					'separator' => ' / ',
					'default' => date('Y-M-D')
				)
		);
		?>&nbsp;&nbsp;～&nbsp;&nbsp;
        <?php
		echo $this->Form->dateTime(
				'to_date', 
				'YMD', 
				null, 
				array(
					'empty' => false,
					'minYear' => 2010,
					'maxYear' => date('Y'),
					'interval' => 0,
					'monthNames' => false,
					'separator' => ' / ',
					'default' => date('Y-M-D')
				)
		);
        ?>&nbsp;&nbsp;<?php echo $this->Form->postButton('集計', array('action' => 'index')); ?>
    </table>
    <hr />
    </div>
	<table border="1" cellpadding="0" cellspacing="0">
	<?php
	// 項目ID
	$main_id = 0;
	// 経費小計
	$supplier_sub_total = 0;
	// 売上小計
	$profitr_sub_total = 0;
	// 仕入合計
	$supplier_total = 0;
	// 売上合計
	$profitr_total = 0;
	// 粗利益
	$gross_margin = 0;
	
	foreach ($spreads as $spread):
    	if ($main_id != $spread['Spread']['main_item_id']) {
			if ($main_id != 0) { ?>
        <tr>
            <td class="bg2"><strong><?php echo __('小計'); ?></strong></td>
            <td class="nb2" colspan="2"><?php echo h(number_format($supplier_sub_total)); ?></td>
            <td class="nb2" colspan="2"><?php echo h(number_format($profitr_sub_total)); ?></td>
        </tr>
		<?php 
			}
			$supplier_total += $supplier_sub_total;
			$profitr_total += $profitr_sub_total;
			$supplier_sub_total = 0;
			$profitr_sub_total = 0
		?>
        <tr>
            <th class="bg1"><?php echo $this->Form->label($spread['Spread']['main_item_name']); ?></th>
            <th class="bg1"><?php echo __('経費数量'); ?></th>
            <th class="bg1"><?php echo __('経費合計'); ?></th>
            <th class="bg1"><?php echo __('売上数量'); ?></th>
            <th class="bg1"><?php echo __('売上合計'); ?></th>
        </tr>
    <?php 
		} 
	?>
        <tr>
        <tr>
            <td class="bg2"><?php echo h($spread['Spread']['item_name']); ?>&nbsp;</td>
            <td class="nb1"><?php echo h(number_format($spread['Spread']['supplier_count'])); ?>&nbsp;</td>
            <td class="nb1"><?php echo h(number_format($spread['Spread']['supplier_total'])); ?>&nbsp;</td>
            <td class="nb1"><?php echo h(number_format($spread['Spread']['profit_count'])); ?>&nbsp;</td>
            <td class="nb1"><?php echo h(number_format($spread['Spread']['profit_total'])); ?>&nbsp;</td>
        </tr>
<?php
		$supplier_sub_total += $spread['Spread']['supplier_total'];
		$profitr_sub_total += $spread['Spread']['profit_total'];
		$main_id = $spread['Spread']['main_item_id'];
	endforeach;
	$supplier_total += $supplier_sub_total;
	$profitr_total += $profitr_sub_total;
?>
        <tr>
        	<td class="bg2"><strong><?php echo __('小計'); ?></strong></td>
            <td class="nb2" colspan="2"><?php echo h(number_format($supplier_sub_total)); ?></td>
            <td class="nb2" colspan="2"><?php echo h(number_format($profitr_sub_total)); ?></td>
        </tr>
        <tr>
        </tr>
            <th class="bg1" colspan="5"><strong><?php echo __('人経費'); ?></strong></th>
        </tr>
        <tr>
        	<td class="bg2">　</td>
            <td class="nb2" colspan="2"><?php if(isset($salary)) { 
													echo h(number_format($salary));
													$supplier_total += $salary;
												} ?>
            </td>
            <td class="nb2" colspan="2"></td>
        </tr>
        <tr>
        	<td class="bg2"><strong><?php echo __('合計'); ?></strong></td>
            <td class="nb2" colspan="2"><?php echo h(number_format($supplier_total)); ?></td>
            <td class="nb2" colspan="2"><?php echo h(number_format($profitr_total)); ?></td>
        </tr>
<?php 
	// 粗利益 = 収益 - 費用
	$gross_margin = $profitr_total - $supplier_total;
?>
        <tr>
        	<td class="bg2"><strong><?php echo __('粗利益'); ?></strong></td>
            <td class="nb1" colspan="4"><?php echo h(number_format($gross_margin)); ?></td>
        </tr>
	</table>
</div>
<?php echo $this->Form->end(); ?>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('controller' => 'posts', 'action' => 'index')); ?></li>
	</ul>
</div>
