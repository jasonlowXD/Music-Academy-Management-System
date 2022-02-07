<?php

$comment_id = $_GET['comment_id'];
$conn = mysqli_connect("localhost", "root", "", "music_academy");


if ($conn) {
    $sql = "DELETE FROM COMMENT WHERE COMMENT_ID = '$comment_id' ";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    }
} else {
    die("FATAL ERROR");
}
$conn->close();