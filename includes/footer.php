	    <footer class="app-footer">
	    	<div class="container text-center py-3">
	    		<!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
	    		<small class="copyright">Copyright &copy; <?= date('Y'); ?> SPK Pemilihan Lokasi Street Food Menggunakan Metode Promethee | Imelda Lukas</small>

	    	</div>
	    </footer>
	    <!--//app-footer-->

	    </div>
	    <!--//app-wrapper-->


	    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	    <!-- Javascript -->
	    <script src="../../assets/plugins/popper.min.js"></script>
	    <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	    <!-- Charts JS -->
	    <script src="../../assets/plugins/chart.js/chart.min.js"></script>
	    <script src="../../assets/js/index-charts.js"></script>

	    <!-- Page Specific JS -->
	    <script src="../../assets/js/app.js"></script>
	    <script src="../../assets/js/alert.js"></script>
	    <script>
	    	// Example of using SweetAlert for alert
	    </script>

		<script src="../../assets/js/clock.js"></script>
	    <script>
	    	$(document).ready(function () {
	    		$('#myTable').DataTable();
	    	});


			function toggleDiv() {
				$("#hiddenDiv").toggle();

				var buttonText = $("#buttonHide").text();
        	$("#buttonHide").text(buttonText === "Sembunyikan Detail Perhitungan" ? "Lihat Detail Perhitungan" : "Sembunyikan Detail Perhitungan");
			};

			


	    </script>

	    </body>

	    </html>