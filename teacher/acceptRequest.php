<?php
session_start();
$response = array();
$userID = $_SESSION["userID"];
$userName =  $_SESSION["name"];
$adminID = $_SESSION["adminID"];
$classID = $_POST['classID'];
$requestID = $_POST['requestID'];
$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {

    $sql = "UPDATE RESCHEDULE_REQUEST SET REQUEST_STATUS ='accepted' WHERE REQUEST_ID = '$requestID'";
    if (mysqli_query($conn, $sql)) {

        // GET NEW DATETIME FROM REQUEST 
        $sql2 = "SELECT * FROM RESCHEDULE_REQUEST WHERE REQUEST_ID = '$requestID' ";
        $result2 = $conn->query($sql2);
        while ($row2 = $result2->fetch_assoc()) {
            $db_request_datetime = $row2["REQUEST_DATETIME"];

            $split_datetime = explode(" ", $db_request_datetime);
            $db_date = $split_datetime[0];
            $db_time = $split_datetime[1];
            $time = date("g:iA", strtotime($db_time));
            $new_request_datetime =   $db_date . ' ' . $time;
        }

        // GET DATA FROM THE ORIGINAL CLASS 
        $sql3 = "SELECT * FROM CLASS 
                    LEFT JOIN CLASS_GROUP ON CLASS.CLASSGROUP_ID = CLASS_GROUP.CLASSGROUP_ID
                    LEFT JOIN CHILD ON CLASS_GROUP.CHILD_ID = CHILD.CHILD_ID
                    LEFT JOIN COURSE ON CHILD.COURSE_ID = COURSE.COURSE_ID
                    WHERE CLASS.CLASS_ID = '$classID'";
        $result3 = $conn->query($sql3);
        while ($row3 = $result3->fetch_assoc()) {
            $db_child_name = $row3["CHILD_NAME"];
            $db_ori_datetime = $row3["START_DATETIME"];
            $db_parent_id = $row3["PARENT_ID"];
            $db_course_duration = $row3["DURATION_PER_CLASS"];

            $split_datetime = explode(" ", $db_ori_datetime);
            $db_date = $split_datetime[0];
            $db_time = $split_datetime[1];
            $time = date("g:iA", strtotime($db_time));
            $old_ori_datetime =   $db_date . ' ' . $time;
        }

        // ADD DURATION TO REQUEST START DATETIME TO SET END DATETIME & DAY
        $interval = new DateInterval('PT' . $db_course_duration . 'M');
        $start_datetime = new DateTime($db_request_datetime);
        $end_datetime = $start_datetime->add($interval);
        $day = $start_datetime->format('w');

        $end_datetime = $end_datetime->format('Y-m-d H:i:s');

        // UPDATE CLASS DATETIME, SET ATTENDANCE TO NULL 
        $sql4 = "UPDATE CLASS SET START_DATETIME ='$db_request_datetime', END_DATETIME = '$end_datetime', CLASS_DAY = '$day', ATTENDANCE = NULL WHERE CLASS_ID = '$classID'";

        // NOTIFY PARENT
        $title = 'Reschedule request accepted';
        $content = $userName . ' has accepted your request on ' . $old_ori_datetime . ' class and changed to ' . $new_request_datetime . '!';
        $status = 'unseen';
        $parent_link = 'PCalendar.php';
        $sql5 = "INSERT INTO NOTIFICATION (NOTIFICATION_ID,ADMIN_ID,TEACHER_ID,PARENT_ID,TITLE,CONTENT,VIEW_STATUS,DATETIME,LINK) 
        VALUES ('',NULL,NULL,'$db_parent_id','$title','$content','$status',CURRENT_TIMESTAMP(),'$parent_link')";

        // NOTIFY ADMIN
        $title = 'Class updated by ' . $userName;
        $content = $db_child_name . ' ' . $old_ori_datetime . ' class changed to ' . $new_request_datetime . ', please check!';
        $status = 'unseen';
        $admin_link = 'ACalendar.php';
        $sql6 = "INSERT INTO NOTIFICATION (NOTIFICATION_ID,ADMIN_ID,TEACHER_ID,PARENT_ID,TITLE,CONTENT,VIEW_STATUS,DATETIME,LINK) 
        VALUES ('','$adminID',NULL,NULL,'$title','$content','$status',CURRENT_TIMESTAMP(),'$admin_link')";


        if (mysqli_query($conn, $sql4) && mysqli_query($conn, $sql5) && mysqli_query($conn, $sql6)) {
            $response['title']  = 'Done!';
            $response['status']  = 'success';
            $response['message'] = 'Request accepted!';
        } else {
            $response['title']  = 'Error!';
            $response['status']  = 'error';
            $response['message'] =  mysqli_error($conn);
        }
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
