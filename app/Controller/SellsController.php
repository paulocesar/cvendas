<?php

App::uses('AppController', 'Controller');

class SellsController extends AppController {

	public $helpers = array('Chart');

	/**
	 * historico de vendas do produto
	 * @param type $product_id
	 * @return type
	 */
	public function history_product($product_id = null) {
		$this->Sell->Product->recursive = -1;
		$this->set('products', $this->Sell->Product->find('all'));
		$this->set('years', $this->Sell->Year->find('list',array('fields'=>'Year.year,Year.year')));
		
		
		$product = null;
		$this->Sell->Product->id = $product_id;
		if (!$this->Sell->Product->exists()) {
			$p = $this->Sell->Product->find('first');
			$product_id = $p['Product']['id'];
			if(!$product_id) {
				$this->Session->setFlash(__('Cadastre um produto antes de continuar'));
				$this->redirect(array('controller'=>'years','action'=>'index'));
				return;
			}	
		}
		
		
		//checando ano
		$year = null;
		if(isset($this->request->query['year']))
			$year = $this->request->query['year'];
		else {
			$y = $this->Sell->Year->find('first',array('order'=>'Year.year DESC'));
			if(isset($y['Year']['year']) && $y['Year']['year'])
				$year = $y['Year']['year'];
			if($year) {
				$this->redirect(array('controller'=>'sells','action'=>'history_product',$product_id,'?' => array('year' => $year)));
				return;
			}
		}
		if(!$year) {
			$this->Session->setFlash(__('Cadastre um ano antes de continuar'));
			$this->redirect(array('controller'=>'years','action'=>'index'));
			return;
		}

		//construindo dados
		$product = $this->Sell->Product->read(null, $product_id);

		$sells = $this->Sell->find('all', array(
				'conditions' => array(
						'Sell.product_id' => $product_id,
						'Year.year' => $year
				),
				'order' => 'Year.year DESC'
		));

		$this->Sell->Month->recursive = -1;
		$months = $this->Sell->Month->find('all');

		$graph = array(
				'title' => "Vendas de {$product['Product']['name']} por Mês - {$year}",
				'label_x' => 'mês',
				'label_y' => 'unidades',
				'axis_y' => array(
						'model' => 'Month',
						'field' => 'name',
						'data' => $months
				),
				'axis_x' => array(
						array(
								'label' => $product['Product']['name'],
								'model' => 'Sell',
								'field' => 'quantity',
								'data' => $sells
						)
				),
		);
		$this->set(compact('graph','year','product'));
	}

	
	
	/**
	 * historico do produto por mes nos ultimos 3 anos
	 * @param type $product_id
	 * @return type
	 */
	public function history_product_last_tree_years($product_id = null) {
		$this->Sell->Product->recursive = -1;
		$this->set('products', $this->Sell->Product->find('all'));
		
		$year = $this->Sell->Year->find('first',array('order'=>'Year.year DESC'));
		if(!isset($year['Year']['year']) || !$year['Year']['year']) {
				$this->Session->setFlash(__('Cadastre um ano antes de continuar'));
				$this->redirect(array('controller'=>'years','action'=>'index'));
		}
		$year = $year['Year']['year'];
		
		$this->Sell->Product->id = $product_id;
		if (!$this->Sell->Product->exists()) {
			$p = $this->Sell->Product->find('first');
			$product_id = $p['Product']['id'];
			if(!$product_id) {
				$this->Session->setFlash(__('Cadastre um produto antes de continuar'));
				$this->redirect(array('controller'=>'years','action'=>'index'));
				return;
			}	
		}

		//construindo dados
		$product = $this->Sell->Product->read(null, $product_id);

		
		$year1 = $year-2;
		$year2 = $year-1;
		$year3 = $year;
		
		$sells1 = $this->Sell->find('all', array(
				'conditions' => array(
						'Sell.product_id' => $product_id,
						'Year.year = ' . $year1
				),
				'order' => 'Year.year DESC'
		));
		$sells2 = $this->Sell->find('all', array(
				'conditions' => array(
						'Sell.product_id' => $product_id,
						'Year.year = ' . $year2
				),
				'order' => 'Year.year DESC'
		));
		$sells3 = $this->Sell->find('all', array(
				'conditions' => array(
						'Sell.product_id' => $product_id,
						'Year.year = ' . $year3
				),
				'order' => 'Year.year DESC'
		));

		$this->Sell->Month->recursive = -1;
		$months = $this->Sell->Month->find('all');

		$graph = array(
				'title' => "Vendas de {$product['Product']['name']} por Mês - {$year1}, {$year2} e {$year3}",
				'label_x' => 'mês',
				'label_y' => 'unidades',
				'axis_y' => array(
						'model' => 'Month',
						'field' => 'name',
						'data' => $months
				),
				'axis_x' => array(
						array(
								'label' => $year1,
								'model' => 'Sell',
								'field' => 'quantity',
								'data' => $sells1
						),
						array(
								'label' => $year2,
								'model' => 'Sell',
								'field' => 'quantity',
								'data' => $sells2
						),
						array(
								'label' => $year3,
								'model' => 'Sell',
								'field' => 'quantity',
								'data' => $sells3
						)
				),
		);
		$this->set(compact('graph','year','product'));
	}
	
