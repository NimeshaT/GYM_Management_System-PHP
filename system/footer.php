<footer class="main-footer text-center">
    <strong>Dashboard-Everest Fitness Center</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo SITE_URL; ?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo SITE_URL; ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo SITE_URL; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--reports-->
<script src="<?php echo SITE_URL; ?>dist/js/html2canvas.min.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL; ?>dist/js/jspdf.min.js" type="text/javascript"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo SITE_URL; ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo SITE_URL; ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo SITE_URL; ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo SITE_URL; ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo SITE_URL; ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo SITE_URL; ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo SITE_URL; ?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo SITE_URL; ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo SITE_URL; ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo SITE_URL; ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo SITE_URL; ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo SITE_URL; ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo SITE_URL; ?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo SITE_URL; ?>plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo SITE_URL; ?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo SITE_URL; ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo SITE_URL; ?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo SITE_URL; ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo SITE_URL; ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo SITE_URL; ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo SITE_URL; ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo SITE_URL; ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo SITE_URL; ?>dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo SITE_URL; ?>dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo SITE_URL; ?>dist/js/pages/dashboard.js"></script>
<!--reports-->
<!--<script src="<?php echo SITE_URL; ?>dist/js/html2canvas.min.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL; ?>dist/js/jspdf.min.js" type="text/javascript"></script>-->
<script>
    function exportTableToExcel(tableID, filename = '') {
        alert('Do you like to download?');
        var downloadLink;
        //file type excel or jpg or pdf something like this
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name
        filename = filename ? filename + '.xls' : 'excel_data.xls';

        // Create download link element
        //create hyperlink
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);
        //blob type means convert binary data
              // Create a link to the file
            //data type and table assign to the href
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
    }
    function Convert_HTML_To_PDF() {
                var elementHTML = document.getElementById('divData');

                html2canvas(elementHTML, {
                    useCORS: true,
                    onrendered: function (canvas) {
                        var pdf = new jsPDF('L', 'pt', 'letter');

                        var pageHeight = 680;
                        var pageWidth = 1900;
                        //create pdf pages count
                        for (var i = 0; i <= elementHTML.clientHeight / pageHeight; i++) {
                            var srcImg = canvas;
                            var sX = 0;
                            var sY = pageHeight * i; // start 1 pageHeight down for every new page
                            var sWidth = pageWidth;
                            var sHeight = pageHeight;
                            var dX = 0;
                            var dY = 0;
                            var dWidth = pageWidth;
                            var dHeight = pageHeight;

                            window.onePageCanvas = document.createElement("canvas");
                            onePageCanvas.setAttribute('width', pageWidth);
                            onePageCanvas.setAttribute('height', pageHeight);
                            var ctx = onePageCanvas.getContext('2d');
                            ctx.drawImage(srcImg, sX, sY, sWidth, sHeight, dX, dY, dWidth, dHeight);

                            var canvasDataURL = onePageCanvas.toDataURL("image/png", 1.0);
                            var width = onePageCanvas.width;
                            var height = onePageCanvas.clientHeight;

                            if (i > 0) // if we're on anything other than the first page, add another page
                                pdf.addPage(612, 864); // 8.5" x 12" in pts (inches*72)

                            pdf.setPage(i + 1); // now we declare that we're working on that page
                            pdf.addImage(canvasDataURL, 'PNG', 20, 40, (width * .62), (height * .62)); // add content to the page
                        }

                        // Save the PDF
                        pdf.save('document-html.pdf');
                    }
                });
            }
            
     function printTable(tableId, tableTitle = "") {
         	// clone html from the table
                // 
                $(".no-print").hide();
                
                //copy-clone
		let tableHTML = $("<div>")
			.append($(`#${tableId}`).clone())
			.html();

                $(".no-print").show();
 
		// create new window and print the table
		const stylesheet =
			"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css";
		const win = window.open("", "Print", "width=500,height=300");
		win.document.write(
			`<html><head><link rel="stylesheet" href="${stylesheet}"></head><body><h2>${tableTitle}</h2><hr>${tableHTML}</body></html>`
		);
        //milliseconds 100
		setTimeout(() => {
			win.print();
			win.document.close();
			win.close();
		}, 300);
         
     }     
            
</script>
<!--<script>
  $(function () {
    
    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }
    
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })
  })
</script>-->

