<?php
session_start();
$response = array();
$classID = $_POST['classID'];
$requestID = $_POST['requestID'];
$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {
    $sql = "UPDATE RESCHEDULE_REQUEST SET REQUEST_STATUS ='rejected' WHERE REQUEST_ID = '$requestID'";

    $sql2 = "SELECT * FROM CLASS 
                LEFT JOIN CLASS_GROUP ON CLASS.CLASSGROUP_ID = CLASS_GROUP.CLASSGROUP_ID 
                LEFT JOIN TEACHER ON CLASS_GROUP.TEACHER_ID = TEACHER.TEACHER_ID
                LEFT JOIN CHILD ON CLASS_GROUP.CHILD_ID = CHILD.CHILD_ID 
                WHERE CLASS.CLASS_ID = '$classID'";
    $result2 = $conn->query($sql2);
    while ($row2 = $result2->fetch_assoc()) {
        $db_teacher_name = $row2["TEACHER_NAME"];
        $db_parent_id = $row2["PARENT_ID"];
        $db_datetime = $row2["START_DATETIME"];
        $split_datetime = explode(" ", $db_datetime);
        $db_date = $split_datetime[0];
        $db_time = $split_datetime[1];
        $time = date("g:iA", strtotime($db_time));
        $datetime =   $db_date . ' ' . $time;
    }

    // NOTIFY PARENT
    $title = 'Reschedule request rejected';
    $content = $db_teacher_name . ' has rejected your request on ' . $datetime . ' class!';
    $status = 'unseen';
    $parent_link = 'PCalendar.php';
    $sql3 = "INSERT INTO NOTIFICATION (NOTIFICATION_ID,ADMIN_ID,TEACHER_ID,PARENT_ID,TITLE,CONTENT,VIEW_STATUS,DATETIME,LINK) 
    VALUES ('',NULL,NULL,'$db_parent_id','$title','$content','$status',CURRENT_TIMESTAMP(),'$parent_link')";


    if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql3)) {
        $response['title']  = 'Done!';
        $response['status']  = 'success';
        $response['message'] = 'Request rejected!';
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
