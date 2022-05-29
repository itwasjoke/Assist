<?php
include '../config.php';
include '../fun.php';
?>
<?php include 'header_pages.php'; ?>

<?php
$studio_id=$_COOKIE['studio_id'];
if (exist_data('newuser')){
	$new_user_data=createData(['post_id_new', 'email']);
	// validEmail($new_user_data['email']);
	if (validEmail($new_user_data['email'])){
		$sql = "UPDATE users SET post_id=".$new_user_data['post_id_new'].", studio_id=".$studio_id." WHERE email='".$new_user_data['email']."'";
	    $in=mysqli_query($GLOBALS['con'], $sql);
	}
	echo "<script>location.href = 'users-edit.php';</script>";
}
if (exist_data('del_sub')){
	$del_id=$_POST['del_id'];
	$data = array(
		'post_id' => 1, 
		'studio_id' => 'null',
		'id' => $del_id
	);
	print_r($data);
	$table='users';
	$dat=array();
    foreach ($data as $key => $value) {
        if ($key!='id') $dat[]=$key."=".$value."";
    }
    $sql = "UPDATE ".$table." SET " . implode(", ", $dat) . " WHERE id=".$data['id'];
	$in=mysqli_query($GLOBALS['con'], $sql);
	echo "<script>location.href = 'users-edit.php';</script>";
}

if (exist_data('post_id')){
	$user_post=createData(['id', 'post_id']);
	editData($user_post, "users");
	echo "<script>location.href = 'users-edit.php';</script>";
}


$sql_users="SELECT u.first_name, u.id as 'u_id', u.second_name, p.id FROM users u 
join posts p on p.id=u.post_id
where studio_id=".$studio_id;
$users=dataFromDb($sql_users);

$sql2="SELECT * FROM posts";
$about=dataFromDb($sql2);


 ?>
 <h2>Сотрудники</h2><br>
 <div class='regist_forms'>

 <?php 
foreach ($users as $us) {

 ?>
	 <form class="ots1" name='user' method="post" action="users-edit.php"> 
	 	<input type="hidden" name="id" value="<?=$us['u_id']?>">
 		<h4 class="user_about"><?=$us['first_name']?> <?=$us['second_name']?></h4>
	 	<form name='del' method="post" action="users-edit.php">
	 		<input type='hidden' name='del_id' value="<?=$us['u_id']?>">
	 		<input type="submit" name="del_sub" class="btn_order" value="Удалить">
	 	</form>
	 	<div class="select">
		 	<select id="standard-select" onchange="this.form.submit()" name='post_id'>
		 		<?php 
		 		$checked='';
	 			foreach ($about as $value) {
	 				if ($us['id']==$value['id']) $checked="selected";
	 				else $checked='';
	 				if ($value['id']!=2){
	 				echo "<option ".$checked." value=".$value['id'].">".$value['name']."</option>";
	 				}
	 			}
		 		
		 		?>
		 	</select>
		 	<span class="focus"></span>
	 	</div>

	 </form>
	 <?php  }?>
	 <form name='user_new' method="post" action="users-edit.php">
		 <h4 class="user_about">Добавить нового сотрудника</h4>
		 <div class='div_user'>
		 	<div class='fm' style="padding-right: 15px;">
		 		<input type="text" name="email" value="" placeholder="Email пользователя">
		 	</div>
		 	<div>
		 		<div class="select">
				 	<select id="standard-select" name='post_id_new'>
				 		<?php 
				 		$checked='';
			 			foreach ($about as $value) {
			 				if ($value['id']!=2){
			 				echo "<option value=".$value['id'].">".$value['name']."</option>";
			 				}
			 			}
				 		
				 		?>
				 	</select>
				 	<span class="focus"></span>
			 	</div>
		 	</div>
		 </div>
		 <input type="submit" name="newuser" class="btn_order" value="Добавить пользователя">
	 </form>
</div>
</div>
</body>
</html>
