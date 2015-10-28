<?php
App::uses('Fund', 'Model');

/**
 * Fund Test Case
 *
 */
class FundTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.fund'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Fund = ClassRegistry::init('Fund');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Fund);

		parent::tearDown();
	}

}
