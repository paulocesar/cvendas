<?php
	echo $this->Form->create('Provider');
	echo $this->Form->input('name',array('label'=>'nome'));
	echo $this->Form->end('criar');
?>