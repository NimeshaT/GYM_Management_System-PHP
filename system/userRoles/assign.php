<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">User Roles</a></li>
                        <li class="breadcrumb-item active">Assign</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <?php
            extract($_POST);

            if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "save" && isset($roleCode)) {
                $db = dbConn();
                $sql = "UPDATE tbl_instructors SET roleCode='$roleCode' WHERE instructorId='$instructorId'";
                $result = $db->query($sql);
            }
            ?>

            <!--====================search===========================-->
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                
                <input type="text" name="roleName" placeholder="Enter Role">
                <button type="submit" class="bg-success btn btn-sm">Search</button>
            </form>

            <?php
            extract($_POST);
            $db = dbConn();
            $where = null;
            //dynamically generate the query
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                //check instructor role
                if (!empty($roleName)) {
                    $where .= " tbl_user_roles.roleName='$roleName' AND";
                }
                //generate dynamic query remove AND last characters from the string
                if (!empty($where)) {
                    $where = substr($where, 0, -3);
                    $where = " WHERE $where";
                }
            }
            $sql = "SELECT * FROM tbl_instructors INNER JOIN tbl_user_roles ON tbl_instructors.roleCode=tbl_user_roles.roleCode $where";
            $result = $db->query($sql);
            ?>

            <table class="table table-striped mt-2" id="tbl_instructors">
                <thead class="bg bg-info">
                    <tr>
                        <th>Instructor Id</th>
                        <th>Instructor Name</th>
                        <th>Role Name</th>
                        <th>Assign Role Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
//                            echo $result->num_rows;
                        while ($row = $result->fetch_assoc()) {
                            ?>

                            <tr>
                                <td><?php echo $row['instructorId']; ?></td>
                                <td><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></td>
                                <td><?php echo $row['roleName']; ?></td>
                                <td>
                                    <div class="col">
                                        <?php
                                        $db = dbConn();
                                        $sql1 = "SELECT * FROM tbl_user_roles";
                                        $result1 = $db->query($sql1);
                                        ?>
                                        <select class="form-control form-select rCode">
                                            <option value="">--</option>
                                            <?php
                                            if ($result1->num_rows > 0) {
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $row1['roleCode']; ?>" <?php if (@$roleCode == $row1['roleCode']) { ?> selected <?php } ?>><?php echo $row1['roleName']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                        <input name="instructorId" type="hidden" value="<?php echo $row['instructorId']; ?>">
                                        <input type="hidden" class="roleCode" name="roleCode">
                                        <button type="submit" class="btn btn-primary" name="action" value="save">Update</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>


        </div>
    </section>
</div>

<?php
include '../footer.php';
?>

<script>
    $(function () {

        $('#tbl_users').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });


    $(".rCode").on("change keyup", (e) => {
        const input = $(e.target).parent().parent().parent().find(".roleCode").first();
        input.val(e.target.value);
    })
</script>
</script>
