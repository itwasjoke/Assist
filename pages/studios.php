<?php
include '../config.php';
include '../fun.php';
?>
<?php include 'header_pages.php'; ?>

<?php

 ?>
 <h2>Студии</h2>

<div class="div_all_serv">
	 <?php
	$studios=dataFromDb("SELECT * FROM studios s");
	foreach ($studios as $studio) {
		// print_r($studio['id']);
		$emp=dataFromDb("SELECT p.name, u.first_name, u.second_name FROM users u join posts p on u.post_id=p.id where u.studio_id=".$studio['id']);

	  ?>
	  	<div class="div_studio" style="background-image: url(../img/<?=$studio['img']?>);
  background-size: cover;">
        </div>
	    <div class='div_studio'>
		 	<h4 class="name_studio"><?=$studio['name']?></h4>
		 	<p><?=$studio['description']?></p>
		 	<p><?=$studio['address']?></p>
		 	<h4 class="zag_studio">Сотрудники</h4>
		 	<div class="div_emp">
		 		 <?php 
		 		foreach ($emp as $em) {
		 		?>
		 		<div>
		 			<p class="emp_post"><?=$em['name']?></p>
		 		</div>
		 		<div>
		 			<p><?=$em['first_name']?> <?=$em['second_name']?></p>
		 		</div>
		 		<?php } ?>
		 	</div>
		 	
	 	</div>
<?php } ?>
</div>
</div>
</body>
</html>
