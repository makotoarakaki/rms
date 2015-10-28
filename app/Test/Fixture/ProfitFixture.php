<?php
/**
 * ProfitFixture
 *
 */
class ProfitFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'profit';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'main_item_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'item_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'item_count' => array('type' => 'integer', 'null' => true, 'default' => null),
		'total' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 10),
		'business_day' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'main_item_id' => 1,
			'item_id' => 1,
			'item_count' => 1,
			'total' => 1,
			'business_day' => '2012-10-23 11:11:33',
			'created' => '2012-10-23 11:11:33',
			'modified' => '2012-10-23 11:11:33'
		),
	);

}
