<?php
session_start();
require 'connect_db.php';
if (isset($_GET['key'])) {
    if (!empty($_GET['key'])) {
        $sql = "DELETE FROM course WHERE Course_id='" . $_GET['key'] . "'";
        if ($conn->query($sql) === true) {
            echo '<meta http-equiv="refresh" content="0;URL=\'tutor.php\'" />';
        } else {
            echo '<meta http-equiv="refresh" content="0;URL=\'tutor.php\'" />';
        }
    } else {
        echo '<meta http-equiv="refresh" content="0;URL=\'tutor.php\'" />';
    }
} else {
    echo '<meta http-equiv="refresh" content="0;URL=\'tutor.php\'" />';
}