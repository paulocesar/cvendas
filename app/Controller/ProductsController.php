<?php

App::uses('AppController', 'Controller');

class ProductsController extends AppController {

	public function index() {
		$this->set('providers',$this->Product->Provider->find('list'));
		$this->set('products',$this->Product->find('all'));
	}
	
	public function add() {
		$providers = $this->Product->Provider->find('list');
		if(empty($providers)) {
			$this->Session->setFlash(__('Adicione fornecedores antes de cadastrar um produto'));
			$this->redirect(array('action'=>'index'));
			return;
		}
		$this->set(compact('providers'));
		
		if ($this->request->isPost()) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('produto salvo com sucesso'));
				$this->redirect(array('controller' => 'years', 'action' => 'index'));
				return;
			} else {
				$this->Session->setFlash(__('houve um erro ao cadastrar um fornecedor'));
			}
		}
	}
}