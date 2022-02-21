<?php
session_start();
$output = '';
$response = array();
$classID = $_GET["classID"];
$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {
    $sql = "SELECT * FROM RESCHEDULE_REQUEST WHERE RESCHEDULE_REQUEST.CLASS_ID = '$classID' ORDER BY RESCHEDULE_REQUEST.CLASS_ID DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $output = '
        <hr>
        <h4><strong>Request Respond</strong></h4>
            <div class="table-responsive">
                <table id="rescheduleListTable" class="table table-hover contact-list" data-page-size="5">
                    <thead>
                        <tr>
                            <th style="width:5%;">#</th>
                            <th style="width:35%;">New Date & Time</th>
                            <th style="width:55%;">Reason</th>
                            <th style="width:5%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>';

        $request_count = 1;
        while ($row = $result->fetch_assoc()) {
            $db_datetime = $row["REQUEST_DATETIME"];
            $split_datetime = explode(" ", $db_datetime);
            $db_date = $split_datetime[0];
            $db_time = $split_datetime[1];
            $time = date("G:i", strtotime($db_time));
            $datetime =   $db_date . ' ' . $time;

            $db_desc = $row["REQUEST_DESC"];
            $db_status = $row["REQUEST_STATUS"];

            $output .= '
                    <tr>
                        <td>' . $request_count . '</td>
                        <td>' .  $datetime . '</td>
                        <td>' . $db_desc . '</td>';

            if ($db_status == 'pending') {
                $output .=   '
                        <td><span class="label label-warning">Pending</span></td>
                    </tr>';
            } else if ($db_status == 'accepted') {
                $output .=   '
                        <td><span class="label label-success">Accepted</span></td>
                    </tr>';
            } else if ($db_status == 'rejected') {
                $output .=   '
                        <td><span class="label label-danger">Rejected</span></td>
                    </tr>';
            }
            $request_count++;
        }
        $output .= ' 
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>';
    }
} else {
    die("FATAL ERROR");
}

$response['output']  =  $output;
$conn->close();
echo json_encode($response);
