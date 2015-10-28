<?php
App::uses('AppModel', 'Model');
/**
 * Fund Model
 *
 */
class Fund extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'fund';
    public $validate = array(
        'fund' => array(
            'numeric' => array(
                'rule' => 'numeric',
				'allowEmpty' => true,
                'message' => '資金は半角数字を入力して下さい。'
            ),
			'maxLength' => array(
				'rule' => array('maxLength', '10'),
				'allowEmpty' => true,
				'message' => "資金は10桁以内で入力してください。",
        	)
        ),
        'stock' => array(
            'numeric' => array(
                'rule' => 'numeric',
				'allowEmpty' => true,
                'message' => 'ストックは半角数字を入力して下さい。'
            ),
			'maxLength' => array(
				'rule' => array('maxLength', '10'),
				'allowEmpty' => true,
				'message' => "ストックは10桁以内で入力してください。",
        	)
        ),
        'reserve' => array(
            'numeric' => array(
                'rule' => 'numeric',
				'allowEmpty' => true,
                'message' => '積立は半角数字を入力して下さい。'
            ),
			'maxLength' => array(
				'rule' => array('maxLength', '10'),
				'allowEmpty' => true,
				'message' => "積立は10桁以内で入力してください。",
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
