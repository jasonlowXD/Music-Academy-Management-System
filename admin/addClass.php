<?php
session_start();
$flag = false;
$userID = $_SESSION["userID"];
$response = array();
$teacher_id = $_POST['teacher'];
$child_id = $_POST['child'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
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
    // $response['message'] = $teacher_id . ',' . $child_id . ',' . $start_datetime . ',' . $end_datetime . ',' . $day . ',' . $location . ',' . $desc;
    $sql = "INSERT INTO CLASS_GROUP (CLASSGROUP_ID,ADMIN_ID,TEACHER_ID,CHILD_ID) 
    VALUES ('','$userID','$teacher_id','$child_id')";
    if (mysqli_query($conn, $sql)) {
        // GET THE CLASSGROUP ID FROM THE LAST INSERT QUERY
        $last_classgroup_id = mysqli_insert_id($conn);
        $currentdate = new DateTime($startDate);
        $interval = new DateInterval('P7D');
        $lastdate = new DateTime($endDate);
        while ($currentdate < $lastdate || $currentdate == $lastdate) {
            $date = $currentdate->format('Y-m-d');
            $start_datetime = $date . ' ' . $startTime . ':00';
            $end_datetime = $date . ' ' . $endTime . ':00';
            // $response['message'] = $last_classgroup_id . ',' . $start_datetime . ',' . $end_datetime . ',' . $dayCode . ',' . $location . ',' . $desc;

            $sql2 = "INSERT INTO CLASS (CLASS_ID,CLASSGROUP_ID,START_DATETIME,END_DATETIME,CLASS_DAY,CLASS_LOCATION,CLASS_DESC,ATTENDANCE) 
            VALUES ('','$last_classgroup_id','$start_datetime','$end_datetime','$dayCode','$location','$desc',NULL)";

            if (mysqli_query($conn, $sql2)) {
                $flag = true;
            } else {
                $flag = false;
                break;
            }
            $currentdate->add($interval);
        }
    } else {
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        $response['message'] = 'insert class_group error!';
    }

    if ($flag) {

        $sql3 = "SELECT * FROM CHILD LEFT JOIN PARENT ON CHILD.PARENT_ID = PARENT.PARENT_ID WHERE CHILD_ID = '$child_id'";
        $result3 = $conn->query($sql3);
        while ($row3 = $result3->fetch_assoc()) {
            $db_child_name = $row3["CHILD_NAME"];
            $db_parent_id = $row3["PARENT_ID"];
        }

        $time = date("g:iA", strtotime($startTime));

        // NOTIFY TEACHER & PARENT
        $title = 'New class added by Admin';
        $content = $db_child_name . ' has new class start from ' . $startDate . ' ' . $time . ', please check';
        $status = 'unseen';
        $teacher_link = 'TCalendar.php';
        $parent_link = 'PCalendar.php';

        $sql4 = "INSERT INTO NOTIFICATION (NOTIFICATION_ID,ADMIN_ID,TEACHER_ID,PARENT_ID,TITLE,CONTENT,VIEW_STATUS,DATETIME,LINK) 
        VALUES ('',NULL,'$teacher_id',NULL,'$title','$content','$status',CURRENT_TIMESTAMP(),'$teacher_link')";
        $sql5 = "INSERT INTO NOTIFICATION (NOTIFICATION_ID,ADMIN_ID,TEACHER_ID,PARENT_ID,TITLE,CONTENT,VIEW_STATUS,DATETIME,LINK) 
        VALUES ('',NULL,NULL,'$db_parent_id','$title','$content','$status',CURRENT_TIMESTAMP(),'$parent_link')";

        if (mysqli_query($conn, $sql4) && mysqli_query($conn, $sql5)) {
            $response['title']  = 'Done!';
            $response['status']  = 'success';
            $response['message'] = 'Classes are successful added!';
        } else {
            $response['title']  = 'Error!';
            $response['status']  = 'error';
            $response['message'] = 'notification error!';
        }
    } else {
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        $response['message'] = 'insert class error!';
    }
} else {
    die("FATAL ERROR");
}
$conn->close();
echo json_encode($response);
