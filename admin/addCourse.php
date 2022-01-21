<?php

$nameCrash = false;
session_start();
$response = array();
$userID = $_SESSION["userID"];
$courseName = $_POST['courseName'];
$courseFee = $_POST['courseFee'];
$duration = $_POST['duration'];
$courseDesc = htmlspecialchars($_POST['courseDesc']);

// BELOW THIS IS AN ARRAY 
if (!empty($_POST['courseTeacher'])) {
    $courseTeacher = $_POST['courseTeacher'];
} else {
    $courseTeacher = null;
}

$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {

    // CHECK GOT CRASH COURSE NAME IN DATABASE OR NOT

    // CHECK COURSE NAME IN COURSE TABLE 
    $sql = "SELECT COUNT(*) FROM COURSE WHERE ADMIN_ID = '$userID' AND COURSE_NAME =  '$courseName' ";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $course_count = $row["COUNT(*)"];
    }

    // IF COURSE NAME CRASH IN DATABASE
    if ($course_count > 0) {
        $nameCrash = true;
    }

    if ($nameCrash) {
        $response['title']  = 'Error course name';
        $response['status']  = 'error';
        $response['message'] = 'Course name is existed in database!';
    }

    // IF ALL NO CRASH, ADD NEW COURSE
    else {
        $courseStatus = 'active';
        $sql2 = "INSERT INTO COURSE (COURSE_ID,ADMIN_ID,COURSE_NAME,COURSE_FEE,DURATION_PER_CLASS,COURSE_DESC,COURSE_STATUS) 
        VALUES ('','$userID','$courseName','$courseFee','$duration','$courseDesc','$courseStatus')";

        // IF INSERT COURSE OK, THEN INSERT BRIDGE TABLE FOR MULTIPLE TEACHER 
        if (mysqli_query($conn, $sql2)) {

            // CHECK HOW MANY TEACHER IN THE FORM 
            if ($courseTeacher != null) {
                $courseTeacherNum = count($courseTeacher);
            } else {
                $courseTeacherNum = 0;
            }

            // IF GOT TEACHER, INSERT TEACHER_COURSE TABLE
            if ($courseTeacherNum > 0) {
                // GET THE COURSE ID FROM THE LAST INSERT QUERY
                $last_course_id = mysqli_insert_id($conn);

                for ($x = 0; $x < $courseTeacherNum; $x++) {
                    $tempCourseTeacher = $courseTeacher[$x];
                    $sql3 = "INSERT INTO TEACHER_COURSE (TEACHER_COURSE_ID,COURSE_ID,TEACHER_ID) 
                    VALUES ('','$last_course_id','$tempCourseTeacher')";
                    if (mysqli_query($conn, $sql3)) {
                        $flag = TRUE;
                    } else {
                        $flag = FALSE;
                        break;
                    }
                }
                if ($flag == TRUE) {
                    $response['title']  = 'Done!';
                    $response['status']  = 'success';
                    $response['message'] = 'New course is added!';
                } else {
                    $response['title']  = 'Error!';
                    $response['status']  = 'error';
                    $response['message'] = 'teacher_course mysql error';
                }
            } else {
                $response['title']  = 'Done!';
                $response['status']  = 'success';
                $response['message'] = 'New course is added!';
            }
        } else {
            $response['title']  = 'Error!';
            $response['status']  = 'error';
            $response['message'] = 'course mysql error';
        }
    }
} else {
    die("FATAL ERROR");
}

$conn->close();
echo json_encode($response);
