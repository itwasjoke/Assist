<?php
include '../config.php';
include '../fun.php';
?>
<?php include 'header_pages.php'; ?>

<?php
$main_data=createData(['studio_id']);
$studio=dataFromDb("SELECT * FROM studios s where s.id=".$main_data['studio_id']);
foreach ($studio as $stud) {
	


 ?>
 <div class='regist_forms'>
	 <form class="ots" name='edit' method="post" action="studios-control.php"> 
	 	<div class='fm'>
		 	<h2>Студия</h2><br>
		 	<input type="hidden" name="id" value="<?=$main_data['studio_id']?>">
		 	<h4 class="user_about">Название</h4>
		 	<input type="text" name="name" placeholder="Название" value="<?=$stud['name']?>"></input><br>
		 	<h4 class="user_about">Описание</h4>
		 	<textarea class="txt_comment" name='description' placeholder="Описание"><?=$stud['description']?></textarea><br>
		 	<h4 class="user_about">Адрес</h4>
		 	<input type="text" name="address" value="<?=$stud['address']?>" placeholder="Адрес">
	 	</div>
	 	<center>
		 	<input class="btn_create" type="submit" name="new_info" value='Отправить'></input><br>
	 	</center>
	 </form>
	 <?php } ?>
</div>
</div>
</body>
</html>
