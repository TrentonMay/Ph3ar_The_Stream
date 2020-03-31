<?php
function dbQuery($query){
    require 'db_config.php';
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query($query);

    return $result;
}

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

function showStreams(){
    $result = dbQuery("SELECT username from streams");
    while($row = $result->fetch_assoc()) {
        $stream = $row["username"];


        echo '<div id="twitch-'.$stream.'" class="col-lg-6 col-md-6 col-sm-12 float-left  streams">
            <header class="col-lg-12 col-md-12 col-sm-12">
                <h4 class="text-center">Stream By '.$stream.'</h4>
            </header>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <iframe class="col-lg-12 col-md-12 col-sm-12" src="https://player.twitch.tv?channel='.$stream.'&autoplay=false&layout=video" allowfullscreen="" scrolling="no" frameborder="0" width="100%" height="400"></iframe>
                </div>

            </div>';
    }
}

function trashOld(){
    $sql = "select * from streams";


    $result = dbQuery($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $id = $row['userid'];
            $age = $row['age'];
            $deletecalc = time() - 18000;

            if($age < $deletecalc){
                $sql = "delete from streams where id = '$id'";
                dbQuery($sql);
            }
        }
    }
}
?>