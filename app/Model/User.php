<?php
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Group $Group
 * @property Post $Post
 */
class User extends AppModel {

    public $name = 'User';
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'ユーザーIDは必須入力です。'
            ),
            'alphanumeric' => array(
                'rule' => 'alphaNumeric',
                'message' => '半角英数字を入力して下さい。'
            ),
            'between' => array(
                'rule' => array('between', 5, 15),
            	'message' => '5文字以上15文字以内を入力して下さい。'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'パスワードは必須入力です。'
            ),
			'minLength' => array(
				'rule' => array('minLength', '6'),
				'allowEmpty' => true,
				'message' => "パスワードは6桁以上で入力してください。",
        	)
        ),
		'email' => array(        
			'rule' => array('email'),
				'allowEmpty' => true,
				'message' => 'メールアドレスが不正です'
	    ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => '有効な権限を入力して下さい。',
                'allowEmpty' => false
            )
        )
    );

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}	
}
