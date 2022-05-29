<?php
include 'config.php';
include 'fun.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="css/modal.css" rel="stylesheet" type="text/css"/>
    <link href="css/header.css" rel="stylesheet" type="text/css"/>
    <link href="css/simple-adaptive-slider.min.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="scripts/script.js"></script>

    <title>Flicker</title>
</head>
<body>

<header class="header">
    <div class="conteiner">
        <div class="header_body">
            <a href="#" class="header_logo">
                <h1>Flicker</h1>
            </a>
<!--             <div class="header_burger">
                <span></span>
            </div> -->
            <nav class="header_menu">
                <ul class="header_list">
                    <li><a href='pages/studios.php' class="header_link">Студии</a></li>
                    <li><a href='pages/services.php' class="header_link">Услуги</a></li>
                    <?php 
                    if (is_user_logged_in()){ 

                        ?>
                        <li><a href='pages/my-orders.php' class="header_link">Мои заказы</a></li>
                        <?php 
                        $m = get_user_info(get_current_user_id());
                        if ($m['post_id']!=1){
                        ?>

                        <li><a href='pages/admin.php' class="header_link">Управление</a></li>

                        <?php
                        }
                    ?>
                        <input type='button' value='Выйти' onclick="exit()" style="margin-left: 15px;">
                    <?php } else {?>
                        <li><a href='pages/auth.php' class="header_link">Авторизация</a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <div class="name">
            <p style="margin: 0 5px 0 0;">
                <?php 
                if (is_user_logged_in()){
                    $m = get_user_info(get_current_user_id());
                    $sql_user="SELECT p.name FROM posts p where p.id=".$m['post_id'];
                    $user_post=dataFromDb($sql_user);
                    foreach ($user_post as $value) {
                        $post=$value['name'];
                    }
                    echo $post.' - '.$m['first_name'].' '.$m['second_name'];
                }
                ?>
            </p>
        </div>
    </div>
</header>



