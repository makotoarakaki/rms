<?php
App::uses('MainItem', 'Model');

/**
 * MainItem Test Case
 *
 */
class MainItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.main_item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MainItem = ClassRegistry::init('MainItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MainItem);

		parent::tearDown();
	}

}
