<?php
session_start();
require 'connect_db.php';
if (empty($_SESSION['username']) || !isset($_GET['id'])) {
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

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
                <div class="top-left"><a href="profile.php"><h3><span class="fa fa-arrow-left"></span></h3></a></div>
                <img src="assets/images/logo.png" class="img-responsive" alt="">
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="visible-xs" style="margin-top: 30px">
                <?php
                    if($_SESSION['type'] == 'student') {
                        $rs_invoice = $conn->query('SELECT * FROM invoice INNER JOIN course ON invoice.course_id = course.Course_id INNER JOIN users ON course.Users_id = users.Users_id WHERE invoice.invoice_id = "'.$_GET['id'].'"');

                        if(isset($_GET['cmd']) && $_GET['cmd'] == 'payment'){
                            $rs = $conn->query('UPDATE `invoice` SET `invoice_status`= "done" WHERE `invoice_Id` = "'.$_GET['id'].'"');
                            if($rs){
                                $row = $rs_invoice->fetch_assoc();
                                $conn->query('UPDATE `users` SET Users_money = (Users_money+'.$row['invoice_price'].') WHERE `Users_id` = "'.$row['Users_id'].'"');
                                echo '<meta http-equiv="refresh" content="0;URL=\'invoiceView.php?id='.$_GET['id'].'\'" />';
                            }
                        }

                    }
                    else $rs_invoice = $conn->query('SELECT * FROM invoice INNER JOIN course ON invoice.course_id = course.Course_id INNER JOIN users ON invoice.user_Id = users.Users_id WHERE invoice.invoice_id = "'.$_GET['id'].'"');
                    if($rs_invoice->num_rows < 1) die('<meta http-equiv="refresh" content="0;URL=\'profile.php\'" />');
                    $row = $rs_invoice->fetch_assoc();
                    $rs_review = $conn->query('SELECT * FROM review WHERE course_id = "'.$row['Course_id'].'" AND user_id = "'.$_SESSION['user_id'].'"');

                ?>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <span class="fa fa-search"></span> Invoice : <?=$_GET['id']?>
                    </div>
                    <div class="panel-body">
                        <p>
                            รายวิชา : <?=$row['Course_Name']?><br>
                            ระดับชั้นการสอน : <?=$row['Course_Grade']?><br>
                            <?php if($_SESSION['type'] == 'student'): ?>
                            ผู้สอน : <?=$row['Users_FullName']?><br>
                            <?php else: ?>
                            ผู้เรียน : <?=$row['Users_FullName']?><br>
                            <?php endif; ?>
                            ราคา : <?=$row['invoice_price']?><br>
                            รายละเอียดการสอน : <?=$row['invoice_detail']?><br>
                            สถานะ : <?=$row['invoice_status']?><br>
                            วันที่ทำรายการ : <?=$row['invoice_datetime']?>
                        </p>
                        <?php if($row['invoice_status'] == 'waiting' && $_SESSION['type'] == 'student'): ?>
                        <div class="input-group col-xs-12">
                            <a href="invoiceView.php?id=<?=$row['invoice_Id']?>&cmd=payment" class="btn btn-warning"> ชำระค่าบริการ</a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if($_SESSION['type'] == 'student' && $row['invoice_status'] == 'done' && $rs_review->fetch_assoc()['review_point'] == 0): ?>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <span class="fa fa-star"></span> Review
                    </div>
                    <div class="panel-body">
                        <p class="text-center">
                            <i id="star_1" data-point="1" class="fa fa-star-o dstar" style="color:chartreuse;font-size: 30px;"></i>
                            <i id="star_2" data-point="2" class="fa fa-star-o dstar" style="color:chartreuse;font-size: 30px;"></i>
                            <i id="star_3" data-point="3" class="fa fa-star-o dstar" style="color:chartreuse;font-size: 30px;"></i>
                            <i id="star_4" data-point="4" class="fa fa-star-o dstar" style="color:chartreuse;font-size: 30px;"></i>
                            <i id="star_5" data-point="5" class="fa fa-star-o dstar" style="color:chartreuse;font-size: 30px;"></i>
                            <br>
                            (<span id="point">0</span> คะแนน)
                            <br>
                            <a href="#" onclick="sendPoint();">ส่งผลคะแนน</a>
                        </p>
                    </div>
                </div>
                <?php endif; ?>



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
<script>

    function sendPoint() {
        var point = $('span#point').html();
        if(point=="0") return;
        $.ajax({
            url: "review.php?id=<?=$row['Course_id']?>",
            method: "POST",
            data: {
                point : point
            },
            dataType: "json",

            beforeSend: function() {

            }
        }).done(function( data ) {
            window.location="invoiceView.php?id=<?=$_GET['id']?>";
        });
    }


    $( "i.dstar" ).hover(
        function() {
            for (var i = 1; i <= parseInt($( this ).data("point"));i++){
                $( 'i#star_'+i ).removeClass("fa fa-star-o").addClass("fa fa-star");
            }
            $('span#point').html($( this ).data("point"));
        }, function(){
            for (var i = 1; i <= parseInt($( this ).data("point"));i++){
                $( 'i#star_'+i ).removeClass("fa fa-star").addClass("fa fa-star-o");
            }
        }
    );
</script>
</body>
</html>