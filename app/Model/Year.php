<?php

App::uses('AppModel', 'Model');

class Year extends AppModel {

	public $validate = array(
			'year' => array(
					'numeric' => array(
							'rule' => array('numeric'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
					'notempty' => array(
							'rule' => array('notempty'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
					'unique' => array(
							'rule' => 'isUnique',
							'message' => 'Ano já existe'
					)
			),
			'lock' => array(
					'notempty' => array(
							'rule' => array('notempty'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
	);
	public $hasMany = array(
			'Sell' => array(
					'className' => 'Sell',
					'foreignKey' => 'year_id',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
			),
	);

}