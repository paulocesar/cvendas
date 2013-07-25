<?php

App::uses('AppModel', 'Model');

class Product extends AppModel {

	public $validate = array(
			'provider_id' => array(
					'notempty' => array(
							'rule' => array('notempty'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
					'numeric' => array(
							'rule' => array('numeric'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
	);
	public $belongsTo = array(
			'Provider' => array(
					'className' => 'Provider',
					'foreignKey' => 'provider_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
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