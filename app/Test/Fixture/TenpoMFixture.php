<?php
/**
 * TenpoMFixture
 *
 */
class TenpoMFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'tenpo_m';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'kaiten_time' => array('type' => 'time', 'null' => true, 'default' => null),
		'heiten_time' => array('type' => 'time', 'null' => true, 'default' => null),
		'twenty_four_flg' => array('type' => 'boolean', 'null' => false, 'default' => null),
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
			'name' => 'Lorem ipsum dolor sit amet',
			'kaiten_time' => '00:41:09',
			'heiten_time' => '00:41:09',
			'twenty_four_flg' => 1,
			'created' => '2014-11-27 00:41:09',
			'modified' => '2014-11-27 00:41:09'
		),
	);

}
