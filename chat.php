<?php
session_start();
require 'connect_db.php';
if (empty($_SESSION['username'])) {
    echo '<meta http-equiv="refresh" content="0;URL=\'home.php\'" />';
    exit();
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

    <div class="row" style="width: 100%;z-index: 1;padding-bottom: 60px;border-bottom: 1px solid #7cc1ff;background: #bcdcf9;position: fixed;">
        <div class="col-xs-12">

            <?php if(isset($_GET['Users_id']) && $_SESSION['type'] != 'student'): ?>
            <h3 class="top-left">
                <a href="chat.php">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </h3>
            <h3 class="top-right">
                <a href="createInvoice.php?user_id=<?=$_GET['Users_id']?>">
                    <i class="fa fa-edit"></i>
                </a>
            </h3>
            <?php else: ?>
            <h3 class="top-left">
                <a href="profile.php">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </h3>
            <?php endif; ?>
        </div>
    </div>
    <div class="row" style="padding-top: 60px;"></div>
    <div class="row" style="margin-top: 10px">
        <div class="col-xs-12">
            <?php
            if (isset($_SESSION['user_id'])){

                $user_ME = $conn->query('SELECT * FROM `users` WHERE `Users_id` = '.$_SESSION['user_id']);
                $ME = $user_ME->fetch_assoc();
                if(isset($_GET['Users_id'])) {
                    $user_YOU = $conn->query('SELECT * FROM `users` WHERE `Users_id` = '.$_GET['Users_id']);
                    $YOU = $user_YOU->fetch_assoc();
                }

                $display = false;
                if(isset($_GET['Users_id'])){

                    $type = $_SESSION['type'] == "student" ? 'std_id': 'tutor_id';
                    $typeJoin = $_SESSION['type'] != "student" ? 'std_id': 'tutor_id';
                    $sql_find = "SELECT * FROM chat INNER JOIN users ON chat.".$typeJoin." = users.Users_id  WHERE chat.".$type." = ".$_SESSION['user_id']." AND chat.".$typeJoin." = ".$_GET['Users_id'];
                    $result_find = $conn->query($sql_find);
                    if ($result_find->num_rows > 0) {
                        $chat_data = $result_find->fetch_assoc();
                        $conn->query('UPDATE `clogs` SET `clogs_readbyfrom`= "1",`clogs_readbyto`= "1" WHERE chat_id = '.$chat_data['chat_id']);
                        $result_clogs = $conn->query('SELECT * FROM `clogs` WHERE chat_id = '.$chat_data['chat_id'].' ORDER BY clogs.clogs_id ASC') or die($conn->error);
                        if($result_clogs->num_rows > 0) $display = true;
                    }else{
                        $result = $conn->query('INSERT INTO `chat`(`std_id`, `tutor_id`, `chat_datetime`) VALUES ('.$_SESSION['user_id'].','.$_GET['Users_id'].',"'.date('Y-m-d H:i:s',time()).'")') or die($conn->error);
                        //header('chat.php?Users_id='.$_GET['Users_id']);
                        die('<script>location="chat.php?Users_id='.$_GET['Users_id'].'";</script>');
                    }
                }else{
                    $type = $_SESSION['type'] == "student" ? 'std_id': 'tutor_id';
                    $typeJoin = $_SESSION['type'] != "student" ? 'std_id': 'tutor_id';
                    $sql_find = "SELECT * FROM chat INNER JOIN users ON chat.".$typeJoin." = users.Users_id  WHERE chat.".$type." = ".$_SESSION['user_id'];
                    $result_find = $conn->query($sql_find);
                    if ($result_find->num_rows > 0) {
                        echo '<div class="list-group">';
                        while ($row = $result_find->fetch_assoc()) {
                            $countNEWMSG = $conn->query("SELECT COUNT(`clogs_readbyfrom`) FROM `clogs` WHERE `clogs_to` = '".$_SESSION['user_id']."' AND `clogs_readbyfrom` = '0'");
                            $countNews = $countNEWMSG->fetch_assoc()['COUNT(`clogs_readbyfrom`)'];
                            echo '<a href="chat.php?Users_id='.$row[$typeJoin].'" class="list-group-item">
                                <h4 class="list-group-item-heading">' . $row['Users_FullName'] . '</h4>
                                <p class="list-group-item-text">
                                    <span class="pull-right"><i class="fa fa-comments" style="font-size: 20px;"></i><!--label class="label label-danger">'.($countNews==0?'':$countNews).'</label--></span>
                                    ID : '.$row[$typeJoin].'
                                </p>
                            </a>';
                        }
                        echo '</div>';
                    } else {
                        echo '<div class="alert alert-warning">
                      <strong>แจ้งเตือน !</strong> ไม่มีข้อมูลการสนทนา
                    </div>';
                    }
                }

            } else {
                die('<meta http-equiv="refresh" content="0;URL=home.php" />');
            }
            ?>
            <div id="listMSG">
            <?php
                if($display){
                    while($clog = $result_clogs->fetch_assoc()){
                        echo '<div class="list-group">';
                        echo '<span class="list-group-item">
                                <h4 class="list-group-item-heading">' . ($clog['clogs_from'] == $ME['Users_id'] ? 'จาก : '.$ME['Users_FullName']:'จาก : '.$YOU['Users_FullName']) . '</h4>
                                <hr>
                                <p class="list-group-item-text">
                                    '.$clog['clogs_msg'].'
                                </p>
                            </span>';
                        echo '</div>';
                    }
                }
            ?>
            </div>
        </div>
    </div>
    <?php
        if(isset($_GET['Users_id'])):
    ?>
<!--    <div class="row">-->
<!--        <div style="position: fixed;bottom: 60px;width: 100%;">-->
<!--            <input type="text" id="chat_msg" name="chat_msg" style="width: 80%;height: 40px;" autofocus>-->
<!--            <div class="btn btn-info" onclick="send();" style="width: 18%;height: 40px;">ส่ง</div>-->
<!--        </div>-->
<!--    </div>-->
    <div class="row" style="margin-top: 100px">
        <div class="visible-xs">
            <footer class="footer">
                <input type="text" id="chat_msg" name="chat_msg" style="width: 80%;height: 40px;" autofocus>
                <div class="btn btn-info" onclick="send();" style="width: 18%;height: 40px;">ส่ง</div>
            </footer>
        </div>
    </div>
    <?php
        else:
    ?>
    <div class="row" style="margin-top: 100px">
        <div class="visible-xs">
            <footer class="footer">
                <div class="col-xs-4">
                    <a href="profile.php" style="color: #d0d0d0;"><h3><span class="fa fa-user"></span></h3></a>
                </div>
                <div class="col-xs-4">
                    <a href="chat.php" style="color: #717171;"><h3><span class="fa fa-comments"></span></h3></a>
                </div>
                <div class="col-xs-4">
                    <a href="setting.php" style="color: #d0d0d0;"><h3><span class="fa fa-cogs"></span></h3></a>
                </div>

            </footer>
        </div>
    </div>
    <?php
        endif;
    ?>
</div>
<?php
    if(isset($_GET['Users_id'])):
?>
<script>
    $(document).ready(function () {
        $("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
        setInterval(function () {
            getNewFeeds();
        },1000);
    });
    
    function getNewFeeds() {
        //get read = 0
        $.getJSON('chatAPI.php?cmd=getnewfeeds&chat_id=<?=$chat_data['chat_id']?>', function( data ) {
            $.each( data['data'], function( key, val ) {
                $('#listMSG').append(
                    '<div class="list-group"><span class="list-group-item">\n' +
                    '<h4 class="list-group-item-heading">'+(val['clogs_from'] == "<?=$ME['Users_id']?>" ? 'จาก : <?=$ME['Users_FullName']?>':'จาก : <?=$YOU['Users_FullName']?>')+'</h4>\n' +
                    '<hr>\n' +
                    '<p class="list-group-item-text">\n' +
                    ''+val['clogs_msg']+'\n' +
                    '</p></span></div>');
                $('#chat_msg').focus();
                $("html, body").animate({ scrollTop: $(document).height()-$(window).height() });

            });

        });
    }

    function send() {
        var msg = $('#chat_msg').val();
        if(msg==""){
            $('#chat_msg').focus();
            return;
        }
        $.ajax({
            url: "chatAPI.php?cmd=push",
            method: "POST",
            data: {
                chat_msg : $('#chat_msg').val(),
                chat_id : "<?=$chat_data['chat_id']?>",
                chat_to : "<?=$_GET['Users_id']?>"
            },
            dataType: "json",

            beforeSend: function() {
                $('#chat_msg').val('');
            }
        }).done(function( data ) {
            $('#chat_msg').val('');
        });

    }
</script>
<?php
    endif;
?>
</body>
</html>