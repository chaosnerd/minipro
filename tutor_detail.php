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
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body class="" style="font-family: 'Kanit', sans-serif;">
<div class="container">
    <div class="row">
        <div class="col-xs-12" style="background: url('miniproject/miniproject/assets/images/head.png')">
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
            <div class="visible-xs " style="margin-top: 30px">
                <?php
                $sql = "SELECT * FROM users WHERE Users_id='" . $_GET['key'] . "'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                echo '     <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                    <span class="fa fa-user"></span>   ข้อมูลของติวเตอร์ 
                    </div>
                    <div class="panel-body">
                      <div class="form-group">
                                <div class="input-group col-xs-12">
                                   ชื่อ - นาวสกุล : ' . $row['Users_FullName'] . '<br>
                                    เพศ : ' . $row['Users_sex'] . '<br>
                                    ประวัติการศึกษา : ' . $row['Users_education'] . '<br>
                                      อาชีพ : ' . $row['Users_job'] . '<br>
                                       ชั้นที่สอน: '.$row['Users_grade'].'<br>
                                </div>
                            </div>
                    </div>
                </div>';


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