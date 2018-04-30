<?php
session_start();
require 'connect_db.php';
if (empty($_SESSION['username'])) {
    echo '<meta http-equiv="refresh" content="0;URL=\'home.php\'" />';
    exit();
}
//if(isset($_SESSION['type']) && $_SESSION['type'] != "student") {
//    echo '<meta http-equiv="refresh" content="0;URL=\'home.php\'" />';
//    exit();
//}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/main.css?v=1">
</head>
<body class="" style="font-family: 'Kanit', sans-serif;">
<div class="container">

    <div class="row">
        <div class="col-xs-12" style="background: url('assets/images/head.png')">
            <div class="visible-xs">
                <?php

                if (isset($_POST['subject'])) {
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
                <form action="student.php" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" name="subject" placeholder="ค้นหาชื่อวิชา" />
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">
                                    <span class=" glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="grade" id="" class="form-control">
                            <option disabled selected>ระบุชั้นปีที่เปิดสอน (*ไม่จำเป็น)</option>
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
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-xs-12">
            <?php
            if (isset($_POST['subject']) || isset($_POST['grade'])) {
                if (!empty($_POST['subject'])||!empty($_POST['grade'])) {
//                    if(isset($_POST['grade'])) $andQ = "AND course.Course_Grade LIKE '%" . $_POST['grade'] . "%'";
//                    else $andQ = '';
                    $where = "";
                    if(!empty($_POST['subject'])) $where .= "course.Course_Name LIKE '%" . $_POST['subject'] . "%'";
                    if(!empty($_POST['subject']) && !empty($_POST['grade'])) $where .= " AND ";
                    if(!empty($_POST['grade'])) $where .= "course.Course_Grade = '" . $_POST['grade'] . "'";

                    $result_find = $conn->query('SELECT * FROM course INNER JOIN users ON course.Users_id = users.Users_id WHERE '.$where);
                    
                    if ($result_find->num_rows > 0) {
                        $conn->query('INSERT INTO `searchlogs`( `searchlogs_type`, `searchlogs_key`, `searchlogs_datetime`) VALUES ("'.($_POST['subject']!=""?'keyword':'grade').'","'.($_POST['subject']!=""?$_POST['subject']:$_POST['grade']).'","'.date('Y-m-d H:i:s',time()).'")');
                        echo '<div class="alert alert-info">
                          <strong>ผลการค้นหา !</strong> ' . ($_POST['subject']!=""?$_POST['subject']:$_POST['grade']) . '
                        </div>';

                        echo '<div class="list-group">';
                        while ($row = $result_find->fetch_assoc()) {
                            $sql_review = "SELECT COUNT(course_id) as count_id,SUM(review_point) as sum_point FROM review WHERE course_id = ".$row['Course_id']."";
                            $sql_count = "SELECT COUNT(review_datetime) AS review_count FROM review WHERE course_id = '".$row['Course_id']."' GROUP BY MONTH(review_datetime)";
                            $rs_review = $conn->query($sql_review);
                            $rs_count = $conn->query($sql_count);
                            $str = "";
                            $avg = 0;
                            $review = $rs_review->fetch_assoc();
                            $count = 0;
                            $n=0;
                            while ($co = $rs_count->fetch_assoc()) {
                                $count += $co["review_count"];
                                $n++;
                            }
                            if($n!=0){
                                $count= $count/$n;
                            }
                            if($review['count_id'] != 0) {
                                $avg = ($review['sum_point'] * 1.0) / ($review['count_id'] * 1.0);

                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= round($avg)) {
                                        $str .= '<i class="fa fa-star" style="color:chartreuse;font-size: 14px;"></i> ';
                                    } else {
                                        $str .= '<i class="fa fa-star-o" style="color:chartreuse;font-size: 14px;"></i> ';
                                    }
                                }
                            }else{
                                for ($i = 1; $i <= 5; $i++) {
                                    $str .= '<i class="fa fa-star-o" style="color:chartreuse;font-size: 14px;"></i> ';
                                }
                            }
                            echo '<span class="list-group-item">
                                    <h4 class="list-group-item-heading">' . $row['Course_Name'] . '</h4>
                                    <p class="list-group-item-text">
                                        <span class="pull-right" ><i class="fa fa-comments" onclick="window.location=\'chat.php?Users_id='.$row['Users_id'].'\';" style="font-size: 20px;"></i> <i class="fa fa-user-circle" onclick="window.location=\'tutor_detail.php?key='.$row['Users_id'].'\';" style="font-size: 20px;"></i></span>
                                        ชั้น : ' . $row['Course_Grade'] . '<br>
                                        ผู้สอน : ' . $row['Users_FullName'] . '<br>
                                        เพศ : ' . $row['Users_sex'] . '<br>
                                        รีวิว : '.$str.' ('.$avg.') <br>
                                        ผู้เรียนเฉลี่ยต่อเดือน : '.$count.'
                                    </p>
                                </span>';
                        }
                        echo '</div>';
                    }else {
                        echo '<div class="alert alert-danger">
                          <strong>แจ้งเตือน !</strong> ไม่มีข้อมูลที่คุณกำลังค้นหา
                        </div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">
                          <strong>แจ้งเตือน !</strong> กรุณากรอกชื่อรายวิชา
                        </div>';
                }
            } else {
                echo '   <div class="visible-xs">
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
            </div>';
            }
            ?>
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