<?php

$id = $_GET['id'];
$conn = mysqli_connect("localhost", "root", "", "music_academy");


if ($conn) {
    $sql = "UPDATE NOTIFICATION SET VIEW_STATUS='seen' WHERE NOTIFICATION_ID = '$id' ";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    }
} else {
    die("FATAL ERROR");
}
$conn->close();