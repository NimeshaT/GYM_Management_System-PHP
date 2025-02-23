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
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php
            $db = dbConn();
            $sql = "SELECT * FROM tbl_user_roles";
            $result = $db->query($sql);
            ?>
            <table class="table table-striped mt-2" id="tbl_user_roles">
                <thead class="bg bg-info">
                    <tr>
                        <th>Role Code</th>
                        <th>Role Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>

                            <tr>
                                <td><?php echo $row['roleCode']; ?></td>
                                <td><?php echo $row['roleName']; ?></td>
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

