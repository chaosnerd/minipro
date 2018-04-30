<?php
session_start();
require 'connect_db.php';
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
    <link rel="stylesheet" href="assets/css/main.css?v=1">
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
                <form action="register.php" method="post" class="text-center">
                    <div class="col-xs-2">

                    </div>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="username" id="username" placeholder="ID ....." required>
                        <input type="password" class="form-control" name="password" id="password" placeholder="PASSWORD .."
                               required>
                        <input type="password" class="form-control" name="repassword" id="repassword" placeholder="RE PASSWORD"
                               required>
                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="ชื่อ - นามสกุล"
                               required>
                        <div class="form-group">
                            <input type="radio" name="sex" value="male" required>
                            <label>MALE</label>
                            <input type="radio" name="sex" value="female" required>
                            <label>FEMALE</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="type" value="student" required>
                            <label>STUDENT</label>
                            <input type="radio" name="type" value="tutor" required>
                            <label>TUTOR</label>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block">สมัครสมาชิก</button>

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
            if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword']) && isset($_POST['fullname']) && isset($_POST['type']) && isset($_POST['sex'])) {
                if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['repassword']) && !empty($_POST['fullname'])) {
                    if (preg_match('/^[a-z0-9]+$/i', $_POST['username']) && preg_match('/^[a-z0-9]+$/i', $_POST['password']) && preg_match('/^[a-z0-9]+$/i', $_POST['repassword'])) {
                        if ($_POST['password'] == $_POST['repassword']) {
                            $sql_check = "SELECT * FROM users WHERE Users_idName='" . $_POST['username'] . "'";
                            $result_check = $conn->query($sql_check);
                            if ($result_check->num_rows > 0) {
                                echo '<div class="alert alert-danger">
                          <strong>แจ้งเตือน !</strong> มีผู้ใช้งานนี้อยู่ในระบบเแล้ว
                        </div>';
                            } else {
                                if ($_POST['type'] == 'tutor') {
                                    $sql = "INSERT INTO users (Users_idName,Users_password,Users_FullName,Users_type,Users_sex,Users_status) VALUE ('" . $_POST['username'] . "','" . $_POST['repassword'] . "','" . $_POST['fullname'] . "','" . $_POST['type'] . "','" . $_POST['sex'] . "','0')";

                                    if ($conn->query($sql) === true){
                                        $_SESSION['user_id'] = $conn->insert_id;
                                        $_SESSION['username'] = $_POST['username'];
                                        $_SESSION['Users_FullName'] = $_POST['fullname'];
                                        $_SESSION['type'] = $_POST['type'];
                                        echo '<meta http-equiv= "refresh" content="0; url=pay.php?key=' . $_POST['username'] . '"/>';
                                    } else {
                                        echo '<div class="alert alert-danger">
                          <strong>แจ้งเตือน !</strong> Error ไม่สามารถสมัครสมาชิกได้
                        </div>';
                                    }

                                } else {
                                    $sql = "INSERT INTO users (Users_idName,Users_password,Users_FullName,Users_type,Users_sex,Users_status) VALUE ('" . $_POST['username'] . "','" . $_POST['repassword'] . "','" . $_POST['fullname'] . "','" . $_POST['type'] . "','" . $_POST['sex'] . "','0')";

                                    if ($conn->query($sql) === true) {
                                        $_SESSION['user_id'] = $conn->insert_id;
                                        $_SESSION['username'] = $_POST['username'];
                                        $_SESSION['Users_FullName'] = $_POST['fullname'];
                                        $_SESSION['type'] = $_POST['type'];
                                        echo '<meta http-equiv="refresh" content="0;URL=\'student.php\'" />';
                                    } else {
                                        echo '<div class="alert alert-danger">
                          <strong>แจ้งเตือน !</strong> Error ไม่สามารถสมัครสมาชิกได้
                        </div>';
                                    }
                                }
                            }
                        } else {
                            echo '<div class="alert alert-danger">
                          <strong>แจ้งเตือน !</strong> PASSWORD ไม่ตรงกัน
                        </div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger">
                          <strong>แจ้งเตือน !</strong> ใช้ภาษาอังกฤษ และตัวเลขเท่านั้น
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