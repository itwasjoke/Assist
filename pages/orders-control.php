<?php
include '../config.php';
include '../fun.php';
?>
<?php include 'header_pages.php'; ?>
<h2>Заказы студии</h2>

<?php
if (exist_data('order_id')){
    $order_edits=createData(['status_id', 'order_id']);
    $sql = "UPDATE order_about SET status_id=" .$order_edits['status_id']. " WHERE order_id=".$order_edits['order_id'];
    $in=mysqli_query($GLOBALS['con'], $sql);
    echo "<script>location.href = 'orders-control.php';</script>";
}
$studio_id=$_COOKIE['studio_id'];
if (is_user_logged_in()){  
    $sql_orders="SELECT o.id, o.number, oa.status_id, o.date_order, o.date_deadline, o.comment, st.cost, t.name as 'type', o.user_id, t.description FROM orders o
join order_about oa on oa.order_id=o.id
join studios_types st on st.id=oa.studios_types_id
join types t on st.type_id=t.id
join studios s on s.id=st.studio_id
where s.id=".$studio_id;
    $orders=dataFromDb($sql_orders);
    
    foreach ($orders as $order) {
        $user=get_user_info($order['user_id']);
    ?>
    <div class="div_all_serv">
        <div class="div_service">
            <h4 class="name_studio">Заказ № <?=$order['number']?></h4>
            <p class="art">Ваш комментарий</p>
            <p><?=$order['comment']?></p>
            <p class="art">Дата заказа</p>
            <p><?=$order['date_order']?></p>
            <p class="art">Дата готовности</p>
            <p><?=$order['date_deadline']?></p>
            <p class="art">Данные клиента</p>
            <p><?=$user['first_name']?> <?=$user['second_name']?> <?=$user['email']?></p>
            <div class="div_serv_cost">
                <div></div>
                <div>
                    <h4 class="st_type">Статус заказа:</h4>
                    <div class="select">
                    <form method="post" action="orders-control.php">
                    <input type="hidden" name="order_id" value="<?=$order['id']?>">
                    <select class="cost" onchange="this.form.submit()" name='status_id'>
                        <?php

                        $sql_status="SELECT s.name, s.id FROM status s";
                        $status=dataFromDb($sql_status);
                        $sel='';
                        foreach ($status as $status_val) {
                            if ($status_val['id']==$order['status_id']){
                                $sel='selected';
                            }
                            else{ $sel=''; }
                            $order_status=$status_val['name'];
                            $order_status_id=$status_val['id'];
                            echo "<option ".$sel." value=".$order_status_id.">".$order_status."</option>";
                        ?>
                        <?php } ?>
                    </select>
                    </form>   
                    </div>
                </div>
            </div>

        </div>
        <div class="div_service">
            <h4 class="name_studio">О услуге</h4>
            <p class="art">Название</p>
            <p><?=$order['type']?></p>
            <p class="art">Описание</p>
            <p><?=$order['description']?></p>
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