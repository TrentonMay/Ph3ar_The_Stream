<?php
/**
 * Created by PhpStorm.
 * User: Trent
 * Date: 1/30/18
 * Time: 7:21 PM
 */
session_start();
require "data_handling.php";
require "config.php";


if(isset($_POST['streamUsr'])){
    $username = $_POST['streamUsr'];
    $apiCall = "https://api.twitch.tv/helix/users?login=".$username;
    $getApiData = tAPI($apiCall);
    $data = json_decode($getApiData);

    if(!empty($data->data[0]->id)){
        $userid = $data->data[0]->id;
        $utime = time();

        $sql = "insert into streams(username, userid, age) VALUES ('$username', '$userid','$utime')";
        $conn->query($sql);
        $_SESSION["success1"] = true;
        header("Location: http://localhost:8888/Ph3ar_The_Stream/index.php", true, 303);

        //header("Location: http://rdservers.site.nfoservers.com", true, 303);
        exit();

    }else{
        $_SESSION["error1"] = true;
        header("Location: http://localhost:8888/Ph3ar_The_Stream/index.php", true, 303);

        //header("Location: http://rdservers.site.nfoservers.com", true, 303);
        exit();
    }
}else{
    $_SESSION["error2"] = true;
    header("Location: http://localhost:8888/Ph3ar_The_Stream/index.php", true, 303);

    //header("Location: http://rdservers.site.nfoservers.com", true, 303);
    exit();
}

?>