<?php
function exist_data($data){
    return isset($_POST[$data]);
}

function validEmail($email){
    $sql="SELECT * FROM users u where u.email='".$email."'";
    $in=mysqli_query($GLOBALS['con'], $sql);
    $c=0;
    foreach ($in as $in2) {
        $c+=1;
    }
    if ($c==0){
        return false;
    }
    elseif ($c==1) {
        return true;
    }
}

function getDateInFormat($date){
    $months = [
      'января',
      'февраля',
      'марта',
      'апреля',
      'мая',
      'июня',
      'июля',
      'августа',
      'сентября',
      'октября',
      'ноября',
      'декабря'
    ];
    $date_order1=strtotime($date);
    $date_order2=date('d', $date_order1).' '.$months[date('n', $date_order1)-1].' '.date('Y', $date_order1).' г.';
    return $date_order2;
}

function createData($data){
    $log=False;
    $data_values=array();
    foreach ($data as $value) {
        if (exist_data($value)){
            $log=True;
            $data_values[$value]=$_POST[$value];
        }
        else{
            echo "Error! Data is not exist.";
            $log=False;
            break;
        }
    }
    if ($log){
        return $data_values;
    }
}

function str_is_int($value){
        if (ctype_digit($value)) {
            return (int)$value;
        }
        else{
            return $value;
        }
}

function insertData($data, $table){
    $keys=array();
    $elements=array();
    foreach ($data as $key => $value) {
        $keys[]=$key;
        $elements[]=$value;
    }

    $keys_string=implode(', ', $keys);
    $elem_string='"'.implode('", "', $elements).'"';

    $sql="INSERT IGNORE INTO ".$table." (".$keys_string.") VALUES (".$elem_string.")";
    $in=mysqli_query($GLOBALS['con'], $sql);
}

function editData($data, $table){
    $dat=array();
    foreach ($data as $key => $value) {
        if ($key!='id') $dat[]=$key."='".$value."'";
    }
    $sql = "UPDATE ".$table." SET " . implode(", ", $dat) . " WHERE id=".$data['id'];
    $in=mysqli_query($GLOBALS['con'], $sql);
}

function login($email, $password){
    $sql="SELECT u.id FROM users u where u.email='$email' and u.password='$password'";
    $res=mysqli_query($GLOBALS['con'], $sql);
    $id=-1;
    foreach ($res as $key => $value) {
        $id=$value['id'];
    }
    // print_r($id);
    if ($id>=0){
        setcookie('id_user', $id, 0, '/');
        return true;
    }
    else{
        return false;
    }
}

function is_user_logged_in(){
    if (isset($_COOKIE['id_user'])){
        return true;
    }
    else{
        return false;
    }
}

function get_current_user_id(){
    return $_COOKIE['id_user'];
}

function get_user_info($user_id){
    $sql="SELECT * FROM users u where u.id=".$user_id;
    $res=mysqli_query($GLOBALS['con'], $sql);
    $user=array();
    foreach ($res as $key1 => $value1) {
        foreach ($value1 as $key => $value) {
            $user[$key]=$value;
        }
        break;
    }
    return $user;
}

function dataFromDb($sql){
    $res=mysqli_query($GLOBALS['con'], $sql);
    return $res;
}


if (is_user_logged_in()){
    $m = get_user_info(get_current_user_id());
    setcookie("post_id", $m['post_id'], 0, '/');
    setcookie("studio_id", $m['studio_id'], 0, '/');
}
?>

