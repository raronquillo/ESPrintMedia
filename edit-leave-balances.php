<?php include 'inc/config.php'; ?>
<?php include 'inc/template_start.php'; ?>
<?php include 'inc/page_head.php'; ?>
<?php
if (empty($_SESSION['hris_id'])) {
    header('Location: login');
}
?>
<?php
$fid = $_GET[md5('id')]; // Foreign id
$rid = ""; // row id
$sql = mysqli_query($db, "SELECT * FROM tbl_leave_balances");
while ($row = mysqli_fetch_assoc($sql)) {
    if ($fid == md5($row['employee_number'])) {
        $rid = $row['employee_number'];
    }
}
?>
<!-- Page content -->
<div id="page-content">
    <!-- eCommerce Dashboard Header -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-wallet"></i><strong>View Leave Balances</strong>
            </h1>

        </div>
    </div>
    <div class="block full">
        <div class="block-title">
            <div class="block-options pull-right">
                <a href="leave-balances" class="btn btn-alt btn-sm btn-default">Leave Balances List</a>
            </div>
            <h2><strong>Leave</strong> Balances</h2>
        </div>
        <?php
        $get_details = mysqli_query($db, "SELECT * FROM tbl_leave_balances WHERE employee_number = '$rid'");
        while ($r = mysqli_fetch_assoc($get_details)) {
        ?>
            <div class="container-fluid">
                <?= $res ?>
                <form method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Employee Number</label>
                                <input type="text" name="employee_number" class="form-control" readonly value="<?= $rid ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Employee Name</label>
                                <input type="text" name="employee_name" class="form-control" readonly value="<?= $r['emp_name'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>SL</label>
                                <input type="text" name="sl" class="form-control" value="<?= $r['SL'] ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>VL</label>
                                <input type="text" name="vl" class="form-control" value="<?= $r['VL'] ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>EL</label>
                                <input type="text" name="el" class="form-control" value="<?= $r['others'] ?>">
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" name="btn_update_leave_balances">Update</button>
                </form>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php include 'inc/page_footer.php'; ?>
<?php include 'inc/template_scripts.php'; ?>
<?php include 'inc/template_end.php'; ?>