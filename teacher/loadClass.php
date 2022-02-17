<?php
session_start();
$userID = $_SESSION["userID"];
$response = array();
$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {
    $sql = "SELECT * FROM CLASS_GROUP 
                LEFT JOIN CLASS ON CLASS_GROUP.CLASSGROUP_ID = CLASS.CLASSGROUP_ID 
                LEFT JOIN CHILD ON CLASS_GROUP.CHILD_ID = CHILD.CHILD_ID
                LEFT JOIN COURSE ON CHILD.COURSE_ID = COURSE.COURSE_ID
                WHERE CLASS_GROUP.TEACHER_ID = '$userID'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {

        $courseName = $row["COURSE_NAME"];
        $childName = $row["CHILD_NAME"];
        $title = $childName . ',' . $courseName;

        $startDatetime = $row["START_DATETIME"];
        $startDatetime = preg_replace('/\s+/u', 'T', $startDatetime);

        $endDatetime = $row["END_DATETIME"];
        $endDatetime = preg_replace('/\s+/u', 'T', $endDatetime);

        $duration = $row["DURATION_PER_CLASS"];

        $extendedProps = array();
        $extendedProps[] = array(
            'classGroup' => $row["CLASSGROUP_ID"],
            'location' => $row["CLASS_LOCATION"],
            'description' => $row["CLASS_DESC"],
            'attendance' => $row["ATTENDANCE"],
            'duration' =>   $duration,
        );

        if ($row["ATTENDANCE"] == null) {
            $className = 'bg-primary';
        } else if ($row["ATTENDANCE"] == 'absent') {
            $className = 'bg-danger';
        } else if ($row["ATTENDANCE"] == 'present') {
            $className = 'bg-success';
        }

        $response[] = array(
            'id' => $row["CLASS_ID"],
            'title' =>  $title,
            'start' =>  $startDatetime,
            'end' =>  $endDatetime,
            'className' =>   $className,
            'extendedProps' =>  $extendedProps,
        );
    }
} else {
    die("FATAL ERROR");
}
$conn->close();
echo json_encode($response);
