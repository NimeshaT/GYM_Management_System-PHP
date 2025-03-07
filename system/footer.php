<footer class="main-footer text-center">
    <strong>Dashboard-Everest Fitness Center</strong>
<!--    <div class="float-right d-none d-sm-inline-block">
    </div>-->
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
        alert('hello');
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
</body>
</html>