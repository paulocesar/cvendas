<div class="row">
	<div class="span4">
		<h4>Produtos</h4>
		<div class="list-scroll" style ="height:300px">
			<?php
				foreach($products as $p) {
					if($p['Product']['id'] == $product['Product']['id'])
						echo $this->Html->link($p['Product']['name'],array('action'=>'history_product_last_tree_years',$p['Product']['id']),array('style'=>'color:red'));
					else
						echo $this->Html->link($p['Product']['name'],array('action'=>'history_product_last_tree_years',$p['Product']['id']));
					echo $this->Html->tag('br');
				}
			?>
		</div>
	</div>

	<div class="span8">
	
		<?php if($product): ?>
	
			<div id="chart-canvas" style="min-width: 200px; height: 450px; margin: 0 auto"></div>
			<?php echo $this->Chart->bar($graph); ?>

		<?php else: ?>
			
			
			
		<?php endif; ?>
	
	
	</div>

</div>
