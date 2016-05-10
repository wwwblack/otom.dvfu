<?php
//Данная функция выводит записи об оборудовании. на страничку main.php, используется через AJAX.
session_start();
include("mysql.php");
mysql_query("SET NAMES 'utf8';");

	$htmlSelectOfType_item = $_POST['htmlSelectOfType_item'];
	$htmlSelectOfBrend = $_POST['htmlSelectOfBrend'];
	$htmlSelectOfRoom = $_POST['htmlSelectOfRoom'];
	$htmlButtonValue= $_POST['htmlButtonValue'];
	
	$sqlZaprosForViewContent = "SELECT item.id, item.id_type_item, item.id_brend, item.id_position ,item.description_item, item.img_item, item.given, brend.title as titleOfBrend, room.position_name as nameOfPosition, type_item.name_type_item as itemTypeName   FROM item 
										JOIN brend ON (brend.id=item.id_brend)
										JOIN room ON (room.id=item.id_position)
										JOIN type_item ON (type_item.id=item.id_type_item)
										WHERE `item`.`given` = '0' ";
										echo mysql_error();	
										if ($htmlSelectOfType_item){
											$sqlZaprosForViewContent .= " AND `item`.`id_type_item` = $htmlSelectOfType_item";
											echo mysql_error();	
										}
										if ($htmlSelectOfBrend){
											$sqlZaprosForViewContent .= " AND `item`.`id_brend` = $htmlSelectOfBrend";
											echo mysql_error();	
										}
										if ($htmlSelectOfRoom){
											$sqlZaprosForViewContent .= " AND `item`.`id_position` = $htmlSelectOfRoom";
											echo mysql_error();	
										}
										
			
				echo mysql_error();
				$result_set = mysql_query($sqlZaprosForViewContent);
				//через уайл загружаем имеющиеся объекты
				while ($result = mysql_fetch_array($result_set)){
					
					echo "
					<div class =\"".$result['id']."\">
						<div class=\"row\" >
						
						 ";
						
					echo "
						<div class=\"col-sm-1\">
							<button type=\"button\" class=\"btn btn-primary\" id=\"myPopover\" data-toggle=\"popover\" data-contentwrapper=\"#mypopover_".$result['id']."\">IMG</button>
							<div id=\"mypopover_".$result['id']."\" style=\"display: none;\">
							  <div class=\"alert alert-danger\"><img src=\""./* Запрос картинки  */$result["img_item"]."\" width=\"150\" height=\"150\"></div>
							</div>
						</div>
					";
				// запрос данных 
					echo "	<div class=\"col-sm-3\">
								Местоположение - ".$result['nameOfPosition']."
							</div>
						";	
					
					echo "
						<div class=\"col-sm-5\">
							Описание - ".$result["description_item"]."
						</div>
					";
					//В батон записываем айди item и логин пользователя и отправляем для дальнейшей обработки	
					echo "
						<div class=\"col-sm-1\">
							<div style=\"margin-left: 80%\">
							<form method=\"POST\">
							<button name=\"addItem\" type=\"submit\" class=\"btn btn-md btn-success\" value=\"".$result["id"].":".$_SESSION['id']."\" >Взять</button>
							</form>
							</div>
						</div>
						
						</div>
						<hr>
					
					";
				}
				echo "
						<script type=\"text/javascript\">
							$(function () {
							  $('[data-toggle=\"popover\"]').popover({
								html:'true',
								trigger: 'hover',
								placement: 'right',
								content: function() {  return $($(this).data('contentwrapper')).html(); }
							  })
							})
						</script>
					";
?>				