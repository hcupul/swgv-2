<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Mapa | Sistema Web de Geolocalización de Vehículos</title>
	<!-- Custom fonts for this template-->
	<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<!-- Page level plugin CSS-->
	<link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<!-- Custom styles for this template-->
	<link href="assets/css/sb-admin.css" rel="stylesheet">
	<link rel="icon" href="assets/img/icon-small.png">
    </head>

    <body id="page-top">

	<?php include 'includes/header.php'; ?>

	<div id="wrapper">

	    <!-- Sidebar -->
	    <?php include 'includes/navbar.html' ?>

	    <div id="content-wrapper">

		<div class="container-fluid">

		    <!-- Breadcrumbs-->
		    <ol class="breadcrumb">
			<li class="breadcrumb-item">
			    <a href="#">Mapa</a>
			</li>
			<li class="breadcrumb-item active">Vehículos en tiempo real</li>
		    </ol>

		    <!-- Area Chart Example-->
		    <div class="card mb-3">
			<div class="card-header" id="lblMapa">
			    <i class="fas fa-map-marked-alt"></i>
			    Mapa
			</div>
			<div class="card-body">
			    <input type="hidden" id="idVehiculo" value="0"  />
			    <div id="mapa" style="border:0; height:400px; width: 100%;"></div>
			</div>
			<div class="card-footer small text-muted">Mapa en tiempo real</div>
		    </div>

		    <!-- DataTables Example -->
		    <div class="card mb-3">
			<div class="card-header">
			    <i class="fas fa-ambulance"></i>
			    Vehículos activos</div>
			<div class="card-body">
			    <div class="row" id="listaVehiculos"></div>
			</div>
			<div class="card-footer small text-muted">Vehículos activos</div>
		    </div>

		</div>
		<!-- /.container-fluid -->

		<?php include 'includes/footer.html' ?>

	    </div>
	    <!-- /.content-wrapper -->

	    <!-- MODAL MAPA -->
	    <div class="modal fade" id="modalMapa" tabindex="-1" role="dialog" aria-labelledby="lblModal" aria-hidden="true">
		<div class="modal-dialog modal-lg">
		    <div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="exampleModalLabel">Ver vehículo</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
			</div>
			<div class="modal-body">
			    <div id="mapaIndividual" style="border:0; height:400px; width: 100%;"></div>
			</div>
			<div class="modal-footer">
			    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
			</div>
		    </div>
		</div>
	    </div>

	</div>
	<!-- /#wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
	    <i class="fas fa-angle-up"></i>
	</a>

	<script src="assets/js/funciones.js"></script>
	<script>
            includeHTML();
        </script>
	<!-- Bootstrap core JavaScript-->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Core plugin JavaScript-->
	<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
	<!-- Page level plugin JavaScript-->
	<script src="assets/vendor/datatables/jquery.dataTables.js"></script>
	<script src="assets/vendor/datatables/dataTables.bootstrap4.js"></script>
	<!-- Custom scripts for all pages-->
	<script src="assets/js/sb-admin.min.js"></script>
	<!-- Demo scripts for this page-->
	<script src="assets/js/demo/datatables-demo.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.metisMenu.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-S005DFqtS74k_AAejRTVsC4ZxNlM34s"></script>
        <script src="assets/js/funciones.js"></script>
	<script src="assets/js/mapav2.js?v=1.8"></script>
	<script src="assets/js/mapa_individual.js"></script>
	<script>
	    menuActivo('#aMenuMapa');
	</script>

    </body>

</html>
