<?php
App::uses('AppHelper', 'View/Helper');

class ChartHelper extends AppHelper {

	public function model_to_chart($config) {
		$data = $config['data'];
		$model = $config['model'];
		$field = $config['field'];
		$label = null;
		if(isset($config['label']))
			$label = $config['label'];
		
		$str = '';
		foreach($data as $m) {
			if(!is_numeric($m[$model][$field]))
				$str .= "'" . $m[$model][$field] .	"',";
			else
				$str .= "" . $m[$model][$field] .	",";
		}
		
		if($label)
			return "{name:'{$label}',data:[{$str}]},";
		else
			return "[{$str}]";
	}

/*
 * EXEMPLO
		$graph = array(
				'title' => 'Grafico',
				'label_x' => '',
				'label_y' => '',
				'axis_y' => array(
						'model' => 'Month',
						'field' => 'name',
						'data' => $months
				),
				'axis_x' => array(
						array(
								'label' => $product['Product']['name'],
								'model' => 'Sell',
								'field' => 'quantity',
								'data' => $sells
						)
				),
		);
 */
	
	public function bar($config) {
		
		$title = $config['title'];
		
		$label_y = $config['label_y'];
		$label_x = $config['label_x'];
		
		$axis_y = $this->model_to_chart($config['axis_y']);
		$axis_x = '';
		foreach($config['axis_x'] as $data)
			$axis_x .= $this->model_to_chart($data);
		
$str = <<<EOF
 		<script type="text/javascript">
			$(function () {
						$('#chart-canvas').highcharts({
								chart: {
										type: 'column'
								},
								title: {
										text: '{$title}'
								},
								xAxis: {
									min: 0,
									title: {
										text: '{$label_x}'
									}, 
									categories: {$axis_y} 
								},
								yAxis: {
										min: 0,
									title: {
											text: '{$label_y}'
									}
								},
								tooltip: {
										headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
										pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
												'<td style="padding:0"> <b>{point.y} {$label_y}</b></td></tr>',
										footerFormat: '</table>',
										shared: true,
										useHTML: true
								},
								plotOptions: {
										column: {
												pointPadding: 0.2,
												borderWidth: 0
										}
								},
								series: [{$axis_x}]
						});
				});
		</script>
EOF;
		return $str;
	}
}