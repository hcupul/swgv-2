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
    var nom = $('#txtNombre').val();
    var apepat = $('#txtApePat').val();
    var apemat = $('#txtApeMat').val();
    var email = $('#txtCorreo').val();
    var puesto = $('#txtPuesto').val();
    var user = $('#txtUsuario').val();
    var pass = $('#txtPassword').val();
    var tipo = $('#txtTipoUsuario').val();
    var idcelular = $('#txtCelular').val();

    if (isEmpty(nom) || isEmpty(apepat) || isEmpty(apemat) || isEmpty(email) || isEmpty(puesto) || isEmpty(user) || isEmpty(pass) || isEmpty(tipo) || isEmpty(idcelular)) {
        alert("Rellene correctamente todos los campos.");
    } else {
        dataToSend = {
            id: id,
            nom: nom,
            apepat: apepat,
            apemat: apemat,
            email: email,
            puesto: puesto,
            user: user,
            pass: pass,
            tipo: tipo,
            idcelular: idcelular
        };

        $.ajax({
            type: "post",
            url: "bd/usuarios/guardar_usuario.php",
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
    var nom = $('#txtNombre').val();
    var apepat = $('#txtApePat').val();
    var apemat = $('#txtApeMat').val();
    var email = $('#txtCorreo').val();
    var puesto = $('#txtPuesto').val();
    var user = $('#txtUsuario').val();
    var pass = $('#txtPassword').val();
    var tipo = $('#txtTipoUsuario').val();
    var idcelular = $('#txtCelular').val();

    if (isEmpty(pass)) {
        pass = "null";
    }

    if (isEmpty(nom) || isEmpty(apepat) || isEmpty(apemat) || isEmpty(email) || isEmpty(puesto) || isEmpty(user) || isEmpty(tipo) || isEmpty(idcelular)) {
        alert("Rellene correctamente todos los campos.");
    } else {
        dataToSend = {
            id: id,
            nom: nom,
            apepat: apepat,
            apemat: apemat,
            email: email,
            puesto: puesto,
            user: user,
            pass: pass,
            tipo: tipo,
            idcelular: idcelular
        };

        $.ajax({
            type: "post",
            url: "bd/usuarios/actualizar_usuario.php",
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
        url: "bd/usuarios/mostrar_usuarios.php",
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
        url: "bd/usuarios/eliminar_usuario.php",
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
        url: "bd/usuarios/mostrar_usuario.php",
        data: dataToSend,
        beforeSend: function () {
            mostrarCargando();
        },
        success: function (response_user) {
            $.ajax({
                type: "post",
                url: "bd/celulares/celulares_select.php",
                data: dataToSend,
                beforeSend: function () {
                    mostrarCargando();
                },
                success: function (response) {
                    $('#txtCelular').html(response);
                    var user = JSON.parse(response_user);
                    $('#txtFolio').val(user[0].IdUsuario);
                    $('#txtNombre').val(user[0].Nombre);
                    $('#txtApePat').val(user[0].ApellidoPat);
                    $('#txtApeMat').val(user[0].ApellidoMat);
                    $('#txtCorreo').val(user[0].Correo);
                    $('#txtPuesto').val(user[0].Puesto);
                    $('#txtUsuario').val(user[0].Usuario);
                    $('#txtPassword').val("");
                    $('#txtTipoUsuario').val(user[0].IdTipoUsuario);
                    $('#txtCelular').val(user[0].IdCelular);
                    $('#lblModal').html('Actualizar celular');
                    $('#modal').modal('show');
                    ocultarCargando();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    mostrarMensaje(errorThrown);
                    ocultarCargando();
                }
            });
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

function llenarCelulares() {
    dataToSend = {
        id: '0'    
    };
    
    $.ajax({
        type: "post",
        url: "bd/celulares/celulares_select.php",
        data: dataToSend,
        beforeSend: function () {
            mostrarCargando();
        },
        success: function (response) {
            $('#txtCelular').html(response);
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
    $('#txtNombre').val("");
    $('#txtApePat').val("");
    $('#txtApeMat').val("");
    $('#txtCorreo').val("");
    $('#txtPuesto').val("");
    $('#txtUsuario').val("");
    $('#txtPassword').val("");
    $('#txtTipoUsuario').val("1");
    llenarCelulares();
    $('#txtCelular').val("0");
}