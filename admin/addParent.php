<?php
require_once('../mailServer.php');

function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces[] = $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

$flag = FALSE;
$emailCrash = false;
$phoneCrash = false;
session_start();
$response = array();
$userID = $_SESSION["userID"];
$parentName = $_POST['parentName'];
$parentEmail = $_POST['parentEmail'];
$parentPhone = $_POST['parentPhone'];
$parentRelationship = $_POST['parentRelationship'];

// BELOW CHILDREN IS ARRAY 
$childrenName = $_POST['childrenName'];
$childrenAge = $_POST['childrenAge'];
$childrenCourse = $_POST['childrenCourse'];
$childrenTeacher = $_POST['childrenTeacher'];

$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {

    // CHECK GOT CRASH EMAIL OR PHONE NUM IN DATABASE OR NOT

    // CHECK EMAIL IN ADMIN TABLE 
    $sql = "SELECT COUNT(*) FROM ADMIN WHERE ADMIN_ID = '$userID' AND ADMIN_EMAIL =  '$parentEmail' ";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $admin_email_count = $row["COUNT(*)"];
    }

    // CHECK EMAIL IN TEACHER TABLE 
    $sql0 = "SELECT COUNT(*) FROM TEACHER WHERE ADMIN_ID = '$userID' AND TEACHER_EMAIL =  '$parentEmail' ";
    $result0 = $conn->query($sql0);
    while ($row0 = $result0->fetch_assoc()) {
        $teacher_email_count = $row0["COUNT(*)"];
    }

    // CHECK EMAIL IN PARENT TABLE 
    $sql1 = "SELECT COUNT(*) FROM PARENT WHERE ADMIN_ID = '$userID' AND PARENT_EMAIL =  '$parentEmail' ";
    $result1 = $conn->query($sql1);
    while ($row1 = $result1->fetch_assoc()) {
        $parent_email_count = $row1["COUNT(*)"];
    }

    // IF EMAIL CRASH IN DATABASE
    if ($admin_email_count > 0 || $teacher_email_count > 0 || $parent_email_count > 0) {
        $emailCrash = true;
    }

    // CHECK PHONE IN TEACHER TABLE 
    $sql2 = "SELECT COUNT(*) FROM TEACHER WHERE TEACHER_PHONE_NUM =  '$parentPhone' ";
    $result2 = $conn->query($sql2);
    while ($row2 = $result2->fetch_assoc()) {
        $teacher_phone_count = $row2["COUNT(*)"];
    }

    // CHECK PHONE IN PARENT TABLE 
    $sql3 = "SELECT COUNT(*) FROM PARENT WHERE PARENT_PHONE_NUM =  '$parentPhone' ";
    $result3 = $conn->query($sql3);
    while ($row3 = $result3->fetch_assoc()) {
        $parent_phone_count = $row3["COUNT(*)"];
    }

    // IF EMAIL CRASH IN DATABASE
    if ($teacher_phone_count > 0 || $parent_phone_count > 0) {
        $phoneCrash = true;
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

    // IF ALL NO CRASH, SET RANDOM PASSWORD AND ADD NEW PARENT
    else {
        $parentPass = random_str(8);
        $mdparentPass = md5($parentPass);
        $parentStatus = 'active';

        $sql4 = "INSERT INTO PARENT (PARENT_ID,ADMIN_ID,PARENT_NAME,PARENT_EMAIL,PARENT_PASS,PARENT_PHONE_NUM,PARENT_STATUS,PARENT_RELATIONSHIP) 
        VALUES ('','$userID','$parentName','$parentEmail','$mdparentPass','$parentPhone','$parentStatus','$parentRelationship')";


        // IF INSERT PARENT OK, THEN DO INSERT CHILDREN
        if (mysqli_query($conn, $sql4)) {

            // CHECK HOW MANY CHILDREN IN THE FORM 
            $childrenNum = count($childrenName);
            // GET THE PARENT ID FROM THE LAST INSERT QUERY
            $last_parent_id = mysqli_insert_id($conn);
            $childStatus = 'active';

            // INSERT CHILDREN
            for ($x = 0; $x < $childrenNum; $x++) {
                $tempChildrenName = $childrenName[$x];
                $tempChildrenAge = $childrenAge[$x];
                $tempChildrenTeacher = $childrenTeacher[$x];
                $tempChildrenCourse = $childrenCourse[$x];
                $sql5 = "INSERT INTO CHILD (CHILD_ID,PARENT_ID,TEACHER_ID,COURSE_ID,CHILD_NAME,CHILD_AGE,CHILD_STATUS) 
                VALUES ('','$last_parent_id','$tempChildrenTeacher','$tempChildrenCourse','$tempChildrenName','$tempChildrenAge','$childStatus')";

                if (mysqli_query($conn, $sql5)) {
                    $flag = TRUE;
                } else {
                    $flag = FALSE;
                    break;
                }
            }

            // IF ALL INSERT OK, SEND EMAIL 
            if ($flag == TRUE) {
                $link = "http://localhost/fyp";
                $mail->setFrom('musicacademyfypp@gmail.com', 'Music Academy');
                $mail->addAddress($parentEmail);
                $mail->isHTML(true);
                $mail->Subject = 'New Account Registered';
                $mail->Body    = "Hi, $parentName
                <br />
                Your account has been created with password: $parentPass
                <br />
                You can edit your password after you login with this link: $link.
                <br />
                <br />
                Thanks & Regard";
                $mailsend = $mail->send();
                if ($mailsend) {
                    $response['title']  = 'Done!';
                    $response['status']  = 'success';
                    $response['message'] = 'New Parent and children added and email has sent to the parent!';
                } else {
                    $response['title']  = 'Error!';
                    $response['status']  = 'error';
                    $response['message'] = 'email cannot send to user.';
                }
            } else {
                $response['title']  = 'Error!';
                $response['status']  = 'error';
                $response['message'] = 'child mysql error';
            }
        } else {
            $response['title']  = 'Error!';
            $response['status']  = 'error';
            $response['message'] = 'mysql error';
        }
    }
} else {
    die("FATAL ERROR");
}

$conn->close();
echo json_encode($response);
