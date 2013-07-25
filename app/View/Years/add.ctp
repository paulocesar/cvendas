<?php
	echo $this->Form->create('Year');
	echo $this->Form->input('year',array('label'=>'ano','value'=>$year));
	echo $this->Form->end('criar');
?>