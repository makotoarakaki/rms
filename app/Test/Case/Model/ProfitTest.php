<?php
App::uses('Profit', 'Model');

/**
 * Profit Test Case
 *
 */
class ProfitTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.profit',
		'app.main_item',
		'app.item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Profit = ClassRegistry::init('Profit');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Profit);

		parent::tearDown();
	}

}
