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
            <div class="visible-xs" style="margin-top: 30px">

                <?php
                $sql = "SELECT * FROM users WHERE Users_idName='" . $_SESSION['username'] . "'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                if ($_SESSION['type'] == 'tutor') {
                    echo '     <div class="panel panel-primary">
                    <div class="panel-heading">
                    <span class="fa fa-user"></span>   PROFILE 
                    </div>
                    <div class="panel-body">
                      <div class="form-group">
                                <div class="input-group col-xs-12">
                                   ชื่อ - นาวสกุล : ' . $row['Users_FullName'] . '<br>
                                    เพศ : ' . $row['Users_sex'] . '<br>
                                    ประวัติการศึกษา : ' . $row['Users_education'] . '<br>
                                      อาชีพ : ' . $row['Users_job'] . '<br>
                                       ชั้นที่สอน: '.$row['Users_grade'].'<br>
                                       ยอดเงินคงเหลือ: '.number_format($row['Users_money'],2).' บาท<br>
                                </div>
                            </div>
                    </div>
                </div>';
                } else {
                    echo '     <div class="panel panel-primary">
                    <div class="panel-heading">
                    <span class="fa fa-user"></span>   PROFILE 
                    </div>
                    <div class="panel-body">
                      <div class="form-group">
                                <div class="input-group col-xs-12">
                                    Username : ' . $row['Users_idName'] . '<br>
                                   ชื่อ - นาวสกุล : ' . $row['Users_FullName'] . '<br>
                                    เพศ : ' . $row['Users_sex'] . '<br>                                  
                                </div>
                            </div>
                    </div>
                </div>';
                }



                ?>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span class="fa fa-bullhorn"></span>   DASHBOARD
                    </div>
                    <div class="panel-body">
                        <?php if ($_SESSION['type'] == 'tutor'): ?>
                            <?php
                                $sql = "SELECT COUNT(invoice.invoice_Id) as _count FROM `invoice` INNER JOIN course ON invoice.course_id = course.Course_id WHERE course.Users_id = '" . $_SESSION['user_id'] . "' AND invoice.invoice_status = 'done'";
                                $result = $conn->query($sql);
                            ?>
                            สอนไปทั้งหมด : <?=$result->fetch_assoc()['_count']?> ครั้ง <br>
                        <?php else: ?>
                            <?php
                                $sql = "SELECT COUNT(invoice.invoice_Id) as _count FROM `invoice` WHERE invoice.user_Id = '" . $_SESSION['user_id'] . "' AND invoice.invoice_status = 'done'";
                                $result = $conn->query($sql);
                            ?>
                            เรียนไปทั้งหมด : <?=$result->fetch_assoc()['_count']?> ครั้ง <br>
                        <?php endif; ?>
                    </div>
                </div>


                <div class="panel panel-info">
                    <div class="panel-heading">
                        <span class="fa fa-list"></span>   Invoice List
                    </div>
                    <div class="panel-body">
                        <?php
                            if($_SESSION['type'] == 'student'){
                                $invoice_list = $conn->query('SELECT * FROM invoice INNER JOIN course ON invoice.course_id = course.Course_id INNER JOIN users ON course.Users_id = users.Users_id WHERE invoice.user_Id = "'.$_SESSION['user_id'].'" ORDER BY invoice.invoice_id DESC');
                                if($invoice_list->num_rows > 0):
                                    while ($row = $invoice_list->fetch_assoc()):
                                        ?>
                                        <a href="invoiceView.php?id=<?=$row['invoice_Id']?>" class="list-group-item">
                                            <h4 class="list-group-item-heading"><?=$row['Course_Name']?></h4>
                                            <p class="list-group-item-text">
                                                <span class="pull-right"><i class="fa fa-search" style="font-size: 20px;"></i></span>
                                                ผู้สอน : <?=$row['Users_FullName']?><br>
                                                สถานะ : <?=$row['invoice_status']?>
                                            </p>
                                        </a>
                                        <?php
                                    endwhile;
                                else:
                                    echo '<h4>ไม่พบข้อมูล</h4>';
                                endif;
                            }else{
                                $invoice_list = $conn->query('SELECT * FROM invoice INNER JOIN course ON invoice.course_id = course.Course_id INNER JOIN users ON invoice.user_Id = users.Users_id WHERE course.Users_id = "'.$_SESSION['user_id'].'" ORDER BY invoice.invoice_id DESC');
                                if($invoice_list->num_rows > 0):
                                    while ($row = $invoice_list->fetch_assoc()):
                                        ?>
                                        <a href="invoiceView.php?id=<?=$row['invoice_Id']?>" class="list-group-item">
                                            <h4 class="list-group-item-heading"><?=$row['Course_Name']?></h4>
                                            <p class="list-group-item-text">
                                                <span class="pull-right"><i class="fa fa-search" style="font-size: 20px;"></i></span>
                                                ผู้เรียน : <?=$row['Users_FullName']?><br>
                                                สถานะ : <?=$row['invoice_status']?>
                                            </p>
                                        </a>
                                        <?php
                                    endwhile;
                                else:
                                    echo '<h4>ไม่พบข้อมูล</h4>';
                                endif;
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
                    <a href="profile.php" style="color: #717171;"><h3><span class="fa fa-user"></span></h3></a>
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