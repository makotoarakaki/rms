<?php
App::uses('YoyakucdM', 'Model');

/**
 * YoyakucdM Test Case
 *
 */
class YoyakucdMTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.yoyakucd_m'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->YoyakucdM = ClassRegistry::init('YoyakucdM');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->YoyakucdM);

		parent::tearDown();
	}

}
