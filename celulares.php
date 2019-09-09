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
	<title>Celulares | Sistema Web de Geolocalización de Vehículos</title>
	<!-- Custom fonts for this template-->
	<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<!-- Page level plugin CSS-->
	<!-- Custom styles for this template-->
	<link href="assets/css/sb-admin.css" rel="stylesheet">
	<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<!-- Page level plugin CSS-->
	<link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<link rel="icon" href="assets/img/icon-small.png">
    </head>

    <body id="page-top">

	<?php include 'includes/header.html'; ?>

	<div id="wrapper">

	    <!-- Sidebar -->
	    <?php include 'includes/navbar.html' ?>

	    <div id="content-wrapper">

		<div class="container-fluid">

		    <!-- Breadcrumbs-->
		    <ol class="breadcrumb">
			<li class="breadcrumb-item">
			    <a href="#">Celulares</a>
			</li>
			<li class="breadcrumb-item active">Catálogo de teléfonos</li>
		    </ol>

		    <!-- Area Chart Example-->
		    <div class="card mb-3">
			<div class="card-header" id="lblMapa">
			    <i class="fas fa-mobile-alt"></i>
			    Celulares
			    <button class="btn btn-primary btn-sm" onclick="btnAgregar_click();" style="margin-left: 10px;">
				<i class="fa fa-mobile-alt "></i> Agregar teléfono
			    </button>
			</div>
			<div class="card-body">
			    <div class="table-responsive">
				<table class="table table-striped table-hover" id="dataTables-example" width="100%" cellspacing="0">
				    <!--table class="table table-striped table-bordered table-hover" id="dataTables-example"-->
				    <thead class="bg-secondary  text-white">
					<tr>
					    <th>#</th>
					    <th>Marca</th>
					    <th>Modelo</th>
					    <th>No. de teléfono</th>
					    <th>Estado</th>
					    <th>Acciones</th>
					</tr>
				    </thead>
				    <tbody id="datosTabla">
				    </tbody>
				</table>
			    </div>
			</div>
			<div class="card-footer small text-muted">Celulares registrados</div>
		    </div>

		    <!-- MODAL AGREGAR / ACTUALIZAR -->
		    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="lblModal" aria-hidden="true">
			<div class="modal-dialog">
			    <div class="modal-content">
				<div class="modal-header">
				    <h5 class="modal-title" id="exampleModalLabel">Agregar celular</h5>
				    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				    </button>
				</div>
				<div class="modal-body">
				    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form">
                                                <div class="form-group">
                                                    <label>Marca:</label>
						    <input type="hidden" id="txtFolio" value="0">
                                                    <input id="txtMarca" class="form-control" placeholder="Marca">
                                                </div>
                                                <div class="form-group">
                                                    <label>Modelo:</label>
                                                    <input id="txtModelo" class="form-control" placeholder="Modelo">
                                                </div>
                                                <div class="form-group">
                                                    <label>Número de teléfono:</label>
                                                    <input id="txtNumero" class="form-control" placeholder="No. de teléfono">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
				</div>
				<div class="modal-footer">
				    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				    <button type="button" class="btn btn-primary" onclick="guardar();">Guardar</button>
				</div>
			    </div>
			</div>
		    </div>
		<!-- /.container-fluid -->

		<?php include 'includes/footer.html' ?>

	    </div>
	    <!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
	    <i class="fas fa-angle-up"></i>
	</a>

	<script src="assets/js/funciones.js"></script>
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="assets/vendor/datatables/jquery.dataTables.js"></script>
	<script src="assets/vendor/datatables/dataTables.bootstrap4.js"></script>
	<script src="assets/js/sb-admin.min.js"></script>
	<script src="assets/js/demo/datatables-demo.js"></script>
	<script src="assets/js/celulares.js"></script>
	<script>
	    menuActivo('#aMenuCelulares');
	</script>
</body>

</html>
