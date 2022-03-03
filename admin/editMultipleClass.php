<?php
session_start();
$flag = '';
$userID = $_SESSION["userID"];
$response = array();
$classID = $_POST['classID'];
$classGroupID = $_POST['classGroupID'];

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
    $calendarDate = new DateTime($oldDate);
    $userInputdate = new DateTime($newDate);
    $interval = new DateInterval('P7D');

    // GET THE CLASS WITH SAME CLASSGROUP ID AND EQUAL OR MORE THAN SELECTED CLASS ID FROM CALENDAR TO EDIT (IF EDIT START FROM CLASS ID 3, CLASS ID LESS THAN 3 CANNOT BE EDITED)
    $sql = "SELECT * FROM CLASS WHERE CLASSGROUP_ID = '$classGroupID' AND CLASS_ID >= '$classID' ";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $db_class_id = $row["CLASS_ID"];
        $db_start_datetime = $row["START_DATETIME"];
        $db_attendance = $row["ATTENDANCE"];
        $split_datetime = explode(" ", $db_start_datetime);
        $db_date = $split_datetime[0];
        $db_date = new DateTime($db_date);

        // IF CURRENT LOOP CLASS NO ATTENDANCE OR ABSENT, THEN CAN EDIT 
        // IF CURRENT LOOP CLASS DATE IS EQUAL OR MORE THAN ORIGINAL DATE (USER SELECT 2022-02-02 AND AFTER DATE TO EDIT, WHICH MEAN DATE BEFORE 2022-02-02 CANNOT DO EDIT)
        if ($db_attendance == null || $db_attendance == 'absent' && $db_date >= $calendarDate) {

            $date = $userInputdate->format('Y-m-d');
            $start_datetime = $date . ' ' . $startTime . ':00';
            $end_datetime = $date . ' ' . $endTime . ':00';
            $sql2 = "UPDATE CLASS SET START_DATETIME ='$start_datetime', END_DATETIME = '$end_datetime', CLASS_DAY = '$dayCode', CLASS_LOCATION = '$location', CLASS_DESC = '$desc' WHERE CLASS_ID = '$db_class_id' AND CLASSGROUP_ID = '$classGroupID'";
            if (mysqli_query($conn, $sql2)) {
                $flag = 'true';
            } else {
                $flag = 'false update class';
                break;
            }
            $userInputdate->add($interval);
        } else if ($db_attendance == 'present') {
            $flag = 'false attendance';
            break;
        }
    }

    if ($flag == 'true') {
        $sqL3 = "SELECT * FROM CLASS LEFT JOIN CLASS_GROUP ON CLASS.CLASSGROUP_ID = CLASS_GROUP.CLASSGROUP_ID WHERE CLASS_ID = '$classID' ";
        $result3 = $conn->query($sqL3);
        while ($row3 = $result3->fetch_assoc()) {
            $db_child_id = $row3["CHILD_ID"];
            $db_teacher_id = $row3["TEACHER_ID"];
        }

        $sql4 = "SELECT * FROM CHILD LEFT JOIN PARENT ON CHILD.PARENT_ID = PARENT.PARENT_ID WHERE CHILD_ID = '$db_child_id'";
        $result4 = $conn->query($sql4);
        while ($row4 = $result4->fetch_assoc()) {
            $db_child_name = $row4["CHILD_NAME"];
            $db_parent_id = $row4["PARENT_ID"];
        }

        $oldTime = date("g:iA", strtotime($oldTime));
        $newTime = date("g:iA", strtotime($startTime));

        // NOTIFY TEACHER & PARENT
        $title = 'Multiple Classes updated by Admin';
        $content = $db_child_name . ' ' . $oldDate . ' ' . $oldTime . ' and following classes changed to start from ' . $newDate . ' ' . $newTime . ', please check!';
        $status = 'unseen';
        $teacher_link = 'TCalendar.php';
        $parent_link = 'PCalendar.php';

        $sql5 = "INSERT INTO NOTIFICATION (NOTIFICATION_ID,ADMIN_ID,TEACHER_ID,PARENT_ID,TITLE,CONTENT,VIEW_STATUS,DATETIME,LINK) 
        VALUES ('',NULL,'$db_teacher_id',NULL,'$title','$content','$status',CURRENT_TIMESTAMP(),'$teacher_link')";
        $sql6 = "INSERT INTO NOTIFICATION (NOTIFICATION_ID,ADMIN_ID,TEACHER_ID,PARENT_ID,TITLE,CONTENT,VIEW_STATUS,DATETIME,LINK) 
        VALUES ('',NULL,NULL,'$db_parent_id','$title','$content','$status',CURRENT_TIMESTAMP(),'$parent_link')";

        if (mysqli_query($conn, $sql5) && mysqli_query($conn, $sql6)) {
            $response['title']  = 'Done!';
            $response['status']  = 'success';
            $response['message'] = 'Classes are successful edited!';
        } else {
            $response['title']  = 'Error!';
            $response['status']  = 'error';
            $response['message'] = 'notification error!';
        }
    } else if ($flag == 'false update class') {
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        $response['message'] = 'update class error!';
    } else if ($flag == 'false attendance') {
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        // $response['message'] =  mysqli_error($conn);
        $response['message'] = 'Cannot edit due to this class attendance is already set!';
    }
} else {
    die("FATAL ERROR");
}
$conn->close();
echo json_encode($response);
