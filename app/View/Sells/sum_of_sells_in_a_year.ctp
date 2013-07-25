<div class="row">
	<div class="span6">
		<h4>Total de vendas no ano por produto</h4>
		<?php echo $this->Form->input('year_id',array('label' => '','default' => $year)); ?>
	</div>

	<div class="span12" style="overflow-x: scroll">
	
	
		
			<div id="chart-canvas" style="min-width: 3000px; height: 450px; margin: 0 auto"></div>
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
	
	
	</div>

</div>
