<?php
App::uses('AppModel', 'Model');
/**
 * HumanCost Model
 *
 */
class HumanCost extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';
	public $validate = array(
		'time' => array(
				'numeric' => array(
						'rule' => 'numeric',
						'allowEmpty' => true,
						'message' => '勤務時間は半角数字を入力して下さい。'
				),
				'maxLength' => array(
						'rule' => array('maxLength', '10'),
						'allowEmpty' => true,
						'message' => "勤務時間は10桁以内で入力してください。",
				)
		),
		'salary' => array(
				'numeric' => array(
						'rule' => 'numeric',
						'allowEmpty' => true,
						'message' => '給料は半角数字を入力して下さい。'
				),
				'maxLength' => array(
						'rule' => array('maxLength', '10'),
						'allowEmpty' => true,
						'message' => "給料は10桁以内で入力してください。",
				)
		),
		'designate' => array(
				'numeric' => array(
						'rule' => 'numeric',
						'allowEmpty' => true,
						'message' => '指名料は半角数字を入力して下さい。'
				),
				'maxLength' => array(
						'rule' => array('maxLength', '10'),
						'allowEmpty' => true,
						'message' => "指名料は10桁以内で入力してください。",
				)
		)
	);

}
