<?php
include '../config.php';
include '../fun.php';
?>
<?php include 'header_pages.php'; ?>

<?php
$edit=False;
$sql2="SELECT ta.id, ta.name FROM types_about ta";
$new_type="create_type_go";
$about=dataFromDb($sql2);
if (exist_data('edit_type')){
	$new_type="edit_type_go";
	$edit=True;
	$main_data = createData(['type_id', 'studio_id', 'cost']);
	$sql="SELECT * FROM types t where t.id=".$main_data['type_id'];
	$about_type=dataFromDb($sql);
	$type=array();
	foreach ($about_type as $value) {
		foreach ($value as $key => $val) {
			$type[$key]=$val;
		}
	}
}

 ?>
 <div class='regist_forms'>
	 <form class="ots" name='edit' method="post" action="services-control.php" enctype="multipart/form-data"> 
	 	<div class='fm'>
		 	<h2>Услуга</h2><br>
		 	<input type="hidden" name="id" value="<?=$main_data['type_id']?>">
		 	<h4 class="user_about">Название</h4>
		 	<input type="text" name="name" placeholder="Название" value="<?=$type['name']?>"></input><br>
		 	<h4 class="user_about">Тип услуги</h4>
		 	<div class="select">
			 	<select id="standard-select" name='type_id'>
			 		<?php 
			 		$checked='';
			 		if ($edit){
			 			foreach ($about as $value) {
			 				if ($type['type_id']==$value['id']) $checked="selected";
			 				else $checked='';
			 				echo "<option ".$checked." value=".$value['id'].">".$value['name']."</option>";
			 			}
			 		}
			 		else{
			 			foreach ($about as $value) {
			 				echo "<option value=".$value['id'].">".$value['name']."</option>";
			 			}
			 		}
			 		?>
			 	</select>
			 	<span class="focus"></span>
		 	</div>
		 	<h4 class="user_about">Описание</h4>
		 	<textarea class="txt_comment" name='description' placeholder="Описание"><?=$type['description']?></textarea><br>
		 	<h4 class="user_about">Стоимость</h4>
		 	<input type="text" name="cost" value="<?=$main_data['cost']?>" placeholder="Стоимость">
		 	<h4 class="user_about">Срок выполнения в днях</h4>
		 	<input type="text" name="implem" value="<?=$type['implem']?>" placeholder="Число">
		 	<?php 
		 	if (!$edit){
		 		?>
		 		<h4 class="user_about">Обложка</h4>
		 		<input type="file" name="file_type">

		 		<?php
		 	}
		 	?>
	 	</div>
	 	<center>
		 	<input class="btn_create" type="submit" name="<?=$new_type?>" value='Отправить'></input><br>
	 	</center>
	 </form>
	 <?php  ?>
</div>
</div>
</body>
</html>
