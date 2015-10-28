<?php
App::uses('TenpoM', 'Model');

/**
 * TenpoM Test Case
 *
 */
class TenpoMTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tenpo_m'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TenpoM = ClassRegistry::init('TenpoM');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TenpoM);

		parent::tearDown();
	}

}
