<?php
/**
 * Created by PhpStorm.
 * User: sctrm
 * Date: 1/18/2018
 * Time: 6:47 PM
 */


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PH3AR The Stream!</title>
    <?php
    //Bootstrap For dummies
    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">'
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://embed.twitch.tv/embed/v1.js"></script>
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-sm bg-dark fixed-top">
        <a class="navbar-brand" href="#"><img src="assets/Ph3ar_Logo.png"></a>
        <ul class="navbar-nav float-right ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Log In</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#streamForm">Start Your Stream</button>
            </li>
        </ul>

    </nav>
    
    <?php
        require 'config.php';
        require 'functions.php';
        $result = $conn->query("SELECT streams from streams");
        while($row = $result->fetch_assoc()) {
            $stream = $row["streams"];

            echo '<div id="twitch-'.$stream.'" class="d-flex justify-content-center">
            <iframe src="https://embed.twitch.tv?channel='.$stream.'&amp;layout=video" allowfullscreen="" scrolling="no" frameborder="0" width="80%" height="480" autoplay=false></iframe>\
            </div>';


        }
    ?>

    <!-------Modal------>
    <div class="modal fade" id="streamForm" tabindex="-1" role="dialog" aria-labelledby="streamFormLabel" aria-hidden="true">

            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="streamFormlabel">Share Your Stream!</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="streamUser">Twitch Username</label>
                            <input id="streamUsr" type="text" class="form-control form-control-lg" placeholder="Enter Twitch Username">
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
</body>
</html>