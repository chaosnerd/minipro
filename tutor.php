<?php
session_start();
require 'connect_db.php';
if (empty($_SESSION['username'])) {
    echo '<meta http-equiv="refresh" content="0;URL=\'home.php\'" />';
    exit();
} else {
    $sql_check = "SELECT * FROM users WHERE Users_idName='" . $_SESSION['username'] . "'";
    $result = $conn->query($sql_check);
    $row = $result->fetch_assoc();
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
                <a href="open_subject.php" class="btn btn-success">ลงทะเบียนวิชา <span
                            class="fa fa-plus"></span></a><br><br>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4>วิชาที่กำลังเปิดสอน</h4>
                    </div>
                    <div class="panel-body ">
                        <?php
                        $sql_subject = "SELECT * FROM course INNER JOIN users ON course.Users_id = users.Users_id WHERE users.Users_idName = '" . $_SESSION['username'] . "'   ";
                        $result_subject = $conn->query($sql_subject);
                        if ($result_subject->num_rows > 0) {
                            echo '<table class="table">';
                            echo '<thead>
                            <tr>
                            
                            <th class="text-center">วิชา</th>
                            <th  class="text-center">ชั้น</th>                           
                            <th  class="text-center">ตัวเลือก</th>
                            </tr>
                            </thead><tbody>';
                            while ($row = $result_subject->fetch_assoc()) {
                                echo '<tr>
                              
                                <td>' . $row['Course_Name'] . '</td>                                
                                <td>' . $row['Course_Grade'] . '</td>
                                <td><a href="del_subject.php?key=' . $row['Course_id'] . '" class="btn btn-danger" onclick="return confirm(' . "'ยืนยันการลบ'" . ')"><span class="fa fa-trash"></span></a></td>
                                </tr>';
                            }
                            echo '</tbody></table>';
                        } else {
                            echo '<div class="alert alert-danger">
                          <strong>แจ้งเตือน !</strong> คุณยังไม่ได้ลงทะเบียนวิชาสอน
                        </div>';

                        }
                        ?>
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
                    <a href="setting.php" style="color: #d0d0d0;"><h3><span class="fa fa-cogs"></span></h3></a>
                </div>

            </footer>
        </div>
    </div>
</div>

</body>
</html>