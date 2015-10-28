<?php
App::uses('TenpoJyoho', 'Model');

/**
 * TenpoJyoho Test Case
 *
 */
class TenpoJyohoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tenpo_jyoho'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TenpoJyoho = ClassRegistry::init('TenpoJyoho');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TenpoJyoho);

		parent::tearDown();
	}

}
