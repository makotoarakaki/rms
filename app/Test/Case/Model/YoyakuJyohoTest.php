<?php
App::uses('YoyakuJyoho', 'Model');

/**
 * YoyakuJyoho Test Case
 *
 */
class YoyakuJyohoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.yoyaku_jyoho'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->YoyakuJyoho = ClassRegistry::init('YoyakuJyoho');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->YoyakuJyoho);

		parent::tearDown();
	}

}
