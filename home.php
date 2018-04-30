<?php
session_start();
require 'connect_db.php';
if (!empty($_SESSION['username'])) {
    if ($_SESSION['type'] == 'student') {
        echo '<meta http-equiv="refresh" content="0;URL=\'student.php\'" />';
    }else{
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
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="" style="font-family: 'Kanit', sans-serif;">
<div class="container">
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Banner</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="https://uppicimg.com/file/8WpdrYPU.gif" style="width: 100%" alt="">
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12" style="background: url('assets/images/head.png')">
            <div class="visible-xs">
                <img src="assets/images/logo.png" class="img-responsive" alt="">
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="visible-xs text-center" style="margin-top: 30px">
                <div class="col-xs-6">
                    <a href="login.php" class="btn btn-success btn-lg">เข้าสู่ระบบ</a>

                </div>
                <div class="col-xs-6">

                    <a href="register.php" class="btn btn-danger btn-lg">สมัครสมาชิก</a>
                </div>
            </div>

        </div>
    </div>
    <div class="row" style="margin-top: 50px">
        <div class="col-xs-12">
            <div class="visible-xs">
                <div class="col-xs-4">
                    <br>
                    <img src="assets/images/book.png" style="width: 100%" alt="">
                </div>
                <div class="col-xs-8">
                    <p>
                    <h3 class="text-center">LEARNER</h3>
                    <ul>
                        <li>ค้นหาติวเตอร์ที่ตรงใจ</li>
                        <li>ประกาศหาตัวติวเตอร์ตามความต้องการ</li>
                    </ul>
                    </p>
                </div>
            </div>
            <div class="visible-xs">
                <div class="col-xs-4">
                    <br>
                    <img src="assets/images/tutor.png" style="width: 100%" alt="">
                </div>
                <div class="col-xs-8">
                    <p>
                    <h3 class="text-center">TUTOR</h3>
                    <ul>
                        <li>รับคำปรึกษาเพื่อเพิ่มคุณภาพการสอน</li>
                        <li>เพิ่มจำนวนผู้เรียน</li>

                    </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(window).on('load', function () {
        $('#myModal').modal('show');
    });
</script>
</body>
</html>