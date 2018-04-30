<?php
session_start();
require 'connect_db.php';
$id = '';
if (empty($_SESSION['username'])) {
    echo '<meta http-equiv="refresh" content="0;URL=\'home.php\'" />';
    exit();
} else {
    $sql_check = "SELECT * FROM users WHERE Users_idName='" . $_SESSION['username'] . "'";
    $result = $conn->query($sql_check);
    $row = $result->fetch_assoc();
    $id = $row['Users_id'];
    if ($row['Users_status'] != '1') {
        echo '<meta http-equiv= "refresh" content="0; url=pay.php?key=' . $_SESSION['username'] . '"/>';
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

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/main.css?v=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="" style="font-family: 'Kanit', sans-serif;">
<div class="container">

    <div class="row">
        <div class="col-xs-12" style="background: url('assets/images/head.png')">
            <div class="visible-xs">
                <div class="top-left"><a href="tutor.php"><h3><span class="fa fa-arrow-left"></span></h3></a></div>
                <img src="assets/images/logo.png" class="img-responsive" alt="">
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="visible-xs text-center" style="margin-top: 30px">
                <form action="open_subject.php" method="post">
                    <div class="form-group">
                        <div class="col-xs-2">

                        </div>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="subject" placeholder="วิชาที่เปิดสอน .. ."
                                   required>
                            <select name="grade" id="" class="form-control">
                                <option disabled selected>ชั้นปีที่เปิดสอน . . .</option>
                                <option value="ประถมศึกษาปีที่ 1">ประถมศึกษาปีที่ 1</option>
                                <option value="ประถมศึกษาปีที่ 2">ประถมศึกษาปีที่ 2</option>
                                <option value="ประถมศึกษาปีที่ 3">ประถมศึกษาปีที่ 3</option>
                                <option value="ประถมศึกษาปีที่ 4">ประถมศึกษาปีที่ 4</option>
                                <option value="ประถมศึกษาปีที่ 5">ประถมศึกษาปีที่ 5</option>
                                <option value="ประถมศึกษาปีที่ 6">ประถมศึกษาปีที่ 6</option>
                                <option value="มัธยมศึกษาปีที่ 1">มัธยมศึกษาปีที่ 1</option>
                                <option value="มัธยมศึกษาปีที่ 2">มัธยมศึกษาปีที่ 2</option>
                                <option value="มัธยมศึกษาปีที่ 3">มัธยมศึกษาปีที่ 3</option>
                                <option value="มัธยมศึกษาปีที่ 4">มัธยมศึกษาปีที่ 4</option>
                                <option value="มัธยมศึกษาปีที่ 5">มัธยมศึกษาปีที่ 5</option>
                                <option value="มัธยมศึกษาปีที่ 6">มัธยมศึกษาปีที่ 6</option>
                                <option value="ปริญญาตรี ปี 1">ปริญญาตรี ปี 1</option>
                                <option value="ปริญญาตรี ปี 2">ปริญญาตรี ปี 2</option>
                                <option value="ปริญญาตรี ปี 3">ปริญญาตรี ปี 3</option>
                                <option value="ปริญญาตรี ปี 4">ปริญญาตรี ปี 4</option>
                                <option value="ปริญญาตรี ปี 5">ปริญญาตรี ปี 5</option>
                                <option value="ปริญญาตรี ปี 6">ปริญญาตรี ปี 6</option>
                            </select>
                            <br>
                            <button type="submit" class="btn btn-success">ลงทะเบียนวิชา</button>

                        </div>
                        <div class="col-xs-2">

                        </div>
                    </div>


                </form>


            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="visible-xs text-center" style="margin-top: 30px">
                <?php
                if (isset($_POST['subject']) && isset($_POST['grade'])) {
                    if (!empty($_POST['subject']) && !empty($_POST['grade'])) {
                        $sql = "INSERT INTO course (Course_Name,Course_Grade,Users_id) VALUE ('" . $_POST['subject'] . "','" . $_POST['grade'] . "','" . $id . "')";
                        if ($conn->query($sql) === true) {
                            echo '<meta http-equiv="refresh" content="0;URL=\'tutor.php\'" />';
                        } else {
                            echo '<div class="alert alert-danger">
                          <strong>แจ้งเตือน !</strong> ไม่สามารถลงทะเบียนได้
                        </div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger">
                          <strong>แจ้งเตือน !</strong> กรุณรากรอกข้อมูล
                        </div>';
                    }
                }

                ?>


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
                    <a href="setting.php" style="color: #d0d0d0;"><h3><span class="fa fa-cogs"></span></h3></a>
                </div>

            </footer>
        </div>
    </div>
</div>

</body>
</html>