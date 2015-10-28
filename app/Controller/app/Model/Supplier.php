<?php
App::uses('AppModel', 'Model');
/**
 * Supplier Model
 *
 * @property MainItem $MainItem
 * @property Item $Item
 */
class Supplier extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'supplier';
	public $validate = array(
		'item_count' => array(
				'numeric' => array(
						'rule' => 'numeric',
						'allowEmpty' => true,
						'message' => '数量は半角数字を入力して下さい。'
				),
				'maxLength' => array(
						'rule' => array('maxLength', '10'),
						'allowEmpty' => true,
						'message' => "数量は10桁以内で入力してください。",
				)
		)
	);

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'MainItem' => array(
			'className' => 'MainItem',
			'foreignKey' => 'main_item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
