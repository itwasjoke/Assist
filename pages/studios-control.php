<?php
include '../config.php';
include '../fun.php';
?>
<?php include 'header_pages.php'; ?>
<h2>Администрирование студии</h2>

<?php
$studio_id=$_COOKIE['studio_id'];

if (exist_data('new_info')){
    $editInfo=createData(['id', 'name', 'description', 'address']);
    editData($editInfo, 'studios');
}

$sql_studio="SELECT * FROM studios s where s.id=".$studio_id;
$studio=dataFromDb($sql_studio);
$s_data=array();
foreach ($studio as $fuc) {
    foreach ($fuc as $key => $value) {
        $s_data[$key]=$value;
    }
}
$sql_users="SELECT u.first_name, u.second_name, p.name FROM users u 
join posts p on p.id=u.post_id
where studio_id=".$studio_id;
$u_data=dataFromDb($sql_users);


?>



    <div class="div_all_serv">
        <div class="div_service1">
            <div>
                <h4 class="name_studio"><?=$s_data['name']?></h4>
                <p class="art">Описание</p>
                <p><?=$s_data['description']?></p>
                <p class="art">Адрес</p>
                <p><?=$s_data['address']?></p>
            </div>
            <form name="zakaz" method="post" action="studio-edit.php">
                <input name='studio_id' type='hidden' value="<?=$studio_id?>">
                <input name='just_go' class="btn_create" type="submit" value="Редактировать">
            </form> 

        </div>
        <div class="div_service">
            <h4 class="name_studio">Сотрудники</h4>
            <?php 
            foreach ($u_data as $value) {
            
            ?>
            <p class="art"><?=$value['name']?></p>
            <p><?=$value['first_name']?> <?=$value['second_name']?></p>
            <?php } ?>
            <form name="zakaz" method="post" action="users-edit.php">
                <input name='studio_id' type='hidden' value="<?=$studio_id?>">
                <input name='edit_users' class="btn_create" type="button" onclick="location.href = 'users-edit.php'" value="Редактировать">
            </form> 
        </div>
    </div>
    <hr>


</div>
</body>
</html>
