<?php
/**
 * YoyakuJyohoFixture
 *
 */
class YoyakuJyohoFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'yoyaku_jyoho';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'user_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'renrakusaki' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'yoyaku_day' => array('type' => 'date', 'null' => true, 'default' => null),
		'raiten_time' => array('type' => 'time', 'null' => true, 'default' => null),
		'taiten_time' => array('type' => 'time', 'null' => true, 'default' => null),
		'ninzu' => array('type' => 'integer', 'null' => true, 'default' => null),
		'zaseki' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'yoyaku_code' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'yoyaku_note' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'gesuto_code' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'gesuto_note' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'user_name' => 'Lorem ipsum dolor sit amet',
			'renrakusaki' => 'Lorem ipsum dolor sit amet',
			'yoyaku_day' => '2014-11-18',
			'raiten_time' => '04:52:52',
			'taiten_time' => '04:52:52',
			'ninzu' => 1,
			'zaseki' => 'Lorem ipsum dolor sit amet',
			'yoyaku_code' => 'Lorem ipsum dolor sit amet',
			'yoyaku_note' => 'Lorem ipsum dolor sit amet',
			'gesuto_code' => 'Lorem ipsum dolor sit amet',
			'gesuto_note' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-11-18 04:52:52',
			'modified' => '2014-11-18 04:52:52'
		),
	);

}
