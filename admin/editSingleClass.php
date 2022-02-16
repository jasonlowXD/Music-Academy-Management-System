<?php
session_start();
$userID = $_SESSION["userID"];
$response = array();
$classID = $_POST['classID'];

//date before edit
$oldDate = $_POST['oldDate'];

//time before edit
$oldTime = $_POST['oldTime'];

//this date is user input new date to edit
$newDate = $_POST['startDate'];
$day = $_POST['day'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$location = $_POST['location'];
$desc = $_POST['desc'];

$dayCode = '';
switch ($day) {
    case 'Sunday':
        $dayCode = '0';
        break;
    case 'Monday':
        $dayCode = '1';
        break;
    case 'Tuesday':
        $dayCode = '2';
        break;
    case 'Wednesday':
        $dayCode = '3';
        break;
    case 'Thrusday':
        $dayCode = '4';
        break;
    case 'Friday':
        $dayCode = '5';
        break;
    case 'Saturday':
        $dayCode = '6';
        break;
}

$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {

    $sql = "SELECT * FROM CLASS LEFT JOIN CLASS_GROUP ON CLASS.CLASSGROUP_ID = CLASS_GROUP.CLASSGROUP_ID WHERE CLASS_ID = '$classID' ";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $db_attendance = $row["ATTENDANCE"];
        $db_child_id = $row["CHILD_ID"];
        $db_teacher_id = $row["TEACHER_ID"];
    }

    // IF CLASS NO ATTENDANCE, THEN CAN EDIT 
    if ($db_attendance == null) {
        $start_datetime = $newDate . ' ' . $startTime . ':00';
        $end_datetime = $newDate . ' ' . $endTime . ':00';

        $sql2 = "UPDATE CLASS SET START_DATETIME ='$start_datetime', END_DATETIME = '$end_datetime', CLASS_DAY = '$dayCode', CLASS_LOCATION = '$location', CLASS_DESC = '$desc' WHERE CLASS_ID = '$classID'";
        if (mysqli_query($conn, $sql2)) {

            $sql3 = "SELECT * FROM CHILD LEFT JOIN PARENT ON CHILD.PARENT_ID = PARENT.PARENT_ID WHERE CHILD_ID = '$db_child_id'";
            $result3 = $conn->query($sql3);
            while ($row3 = $result3->fetch_assoc()) {
                $db_child_name = $row3["CHILD_NAME"];
                $db_parent_id = $row3["PARENT_ID"];
            }

            $oldTime = date("g:iA", strtotime($oldTime));
            $newTime = date("g:iA", strtotime($startTime));

            // NOTIFY TEACHER & PARENT
            $title = 'Class updated by Admin';
            $content = $db_child_name . ' ' . $oldDate . ' ' . $oldTime . ' class changed to ' . $newDate . ' ' . $newTime . ', please check';
            $status = 'unseen';
            $teacher_link = 'TCalendar.php';
            $parent_link = 'PCalendar.php';

            $sql4 = "INSERT INTO NOTIFICATION (NOTIFICATION_ID,ADMIN_ID,TEACHER_ID,PARENT_ID,TITLE,CONTENT,VIEW_STATUS,DATETIME,LINK) 
            VALUES ('',NULL,'$db_teacher_id',NULL,'$title','$content','$status',CURRENT_TIMESTAMP(),'$teacher_link')";
            $sql5 = "INSERT INTO NOTIFICATION (NOTIFICATION_ID,ADMIN_ID,TEACHER_ID,PARENT_ID,TITLE,CONTENT,VIEW_STATUS,DATETIME,LINK) 
            VALUES ('',NULL,NULL,'$db_parent_id','$title','$content','$status',CURRENT_TIMESTAMP(),'$parent_link')";

            if (mysqli_query($conn, $sql4) && mysqli_query($conn, $sql5)) {
                $response['title']  = 'Done!';
                $response['status']  = 'success';
                $response['message'] = 'Class successfully edited!';
            } else {
                $response['title']  = 'Error!';
                $response['status']  = 'error';
                $response['message'] = 'notification error!';
            }
        } else {
            $response['title']  = 'Error!';
            $response['status']  = 'error';
            $response['message'] = 'update class error!';
        }
    } else {
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        $response['message'] = 'Cannot edit due to this class attendance is already set!';
    }
} else {
    die("FATAL ERROR");
}
$conn->close();
echo json_encode($response);
