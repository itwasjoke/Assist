<?php
include '../config.php';
include '../fun.php';
?>
<?php include 'header_pages.php'; ?>

<?php
if (exist_data('order')){

$user = get_user_info(get_current_user_id());
$id_serv=createData(['id'])['id'];
$sql="SELECT t.name as 'type', t.type_id, t.description, t.articul, t.implem, st.cost, s.name as 'studio' FROM types t
join studios_types st on st.type_id=t.id
join studios s on st.studio_id=s.id
where t.id=".$id_serv;
$serv=dataFromDb($sql);
$order_serv=array();
foreach ($serv as $item) {
	foreach ($item as $key => $value) {
		$order_serv[$key]=$value;
	}
}
$date1=date("Y-m-d");

$n = date("w", mktime(0,0,0,date("m"),date("d"),date("Y")));
    switch ($n) {
        case 0:
            $order_serv['implem']+=1;
            break;
        case 5:
            $order_serv['implem']+=2;
            break;
        case 6:
            $order_serv['implem']+=2;
            break;
        default:
            break;
    }


$date=date("Y-m-d", strtotime($date1.' + '.$order_serv['implem'].' days'));
$date_deadline=getDateInFormat($date);

 ?>
 <div class='regist_forms'>
	 <form name='createOrder' method="post" action="my-orders.php">
	 <input type="hidden" name="art" value="<?=$order_serv['type_id']?>"> 
	 <input type="hidden" name="implem" value="<?=$order_serv['implem']?>"> 
	 <input type="hidden" name="id" value="<?=$id_serv?>"> 
	 <input type="hidden" name="cost", value="<?=$order_serv['cost']?>">
	 	<div class='fm'>
		 	<h2>Оформление заказа</h2>
		 	<h4 class="zag_studio">Данные о клиенте:</h4>
		 	<div class="div_serv_cost">
			 	<h4 class="user_about">Имя и фамилия</h4>
			 	<p><?=$user['first_name']?> <?=$user['second_name']?></p>

			 	<h4 class="user_about">Email</h4>
			 	<p><?=$user['email']?></p>
		 	</div>
		 	<h4 class="zag_studio">Данные о услуге:</h4>
		 	<div class="div_serv_cost">
		 		<h4 class="user_about">Название</h4>
			 	<p><?=$order_serv['type']?></p>

			 	<h4 class="user_about">Описание</h4>
			 	<p><?=$order_serv['description']?></p>

			 	<h4 class="user_about">Студия</h4>
			 	<p><?=$order_serv['studio']?></p>

			 	<h4 class="user_about">Артикул</h4>
			 	<p><?=$order_serv['articul']?></p>

			 	<h4 class="user_about">Стоимость</h4>
			 	<p><?=$order_serv['cost']?> руб.</p>

		 	</div>
		 	<h4 class="zag_studio">Работа будет выполнена к <?=$date_deadline?></h4>
		 	<h4 class="zag_studio">Комментарий</h4>
		 	<textarea name='comment' class="txt_comment" placeholder="Напишите свои пожелания к заказу, оставьте ссылки на необходимые источники"></textarea>

		 	<div>
		 		<input id='confirm' class='custom-checkbox' type="checkbox" name="confirm" value="1">
		 		<label for='confirm'>Заполняя эту форму, я подтверждаю, что ознакомился с условиями публичной оферты.</label>	
		 	</div>
		 	<div class="order_create">
		 		<input type="submit" name="order1" class="btn_order" value="Сделать заказ">
		 	</div>
		 	
	 	</div>
	 </form>
</div>

<?php } ?>
</div>
</body>
</html>
