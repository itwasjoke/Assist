<?php
include '../config.php';
include '../fun.php';
?>
<?php
if (exist_data('go_auth2')){
	insertData(
		createData(['first_name', 'second_name', 'email', 'password', 'post_id'])
		, 'users');
}
if (exist_data('go_auth1')){
	if (login($_POST['email'], $_POST['password'])){
		echo "<script>location.href = '../index.php';</script>";
	}
}
?>

 <?php include 'header_pages.php'; ?>


<div class='regist_forms'>
	<form id='auth1' name='login' method="post" action="auth.php"> 
	 	<div class='fm'>
		 	<h2>Вход</h2><br>
		 	<input type="email" name="email" placeholder="Почта"></input><br>
		 	<input type="password" name='password' placeholder="Пароль"></input><br>
	 	</div>
	 	<center>
		 	<input class="btn_create" type="submit" name="go_auth1" value='Отправить'></input><br>
		 	<input onclick="go_reg()" class="btn_change" type='button' value="Нет профиля? Зарегестрироваться">
	 	</center>
	</form>
	<form class='fm hide' id='auth2' name='regist' method="post" action="auth.php">
	 	<div class='fm'>
		 	<h2>Регистрация</h2><br>
		 	<input type="text" name="first_name" placeholder="Имя"></input><br>
		 	<input type="text" name="second_name" placeholder="Фамилия"></input><br>
		 	<input type="email" name="email" placeholder="Почта"></input><br>
		 	<input type="password" name='password' placeholder="Пароль"></input><br>
		 	<input type="hidden" name='post_id' value="1">
	 	</div>
	 	<center>
		 	<input class="btn_create" type="submit" name="go_auth2" value='Отправить'></input><br>
		 	<input onclick="go_log()" class="btn_change" type='button' value="Уже есть профиль? Войти">
	 	</center>
	</form>
	 <?php  ?>
</div>
</div>
</body>
</html>
