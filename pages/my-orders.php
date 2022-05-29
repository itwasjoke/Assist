<?php
include '../config.php';
include '../fun.php';
?>
<?php include 'header_pages.php'; ?>
<h2>Мои заказы</h2>

<?php
if (exist_data('order1')){
    $data= createData(['id', 'comment', 'cost','art', 'implem']);
    $sql_st="SELECT * FROM studios_types st where type_id=".$data['id'];
    $studio_type=dataFromDb($sql_st);
    $n = date("w", mktime(0,0,0,date("m"),date("d"),date("Y")));
    switch ($n) {
        case 0:
            $data['implem']+=1;
            break;
        case 5:
            $data['implem']+=2;
            break;
        case 6:
            $data['implem']+=2;
            break;
        default:
            break;
    }




    $count=0;
    $sql_last_id="SELECT o.id from orders o order by id desc limit 1";
    $last_id=dataFromDb($sql_last_id);
    foreach ($last_id as $value) {
        $count++;
        $id_last=$value['id']+1;
    }
    if ($count==0){
        $id_last=1;
    }


    $id_user=get_current_user_id();
    $order=array();
    $order['number']=$id_last;
    $order['date_order']='now()';
    $order['date_deadline']='DATE_ADD(now(), interval '.$data['implem'].' DAY)';
    $order['comment']=$data['comment'];
    $order['user_id']=$id_user;
    $sql="INSERT IGNORE INTO orders (number, date_order, date_deadline, comment, user_id) VALUES ('".$order['number']."', now(), ".$order['date_deadline'].", '".$order['comment']."', '".$order['user_id']."')";
    $in=mysqli_query($con, $sql);

    $st=0;
    foreach ($studio_type as $value) {
        $st=$value['id'];
    }
    $id_new_order=mysqli_insert_id($con);
    $order_about=array();
    $order_about['order_id']=$id_new_order;
    $order_about['studios_types_id']=$st;
    $order_about['status_id']=1;
    $order_about['cost']=$data['cost'];
    insertData($order_about, 'order_about');
    echo "<script>location.href = 'my-orders.php';</script>";
}



if (is_user_logged_in()){  
    $sql_orders="SELECT o.number, oa.status_id, o.date_order, o.date_deadline, o.comment, st.cost,  s.name as 'studio', s.address, t.name as 'type', t.description FROM orders o
join order_about oa on oa.order_id=o.id
join studios_types st on st.id=oa.studios_types_id
join types t on st.type_id=t.id
join studios s on s.id=st.studio_id
where o.user_id=".get_current_user_id();
    $orders=dataFromDb($sql_orders);
    $user=get_user_info(get_current_user_id());
    foreach ($orders as $order) {
        $sql_status="SELECT * FROM status s where s.id=".$order['status_id'];
        $status=dataFromDb($sql_status);
        foreach ($status as $status_val) {
            $order_status=$status_val['name'];
        }
        
        $date_order2=getDateInFormat($order['date_order']);
        $date_deadline2=getDateInFormat($order['date_deadline']);
    

    ?>
    <div class="div_all_serv">
        <div class="div_service1">
            <div>
                <h4 class="name_studio">Заказ № <?=$order['number']?></h4>
                <p class="art">Ваш комментарий</p>
                <p><?=$order['comment']?></p>
                <p class="art">Дата заказа</p>
                <p><?=$date_order2?></p>
                <p class="art">Дата готовности</p>
                <p><?=$date_deadline2?></p>
                <p class="art">Данные клиента</p>
                <p><?=$user['first_name']?> <?=$user['second_name']?> <?=$user['email']?></p>
            </div>
            <div class="div_serv_cost">
                <div></div>
                <div>
                    <h4 class="st_type">Статус заказа:</h4>
                    <h4 class="cost"><?=$order_status?></h4>      
                </div>
            </div>

        </div>
        <div class="div_service">
            <h4 class="name_studio">О услуге</h4>
            <p class="art">Название</p>
            <p><?=$order['type']?></p>
            <p class="art">Описание</p>
            <p><?=$order['description']?></p>
            <p class="art">Студия</p>
            <p><?=$order['studio']?></p>
            <p class="art">Адрес студии</p>
            <p><?=$order['address']?></p>
            <p class="art">Стоимость услуги</p>
            <p><?=$order['cost']?> руб.</p>
        </div>
    </div>
    <hr>


<?php
}
} else {
 ?>
<h3>Авторизируйтесь, чтобы просматривать свои заказы.</h3>


<?php } ?>
</div>
</body>
</html>