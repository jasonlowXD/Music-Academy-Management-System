<?php
session_start();
$userID = $_SESSION["userID"];
$amount_left = $_SESSION["amount_left"];
$receipt_total_amount = $_SESSION["receipt_total_amount"];
$invoice_amount = $_SESSION["invoice_amount"];
$receipt_id = $_GET["receipt_id"];
$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {
    // GET RECEIPT DATA TO DISPLAY IN MODAL 
    $sql = "SELECT * FROM PAYMENT_RECEIPT WHERE RECEIPT_ID = '$receipt_id'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $receipt_date = $row["RECEIPT_DATE"];
        $receipt_amount = $row["RECEIPT_AMOUNT"];
        $receipt_desc = $row["RECEIPT_DESC"];
        $receipt_type = $row["RECEIPT_TYPE"];
        if ($row["RECEIPT_FILEPATH"] != null) {
            $receipt_filepath = $row["RECEIPT_FILEPATH"];
            $receipt_filename =  basename($receipt_filepath);
        } else {
            $receipt_filepath = null;
            $receipt_filename = '-';
        }
    }
} else {
    die("FATAL ERROR");
}
?>

<div class="modal-header">
    <h4 class="modal-title" id="exampleModalLabel1">Edit Receipt</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<form enctype="multipart/form-data" class="form-control-line" id="editReceiptForm" method="post" action="editReceipt.php?receipt_id=<?= $receipt_id ?>">
    <div class="modal-body">
        <div class="form-group">
            <label class="col-md-12">Receipt Date</span>
            </label>
            <div class="col-md-12">
                <input type="text" name="receiptDate" class="form-control mydatepicker text-muted" placeholder="yyyy-mm-dd" value="<?php echo $receipt_date ?>" required>
            </div>
        </div>
        <div class="form-group">
            <div class="p-0 col-md-12 mb-2">
                <label class="col-md-12">Amount (RM)</span>
                </label>
                <div class="col-md-12">
                    <input type="number" name="amount" min=0 oninput="validity.valid||(value='');" class="form-control text-muted editReceipt_amount_change" placeholder="enter receipt amount" value="<?php echo $receipt_amount ?>" required>
                </div>
            </div>
            <div class="p-0 col-md-12">
                <label class="col-md-12">Amount remaining in the invoice (RM)</span>
                </label>
                <div class="col-md-12">
                    <input type="number" class="form-control pl-2 editReceipt_amount_left" value="<?php echo $amount_left ?>" disabled>
                    <input type="hidden" class="form-control editReceipt_receipt_total_amount" value="<?php echo $receipt_total_amount ?>">
                    <input type="hidden" class="form-control editReceipt_current_receipt_amount" value="<?php echo $receipt_amount ?>">
                    <input type="hidden" class="form-control editReceipt_invoice_amount" value="<?php echo $invoice_amount ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Description</label>
            <div class="col-md-12">
                <input class="form-control text-muted" name="desc" placeholder="enter receipt description" value="<?php echo $receipt_desc ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-12">Type</label>
            <div class="col-sm-12">
                <select class="form-control text-muted" name="receiptType" required>
                    <?php
                    if ($receipt_type == "cash") {
                    ?>
                        <option selected value="cash">Cash</option>
                        <option value="card">Debit/Credit card</option>
                        <option value="ewallet">E-wallet</option>
                        <option value="bank">Bank transfer</option>
                    <?php
                    } else if ($receipt_type == "card") {
                    ?>
                        <option value="cash">Cash</option>
                        <option selected value="card">Debit/Credit card</option>
                        <option value="ewallet">E-wallet</option>
                        <option value="bank">Bank transfer</option>
                    <?php
                    } else if ($receipt_type == "ewallet") {
                    ?>
                        <option value="cash">Cash</option>
                        <option value="card">Debit/Credit card</option>
                        <option selected value="ewallet">E-wallet</option>
                        <option value="bank">Bank transfer</option>
                    <?php
                    } else if ($receipt_type == "bank") {
                    ?>
                        <option value="cash">Cash</option>
                        <option value="card">Debit/Credit card</option>
                        <option value="ewallet">E-wallet</option>
                        <option selected value="bank">Bank transfer</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group" id="editReceiptFileDiv">
            <label class="col-sm-12">Upload Receipt File</label>
            <div class="col-sm-12 fileinput fileinput-exists input-group" data-provides="fileinput">
                <div class="form-control" data-trigger="fileinput">
                    <i class="glyphicon glyphicon-file fileinput-exists"></i>
                    <input type="hidden" id="oldFileValue" name="oldFile" value="<?php echo $receipt_filepath; ?>">
                    <span class="fileinput-filename text-muted"><?php echo $receipt_filename; ?></span>
                </div>
                <div class="col-sm-12 p-l-0">
                    <span class="p-l-0 border-bottom-0 input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">Select file (only accept pdf or image file, max 2MB)</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="hidden">
                        <!-- get file data from this below input -->
                        <input type="file" id="editReceiptFileInput" name="receiptFile" accept="image/jpeg,image/png,application/pdf">
                    </span>
                    <a href="javascript:void(0)" id="btnFileRemove2" class=" border-bottom-0 input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
            </div>
            <span class="p-l-0 col-sm-12" id="editReceiptFileFeedback"></span>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-info">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>

<!-- Date Picker Plugin JavaScript -->
<script src="../assets/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script>
    // Date Picker
    $('.mydatepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });

    var invoice_amount = $(".editReceipt_invoice_amount").val();
    var all_receipt_total_amount = $(".editReceipt_receipt_total_amount").val();
    var current_receipt_amount = $(".editReceipt_current_receipt_amount").val();
    var total_of_other_receipt_amount = all_receipt_total_amount - current_receipt_amount;
    // auto calculate the left amount to display 
    $(document).on('change keyup mouseup click', '.editReceipt_amount_change', function() {
        var invoice_amount_left = invoice_amount - total_of_other_receipt_amount - $(this).val();
        if (invoice_amount_left < 0) {
            invoice_amount_left = 0;
        }
        $(".editReceipt_amount_left").val(invoice_amount_left);
    });

    $('#btnFileRemove2').click(function() {
        editReceiptFileRemoveClass();
        $("#editReceiptFileInput").val('');
        $("#oldFileValue").val('');
    });

    $("#editReceiptForm").submit(function(e) {
        e.preventDefault();
        $('html, body').css("cursor", "wait");
        var formData = new FormData(this);
        $.ajax({
                enctype: 'multipart/form-data',
                url: $("#editReceiptForm").attr('action'),
                type: $("#editReceiptForm").attr('method'),
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json'
            })
            .done(function(response) {
                if (response.status == 'success') {
                    editReceiptFileRemoveClass();
                    Swal.fire(
                        response.title,
                        response.message,
                        response.status
                    ).then(() => {
                        location.reload();
                    })
                    $('html, body').css("cursor", "auto");
                } else if (response.status == 'error' && response.title == 'Error receipt file') {
                    editReceiptFileAddClass(response.message);
                    $('html, body').css("cursor", "auto");
                } else {
                    editReceiptFileRemoveClass();
                    Swal.fire(
                        response.title,
                        response.message,
                        response.status
                    )
                    $('html, body').css("cursor", "auto");
                }
            })
            .fail(function(xhr, textStatus, errorThrown) {
                Swal.fire(
                    'Oops...',
                    'Something went wrong with ajax!',
                    'error'
                )
                $('html, body').css("cursor", "auto");
                console.log(xhr);
            })
    })
</script>