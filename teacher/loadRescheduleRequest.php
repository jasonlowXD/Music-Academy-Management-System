<?php
session_start();
$output = '';
$response = array();
$userID = $_SESSION["userID"];
$classID = $_GET["classID"];
$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {
    $sql = "SELECT * FROM RESCHEDULE_REQUEST LEFT JOIN PARENT ON RESCHEDULE_REQUEST.PARENT_ID = PARENT.PARENT_ID WHERE RESCHEDULE_REQUEST.CLASS_ID = '$classID' ORDER BY RESCHEDULE_REQUEST.CLASS_ID DESC";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        $output = ' <div id="noRequestDiv">
                        <p>no request from parent in this class </p>
                    </div>';
    } else {
        $output =
            '<div id="requestRespondTable">
            <div class="table-responsive">
                <table id="rescheduleListTable" class="table table-hover" data-page-size="5">
                    <thead>
                        <tr>
                            <th style="width:5%;">#</th>
                            <th style="width:20%;">Parent</th>
                            <th style="width:25%;">New Date & Time</th>
                            <th style="width:40%;">Reason</th>
                            <th style="width:5%;">Status</th>
                            <th style="width:5%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
        $request_count = 1;
        while ($row = $result->fetch_assoc()) {
            $db_requestID = $row["REQUEST_ID"];
            $db_parent_name = $row["PARENT_NAME"];

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
                        <td>' . $db_parent_name . '</td>
                        <td>' .  $datetime . '</td>
                        <td>' . $db_desc . '</td>';
            if ($db_status == 'pending') {
                $output .=   '
                        <td><span class="label label-warning">Pending</span></td>
                        <td>
                            <div class="btn-group-vertical">
                                <button type="button" id="' .  $db_requestID . '" class="btn btn-sm btn-info mb-1 btn_accept"> Accept</button>
                                <button type="button" id="' .  $db_requestID . '"class="btn btn-sm btn-danger mt-1 btn_reject">Reject</button>
                            </div>
                        </td>
                    </tr>';
            } else if ($db_status == 'accepted') {
                $output .=   '
                        <td><span class="label label-success">Accepted</span></td>
                        <td>
                            <div class="btn-group-vertical">
                                <button type="button" id="' .  $db_requestID . '" class="btn btn-sm btn-info mb-1 btn_accept" disabled> Accept</button>
                                <button type="button" id="' .  $db_requestID . '"class="btn btn-sm btn-danger mt-1 btn_reject" disabled>Reject</button>
                            </div>
                        </td>
                    </tr>';
            } else if ($db_status == 'rejected') {
                $output .=   '
                        <td><span class="label label-danger">Rejected</span></td>
                        <td>
                            <div class="btn-group-vertical">
                                <button type="button" id="' .  $db_requestID . '" class="btn btn-sm btn-info mb-1 btn_accept" disabled> Accept</button>
                                <button type="button" id="' .  $db_requestID . '"class="btn btn-sm btn-danger mt-1 btn_reject" disabled>Reject</button>
                            </div>
                        </td>
                    </tr>';
            }
            $request_count++;
        }

        $output .= ' 
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>';
    }
} else {
    die("FATAL ERROR");
}

$response['output']  =  $output;
$conn->close();
echo json_encode($response);
