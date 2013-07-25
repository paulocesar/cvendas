<?php ?>
<div class='row'>
	<div class="span8">
		<br>
	</div>
	<div class ="offset7 span4 well" id="formEdit">
		val: <input id="formValue" type="text"/><br>
		obs: <input id="formObs" type="text"/> <br>
		<input id="formSubmit" type="submit" value="salvar" style="margin-top:-10px"/>
	</div>
</div>
<br><br>
<table class="table table-striped table-bordered">
	<tr>
		<th>PRODUTO</th>
		<?php
		foreach ($months as $m)
			echo "<th>{$m['Month']['name']}</th>";
		?>
	</tr>
	<?php
	foreach ($year['Sell'] as $sell):
		$id = "{$sell['Year']['id']}-{$sell['Month']['id']}-{$sell['Product']['id']}";
		if ($sell['month_id'] % 12 == 1)
			echo "<tr><td class='cell'>{$sell['Product']['name']}</td>";
		if(isset($sell['observation']) && $sell['observation'] && $sell['observation'] != '')
			echo "<td class='cell' id='{$id}' alt='{$sell['observation']}' style='background-color:#FFFCDB'>" . $sell['quantity'] . '</td>';
		else
			echo "<td class='cell' id='{$id}' alt='{$sell['observation']}'>" . $sell['quantity'] . '</td>';
		if ($sell['month_id'] == 12)
			echo "</tr>";
	endforeach;
	?>
</table>

<script type="text/javascript">
	id=null;
	path = '<?php echo $this->webroot ?>';
	value = 0;
	function setForm() {
		if(!id) {
			$('#formValue').attr('disabled',true);
			$('#formObs').attr('disabled',true);
			$('#formSubmit').attr('disabled',true);
		} else {
			$('#formValue').attr('disabled',false);
			$('#formObs').attr('disabled',false);
			$('#formSubmit').attr('disabled',false);
		}
	}

	$('.cell').click(function () {
		if(id)
			$('#'+id).css('color','black');
		id = $(this).attr('id');
		$(this).css('color','red');
		setForm();
		$('#formValue').val($(this).html());
		$('#formObs').val($(this).attr('alt'));
	});

	$('#formSubmit').click(function() {
		value = $('#formValue').val();
		obs = $('#formObs').val();
		link = path+'years/'+"update_cell/"+id+"?value="+value+"&obs="+obs;
		$.get(link,function(data){
			if(data == 'OK') {
				$('#'+id).html(value);
				$('#'+id).attr('alt',obs);
				if(obs && obs!= '')
					$('#'+id).css('background-color', '#FFFCDB');
				else
					$('#'+id).css('background-color', 'white');
			} else {
				alert('Houve um problema, tente novamente mais tarde');
			}
		});
	});

	$("#formValue").keydown(function(event) {
		// Allow: backspace, delete, tab, escape, and enter
		if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
			// Allow: Ctrl+A
		(event.keyCode == 65 && event.ctrlKey === true) || 
			// Allow: home, end, left, right
		(event.keyCode >= 35 && event.keyCode <= 39)) {
			// let it happen, don't do anything
			return;
		}
		else {
			// Ensure that it is a number and stop the keypress
			if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
				event.preventDefault(); 
			}   
		}
	});
	
	
	var documentHeight = 0;
	var topPadding = 15;
	$(function() {
		var offset = $("#sidebar").offset();
		documentHeight = $(document).height();
		$(window).scroll(function() {
			var sideBarHeight = $("#sidebar").height();
			if ($(window).scrollTop() > offset.top) {
				var newPosition = ($(window).scrollTop() - offset.top) + topPadding;
				var maxPosition = documentHeight - (sideBarHeight + 100);
				if (newPosition > maxPosition) {
					newPosition = maxPosition;
				}
				$("#sidebar").stop().animate({
					marginTop: newPosition
				});
			} else {
				$("#sidebar").stop().animate({
					marginTop: 0
				});
			};
		});
	});
		
		
	
	$(document).ready(function(){
		setForm();
	});
</script>