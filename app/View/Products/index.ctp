<?php
	echo $this->Html->link('adicionar produto',array('action' => 'add'));
	echo '<br>';
	echo $this->Html->link('adicionar fornecedor',array('controller'=>'providers','action'=>'add'));
?>
	
<?php foreach($products as $product):?>


<?php endforeach; ?>