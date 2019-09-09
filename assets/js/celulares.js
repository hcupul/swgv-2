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
    var numero = $('#txtNumero').val();

    if (isEmpty(marca) || isEmpty(modelo) || isEmpty(numero)) {
        alert("Rellene correctamente todos los campos.");
    } else {
        dataToSend = {
            id: id,
            marca: marca,
            modelo: modelo,
            numero: numero
        };

        $.ajax({
            type: "post",
            url: "bd/celulares/guardar_celular.php",
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
    var numero = $('#txtNumero').val();

    if (isEmpty(marca) || isEmpty(modelo) || isEmpty(numero)) {
        alert("Rellene correctamente todos los campos.");
    } else {
        dataToSend = {
            id: id,
            marca: marca,
            modelo: modelo,
            numero: numero
        };

        $.ajax({
            type: "post",
            url: "bd/celulares/actualizar_celular.php",
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
            }
        });
    }//Cierra else interno	
}//Cierra metodo agregar

function refrescarTabla() {
    $.ajax({
        type: "get",
        url: "bd/celulares/mostrar_celulares.php",
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
        url: "bd/celulares/eliminar_celular.php",
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
        url: "bd/celulares/mostrar_celular.php",
        data: dataToSend,
        beforeSend: function () {
            mostrarCargando();
        },
        success: function (response) {
            var user = JSON.parse(response);
            $('#txtFolio').val(user[0].IdCelular);
            $('#txtMarca').val(user[0].Marca);
            $('#txtModelo').val(user[0].Modelo);
            $('#txtNumero').val(user[0].Numero);
            $('#lblModal').html('Actualizar celular');
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
    $('#lblModal').html('Agregar celular');
    $('#modal').modal('show');
}


function limpiarCampos() {
    $('#txtFolio').val("0");
    $('#txtMarca').val("");
    $('#txtModelo').val("");
    $('#txtNumero').val("");
}