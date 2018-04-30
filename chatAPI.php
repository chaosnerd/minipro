<?php
session_start();
require 'connect_db.php';
if (!isset($_SESSION['user_id'])) {
    die('error');
}
if(isset($_GET['cmd'])){
    if($_GET['cmd'] == "getnewfeeds" && isset($_GET['chat_id'])){
        $result = $conn->query('SELECT * FROM `clogs` WHERE `chat_id` = "'.$_GET['chat_id'].'" ORDER BY clogs_id ASC LIMIT 1');
        $_data = $result->fetch_assoc();
        if($_data['clogs_from'] == $_SESSION['user_id']) $type = 'clogs_readbyfrom';
        else $type = 'clogs_readbyto';
        $result = $conn->query('SELECT * FROM `clogs` WHERE `chat_id` = "'.$_GET['chat_id'].'" AND '.$type.' = "0" ORDER BY clogs_id ASC LIMIT 1');

        //$result = $conn->query('SELECT * FROM `clogs` WHERE `chat_id` = "'.$_GET['chat_id'].'" AND `clogs_read` = "0"');
        $conn->query('UPDATE `clogs` SET '.$type.' = "1" WHERE chat_id = '.$_GET['chat_id']);
        $output['data'] = array();
        while ($row = $result->fetch_assoc()) {
            array_push($output['data'],$row);
        }
        die(json_encode($output));
    }

    if($_GET['cmd'] == "push"){
        $chat_id = $_POST['chat_id'];
        $chat_msg = $_POST['chat_msg'];
        $chat_to = $_POST['chat_to'];
        $conn->query('INSERT INTO `clogs`(`chat_id`, `clogs_msg`, `clogs_from`, `clogs_to`, `clogs_datetime`) VALUES ("'.$chat_id.'","'.htmlspecialchars($chat_msg).'","'.$_SESSION['user_id'].'","'.$chat_to.'","'.date('Y-m-d H:i:s',time()).'")');
    }
}