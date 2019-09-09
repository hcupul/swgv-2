$(document).ready(function () {
    finishLoading();
});
var request = false;

function finishLoading() {
    limpiarCampos();
    refrescarTabla();
}

function guardar() {
    var id = $('#txtFolio').val();
    if (id === "0") {
        agregar();
    } else {
        actualizar();
    }
}

function agregar() {
    var id = $('#txtFolio').val();
    var marca = $('#txtMarca').val();
    var modelo = $('#txtModelo').val();
    var numunidad = $('#txtNumUnidad').val();
    var numserie = $('#txtNumSerie').val();
    var numplaca = $('#txtPlaca').val();
    var idconductor = $('#txtConductor').val();

    if (isEmpty(marca) || isEmpty(modelo) || isEmpty(numunidad) || isEmpty(numserie) || isEmpty(numplaca) || isEmpty(idconductor)) {
        alert("Rellene correctamente todos los campos.");
    } else {
        dataToSend = {
            id: id,
            marca: marca,
            modelo: modelo,
            numunidad: numunidad,
            numserie: numserie,
            numplaca: numplaca,
            idconductor: idconductor
        };

        $.ajax({
            type: "post",
            url: "bd/vehiculos/guardar_vehiculo.php",
            data: dataToSend,
            beforeSend: function () {
                mostrarCargando();
            },
            success: function (response) {
                mostrarMensaje(response);
                refrescarTabla();
                limpiarCampos();
                $('#modal').modal('hide');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarMensaje(errorThrown);
                ocultarCargando();
            }
        });
    }//Cierra else interno	
}//Cierra metodo agregar

function actualizar() {
    var id = $('#txtFolio').val();
    var marca = $('#txtMarca').val();
    var modelo = $('#txtModelo').val();
    var numunidad = $('#txtNumUnidad').val();
    var numserie = $('#txtNumSerie').val();
    var numplaca = $('#txtPlaca').val();
    var idconductor = $('#txtConductor').val();

    if (isEmpty(marca) || isEmpty(modelo) || isEmpty(numunidad) || isEmpty(numserie) || isEmpty(numplaca) || isEmpty(idconductor)) {
        alert("Rellene correctamente todos los campos.");
    } else {
        dataToSend = {
            id: id,
            marca: marca,
            modelo: modelo,
            numunidad: numunidad,
            numserie: numserie,
            numplaca: numplaca,
            idconductor: idconductor
        };

        $.ajax({
            type: "post",
            url: "bd/vehiculos/actualizar_vehiculo.php",
            data: dataToSend,
            beforeSend: function () {
                mostrarCargando();
            },
            success: function (response) {
                mostrarMensaje(response);
                refrescarTabla();
                $('#modal').modal('hide');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarMensaje(errorThrown);
                ocultarCargando();
                $('#modal').modal('hide');
            }
        });
    }//Cierra else interno	
}//Cierra metodo agregar

function refrescarTabla() {
    $.ajax({
        type: "get",
        url: "bd/vehiculos/mostrar_vehiculos.php",
        beforeSend: function () {
            mostrarCargando();
        },
        success: function (response) {
            $('#datosTabla').html(response);
            $('#dataTables-example').dataTable();
            ocultarCargando();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            mostrarMensaje(errorThrown);
            ocultarCargando();
        }
    });
}

function confirmaEliminar(id) {
    $("#txtIdEliminar").val(id);
    $('#modalEliminar').modal('show');
}

function eliminar() {
    var id = $("#txtIdEliminar").val();
    dataToSend = {
        id: id
    };

    $.ajax({
        type: "post",
        url: "bd/vehiculos/eliminar_vehiculo.php",
        data: dataToSend,
        beforeSend: function () {
            $('#modalEliminar').modal('hide');
            mostrarCargando();
        },
        success: function (response) {
            mostrarMensaje(response);
            refrescarTabla();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            mostrarMensaje(errorThrown);
            ocultarCargando();
        }
    });
    $("#txtIdEliminar").val("0");
}

function editar(id) {
    dataToSend = {
        id: id
    };

    $.ajax({
        type: "post",
        url: "bd/vehiculos/mostrar_vehiculo.php",
        data: dataToSend,
        beforeSend: function () {
            mostrarCargando();
        },
        success: function (response) {
            var user = JSON.parse(response);
            $('#txtFolio').val(user[0].IdVehiculo);
            $('#txtMarca').val(user[0].Marca);
            $('#txtModelo').val(user[0].Modelo);
            $('#txtNumUnidad').val(user[0].NumUnidad);
            $('#txtNumSerie').val(user[0].NumSerie);
            $('#txtPlaca').val(user[0].NumPlaca);
            $('#txtConductor').val(user[0].IdConductor);
            $('#lblModal').html('Actualizar vehículo');
            $('#modal').modal('show');
            ocultarCargando();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            mostrarMensaje(errorThrown);
            ocultarCargando();
        }
    });
}

function btnAgregar_click() {
    limpiarCampos();
    $('#lblModal').html('Agregar vehículo');
    $('#modal').modal('show');
}

function llenarConductores() {
    $.ajax({
        type: "get",
        url: "bd/usuarios/conductores_select.php",
        beforeSend: function () {
            mostrarCargando();
        },
        success: function (response) {
            $('#txtConductor').html(response);
            ocultarCargando();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            mostrarMensaje(errorThrown);
            ocultarCargando();
        }
    });
}

function limpiarCampos() {
    $('#txtFolio').val("0");
    $('#txtMarca').val("");
    $('#txtModelo').val("");
    $('#txtNumUnidad').val("");
    $('#txtNumSerie').val("");
    $('#txtPlaca').val("");
    llenarConductores();
    $('#txtConductor').val("0");
}