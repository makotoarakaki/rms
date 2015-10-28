<?php
App::uses('GesutocdM', 'Model');

/**
 * GesutocdM Test Case
 *
 */
class GesutocdMTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.gesutocd_m'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->GesutocdM = ClassRegistry::init('GesutocdM');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GesutocdM);

		parent::tearDown();
	}

}
