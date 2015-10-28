<?php
App::uses('AppModel', 'Model');
/**
 * TenpoM Model
 *
 */
class TenpoM extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'tenpo_m';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	
	public $hasAndBelongsToMany = array('ZasekiM' =>
									array('className' => 'ZasekiM',
										  'joinTable' => 'tenpo_jyoho',
										  'foreignKey' => 'tenpo_id',
										  'associationForeignKey' => 'zaseki_id',
										  'conditions' => '',
										  'order' => '',
										  'limit' => '',
										  'unique' => true,
										  'finderQuery' => '',
										  'deleteQuery' => ''));

}
