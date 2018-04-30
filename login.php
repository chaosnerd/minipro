<?php
session_start();
require 'connect_db.php';
if (!empty($_SESSION['username'])) {
    if ($_SESSION['type'] == 'student') {
        echo '<meta http-equiv="refresh" content="0;URL=\'student.php\'" />';
    } else {
        $sql = "SELECT * FROM users WHERE Users_idName='" . $_SESSION['username'] . "'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if ($row['Users_status'] == '0') {
            echo '<meta http-equiv= "refresh" content="0; url=pay.php?key=' . $row['Users_idName'] . '"/>';
        } else {

            echo '<meta http-equiv="refresh" content="0;URL=\'tutor.php\'" />';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body class="" style="font-family: 'Kanit', sans-serif;">
<div class="container">
    <div class="row">
        <div class="col-xs-12" style="background: url('assets/images/head.png')">
            <div class="visible-xs">
                <div class="top-left"><a href="home.php"><h3><span class="fa fa-arrow-left"></span></h3></a></div>
                <img src="assets/images/logo.png" class="img-responsive" alt="">
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="visible-xs" style="margin-top: 50px">
                <form action="login.php" method="post" class="text-center">
                    <div class="col-xs-2">

                    </div>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="username" id="username" placeholder="ID .....">
                        <input type="password" class="form-control" name="password" id="password" placeholder="PASSWORD ..">
                        <br>
                        <button type="submit" class="btn btn-warning btn-block">เข้าสู่ระบบ</button>

                    </div>
                    <div class="col-xs-2">

                    </div>


                </form>
            </div>

        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-xs-1">

        </div>
        <div class="col-xs-10">
            <?php

            if (isset($_POST['username']) && isset($_POST['password'])) {
                if (!empty($_POST['username']) && !empty($_POST['password'])) {
                    $sql = "SELECT * FROM users WHERE Users_idName='" . trim($_POST['username']) . "' AND Users_password='" . trim($_POST['password']) . "'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        if ($row['Users_type'] == 'student') {
                            $_SESSION['user_id'] = $row['Users_id'];
                            $_SESSION['type'] = $row['Users_type'];
                            $_SESSION['username'] = $row['Users_idName'];
                            $_SESSION['Users_FullName'] = $row['Users_FullName'];
                            echo '<meta http-equiv="refresh" content="0;URL=\'student.php\'" />';
                        } else {
                            if ($row['Users_status'] == '0') {
                                $_SESSION['user_id'] = $row['Users_id'];
                                $_SESSION['type'] = $row['Users_type'];
                                $_SESSION['username'] = $row['Users_idName'];
                                $_SESSION['Users_FullName'] = $row['Users_FullName'];
                                echo '<meta http-equiv= "refresh" content="0; url=pay.php?key=' . $row['Users_idName'] . '"/>';
                            } else {
                                $_SESSION['user_id'] = $row['Users_id'];
                                $_SESSION['type'] = $row['Users_type'];
                                $_SESSION['username'] = $row['Users_idName'];
                                $_SESSION['Users_FullName'] = $row['Users_FullName'];
                                echo '<meta http-equiv="refresh" content="0;URL=\'tutor.php\'" />';
                            }
                        }

                    } else {
                        echo '<div class="alert alert-danger">
                          <strong>แจ้งเตือน !</strong> ไม่พบข้อมูลผู้ใช้ หรือข้อมูลไม่ถูกต้อง
                        </div>';

                    }
                } else {
                    echo '<div class="alert alert-danger">
                          <strong>แจ้งเตือน !</strong> กรุณากรอกข้อมูลให้ครบถ้วน
                        </div>';

                }
            }
            ?>
        </div>
        <div class="col-xs-1">

        </div>
    </div>
</div>

</body>
</html>