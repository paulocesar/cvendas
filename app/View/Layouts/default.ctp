<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $cakeDescription ?>:
			<?php echo $title_for_layout; ?>
		</title>
		<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('main');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script('jquery-1.9.1.min');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('highcharts');
		echo $this->Html->script('modules/exporting');
		?>
		
		
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div class="container">
					<h1><?php echo 'Vendas'; ?></h1>
				</div>
			</div>
			<div id="content">

				<center><?php echo $this->Session->flash(); ?></center>

				<div class="container">
					<div class="navbar">
						<div class="navbar-inner">
							<ul class="nav">

								<li><?php echo $this->Html->link('principal', array('controller' => 'years', 'action' => 'index')); ?></li>

								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">adicionar<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><?php echo $this->Html->link('ano', array('controller' => 'years', 'action' => 'add')); ?></li>
										<li><?php echo $this->Html->link('produto', array('controller' => 'products', 'action' => 'add')); ?></li>
										<li><?php echo $this->Html->link('fornecedor', array('controller' => 'providers', 'action' => 'add')); ?></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">gráficos<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><?php echo $this->Html->link('histórico de produtos', array('controller' => 'sells', 'action' => 'history_product')); ?></li>
										<li><?php echo $this->Html->link('histórico dos ultimos anos', array('controller' => 'sells', 'action' => 'history_product_last_tree_years')); ?></li>
										<li><?php echo $this->Html->link('total de vendas no ano', array('controller' => 'sells', 'action' => 'sum_of_sells_in_a_year')); ?></li>
									</ul>
								</li>

							</ul>
						</div>
					</div>

					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
			<div id="footer">
				<div class="container">
				</div>
			</div>
		</div>
		<?php //echo $this->element('sql_dump');  ?>
	</body>
</html>
