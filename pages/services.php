<?php
include '../config.php';
include '../fun.php';
?>
<?php include 'header_pages.php'; ?>
<h2>Услуги</h2>
<!-- <h4 class="user_about">Сортировка</h4>
<div style="width: 30%; margin: 5px 20px;">
    <div class="select">
        <select id="standard-select" name='type_id'> -->
            <?php 
                // $sql2="SELECT ta.id, ta.name FROM types_about ta";
                // $about=dataFromDb($sql2);
                // echo "<option value=0>Не выбрано</option>";
                // foreach ($about as $value) {
                    // echo "<option value=".$value['id'].">".$value['name']."</option>";
                // }
            ?>
<!--         </select>
    </div>
</div> -->
    <?php
    $action="";
    if (is_user_logged_in()){
        $action="order.php";
    }
    else{
        $action="auth.php";
    }

    $sql2="SELECT * FROM types_about ta";
    $ta=dataFromDb($sql2);
    foreach ($ta as $about) {
        

        $sql='SELECT s.name as "studio", t.name as "type", t.img, t.description, t.articul, t.id, st.cost FROM studios_types st
        join studios s on s.id=st.studio_id
        join types t on t.id=st.type_id where t.type_id='.$about['id'];
        $tp=dataFromDb($sql);
        $count=0;
        foreach ($tp as $tp2){
            $count++;
        }
        if ($count!=0){

            ?>
        <div class="div_about_serv">
            <h4 class="zag_studio"><?=$about['name']?></h4>
            <p class="zag_service"><?=$about['description']?></p>
        </div>
        <?php


        foreach ($tp as $type) {

            ?>
        <div class="div_all_serv">
            <div class="div_service">
                <h4 class="name_studio"><?=$type['type']?></h4>
                <p class="art">Артикул: <?=$type['articul']?></p>
                <p><?=$type['description']?></p>

                <div class="div_serv_cost">
                    <div>
                        <form name="zakaz" method="post" action="<?=$action?>">
                            <input name='id' type='hidden' value="<?=$type['id']?>">
                            <input name='order' class="btn_create" type="submit" value="Заказать">
                        </form>                    
                    </div>
                    <div>
                        <h4 class="st_type">Студия: <?=$type['studio']?></h4>
                        <h4 class="cost"><?=$type['cost']?> руб.</h4>      
                    </div>
                </div>

            </div>
            <div class="div_service" style="background-image: url(../img/<?=$type['img']?>);
      background-size: cover;">
            </div>
        </div>
            <?php
        }
    }
        
    } ?>

</div>
</body>
</html>