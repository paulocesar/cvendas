<div class="row">

	<div class="span4">
		<h4>Anos</h4>
		<div class="list-scroll">
			<?php
				foreach($years as $year)
					echo $this->Html->link($year['Year']['year'],array('action'=>'view',$year['Year']['id'])) . '<br>';
			?>
		</div>
	</div>
	
	<div class="span4">
		<h4>Produtos</h4>
		<div class="list-scroll">
			<?php
				foreach($products as $product)
					echo $this->Html->link($product['Product']['name'],array('controller'=>'products','action'=>'edit',$product['Product']['id'])) . '<br>';
			?>
		</div>
	</div>
	
	<div class="span4">
		<h4>Fornecedores</h4>
		<div class="list-scroll">
			<?php
				foreach($providers as $provider)
					echo $this->Html->link($provider['Provider']['name'],array('controller'=>'providers','action'=>'view',$provider['Provider']['id'])) . '<br>';
			?>
		</div>
	</div>

</div>
