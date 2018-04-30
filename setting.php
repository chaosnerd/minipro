<?php
session_start();
require 'connect_db.php';
if (empty($_SESSION['username'])) {
    echo '<meta http-equiv="refresh" content="0;URL=\'home.php\'" />';
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
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/main.css?v=1">
</head>
<body class="" style="font-family: 'Kanit', sans-serif;">
<div class="container">
    <div class="row">
        <div class="col-xs-12" style="background: url('assets/images/head.png')">
            <div class="visible-xs">
                <?php
                if ($_SESSION['type'] == 'tutor') {
                    echo ' <div class="top-left"><a href="tutor.php"><h3><span class="fa fa-arrow-left"></span></h3></a></div>';
                } else {
                    echo ' <div class="top-left"><a href="student.php"><h3><span class="fa fa-arrow-left"></span></h3></a></div>';
                }
                ?>

                <img src="assets/images/logo.png" class="img-responsive" alt="">
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="visible-xs text-center" style="margin-top: 30px">
                <?php
                if (isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['repassworad'])) {
                    if (!empty($_POST['oldpassword']) && !empty($_POST['newpassword']) && !empty($_POST['repassworad'])) {
                        if ($_POST['newpassword'] == $_POST['repassworad']) {
                            $sql = "UPDATE users SET Users_password='" . $_POST['repassworad'] . "' WHERE Users_idName='" . $_SESSION['username'] . "' ";
                            if ($conn->query($sql) === true) {
                                echo '<div class="alert alert-success text-center">
                       <strong> ระบบ ! </strong> Password เปลี่ยน Password สำเร็จ <br>
                       กรุณาออกจากระบบเพื่อใช้ Password ใหม่
                        </div>';
                            } else {
                                echo '<div class="alert alert-danger">
                       <strong> Error ! </strong> ไม่สามารถเปลี่ยน Password ได้
                        </div>';
                            }

                        } else {
                            echo '<div class="alert alert-danger">
                       <strong> ระบบ ! </strong> Password ไม่ตรงกัน
                        </div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger">
                       <strong> ระบบ ! </strong> กรุณากรอกข้อมูลให้ครบถ้วน
                        </div>';
                    }

                }

                if (isset($_POST['education']) && isset($_POST['job']) && isset($_POST['grade'])) {
                    if (!empty($_POST['education']) && !empty($_POST['job']) && !empty($_POST['grade'])) {
                        $sql = "UPDATE users SET Users_education='" . $_POST['education'] . "',Users_job='" . $_POST['job'] . "',Users_grade='" . $_POST['grade'] . "' WHERE Users_idName='".$_SESSION['username']."'";
                        if ($conn->query($sql) === true) {
                            echo '<div class="alert alert-success">
                       <strong> สำเร็จ ! </strong> ทำการอัพเดต
                        </div>';

                        } else {
                            echo '<div class="alert alert-danger">
                       <strong> Error ! </strong> ไม่สามารถอัพเดต
                        </div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger">
                       <strong> แจ้งเตือน ! </strong> กรุณากรอกข้อมูลให้ครบ
                        </div>';
                    }
                }


                if ($_SESSION['type'] == 'tutor') {
                    $sql = "SELECT * FROM users WHERE Users_idName='" . $_SESSION['username'] . "' ";
                    $result = $conn->query($sql);
                    $row = '';
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                    }

                    echo '    <div class="panel panel-success">
                    <div class="panel-heading">
                        PROFILE <span class="fa fa-edit"></span>
                    </div>
                    <div class="panel-body">
                        <form action="setting.php" method="post">

                            <div class="form-group">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="  form-control" name="education"
                                           placeholder="ประวัติการศึกษา" value="'.$row['Users_education'].'" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="  form-control" name="job"
                                           placeholder="อาชีพ" value="'.$row['Users_job'].'" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="  form-control" name="grade"
                                           placeholder="ระดับชั้นที่สอน" value="'.$row['Users_grade'].'" required/>
                                </div>
                            </div>
                            <div class="input-group col-xs-12">
                                <button type="submit" class="btn btn-warning">อัพเดทข้อมูล</button>
                            </div>
                        </form>
                    </div>
                </div>';
                }
                ?>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        SETTING <span class="fa fa-cogs"></span>
                    </div>
                    <div class="panel-body">
                        <form action="setting.php" method="post">

                            <div class="form-group">
                                <div class="input-group col-xs-12">
                                    <input type="password" class="  form-control" name="oldpassword"
                                           placeholder="OLD PASSWORD" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group col-xs-12">
                                    <input type="password" class="  form-control" name="newpassword"
                                           placeholder="NEW PASSWORD" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group col-xs-12">
                                    <input type="password" class="  form-control" name="repassworad"
                                           placeholder="RE PASSWORD" required/>
                                </div>
                            </div>
                            <div class="input-group col-xs-12">
                                <button type="submit" class="btn btn-danger">เปลี่ยนรหัสผ่าน</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span class="fa fa-user"></span>
                    </div>
                    <div class="panel-body">
                        <a href="logout.php" class="btn btn-warning btn-block">ออกจากระบบ</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row" style="margin-top: 100px">
        <div class="visible-xs">
            <footer class="footer">
                <div class="col-xs-4">
                    <a href="profile.php" style="color: #d0d0d0;"><h3><span class="fa fa-user"></span></h3></a>
                </div>
                <div class="col-xs-4">
                    <a href="chat.php" style="color: #d0d0d0;"><h3><span class="fa fa-comments"></span></h3></a>
                </div>
                <div class="col-xs-4">
                    <a href="setting.php" style="color: #717171;"><h3><span class="fa fa-cogs"></span></h3></a>
                </div>

            </footer>
        </div>
    </div>
</div>

</body>
</html>