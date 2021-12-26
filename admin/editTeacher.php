<?php
$emailCrash = false;
$phoneCrash = false;
session_start();
$response = array();
$userID = $_SESSION["userID"];
$teacher_id = $_GET["teacher_id"];
$teacherName = $_POST['teacherName'];
$teacherEmail = $_POST['teacherEmail'];
$teacherPhone = $_POST['teacherPhone'];
$teacherStatus = $_POST['teacherStatus'];

$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {

    $sql = "SELECT * FROM TEACHER WHERE TEACHER_ID = '$teacher_id' AND ADMIN_ID = '$userID'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $db_teacher_name = $row["TEACHER_NAME"];
        $db_teacher_email = $row["TEACHER_EMAIL"];
        $db_teacher_phone = $row["TEACHER_PHONE_NUM"];
        $db_teacher_status = $row["TEACHER_STATUS"];
    }

    // IF NOTHING CHANGE
    if ($teacherName == $db_teacher_name && $teacherEmail == $db_teacher_email && $teacherPhone ==  $db_teacher_phone && $teacherStatus ==  $db_teacher_status) {
        $response['title']  = 'Nothing Changed!';
        $response['status']  = 'info';
        $response['message'] = 'All info are same!';
    }

    // IF GOT CHANGE, CHECK GOT CRASH EMAIL OR PHONE NUM IN DATABASE OR NOT
    else {


        if ($teacherEmail != $db_teacher_email) {
            // CHECK EMAIL IN ADMIN TABLE 
            $sql1 = "SELECT COUNT(*) FROM ADMIN WHERE ADMIN_ID = '$userID' AND ADMIN_EMAIL =  '$teacherEmail' ";
            $result1 = $conn->query($sql1);
            while ($row1 = $result1->fetch_assoc()) {
                $admin_email_count = $row1["COUNT(*)"];
            }

            // CHECK EMAIL IN TEACHER TABLE 
            $sql2 = "SELECT COUNT(*) FROM TEACHER WHERE ADMIN_ID = '$userID' AND TEACHER_EMAIL =  '$teacherEmail' ";
            $result2 = $conn->query($sql2);
            while ($row2 = $result2->fetch_assoc()) {
                $teacher_email_count = $row2["COUNT(*)"];
            }

            // CHECK EMAIL IN PARENT TABLE 
            $sql3 = "SELECT COUNT(*) FROM PARENT WHERE ADMIN_ID = '$userID' AND PARENT_EMAIL =  '$teacherEmail' ";
            $result3 = $conn->query($sql3);
            while ($row3 = $result3->fetch_assoc()) {
                $parent_email_count = $row3["COUNT(*)"];
            }

            // IF EMAIL CRASH IN DATABASE
            if ($admin_email_count > 0 || $teacher_email_count > 0 || $parent_email_count > 0) {
                $emailCrash = true;
            }
        }

        if ($teacherPhone != $db_teacher_phone) {
            // CHECK PHONE IN TEACHER TABLE 
            $sql4 = "SELECT COUNT(*) FROM TEACHER WHERE TEACHER_PHONE_NUM =  '$teacherPhone' ";
            $result4 = $conn->query($sql4);
            while ($row4 = $result4->fetch_assoc()) {
                $teacher_phone_count = $row4["COUNT(*)"];
            }

            // CHECK PHONE IN PARENT TABLE 
            $sql5 = "SELECT COUNT(*) FROM PARENT WHERE PARENT_PHONE_NUM =  '$teacherPhone' ";
            $result5 = $conn->query($sql5);
            while ($row5 = $result5->fetch_assoc()) {
                $parent_phone_count = $row5["COUNT(*)"];
            }

            // IF PHONE CRASH IN DATABASE
            if ($teacher_phone_count > 0 || $parent_phone_count > 0) {
                $phoneCrash = true;
            }
        }

        if ($emailCrash) {
            $response['title']  = 'Error email';
            $response['status']  = 'error';
            $response['message'] = 'Email existed! Please use other email!';
        } else if ($phoneCrash) {
            $response['title']  = 'Error phone';
            $response['status']  = 'error';
            $response['message'] = 'Phone number existed! Please use other phone number!';
        }

        // IF ALL NO CRASH, UPDATE TEACHER INFO
        else {
            $sql6 = "UPDATE TEACHER SET TEACHER_NAME ='$teacherName', TEACHER_EMAIL = '$teacherEmail', TEACHER_PHONE_NUM = '$teacherPhone', TEACHER_STATUS = '$teacherStatus' WHERE TEACHER_ID = '$teacher_id' AND ADMIN_ID = '$userID' ";

            if (mysqli_query($conn, $sql6)) {
                $response['title']  = 'Done!';
                $response['status']  = 'success';
                $response['message'] = 'Teacher edited!';
            } else {
                $response['title']  = 'Error!';
                $response['status']  = 'error';
                $response['message'] = 'mysql error';
            }
        }
    }
} else {
    die("FATAL ERROR");
}

$conn->close();
echo json_encode($response);
