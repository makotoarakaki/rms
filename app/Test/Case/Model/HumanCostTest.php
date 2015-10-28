<?php
App::uses('HumanCost', 'Model');

/**
 * HumanCost Test Case
 *
 */
class HumanCostTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.human_cost'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HumanCost = ClassRegistry::init('HumanCost');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HumanCost);

		parent::tearDown();
	}

}
