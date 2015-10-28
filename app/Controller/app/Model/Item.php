<?php
App::uses('AppModel', 'Model');
/**
 * Item Model
 *
 */
class Item extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'item';
    public $validate = array(
        'main_item_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => '品目は必須入力です。'
            )
        ),
    	'cost' => array(
            'numeric' => array(
                'rule' => 'numeric',
				'allowEmpty' => true,
                'message' => '原価は半角数字を入力して下さい。'
            ),
			'maxLength' => array(
				'rule' => array('maxLength', '10'),
				'allowEmpty' => true,
				'message' => "原価は10桁以内で入力してください。",
        	)
        ),
        'unit_price' => array(
            'numeric' => array(
                'rule' => 'numeric',
				'allowEmpty' => true,
                'message' => '単価は半角数字を入力して下さい。'
            ),
			'maxLength' => array(
				'rule' => array('maxLength', '10'),
				'allowEmpty' => true,
				'message' => "単価は10桁以内で入力してください。",
        	)
        )
    );

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

}
