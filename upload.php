<?php
/**
 * Created by PhpStorm.
 * User: Trent
 * Date: 1/30/18
 * Time: 7:21 PM
 */
session_start();
require "data_handling.php";

function checkExists($userid){
    $sql = "select * from streams where userid=$userid limit 1";
    $result = dbQuery($sql);
    if($result->num_rows) {
        return true;
    }
}

if(isset($_POST['streamUsr'])){
    $username = $_POST['streamUsr'];
    $apiCall = "https://api.twitch.tv/helix/users?login=".$username;
    $getApiData = tAPI($apiCall);
    $data = json_decode($getApiData);

    if(!empty($data->data[0]->id)){
        $userid = $data->data[0]->id;
        $utime = time();

        if(!checkExists($userid)) {
            $sql = "insert into streams(username, userid, age) VALUES ('$username', '$userid','$utime')";
            dbQuery($sql);
        }

        $_SESSION["success1"] = true;
        header("Location: index.php", true, 303);
        exit();

    }else{
        $_SESSION["error1"] = true;
        header("Location: index.php", true, 303);
        exit();
    }
}else{
    $_SESSION["error2"] = true;
    header("Location: index.php", true, 303);
    exit();
}

?>