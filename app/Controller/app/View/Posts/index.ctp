<div class="users index">
<?php echo $this->Form->create('Post'); ?>
	<h2><?php echo __('トップ'); ?></h2>
    <div class="seach">
    <hr />
	<table cellpadding="0" cellspacing="0">
    <h4><?php echo __('メール送信'); ?></h4>
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
        ?>&nbsp;&nbsp;<?php echo $this->Form->postButton('送信', array('action' => 'index')); ?>
    </table>
    <hr />
    </div>
	<table cellpadding="0" cellspacing="0">
    <?php foreach ($posts as $post): ?>
		<?php echo $post['Post']['id']; ?>
    <?php endforeach; ?>
	</table>
	<p>
</div>
<?php echo $this->Form->end(); ?>
<div class="actions">
	<h4><?php echo __('ホーム'); ?></h4>
    <hr />
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('action' => 'index')); ?></li>
	</ul>
	<h4><?php echo __('勘定業務'); ?></h4>
    <hr />
	<ul>
		<li><?php echo $this->Html->link(__('経費管理'), array('controller' => 'Suppliers', 'action' => 'index')); ?> </li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('売上管理'), array('controller' => 'Profits', 'action' => 'index')); ?> </li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('スタッフ管理'), array('controller' => 'Staffs', 'action' => 'index')); ?> </li>
	</ul>
	<h4><?php echo __('損益計算表'); ?></h4>
    <hr />
	<ul>
		<li><?php echo $this->Html->link(__('集計'), array('controller' => 'Spreads', 'action' => 'index')); ?> </li>
	</ul>
    <?php if ($_SESSION['role'] == 'admin') { ?>
        <h4><?php echo __('マスター管理'); ?></h4>
        <hr />
        <ul>
            <li><?php echo $this->Html->link(__('項目管理'), array('controller' => 'MainItems', 'action' => 'index')); ?> </li>
        </ul>
        <ul>
            <li><?php echo $this->Html->link(__('品目管理'), array('controller' => 'Items', 'action' => 'index')); ?> </li>
        </ul>
        <ul>
            <li><?php echo $this->Html->link(__('予算管理'), array('controller' => 'Funds', 'action' => 'index')); ?> </li>
        </ul>
        <h4><?php echo __('ユーザー管理'); ?></h4>
        <hr />
        <ul>
            <li><?php echo $this->Html->link(__('ユーザー管理'), array('controller' => 'users', 'action' => 'index')); ?></li>
        </ul>
        <br />
    <?php } ?>
</div>
