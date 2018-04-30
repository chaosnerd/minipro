<?php
session_start();
require 'connect_db.php';
if (empty($_SESSION['username']) || !isset($_GET['id'])) {
    echo '<meta http-equiv="refresh" content="0;URL=\'home.php\'" />';
}
$rs = $conn->query('INSERT INTO `review`(`review_point`, `course_id`, `user_id`, `review_datetime`) VALUES ("'.$_POST['point'].'","'.$_GET['id'].'","'.$_SESSION['user_id'].'","'.date('Y-m-d H:i:s',time()).'")');
die(json_encode(true));