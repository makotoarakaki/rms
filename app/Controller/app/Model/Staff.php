<?php
App::uses('AppModel', 'Model');
/**
 * Staff Model
 *
 */
class Staff extends AppModel {

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'id';

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'staff';
	public $validate = array(
		'hourly_wage' => array(
				'numeric' => array(
						'rule' => 'numeric',
						'allowEmpty' => true,
						'message' => '時給は半角数字を入力して下さい。'
				),
				'maxLength' => array(
						'rule' => array('maxLength', '10'),
						'allowEmpty' => true,
						'message' => "時給は10桁以内で入力してください。",
				)
		)
	);
}
