<?php
require 'config.php';
function tAPI($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


    $headers = array();
    $headers[] = "Client-Id: v1o0a8wz5p6wuwnscblsfj0i6iijo4";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close ($ch);
    return $result;
}

function trashOld(){
    require 'config.php';
    $sql = "select * from streams";


    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $id = $row['userid'];
            $age = $row['age'];
            $deletecalc = time() - 18000;

            if($age < $deletecalc){
                $sql = "delete from streams where id = '$id'";
                $conn->query($sql);
            }
        }
    }
}