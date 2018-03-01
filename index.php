<?php
/**
 * Created by PhpStorm.
 * User: sctrm
 * Date: 1/18/2018
 * Time: 6:47 PM
 */
session_start();
require "config.php";
require "data_handling.php";


$test = "https://api.twitch.tv/helix/users?login=monstercat";
$ex = tAPI($test);
$a = json_decode($ex);


trashOld();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PH3AR The Stream!</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://embed.twitch.tv/embed/v1.js"></script>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-sm bg-dark fixed-top">
        <a class="navbar-brand" href="#"><img src="assets/Ph3ar_Logo.png"></a>
        <ul class="navbar-nav float-right ml-auto">
            <li class="nav-item">
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#streamForm">Start Your Stream</button>
            </li>
        </ul>
    </nav>

    <div class='col-lg-12 col-md-12 col-sm-12 streamArea'>
    <?php
        $result = $conn->query("SELECT username from streams");
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
    ?>
    </div>

    <!-------Modal------>
    <div class="modal fade" id="streamForm" tabindex="-1" role="dialog" aria-labelledby="streamFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="streamFormlabel">Share Your Stream!</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="upload.php" method="post">
                        <div class="form-group">
                            <label for="streamUsr">Twitch Username</label>
                            <input id="streamUsr" name="streamUsr" type="text" class="form-control form-control-lg" placeholder="Enter Twitch Username">
                            <small class="form-text text-muted">Please make sure you are streaming before sharing your stream here</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-------Error Modal------>
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="streamFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="errorFormlabel">Oops! Looks Like Your Stream Or The Username You Provided Doesn't Exist. Please Try Again</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="upload.php" method="post">
                        <div class="form-group">
                            <label for="streamUsr">Twitch Username</label>
                            <input id="streamUsr" name="streamUsr" type="text" class="form-control form-control-lg" placeholder="Enter Twitch Username">
                            <small id="streamUsrHelp" class="form-text text-muted">Please make sure you are streaming before sharing your stream here</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-------Success Modal------>
    <div class="modal fade" tabindex="-1" role="dialog" id="successModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Your stream sharing was successful! Happy Watching!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



</body>
<?php
if(!empty($_SESSION["error1"])){
    if($_SESSION["error1"] === true){
        echo '<script type="text/javascript"> $(document).ready(function(){$("#errorModal").modal("show");});</script>';
        session_destroy();
    }
}

if(!empty($_SESSION["success1"])){
    if($_SESSION["success1"] === true){
        echo '<script type="text/javascript"> $(document).ready(function(){$("#successModal").modal("show");});</script>';
        session_destroy();
    }
}
?>
</html>