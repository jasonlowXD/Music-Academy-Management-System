<?php
session_start();
$userID = $_SESSION["userID"];
$classID = $_POST['classID'];
$newDate = $_POST['newDate'];
$newTime = $_POST['newTime'];
$desc = $_POST['desc'];

$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {

    $request_datetime = $newDate . ' ' . $newTime . ':00';
    $status = 'pending';
    $sql = "INSERT INTO RESCHEDULE_REQUEST (REQUEST_ID,CLASS_ID,PARENT_ID,REQUEST_DATETIME,REQUEST_DESC,REQUEST_STATUS) 
    VALUES ('','$classID','$userID','$request_datetime','$desc','$status')";


    $sql2 = "SELECT * FROM CLASS 
                LEFT JOIN CLASS_GROUP ON CLASS.CLASSGROUP_ID = CLASS_GROUP.CLASSGROUP_ID 
                LEFT JOIN CHILD ON CLASS_GROUP.CHILD_ID = CHILD.CHILD_ID 
                WHERE CLASS.CLASS_ID = '$classID'";
    $result2 = $conn->query($sql2);
    while ($row2 = $result2->fetch_assoc()) {
        $db_child_name = $row2["CHILD_NAME"];
        $db_teacher_id = $row2["TEACHER_ID"];
        $db_datetime = $row2["START_DATETIME"];
        $split_datetime = explode(" ", $db_datetime);
        $db_date = $split_datetime[0];
        $db_time = $split_datetime[1];
        $time = date("g:iA", strtotime($db_time));
        $datetime =   $db_date . ' ' . $time;
    }

    // NOTIFY TEACHER
    $title = 'New class reschedule request';
    $content = $db_child_name . ' ' . $datetime . ' class has a new reschedule request, please check!';
    $status = 'unseen';
    $teacher_link = 'TCalendar.php';
    $sql3 = "INSERT INTO NOTIFICATION (NOTIFICATION_ID,ADMIN_ID,TEACHER_ID,PARENT_ID,TITLE,CONTENT,VIEW_STATUS,DATETIME,LINK) 
    VALUES ('',NULL,'$db_teacher_id',NULL,'$title','$content','$status',CURRENT_TIMESTAMP(),'$teacher_link')";

    if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql3)) {
        $response['title']  = 'Done!';
        $response['status']  = 'success';
        $response['message'] = 'Request sent successfully!';
    } else {
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        $response['message'] =  mysqli_error($conn);
    }
} else {
    die("FATAL ERROR");
}
$conn->close();
echo json_encode($response);