<script>
    $(document).ready(function () {
    $.ajax({
        url: 'getChartData.php', // Call PHP script
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            // Extract data from response
            let bookingDates = response.bookings.map(item => item.date);
            //let enrollmentsDates = response.enrollments.map(item => item.date);
            let bookingCounts = response.bookings.map(item => item.count);
            let enrollmentCounts = response.enrollments.map(item => item.count);

            // Chart.js Data
            var chartData = {
                labels: bookingDates, // Dates from database
                datasets: [
                    {
                        label: 'Bookings',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        data: bookingCounts
                    },
                    {
                        label: 'Enrollments',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        data: enrollmentCounts
                    }
                ]
            };

            // Render Chart
            var barChartCanvas = $('#barChart').get(0).getContext('2d');
            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            };

            new Chart(barChartCanvas, {
                type: 'bar',
                data: chartData,
                options: barChartOptions
            });
        },
        error: function (xhr, status, error) {
            console.log('Error:', error);
        }
    });
});

</script>
<!--<script>
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })
</script>-->

    <script>
    $(document).ready(function() {
        $.ajax({
            url: 'getCashierChartData.php', // Call the PHP script
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var labels = [];
                var data = [];
                var backgroundColors = ['#FF6384', '#36A2EB', '#FFCE56']; // Customize colors

                response.forEach(function(item) {
                    labels.push(item.category);
                    data.push(item.total);
                });

                var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
                var pieData = {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColors
                    }]
                };

                var pieOptions = {
                    maintainAspectRatio: false,
                    responsive: true
                };

                new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                });
            },
            error: function(error) {
                console.log("Error loading data: ", error);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'getReceptionistChartData.php', // Call the PHP script
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var labels = [];
                var data = [];
                var backgroundColors = ['#FF6384', '#36A2EB', '#FFCE56']; // Customize colors

                response.forEach(function(item) {
                    labels.push(item.category);
                    data.push(item.total);
                });

                var pieChartCanvas = $('#pieChart1').get(0).getContext('2d');
                var pieData = {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColors
                    }]
                };

                var pieOptions = {
                    maintainAspectRatio: false,
                    responsive: true
                };

                new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                });
            },
            error: function(error) {
                console.log("Error loading data: ", error);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'getReceptionistChartData1.php', // Call the PHP script
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var labels = [];
                var data = [];
                var backgroundColors = ['#FF6384', '#36A2EB', '#FFCE56']; // Customize colors

                response.forEach(function(item) {
                    labels.push(item.category);
                    data.push(item.total);
                });

                var pieChartCanvas = $('#pieChart2').get(0).getContext('2d');
                var pieData = {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColors
                    }]
                };

                var pieOptions = {
                    maintainAspectRatio: false,
                    responsive: true
                };

                new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                });
            },
            error: function(error) {
                console.log("Error loading data: ", error);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'getReceptionistChartData1.php', // Call the PHP script
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var labels = [];
                var data = [];
                var backgroundColors = ['#FF6384', '#36A2EB', '#FFCE56']; // Customize colors

                response.forEach(function(item) {
                    labels.push(item.category);
                    data.push(item.total);
                });

                var pieChartCanvas = $('#lineChart2').get(0).getContext('2d');
                var pieData = {
                    labels: labels,
                    datasets: [{
                        label: "Job Card Status",
                        data: data,
                        backgroundColor: backgroundColors,
                        fill: false,
                        borderColor: '#36A2EB'
                    }]
                };

                var pieOptions = {
                    maintainAspectRatio: false,
                    responsive: true
                };

                new Chart(pieChartCanvas, {
                    type: 'line',
                    data: pieData,
                    options: pieOptions
                });
            },
            error: function(error) {
                console.log("Error loading data: ", error);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'getReceptionistChartData.php', // Call the PHP script
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var labels = [];
                var data = [];
                var backgroundColors = ['#FF6384', '#36A2EB', '#FFCE56']; // Customize colors

                response.forEach(function(item) {
                    labels.push(item.category);
                    data.push(item.total);
                });

                var lineChartCanvas = $('#lineChart1').get(0).getContext('2d');
                var lineData = {
                    labels: labels,
                    datasets: [{
                        label: "Job Card Status",
                        data: data,
                        backgroundColor: backgroundColors,
                        fill: false,
                        borderColor: '#36A2EB'
                    }]
                };

                var lineOptions = {
                    maintainAspectRatio: false,
                    responsive: true
                   
                };

                new Chart(lineChartCanvas, {
                    type: 'line',
                    data: lineData,
                    options: lineOptions
                });
            },
            error: function(error) {
                console.log("Error loading data: ", error);
            }
        });
    });
</script>
</body>
</html>