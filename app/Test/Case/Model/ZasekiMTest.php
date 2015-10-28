<?php
App::uses('ZasekiM', 'Model');

/**
 * ZasekiM Test Case
 *
 */
class ZasekiMTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.zaseki_m'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ZasekiM = ClassRegistry::init('ZasekiM');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ZasekiM);

		parent::tearDown();
	}

}
