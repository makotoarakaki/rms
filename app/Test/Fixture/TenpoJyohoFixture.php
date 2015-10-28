<?php
/**
 * TenpoJyohoFixture
 *
 */
class TenpoJyohoFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'tenpo_jyoho';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'tenpo_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'zaseki_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'tenpo_id' => array('column' => 'tenpo_id', 'unique' => 0),
			'zaseki_id' => array('column' => 'zaseki_id', 'unique' => 0)
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
			'tenpo_id' => 1,
			'zaseki_id' => 1,
			'created' => '2014-11-28 06:36:19',
			'modified' => '2014-11-28 06:36:19'
		),
	);

}
