<?php
//Данная функция выводит записи об оборудовании. на страничку main.php, используется через AJAX.
session_start();
include("mysql.php");
mysql_query("SET NAMES 'utf8';");

	$htmlSelectOfType_item = $_POST['htmlSelectOfType_item'];
	$htmlSelectOfBrend = $_POST['htmlSelectOfBrend'];
	$htmlSelectOfRoom = $_POST['htmlSelectOfRoom'];
	$htmlButtonValue= $_POST['htmlButtonValue'];
	
	$sqlZaprosForViewContent = "SELECT item.id, item.id_type_item, item.id_brend, item.id_position, item.Containerboard_number  ,item.description_item, item.img_item, item.given, brend.title as titleOfBrend, room.position_name as nameOfPosition, type_item.name_type_item as itemTypeName   FROM item 
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
	//Подсчёт строк
	//----------------------------------------------------------
	
	//----------------------------------------------------------
			
				echo mysql_error();
				$result_set = mysql_query($sqlZaprosForViewContent);
				$result = mysql_fetch_array($result_set);
				//Проверяем на пустоту массива.
				if (empty($result)) {
					echo 'Извини друг, нечего не смог найти :(';
				}
				else {
					//через уайл загружаем имеющиеся объекты
					$i = 0;
					while ($result = mysql_fetch_array($result_set)){
						// Мой паповер вывод картинки
						$i++;
						echo "
						<div class =\"".$result['id']."\">
							<div class=\"row\"  style=\"margin-top: 2px;\" >
							<div class=\"col-sm-1\">
							".$i."
							</div>
								<div class=\"col-sm-1\"  >
									<button type=\"button\" class=\"btn btn-primary\" id=\"myPopover\" data-toggle=\"popover\" data-contentwrapper=\"#mypopover_".$result['id']."\">IMG</button>
									<div id=\"mypopover_".$result['id']."\" style=\"display: none;\">
									  <div class=\"alert alert-danger\"><img src=\""./* Запрос картинки  */$result["img_item"]."\" width=\"150\" height=\"150\"></div>
									</div>
								</div>
						";
				
						echo "	<div class=\"col-sm-2\" style=\"border-left: 1px solid black;\">
									".$result['nameOfPosition']."
								</div>
							";	
						
						echo "
								<div class=\"col-sm-3\"style=\"border-left: 1px solid black;\">
									".$result["description_item"]."
								</div>
                                <div class=\"col-sm-2\"style=\"border-left: 1px solid black;\">
									".$result["Containerboard_number"]."
								</div>
						";
						//В батон записываем айди item и логин пользователя и отправляем для дальнейшей обработки	
						echo "	<form method=\"POST\">
								<div class=\"col-sm-2\"style=\"border-left: 1px solid black;\">	
									<input type=\"date\" style=\"\" name=\"days\" class=\"form-control\"/>
								</div>
								<div class=\"col-sm-1\" style=\"border-left: 1px solid black; border-right: 1px solid black;\">
									<div>
									
									<button name=\"addItem\" type=\"submit\" class=\"btn btn-md btn-primary\" value=\"".$result["id"].":".$_SESSION['id']."\" >Взять</button>
									</form>
									</div>
								</div>
								<div class=\"col-sm-3\" style=\"border-left: 1px solid black; \"></div>
						</div>
						</div>
						";
					}
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