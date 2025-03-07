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
                <input type="date" name="from" placeholder="Enter from date" value="<?php echo @$from ?>">
                <input type="date" name="to" placeholder="Enter to date" value="<?php echo @$to ?>">
                <select name="rep_type">
                    <option value="">==</option>
                    <option value="D">Daily</option>
                    <option value="W">Weekly</option>
                    <option value="M">Monthly</option>
                    <option value="Y">Yearly</option>
                </select>
                <button type="submit" class="bg-success">Search</button>
            </form>
            <?php
            extract($_POST);
            $db = dbConn();
            $where = null;
            //dynamically generate the query
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                //check from to dates
                if (!empty($from) && !empty($to)) {
                    $where .= " appointmentDate BETWEEN  '$from' AND '$to' AND";
                }
                //generate dynamic query remove AND last characters from the string
                if (!empty($where)) {
                    $where = substr($where, 0, -3);
                    $where = " WHERE $where";
                }

                if (@$rep_type == "D") {
                    $sql = "SELECT appointmentDate,COUNT(appointmentId) AS mycount FROM tbl_appointments $where GROUP BY appointmentDate";
                }
                if (@$rep_type == "M") {
                    $sql = "SELECT MONTH(appointmentDate)AS Month,COUNT(appointmentId) AS mycount FROM tbl_appointments $where GROUP BY MONTH(appointmentDate)";
                }
                if (@$rep_type == "Y") {
                    $sql = "SELECT YEAR(appointmentDate)AS Year,COUNT(appointmentId) AS mycount FROM tbl_appointments $where GROUP BY YEAR(appointmentDate)";
                }
                if (@$rep_type == "W") {
                    $sql = "SELECT WEEK(appointmentDate)AS Week,COUNT(appointmentId) AS mycount FROM tbl_appointments $where GROUP BY WEEK(appointmentDate)";
                }
                $result = $db->query($sql);
                $total = 0;
                ?>
                <div id="tbl_Data">
                    <?php
                    echo "<strong>Found " . $result->num_rows . " records</strong>";
                    ?>
                    <table border='1' width='100%' class="mt-3">
                        <thead>
                            <tr>
                                <?php
                                if (@$rep_type == "D") {
                                    ?>
                                    <th>AppointmentDate</th>
                                    <?php
                                } else if (@$rep_type == "M") {
                                    ?>
                                    <th>Appointment Month</th>
                                    <?php
                                } else if (@$rep_type == "Y") {
                                    ?>
                                    <th>Appointment Year</th>
                                    <?php
                                } else {
                                    ?>
                                    <th>Appointment Week</th>
                                    <?php
                                }
                                ?>
                                <th>No:of Appointments</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <?php
                                        if (@$rep_type == "D") {
                                            ?>
                                            <td><?php echo $row['appointmentDate']; ?></td>
                                            <?php
                                        } else if (@$rep_type == "M") {
                                            ?>
                                            <td><?php echo getMonthByNumber($row['Month']); ?></td>
                                            <?php
                                        } else if (@$rep_type == "Y") {
                                            ?>
                                            <td><?php echo $row['Year']; ?></td>
                                            <?php
                                        } else {
                                            ?>
                                            <td><?php echo $row['Week']; ?></td>
                                            <?php
                                        }
                                        ?>

                                        <td><?php
                                            echo $row['mycount'];
                                            $total += $row['mycount'];
                                            ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td class="bg-info"><?php echo $total ?></td>

                            </tr>
                        </tbody>
                    </table>

                </div>
                <button onclick="exportTableToExcel('tbl_Data', 'appointments-data')">Export Table Data To Excel File</button>
                <button onclick="printTable('tbl_Data', 'Appointment Data');">Convert HTML to PDF</button>
            <?php } ?>
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

        const x = $(tds[0]).text();
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
            type: 'bar',
            data: {
                labels: xValues,
                //y axis may be have multiple dataset
                datasets: [{
                        label: 'Appointments',
                        data: yValues,
                        backgroundColor: 'rgb(255, 99, 132)',
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
