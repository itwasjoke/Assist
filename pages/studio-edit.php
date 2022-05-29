<?php
include '../config.php';
include '../fun.php';
?>
<?php include 'header_pages.php'; ?>

<?php
if (exist_data('studio_id')){
	$s="studios-control.php";
	$b=False;
	$main_data=createData(['studio_id']);
	$studio=dataFromDb("SELECT * FROM studios s where s.id=".$main_data['studio_id']);
	foreach ($studio as $ka) {
		foreach ($ka as $key => $value) {
			$stud[$key]=$value;
		}
	}
}
else{
	$s="admin-studio.php";
	$b=True;
}
 ?>
 <div class='regist_forms'>
	 <form class="ots" name='edit' method="post" action="<?=$s?>" enctype="multipart/form-data"> 
	 	<div class='fm'>
	 		
		 	<h2>Студия</h2><br>
		 	<input type="hidden" name="id" value="<?=$main_data['studio_id']?>">
		 	<h4 class="user_about">Название</h4>
		 	<input type="text" name="name" placeholder="Название" value="<?=$stud['name']?>"></input><br>
		 	<h4 class="user_about">Описание</h4>
		 	<textarea class="txt_comment" name='description' placeholder="Описание"><?=$stud['description']?></textarea><br>
		 	<h4 class="user_about">Адрес</h4>
		 	<input type="text" name="address" value="<?=$stud['address']?>" placeholder="Адрес">
		 	<?php 
	 			if ($b){
	 				?>
	 				<h4 class="user_about">Email руководителя</h4>
	 				<input type="text" name="admin" value="" placeholder="email">
	 				<?php
	 			}
	 		?>
		 	<?php 
		 	if ($b){
		 		echo "<h4 class='user_about'>Обложка</h4>";
		 		echo "<input type='file' name='photo'>";
		 	}

		 	?>
	 	</div>
	 	<center>
	 		<?php if ($b){
	 			?>
	 			<input class="btn_create" type="submit" name="new_stud" value='Создать'></input><br>
	 			<?php
	 		} 
	 		else {
	 		?>
		 	<input class="btn_create" type="submit" name="new_info" value='Отправить'></input><br>
		 <?php } ?>
	 	</center>
	 </form>
</div>
</div>
</body>
</html>
