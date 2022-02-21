<?php
session_start();
$flag = false;
$userID = $_SESSION["userID"];
$classID = $_POST['classID'];

//date selected to be delete
$selectedDate = $_POST['selectedDate'];
$classGroupID = $_POST['classGroupID'];
$response = array();

$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {

    // GET THE CLASS DATA BEFORE DELETE, FOR NOTIFICATION USE
    $sql = "SELECT * FROM CLASS LEFT JOIN CLASS_GROUP ON CLASS.CLASSGROUP_ID = CLASS_GROUP.CLASSGROUP_ID WHERE CLASS_ID = '$classID' ";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $db_datetime = date_create($row["START_DATETIME"]);
        $datetime = date_format($db_datetime, 'Y-m-d g:iA');
        $db_child_id = $row["CHILD_ID"];
        $db_teacher_id = $row["TEACHER_ID"];
    }

    $selectedCalendarDateTime = $selectedDate . ' 00:00:00';

    $sql2 = "DELETE FROM CLASS WHERE CLASSGROUP_ID = '$classGroupID' AND START_DATETIME >= '$selectedCalendarDateTime'";
    if (mysqli_query($conn, $sql2)) {

        // CHECK IF THERE ARE STILL GOT REMAIN CLASS FOR THAT CLASSGROUP 
        $sql3 = "SELECT * FROM CLASS WHERE CLASSGROUP_ID = '$classGroupID' ";
        $result3 = $conn->query($sql3);

        // IF STILL GOT CLASS, KEEP CLASSGROUP
        if ($result3->num_rows > 0) {
            $flag = true;
        }
        // IF NO MORE CLASS, DELETE CLASSGROUP 
        else if ($result3->num_rows == 0) {
            $sql4 = "DELETE FROM CLASS_GROUP WHERE CLASSGROUP_ID = '$classGroupID' AND ADMIN_ID = '$userID'";
            if (mysqli_query($conn, $sql4)) {
                $flag = true;
            } else {
                $flag = false;
            }
        }

        if ($flag) {
            $sql5 = "SELECT * FROM CHILD LEFT JOIN PARENT ON CHILD.PARENT_ID = PARENT.PARENT_ID WHERE CHILD_ID = '$db_child_id'";
            $result5 = $conn->query($sql5);
            while ($row5 = $result5->fetch_assoc()) {
                $db_child_name = $row5["CHILD_NAME"];
                $db_parent_id = $row5["PARENT_ID"];
            }

            // NOTIFY TEACHER & PARENT
            $title = 'Classes deleted by Admin';
            $content = $db_child_name . ' ' . $datetime . ' and following classes has been deleted, please check!';
            $status = 'unseen';
            $teacher_link = 'TCalendar.php';
            $parent_link = 'PCalendar.php';

            $sql6 = "INSERT INTO NOTIFICATION (NOTIFICATION_ID,ADMIN_ID,TEACHER_ID,PARENT_ID,TITLE,CONTENT,VIEW_STATUS,DATETIME,LINK) 
            VALUES ('',NULL,'$db_teacher_id',NULL,'$title','$content','$status',CURRENT_TIMESTAMP(),'$teacher_link')";
            $sql7 = "INSERT INTO NOTIFICATION (NOTIFICATION_ID,ADMIN_ID,TEACHER_ID,PARENT_ID,TITLE,CONTENT,VIEW_STATUS,DATETIME,LINK) 
            VALUES ('',NULL,NULL,'$db_parent_id','$title','$content','$status',CURRENT_TIMESTAMP(),'$parent_link')";

            if (mysqli_query($conn, $sql6) && mysqli_query($conn, $sql7)) {
                $response['title']  = 'Done!';
                $response['status']  = 'success';
                $response['message'] = 'All classes successfully deleted!';
            } else {
                $response['title']  = 'Error!';
                $response['status']  = 'error';
                $response['message'] = 'notification error!';
            }
        } else {
            $response['title']  = 'Error!';
            $response['status']  = 'error';
            $response['message'] = 'delete classgroup error!';
        }
    } else {
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        $response['message'] = 'delete class error!';
    }
} else {
    die("FATAL ERROR");
}
$conn->close();
echo json_encode($response);
