<div class="row">
	<div class="span4">
		<h4>Ano</h4>
		<?php echo $this->Form->input('year_id',array('label' => '','default' => $year)); ?>
		<h4>Produtos</h4>
		<div class="list-scroll" style ="height:300px">
			<?php
			if($year) {
				foreach($products as $p) {
					if($p['Product']['id'] == $product['Product']['id'])
						echo $this->Html->link($p['Product']['name'],array('action'=>'history_product',$p['Product']['id'],'?'=>array('year'=>$year)),array('style'=>'color:red'));
					else
						echo $this->Html->link($p['Product']['name'],array('action'=>'history_product',$p['Product']['id'],'?'=>array('year'=>$year)));
						
					echo $this->Html->tag('br');
				}
			}else{
				foreach($products as $p) {
					if($p['Product']['id'] == $product['Product']['id'])
						echo $this->Html->link($p['Product']['name'],array('action'=>'history_product',$p['Product']['id']),array('style'=>'color:red'));
					else
						echo $this->Html->link($p['Product']['name'],array('action'=>'history_product',$p['Product']['id']));
					echo $this->Html->tag('br');
				}
			}
			?>
		</div>
	</div>

	<div class="span8">
	
		<?php if($product): ?>
	
		
			<div id="chart-canvas" style="min-width: 200px; height: 450px; margin: 0 auto"></div>
			<?php echo $this->Chart->bar($graph); ?>

			<script type="text/javascript">
			$(document).ready(function() {
				$('#year_id').change(function() {
					var pathname = window.location.href;
					pathname = pathname.substring(0, pathname.length - 4);
					pathname = pathname + $(this).val();
					window.location = pathname;
				});
			});
			</script>
	

		<?php else: ?>
			
			
			
		<?php endif; ?>
	
	
	</div>

</div>
