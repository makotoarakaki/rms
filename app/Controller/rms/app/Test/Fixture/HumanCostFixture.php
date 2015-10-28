<?php
/**
 * HumanCostFixture
 *
 */
class HumanCostFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'business_day' => array('type' => 'date', 'null' => true, 'default' => null),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'time' => array('type' => 'integer', 'null' => true, 'default' => null),
		'designate' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'business_day' => '2012-11-13',
			'name' => 'Lorem ipsum dolor sit amet',
			'time' => 1,
			'designate' => 1,
			'created' => '2012-11-13 08:26:17',
			'modified' => '2012-11-13 08:26:17'
		),
	);

}
