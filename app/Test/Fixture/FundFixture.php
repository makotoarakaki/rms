<?php
/**
 * FundFixture
 *
 */
class FundFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'fund';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'fund' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 10),
		'stock' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 10),
		'reserve' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 10),
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
			'fund' => 1,
			'stock' => 1,
			'reserve' => 1,
			'created' => '2012-10-23 11:10:22',
			'modified' => '2012-10-23 11:10:22'
		),
	);

}
