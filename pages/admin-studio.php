<?php
include '../config.php';
include '../fun.php';
?>
<?php include 'header_pages.php'; ?>
<h2>Администрирование студии</h2>

<?php
$studio_id=$_COOKIE['studio_id'];

if (exist_data('new_stud')){
    $all=createData(['name', 'description', 'address', 'admin']);
    $dir='../img/';
    $file=$dir.basename($_FILES['photo']['name']);
    copy($_FILES['photo']['tmp_name'], $file);
    $newstud['img']=$_FILES['photo']['name'];
    $newstud['name']=$all['name'];
    $newstud['description']=$all['description'];
    $newstud['address']=$all['address'];
    insertData($newstud, 'studios');
    if (validEmail($all['admin'])){
        $sql_id_n="SELECT u.id FROM users u where u.email='".$all['admin']."'";
        $admin_id=dataFromDb($sql_id_n);
        foreach ($admin_id as $key) {
            foreach ($key as $noth2) {
                $id_n=$noth2['id'];
            }
        }
        $sql_count="SELECT count(s.id) as 'count' FROM studios s";
        $c=dataFromDb($sql_count);
        foreach ($c as $key) {
            foreach ($key as $noth2) {
                $count_all=$noth2['count'];
            }
        }
        $u['id']=$id_n;
        $u['post_id']=3;
        $u['studio_id']=$count_all;
        editData($u, 'users');
    }
}

if (exist_data('edit_admin')){
    $data=createData(['email', 'studio_id']);
    if (validEmail($data['email'])){

        $sql_old_admin="SELECT u.id FROM users u where u.post_id=3 and studio_id=".$data['studio_id'];
        $admin_id=dataFromDb($sql_old_admin);
        foreach ($admin_id as $key) {
            foreach ($key as $noth2) {
                $id_old=$noth2['id'];
            }
        }
        $user_ao['id']=$id_old;
        $user_ao['studio_id']='';
        $user_ao['post_id']=1;
        editData($user_ao, 'users');


        $sql_admin_user="SELECT u.id FROM users u where u.email='".$data['email']."'";
        $u_id=dataFromDb($sql_admin_user);
        foreach ($u_id as $key) {
            foreach ($key as $noth2) {
                $id=$noth2['id'];
            }
        }
        $user_a['id']=$id;
        $user_a['studio_id']=$data['studio_id'];
        $user_a['post_id']=3;
        editData($user_a, 'users');
        
    }
}
?>
<center>
<form name="zakaz" method="post" action="studio-edit.php">
        <input name='edit_admin' class="btn_create" type="submit" value="Создать новую студию">
</form> 
</center>
<?php


$sql_studio="SELECT * FROM studios";
$studio=dataFromDb($sql_studio);
$s_data=array();
foreach ($studio as $fuck) {
    foreach ($fuck as $key => $value) {
        $s_data[$key]=$value;
    }





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

        </div>
        <div class="div_service">
            <h4 class="name_studio">Руководитель:</h4>
            <?php 
            // print_r($s_data['id']);
            $sql_admin="SELECT * FROM users u where u.post_id=3 and u.studio_id=".$s_data['id'];
            $u_data=dataFromDb($sql_admin);
            $value=array();
            foreach ($u_data as $fu) {
                foreach ($fu as $key => $val) {
                    $value[$key]=$val;
                } 
            }
            // print_r($value);
            
            ?>
            
            <p><?=$value['first_name']?> <?=$value['second_name']?></p>
            <!-- <p class="art">Почта: </p> -->
            
            <form name="zakaz" method="post" class='fm' action="admin-studio.php">
                <input name='studio_id' type='hidden' value="<?=$studio_id?>">
                <input type="text" value="<?=$value['email']?>" name='email'>
                <input name='edit_admin' class="btn_create" type="submit" value="Изменить">
            </form> 
            <?php  ?>
        </div>
    </div>
    <hr>
    <?php } ?>


</div>
</body>
</html>