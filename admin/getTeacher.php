<?php
session_start();
$userID = $_SESSION["userID"];
$output = '';
$response = array();
$course_id = $_POST['course_id'];
$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {
    $sql = "SELECT * FROM TEACHER LEFT JOIN TEACHER_COURSE ON TEACHER.TEACHER_ID = TEACHER_COURSE.TEACHER_ID WHERE TEACHER.ADMIN_ID = '$userID' AND TEACHER.TEACHER_STATUS ='active' AND TEACHER_COURSE.COURSE_ID = '$course_id'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $teacher_id = $row["TEACHER_ID"];
        $teacher_name = $row["TEACHER_NAME"];
        $output .= '<option value="' . $teacher_id . '">' . $teacher_name . '</option>';
    }
} else {
    die("FATAL ERROR");
}

$response['output']  =  $output;
$conn->close();
echo json_encode($response);
