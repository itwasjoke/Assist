<?php
include '../config.php';
include '../fun.php';
?>
<?php include 'header_pages.php'; 
$studio_id=$_COOKIE['studio_id'];
?>
<h2>Управление услугами</h2>
<center>
    <form name="zakaz" method="post" action="service-edit.php">
        <input name='studio_id' type='hidden' value="<?=$studio_id?>">
        <input name='create_type' class="btn_create" type="submit" value="Создать новую услугу">
    </form>  
</center>
<?php

if (exist_data('edit_type_go')){
    $edit_data=createData(['id','name', 'description', 'type_id', 'implem']);
    $edit_data_cost=createData(['cost']);
    $edit_id_z=dataFromDb("SELECT st.id FROM studios_types st where st.type_id=".$edit_data['id']);
    foreach ($edit_id_z as $value) {
        $edit_data_cost['id']=$value['id'];
    }
    editData($edit_data, 'types');
    editData($edit_data_cost, 'studios_types');
    echo "<script>location.href = 'services-control.php';</script>";
}
if(exist_data('create_type_go')){

    $create_data=createData(['name', 'description', 'type_id', 'implem']);
    $dir='../img/';
    $file=$dir.basename($_FILES['file_type']['name']);
    copy($_FILES['file_type']['tmp_name'], $file);
    $create_data['img']=$_FILES['file_type']['name'];

    $sql_articul="SELECT ta.articul_type FROM types_about ta where ta.id=".$create_data['type_id'];
    $articul_data=dataFromDb($sql_articul);
    foreach ($articul_data as $value) {
        $art_data=$value['articul_type'];
    }

    $idn=dataFromDb('SELECT MAX(id) as "id" FROM types');
    foreach ($idn as $value) {
        $id=$value['id'];
    }
    $id=$id+1;
    $create_data['articul']=$id.$art_data."_st".$studio_id;
    insertData($create_data, 'types');
    $create_data_cost=createData(['cost']);
    $create_data_cost['studio_id']=$studio_id;
    $create_data_cost['type_id']=$id;
    insertData($create_data_cost, 'studios_types');
    echo "<script>location.href = 'services-control.php';</script>";
}



$sql='SELECT t.name as "type", t.img, t.description, t.articul, t.id, st.cost FROM studios_types st
join types t on t.id=st.type_id
where st.studio_id='.$studio_id;
$tp=dataFromDb($sql);
foreach ($tp as $type) {
    ?>
<div class="div_all_serv">
    <div class="div_service">
        <h4 class="name_studio"><?=$type['type']?></h4>
        <p class="art">Артикул: <?=$type['articul']?></p>
        <p><?=$type['description']?></p>

        <div class="div_serv_cost">
            <div>
                <form name="zakaz" method="post" action="service-edit.php">
                    <input name='type_id' type='hidden' value="<?=$type['id']?>">
                    <input name='studio_id' type='hidden' value="<?=$studio_id?>">
                    <input name='cost' type='hidden' value="<?=$type['cost']?>">
                    <input name='edit_type' class="btn_create" type="submit" value="Редактировать">
                </form>                    
            </div>
            <div>
                <h4 class="st_type">Пренаджлежит студии</h4>
                <h4 class="cost"><?=$type['cost']?> руб.</h4>      
            </div>
        </div>

    </div>
    <div class="div_service" style="background-image: url(../img/<?=$type['img']?>);
background-size: cover;">
    </div>
</div>
<hr>
    <?php
}

?>

</div>
</body>
</html>