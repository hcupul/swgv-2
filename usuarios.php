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
	<title>Usuarios | Sistema Web de Geolocalización de Vehículos</title>
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
			    <a href="#">Usuarios</a>
			</li>
			<li class="breadcrumb-item active">Catálogo de usuarios</li>
		    </ol>

		    <!-- Area Chart Example-->
		    <div class="card mb-3">
			<div class="card-header" id="lblMapa">
			    <i class="fas fa-users"></i>
			    Vehículos
			    <button class="btn btn-primary btn-sm" onclick="btnAgregar_click();" style="margin-left: 10px;">
				<i class="fa fa-user "></i> Agregar usuario
			    </button>
			</div>
			<div class="card-body">
			    <div class="table-responsive">
				<table class="table table-striped table-hover" id="dataTables-example" width="100%" cellspacing="0">
				    <!--table class="table table-striped table-bordered table-hover" id="dataTables-example"-->
				    <thead class="bg-secondary  text-white">
					<tr>
					    <th>Nombre</th>
					    <th>Correo</th>
					    <th>Usuario</th>
					    <th>Tipo Usuario</th>
					    <th>No. teléfono</th>
					    <th>Estado</th>
					    <th>Acciones</th>
					</tr>
				    </thead>
				    <tbody id="datosTabla">
				    </tbody>
				</table>
			    </div>
			</div>
			<div class="card-footer small text-muted">Usuarios registrados</div>
		    </div>

		    <!-- MODAL AGREGAR / ACTUALIZAR -->
		    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="lblModal" aria-hidden="true">
			<div class="modal-dialog">
			    <div class="modal-content">
				<div class="modal-header">
				    <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
				    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				    </button>
				</div>
				<div class="modal-body">
				    <div class="row">
                                        <div class="col-lg-6">
                                            <form role="form">
						<div class="form-group">
						    <label>Nombre</label>
						    <input type="hidden" id="txtFolio" value="0"/>
						    <input class="form-control" id="txtNombre" placeholder="Nombre"/>
						</div>
						<div class="form-group">
						    <label>Apellido Paterno</label>
						    <input class="form-control" id="txtApePat" placeholder="Apellido Paterno"/>
						</div>
						<div class="form-group">
						    <label>Apellido Materno</label>
						    <input class="form-control" id="txtApeMat" placeholder="Apellido Materno"/>
						</div>
						<div class="form-group">
						    <label>Correo</label>
						    <input class="form-control" id="txtCorreo" placeholder="Correo"/>
						</div>
						<div class="form-group">
						    <label>Puesto</label>
						    <input class="form-control" id="txtPuesto" placeholder="Puesto"/>
						</div>
					    </form>
                                        </div>
                                        <div class="col-lg-6">
                                            <form role="form">
                                                <div class="form-group">
						    <label>Usuario</label>
						    <input class="form-control" id="txtUsuario" placeholder="Usuario"/>
						</div>
						<div class="form-group">
						    <label>Contraseña</label>
						    <input type="password" class="form-control" id="txtPassword" placeholder="Contraseña"/>
						</div>
						<div class="form-group">
						    <label>Tipo Usuario</label>
						    <select class="form-control" id="txtTipoUsuario">
						    <option value="1">Administrador</option>
						    <option value="2">Chofer</option>
						    </select>
						</div>
						<div class="form-group">
						    <label>Teléfono celular</label>
						    <select class="form-control" id="txtCelular"/>
						    <option value="0">Ninguno</option>
						    </select>
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
	<script src="assets/js/usuarios.js"></script>
	<script>
	    menuActivo('#aMenuUsuarios');
	</script>
</body>

</html>
