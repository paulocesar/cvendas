<?php

App::uses('AppController', 'Controller');

class ProvidersController extends AppController {
	public function add() {
		if ($this->request->isPost()) {
			$this->Provider->create();
			if ($this->Provider->save($this->request->data)) {
				$this->Session->setFlash(__('fornecedor salvo com sucesso'));
				$this->redirect(array('controller' => 'years', 'action' => 'index'));
				return;
			} else {
				$this->Session->setFlash(__('houve um erro ao cadastrar um fornecedor'));
			}
		}
	}

}