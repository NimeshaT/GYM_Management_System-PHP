<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Invoice</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Class Invoice</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        extract($_POST);
                        ?>

                        <!--                            ================search==================-->
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="text" name="memberId" placeholder="Enter Member Id" value="<?php echo @$memberId ?>">
                            <button type="submit" class="bg-success btn">Search</button>
                        </form>

                        <?php
                        $db = dbConn();
                        $where = null;
                        //dynamically generate the query
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            //check member id
                            if (!empty($memberId)) {
                                $where .= "WHERE memberId='$memberId' AND";
                            }
                           
                            //generate dynamic query remove AND last characters from the string
                            if (!empty($where)) {
                                $where = substr($where, 0, -3);
                                $where = " $where";
                            }
                        }
                        
                        $sql1="SELECT * FROM tbl_class_enrollment INNER JOIN tbl_classes ON tbl_class_enrollment.classId=tbl_classes.classId $where";

   
                        $result = $db->query($sql1);
                        ?>
                        <table id="jobCard_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Enrollment ID</th>
                                    <th>Enrollment No</th>
                                    <th>Member ID</th>
                                    <th>Class ID</th>
                                    <th>Class Name</th>
                                    <th>Class Fees</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $mID=$row['memberId'];
                                        $eId=$row['classEnrollmentId'];
                                        ?>
                                        <tr>
                                            <td>
                                                <form action="createClassInvoice2.php" method="post">
                                                    <input type="hidden" name="memberId" value="<?php echo @$mID; ?>">
                                                    <input type="hidden" name="classEnrollmentId" value="<?php echo @$eId; ?>">
<!--                                                    <input type="text" name="classId" value="<?php echo $row['classId']; ?>">-->
                                                    <button type="submit" class="btn btn-danger btn-sm">Create Invoice</button>
                                                </form>
                                            </td>
                                            <td><?php echo $row['classEnrollmentId']; ?></td>
                                            <td><?php echo $row['enrollmentNo']; ?></td>
                                            <td><?php echo $row['memberId']; ?></td>
                                            <td><?php echo $row['classId']; ?></td>
                                            <td><?php echo $row['className']; ?></td>
                                            <td><?php echo $row['classFees']; ?></td>
                                        </tr>  
        <?php
    }
}
?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include '../footer.php';
?>

<script>
    $(function () {
        $('#jobCard_list').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

</script>









