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
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/main.css?v=1">
</head>
<body class="" style="font-family: 'Kanit', sans-serif;">
<div class="container">
    <div class="row">
        <div class="col-xs-12" style="background: url('assets/images/head.png')">
            <div class="visible-xs">
                <?php
                    $b_url = 'chat.php?Users_id='.$_GET['user_id'];
                    if(isset($_GET['course_id'])){
                        $b_url = 'createInvoice.php?user_id='.$_GET['user_id'];
                    }
                ?>
                <div class="top-left"><a href="<?=$b_url?>"><h3><span class="fa fa-arrow-left"></span></h3></a></div>
                <img src="assets/images/logo.png" class="img-responsive" alt="">
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="visible-xs" style="margin-top: 30px">
                <?php
                if (isset($_GET['course_id']) && isset($_GET['user_id']) && isset($_POST['submit'])) {

                        if (!empty($_POST['invoice_price']) && !empty($_POST['invoice_detail'])) {
                            $sql = 'INSERT INTO `invoice`(`invoice_price`, `course_id`, `user_Id`, `invoice_detail`, `invoice_status`, `invoice_datetime`) VALUES ("'.sprintf('%.2f',$_POST['invoice_price']).'","'.$_GET['course_id'].'","'.$_GET['user_id'].'","'.$_POST['invoice_detail'].'","waiting","'.date('Y-m-d H:i:s',time()).'")';
                            $result = $conn->query($sql);
                            if ($result) {
                                die('<script>location="invoiceView.php?id='.$conn->insert_id.'";</script>');
                            }

                        } else {
                            echo '<div class="alert alert-danger">
                                   <strong> ระบบ ! </strong> กรอกข้อมูลไม่ครบถ้วน
                            </div>';
                        }


                }

                ?>
                <?php if(isset($_GET['course_id']) && isset($_GET['user_id'])): ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            สร้าง Invoice <span class="fa fa-plus"></span>
                        </div>
                        <div class="panel-body">
                            <form action="createInvoice.php?user_id=<?=$_GET['user_id']?>&course_id=<?=$_GET['course_id']?>" method="post">
                                <div class="form-group">
                                    <div class="input-group col-xs-12">
                                        ราคา :
                                        <input type="text" class="form-control" id="invoice_price" name="invoice_price" placeholder="0.00 บาท" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group col-xs-12">
                                        รายละเอียดข้อตกลง :
                                        <textarea type="text" class="form-control" rows="5" id="invoice_detail" name="invoice_detail" placeholder="รายละเอียดข้อตกลง" required></textarea>
                                    </div>
                                </div>

                                <div class="input-group col-xs-12">
                                    <button type="submit" name="submit" class="btn btn-info"><i class="fa fa-save"></i> ยืนยันข้อตกลง</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <h4 class="text-center">เลือกวิชาที่ต้องการทำข้อตกลง</h4>
                    <div class="list-group">
                    <?php
                        $course_data = $conn->query('SELECT * FROM `course` WHERE `Users_id` = "'.$_SESSION['user_id'].'"');
                        if($course_data->num_rows > 0):
                            while ($row = $course_data->fetch_assoc()):
                    ?>
                        <a href="createInvoice.php?user_id=<?=$_GET['user_id']?>&course_id=<?=$row['Course_id']?>" class="list-group-item">
                            <h4 class="list-group-item-heading"><?=$row['Course_Name']?></h4>
                            <p class="list-group-item-text">
                                <span class="pull-right"><i class="fa fa-plus" style="font-size: 20px;"></i></span>
                                ID : <?=$row['Course_id']?><br>
                                ระดับชั้นที่เปิดสอน : <?=$row['Course_Grade']?>
                            </p>
                        </a>
                    <?php
                            endwhile;
                        endif;
                    ?>
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

</body>
</html>