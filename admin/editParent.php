<?php
$emailCrash = false;
$phoneCrash = false;
session_start();
$response = array();
$userID = $_SESSION["userID"];
$parent_id = $_GET["parent_id"];
$parentName = $_POST['parentName'];
$parentEmail = $_POST['parentEmail'];
$parentPhone = $_POST['parentPhone'];
$parentRelationship = $_POST['parentRelationship'];
$parentStatus = $_POST['parentStatus'];

$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {

    $sql = "SELECT * FROM PARENT WHERE PARENT_ID = '$parent_id' AND ADMIN_ID = '$userID'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $db_parent_name = $row["PARENT_NAME"];
        $db_parent_email = $row["PARENT_EMAIL"];
        $db_parent_phone = $row["PARENT_PHONE_NUM"];
        $db_parent_relationship = $row["PARENT_RELATIONSHIP"];
        $db_parent_status = $row["PARENT_STATUS"];
    }

    // IF NOTHING CHANGE
    if ($parentName == $db_parent_name && $parentEmail == $db_parent_email && $parentPhone ==  $db_parent_phone && $parentRelationship ==  $db_parent_relationship && $parentStatus ==  $db_parent_status) {
        $response['title']  = 'Nothing Changed!';
        $response['status']  = 'info';
        $response['message'] = 'All info are same!';
    }

    // IF GOT CHANGE, CHECK GOT CRASH EMAIL OR PHONE NUM IN DATABASE OR NOT
    else {


        if ($parentEmail != $db_parent_email) {
            // CHECK EMAIL IN ADMIN TABLE 
            $sql1 = "SELECT COUNT(*) FROM ADMIN WHERE ADMIN_ID = '$userID' AND ADMIN_EMAIL =  '$parentEmail' ";
            $result1 = $conn->query($sql1);
            while ($row1 = $result1->fetch_assoc()) {
                $admin_email_count = $row1["COUNT(*)"];
            }

            // CHECK EMAIL IN TEACHER TABLE 
            $sql2 = "SELECT COUNT(*) FROM TEACHER WHERE ADMIN_ID = '$userID' AND TEACHER_EMAIL =  '$parentEmail' ";
            $result2 = $conn->query($sql2);
            while ($row2 = $result2->fetch_assoc()) {
                $teacher_email_count = $row2["COUNT(*)"];
            }

            // CHECK EMAIL IN PARENT TABLE 
            $sql3 = "SELECT COUNT(*) FROM PARENT WHERE ADMIN_ID = '$userID' AND PARENT_EMAIL =  '$parentEmail' ";
            $result3 = $conn->query($sql3);
            while ($row3 = $result3->fetch_assoc()) {
                $parent_email_count = $row3["COUNT(*)"];
            }

            // IF EMAIL CRASH IN DATABASE
            if ($admin_email_count > 0 || $teacher_email_count > 0 || $parent_email_count > 0) {
                $emailCrash = true;
            }
        }

        if ($parentPhone != $db_parent_phone) {
            // CHECK PHONE IN TEACHER TABLE 
            $sql4 = "SELECT COUNT(*) FROM TEACHER WHERE TEACHER_PHONE_NUM =  '$parentPhone' ";
            $result4 = $conn->query($sql4);
            while ($row4 = $result4->fetch_assoc()) {
                $teacher_phone_count = $row4["COUNT(*)"];
            }

            // CHECK PHONE IN PARENT TABLE 
            $sql5 = "SELECT COUNT(*) FROM PARENT WHERE PARENT_PHONE_NUM =  '$parentPhone' ";
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
            $sql6 = "UPDATE PARENT SET PARENT_NAME ='$parentName', PARENT_EMAIL = '$parentEmail', PARENT_PHONE_NUM = '$parentPhone', PARENT_RELATIONSHIP = '$parentRelationship' , PARENT_STATUS = '$parentStatus' WHERE PARENT_ID = '$parent_id' AND ADMIN_ID = '$userID' ";

            if (mysqli_query($conn, $sql6)) {
                // IF PARENT IS INACTIVE, ALL CHILDREN MUST INACTIVE AS WELL
                if ($parentStatus == 'inactive') {
                    $sql7 = "UPDATE CHILD SET CHILD_STATUS = '$parentStatus' WHERE PARENT_ID = '$parent_id'";
                    if (mysqli_query($conn, $sql7)) {
                        $response['title']  = 'Done!';
                        $response['status']  = 'success';
                        $response['message'] = 'Parent edited!';
                    } else {
                        $response['title']  = 'Error!';
                        $response['status']  = 'error';
                        $response['message'] = 'child mysql error';
                    }
                } else {
                    $response['title']  = 'Done!';
                    $response['status']  = 'success';
                    $response['message'] = 'Parent edited!';
                }
            } else {
                $response['title']  = 'Error!';
                $response['status']  = 'error';
                $response['message'] = 'parent mysql error';
            }
        }
    }
} else {
    die("FATAL ERROR");
}

$conn->close();
echo json_encode($response);
