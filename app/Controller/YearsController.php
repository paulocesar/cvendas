<?php

App::uses('AppController', 'Controller');

class YearsController extends AppController {

	public function index() {
		$this->loadModel('Provider');
		$this->loadModel('Product');
		$this->set('years',$this->Year->find('all',array('order' => 'Year.year DESC')));
		$this->set('providers',$this->Provider->find('all'));
		$this->set('products',$this->Product->find('all'));
	}

	public function add() {
		$this->set('year', date('Y'));
		
		if ($this->request->isPost()) {
			
			$products = $this->Year->Sell->Product->find('all');
			if(empty($products)) {
				$this->Session->setFlash(__('cadastre pelo menos um produto antes de continuar'));
				return;
			}
			
			$this->Year->create();
			if (!$this->Year->save($this->request->data)) {
				$this->Session->setFlash(__("Ano inválido"));
				$this->set('year',$this->request->data['Year']['year']);
				return;
			}

			foreach ($products as $prod) {
				for ($i = 1; $i <= 12; $i++) {
					$data = array('Sell' => array('year_id' => $this->Year->id, 'month_id' => $i, 'product_id' => $prod['Product']['id']));
					$this->Year->Sell->create();
					if (!$this->Year->Sell->save($data)) {
						throw new Exception(__('Houve um erro, entre em contato com o administrador!'));
					}
				}
			}

			$this->redirect(array('controller' => 'years','action' => 'view', $this->Year->id));
			return;
		}
		
	}

	public function view($id = null) {
		$this->Year->recursive = 2;
		$this->Year->id = $id;
		if(!$this->Year->exists()) {
			$this->Session->setFlash(__('Ano inválido'));
			$this->redirect(array('action' => 'index'));
			return;
		}
		$this->loadModel('Month');
		$this->set('months',$this->Month->find('all'));
		$this->set('year', $this->Year->read(null,$id));
	}

	public function update_cell($id = null) {
		$this->layout = 'ajax';
		
		$ids = $this->request->params['pass'][0];
		$ids = explode('-',$ids);
		
		$value = $this->request->query['value'];
		
		$obs = null;
		if(isset($this->request->query['obs']) && $this->request->query['obs'])
			$obs = $this->request->query['obs'];
		
		$sell = $this->Year->Sell->find('first', array(
				'conditions' => array(
						'Sell.year_id' => $ids[0],
						'Sell.month_id' => $ids[1],
						'Sell.product_id' => $ids[2],
				)
		));
		
		$sell['Sell']['quantity'] = $value;
		$sell['Sell']['observation'] = $obs;
		
		$this->Year->Sell->id = $sell['Sell']['id'];
		if($this->Year->Sell->save($sell))
			$this->set('response','OK');
		else
			$this->set('response','ERROR');
	}
}