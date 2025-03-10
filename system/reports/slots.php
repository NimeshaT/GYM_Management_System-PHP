<?php
include '../header.php';
include '../nav.php';
//include 'system/function.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Report</a></li>
                        <li class="breadcrumb-item active">Reservation</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <?php
                $db = dbConn();
                $sql1 = "SELECT * FROM tbl_time_slots";
                $result1 = $db->query($sql1);
                ?>
                <label for="s_Id" class="form-label">Slot Name : </label>
                <select  class="btn btn-sm bg-info" name="s_Id" id="s_Id">
                    <option value="">--</option>
                    <?php
                    if ($result1->num_rows > 0) {
                        while ($row = $result1->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['slotId']; ?>" <?php if (@$s_Id == $row['slotId']) { ?> selected <?php } ?>><?php echo $row['slotName']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
<!--               <input type="text" name="cus_Reg" placeholder="Enter Customer RegNo">-->
                <input type="date" name="from" placeholder="Enter from date">
                <input type="date" name="to" placeholder="Enter to date">

                <button type="submit" class="bg-success">Search</button>
            </form>
            <?php
            extract($_POST);
            $db = dbConn();
            $where = null;
            //dynamically generate the query
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //check slot id
                if (!empty($s_Id)) {
                    $where .= "tbl_appointments.slotId='$s_Id' AND";
                }
                //check customer reg no
//                if (!empty($cus_Reg)) {
//                    $where .= " CRegNo='$cus_Reg' AND";
//                }
                //check from to dates
                if (!empty($from) && !empty($to)) {
                    $where .= " tbl_appointments.appointmentDate BETWEEN  '$from' AND '$to' AND";
                }
                //generate dynamic query remove AND last characters from the string
                if (!empty($where)) {
                    $where = substr($where, 0, -3);
                    $where = " WHERE $where";
                }
            }

            $sql = "SELECT * FROM tbl_appointments INNER JOIN tbl_time_slots ON tbl_appointments.slotId=tbl_time_slots.slotId $where";
            $result = $db->query($sql);
            ?>
            <div id="divData">
                <?php
                echo "<strong>Found " . $result->num_rows . " records</strong>";
                ?>
                <table border='1' width='100%' class="mt-3 table table-bordered" id="tbl_Data">
                    <thead>
                        <tr>
                            <th>Appointment ID</th>
                            <th>Slot ID</th>
                            <th>Appointment Date</th>
<!--                            <th>Count</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php
                        echo $row['appointmentId'];
//                                        $total += $row['AppointmentId'];
                                ?></td>
                                    <td><?php echo $row['slotId'] ?></td>
                                    <td><?php echo $row['appointmentDate'] ?></td>
                                    
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <button onclick="exportTableToExcel('tbl_Data', 'appointments-data')">Export Table Data To Excel File</button>
            <button onclick="printTable('tbl_Data', 'Appointment Data');">Convert HTML to PDF</button>
        </div>
    </section>
    
    <div class="mx-auto" style="width: 80%">
        <canvas id="myChart"></canvas>
    </div>

</div>

<?php
include '../footer.php';
?>

<script>

    const xValues = [];
    const yValues = [];

    //i index el element
    //x and y values get from table
    $("tbody tr").each((i, el) => {
        const tds = $(el).children();

        const x = $(tds[2]).text();
        const y = parseFloat($(tds[1]).text());
        //last column ignore
        if (x?.trim() == "")
            return;

        xValues.push(x);
        yValues.push(y);
    });


    // check if there are x and y values
    if (xValues.length > 0) {

        const config = {
            type: 'pie',
            data: {
                labels: xValues,
                //y axis may be have multiple dataset
                datasets: [{
                        label: 'Slots',
                        data: yValues,
                        backgroundColor: 'rgb(255, 178, 102)',
                        borderColor: 'rgb(255, 99, 132)'
                    }]
            },
            // make precission points 0 (only show integers)
            options: {
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                precision: 0,
                            },
                        },
                    ]
                }
            }
        };

        const myChart = new Chart(
                document.getElementById('myChart'),
                config
                );

    }


</script>



