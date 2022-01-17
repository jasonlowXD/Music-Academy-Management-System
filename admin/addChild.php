<?php
$emailCrash = false;
$phoneCrash = false;
session_start();
$response = array();
$userID = $_SESSION["userID"];
$parent_id = $_GET["parent_id"];
$childrenName = $_POST['childrenName'];
$childrenAge = $_POST['childrenAge'];
$childrenCourse = $_POST['childrenCourse'];
$childrenTeacher = $_POST['childrenTeacher'];
$childStatus = 'active';

$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {

    $sql = "INSERT INTO CHILD (CHILD_ID,PARENT_ID,TEACHER_ID,COURSE_ID,CHILD_NAME,CHILD_AGE,CHILD_STATUS) 
    VALUES ('','$parent_id','$childrenTeacher','$childrenCourse','$childrenName','$childrenAge','$childStatus')";

    // NOTIFY TEACHER
    $title = 'You have a new child!';
    $content = 'A new child (' . $childrenName . ') has assigned to you!';
    $status = 'unseen';
    $link = 'TChildren.php';
    $sql2 = "INSERT INTO NOTIFICATION (NOTIFICATION_ID,ADMIN_ID,TEACHER_ID,PARENT_ID,TITLE,CONTENT,VIEW_STATUS,DATETIME,LINK) 
    VALUES ('',NULL,'$childrenTeacher',NULL,'$title','$content','$status',CURRENT_TIMESTAMP(),'$link')";


    if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
        $response['title']  = 'Done!';
        $response['status']  = 'success';
        $response['message'] = 'New child added!';
    } else {
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        $response['message'] = mysqli_error($conn);
    }
} else {
    die("FATAL ERROR");
}

$conn->close();
echo json_encode($response);
