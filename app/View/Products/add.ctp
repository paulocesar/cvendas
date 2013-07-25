<?php
	echo $this->Form->create('Product');
	echo $this->Form->input('name',array('label'=>'nome'));
	echo $this->Form->input('code',array('label'=>'código'));
	echo $this->Form->input('provider_id',array('label'=>'fornecedor'));
	echo $this->Form->end('criar');
?>