<?php
session_start();
require 'connect_db.php';
if (empty($_SESSION['username'])) {

    echo '<meta http-equiv="refresh" content="0;URL=\'home.php\'" />';
    exit();
} else {
    if (empty($_GET['key'])) {
        session_destroy();
        echo '<meta http-equiv="refresh" content="0;URL=\'home.php\'" />';
        exit();
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
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/main.css?v=1">
</head>
<body class="" style="font-family: 'Kanit', sans-serif;">
<div class="container">

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
                <form action="pay.php?key=<?= $_GET['key'] ?>" method="post">
                    <div class="form-group ">
                        <div class="input-group col-xs-12">
                            <input type="text" class="  form-control" name="truemoney" placeholder="เลขบัตรทรูมันนี่"
                                   required/>
                            <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">
                                        เติมเงิน
                                    </button>
                        </span>
                        </div>
                    </div>
                    <div class="form-group ">
                        <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?php
            if (isset($_POST['truemoney'])) {
                if (!empty($_POST['truemoney'])) {
                    switch ($_POST['truemoney']) {
                        case "11111111111111":

                            $sql = "UPDATE users SET Users_status='1' WHERE Users_idName='" . $_GET['key'] . "'";
                            if ($conn->query($sql) === true) {
                                echo '<div class="alert alert-success">
                          <strong>สำเร็จ !</strong> คุณได้เติมเงินจำนวน 50 บาท กรุณารอระบบพาไปยังหน้าสมาชิก
                        </div>';
                                echo '<meta http-equiv="refresh" content="3;URL=\'tutor.php\'" />';
                            }
                            break;
                        case "22222222222222":
                            $sql = "UPDATE users SET Users_status='1' WHERE Users_idName='" . $_GET['key'] . "'";
                            if ($conn->query($sql) === true) {
                                echo '<div class="alert alert-success">
                          <strong>สำเร็จ !</strong> คุณได้เติมเงินจำนวน 90 บาท กรุณารอระบบพาไปยังหน้าสมาชิก
                        </div>';
                                echo '<meta http-equiv="refresh" content="3;URL=\'tutor.php\'" />';
                            }
                            break;
                        case "33333333333333":
                            $sql = "UPDATE users SET Users_status='1' WHERE Users_idName='" . $_GET['key'] . "'";
                            if ($conn->query($sql) === true) {
                                echo '<div class="alert alert-success">
                          <strong>สำเร็จ !</strong> คุณได้เติมเงินจำนวน 150 บาท กรุณารอระบบพาไปยังหน้าสมาชิก
                        </div>';
                                echo '<meta http-equiv="refresh" content="3;URL=\'tutor.php\'" />';
                            }
                            break;
                        case "44444444444444":
                            $sql = "UPDATE users SET Users_status='1' WHERE Users_idName='" . $_GET['key'] . "'";
                            if ($conn->query($sql) === true) {
                                echo '<div class="alert alert-success">
                          <strong>สำเร็จ !</strong> คุณได้เติมเงินจำนวน 300 บาท กรุณารอระบบพาไปยังหน้าสมาชิก
                        </div>';
                                echo '<meta http-equiv="refresh" content="3;URL=\'tutor.php\'" />';
                            }
                            break;
                        default:
                            echo '<div class="alert alert-danger">
                          <strong>ระบบ !</strong> รหัสบัตรทรูมันนี่ผิด หรือ บัตรนี้ถูกใช้เรียบร้อยแล้ว
                        </div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">
                          <strong>แจ้งเตือน !</strong> กรุณากรอก รหัส 14 หลัก
                        </div>';
                }
            }
            ?>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="visible-xs text-center" style="margin-top: 30px">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        แจ้งเตือน !
                    </div>
                    <div class="panel-body">
                        ค่าสมัครสมาชิก ?? บาท <br>
                        หากท่านชำระเกินระบบจะไม่ทำการคืนเงินให้ท่าน <br>
                        กรุณาเตรียมบัตรให้พอดีราคา
                        <br>
                        ประสงค์จะสนับสนุนสามารถเติมเงินเกินราคาได้เลยค่ะ
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>