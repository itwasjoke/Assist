<?php
include '../config.php';
include '../fun.php';
?>
<?php include 'header_pages.php'; ?>

<?php

 ?>
 <h2>Управление содержанием</h2>
<?php 
$post_id=$_COOKIE['post_id'];
if ($post_id==2) echo "<h4 class='control_lab'>Вы - администратор. Вы можете всё!</h4>";
elseif ($post_id==3) echo "<h4 class='control_lab'>Руководство студией</h4>";
else echo "<h4 class='control_lab'>Доступен просмотр заказов</h4>";
?>
<center>
<nav class="control">
	<?php 
	if ($post_id==2) echo "<li><a href='admin-studio.php'>Администрирование студий</a></li>";
	if ($post_id==3 or $post_id==2) echo "<li><a href='services-control.php'>Редактирование услуг</a></li>";
	if ($post_id==3 or $post_id==2) echo "<li><a href='studios-control.php'>Управление студией</a></li>";
	?>
	<li><a href='orders-control.php'>Работа над заказами</a></li>
</nav>
</center>
</div>
</body>
</html>
