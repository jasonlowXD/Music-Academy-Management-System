<?php
$nameCrash = false;
session_start();
$response = array();
$userID = $_SESSION["userID"];
$course_id = $_GET["course_id"];
$courseName = $_POST['courseName'];
$courseFee = $_POST['courseFee'];
$duration = $_POST['duration'];
$courseDesc = htmlspecialchars($_POST['courseDesc']);
$courseStatus = $_POST['courseStatus'];


// BELOW THIS IS AN ARRAY 
if (!empty($_POST['courseTeacher'])) {
    $courseTeacher = $_POST['courseTeacher'];
} else {
    $courseTeacher = null;
}


$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {

    $sql = "SELECT * FROM COURSE LEFT JOIN TEACHER_COURSE ON COURSE.COURSE_ID = TEACHER_COURSE.COURSE_ID WHERE COURSE.COURSE_ID = '$course_id' AND COURSE.ADMIN_ID = '$userID'";
    $result = $conn->query($sql);
    $x = 0;
    while ($row = $result->fetch_assoc()) {
        $db_course_name = $row["COURSE_NAME"];
        $db_course_fee = $row["COURSE_FEE"];
        $db_duration_per_class = $row["DURATION_PER_CLASS"];
        $db_course_desc = $row["COURSE_DESC"];
        $db_course_status = $row["COURSE_STATUS"];

        if ($row["TEACHER_ID"] != null) {
            $db_courseTeacher[$x] = $row["TEACHER_ID"];
            $x++;
        } else {
            $db_courseTeacher = null;
        }
    }

    // IF NOTHING CHANGE
    if ($courseName == $db_course_name && $courseFee == $db_course_fee && $duration ==  $db_duration_per_class && $courseDesc ==  $db_course_desc && $courseStatus == $db_course_status && $courseTeacher == $db_courseTeacher) {
        $response['title']  = 'Nothing Changed!';
        $response['status']  = 'info';
        $response['message'] = 'All info are same!';
    }

    // IF GOT CHANGE, CHECK GOT CRASH COURSE NAME IN DATABASE OR NOT
    else {
        if ($courseName != $db_course_name) {
            // CHECK COURSE NAME IN COURSE TABLE 
            $sql2 = "SELECT COUNT(*) FROM COURSE WHERE ADMIN_ID = '$userID' AND COURSE_NAME =  '$courseName' ";
            $result2 = $conn->query($sql2);
            while ($row2 = $result2->fetch_assoc()) {
                $course_count = $row2["COUNT(*)"];
            }

            // IF COURSE NAME CRASH IN DATABASE
            if ($course_count > 0) {
                $nameCrash = true;
            }
        }

        if ($nameCrash) {
            $response['title']  = 'Error course name';
            $response['status']  = 'error';
            $response['message'] = 'Course name is existed in database!';
        }

        // IF NO CRASH, UPDATE COURSE INFO
        else {
            $sql3 = "UPDATE COURSE SET COURSE_NAME ='$courseName', COURSE_FEE = '$courseFee', DURATION_PER_CLASS = '$duration', COURSE_DESC = '$courseDesc', COURSE_STATUS = '$courseStatus' WHERE COURSE_ID = '$course_id' AND ADMIN_ID = '$userID' ";

            if (mysqli_query($conn, $sql3)) {

                // IF THE TEACHER TEACH THIS COURSE IS DIFFERENT 
                if ($courseTeacher != $db_courseTeacher) {
                    $sql4 = "DELETE FROM TEACHER_COURSE WHERE COURSE_ID = '$course_id'";

                    if (mysqli_query($conn, $sql4)) {

                        // CHECK HOW MANY TEACHER IN THE FORM 
                        if ($courseTeacher != null) {
                            $courseTeacherNum = count($courseTeacher);
                        } else {
                            $courseTeacherNum = 0;
                        }

                        // IF GOT TEACHER, INSERT TEACHER_COURSE TABLE
                        if ($courseTeacherNum > 0) {
                            for ($x = 0; $x < $courseTeacherNum; $x++) {
                                $tempCourseTeacher = $courseTeacher[$x];
                                $sql5 = "INSERT INTO TEACHER_COURSE (TEACHER_COURSE_ID,COURSE_ID,TEACHER_ID) 
                                    VALUES ('','$course_id','$tempCourseTeacher')";
                                if (mysqli_query($conn, $sql5)) {
                                    $flag = TRUE;
                                } else {
                                    $flag = FALSE;
                                    break;
                                }
                            }
                            if ($flag == TRUE) {
                                $response['title']  = 'Done!';
                                $response['status']  = 'success';
                                $response['message'] = 'Course edited!';
                            } else {
                                $response['title']  = 'Error!';
                                $response['status']  = 'error';
                                $response['message'] = 'teacher_course mysql error';
                            }
                        } else {
                            $response['title']  = 'Done!';
                            $response['status']  = 'success';
                            $response['message'] = 'Course edited!';
                        }
                    } else {
                        $response['title']  = 'Error!';
                        $response['status']  = 'error';
                        $response['message'] = 'Delete part mysql error';
                    }
                } else {
                    $response['title']  = 'Done!';
                    $response['status']  = 'success';
                    $response['message'] = 'Course edited!';
                }
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