	/**
	 * historico de vendas do produto
	 * @param type $product_id
	 * @return type
	 */
	public function sum_of_sells_in_a_year() {
		$this->Sell->Product->recursive = -1;
		$this->set('products', $this->Sell->Product->find('all'));
		$this->set('years', $this->Sell->Year->find('list',array('fields'=>'Year.year,Year.year')));
		
		
		//checando ano
		$year = null;
		if(isset($this->request->query['year']))
			$year = $this->request->query['year'];
		else {
			$y = $this->Sell->Year->find('first',array('order'=>'Year.year DESC'));
			if(isset($y['Year']['year']) && $y['Year']['year'])
				$year = $y['Year']['year'];
			if($year) {
				$this->redirect(array('controller'=>'sells','action'=>'sum_of_sells_in_a_year','?' => array('year' => $year)));
				return;
			}
		}
		if(!$year) {
			$this->Session->setFlash(__('Cadastre um ano antes de continuar'));
			$this->redirect(array('controller'=>'years','action'=>'index'));
			return;
		}

		//construindo dados
		$year1 = $year - 2;
		$year2 = $year - 1;
		$year3 = $year;
		$sells1 = $this->Sell->find('all', array(
				'fields' => 'SUM(Sell.quantity),Sell.*,Year.*,Product.*',
				'conditions' => array(
						'Year.year' => $year1
				),
				'group' => array('Sell.product_id')
		));
		$sells2 = $this->Sell->find('all', array(
				'fields' => 'SUM(Sell.quantity),Sell.*,Year.*,Product.*',
				'conditions' => array(
						'Year.year' => $year2
				),
				'group' => array('Sell.product_id')
		));
		$sells3 = $this->Sell->find('all', array(
				'fields' => 'SUM(Sell.quantity),Sell.*,Year.*,Product.*',
				'conditions' => array(
						'Year.year' => $year3
				),
				'group' => array('Sell.product_id')
		));

		$graph = array(
				'title' => "Vendas de produtos no ano ({$year1}, {$year2} e {$year3})",
				'label_x' => 'mês',
				'label_y' => 'unidades',
				'axis_y' => array(
						'model' => 'Product',
						'field' => 'name',
						'data' => $sells3
				),
				'axis_x' => array(
						array(
								'label' => $year1,
								'model' => 0,
								'field' => 'SUM(`Sell`.`quantity`)',
								'data' => $sells1
						),
						array(
								'label' => $year2,
								'model' => 0,
								'field' => 'SUM(`Sell`.`quantity`)',
								'data' => $sells2
						),
						array(
								'label' => $year3,
								'model' => 0,
								'field' => 'SUM(`Sell`.`quantity`)',
								'data' => $sells3
						)
				),
		);
		$this->set(compact('graph','year','product'));
	}
}
