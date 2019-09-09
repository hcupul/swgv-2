$(document).ready(function () {

});
var mapaIndividual;
var idVehiculo = "0";
var ubicacionIndividual = [];

function mostrarUbicacionIndividual() {
    var id = $("#idVehiculo").val();
    dataToSend = {
        id: id
    };
    $.ajax({
        type: "post",
        url: "bd/mapa/mostrar_ubicacion.php",
        data: dataToSend,
        beforeSend: function () {
            mostrarCargando();
        },
        success: function (response) {
            var vehicles = JSON.parse(response);
            var vehiculo = vehicles[0];
            var latitud = parseFloat(vehiculo.Latitud);
            var longitud = parseFloat(vehiculo.Longitud);
            var posicion = new google.maps.LatLng(latitud, longitud);
            ubicacionIndividual = new google.maps.Marker({
                position: posicion,
                map: mapaIndividual,
                animation: google.maps.Animation.BOUNCE,
                title: vehiculo.Numero,
                zIndex: 1
            });
            ocultarCargando();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            mostrarMensaje(errorThrown);
            ocultarCargando();
        }
    });
}

function actualizarUbicacionIndividual() {
    ubicacionIndividual.setMap(null);
    ubicacionIndividual = [];
    mostrarUbicacionIndividual();
}

function inicializarMapaIndividual() {
    var id = $("#idVehiculo").val();
    var vehiculo = [];
    dataToSend = {
        id: id
    };
    $.ajax({
        type: "post",
        url: "bd/mapa/mostrar_ubicacion.php",
        data: dataToSend,
        beforeSend: function () {
            mostrarCargando();
        },
        success: function (response) {
            var vehicles = JSON.parse(response);
            vehiculo = vehicles[0];
            var latitud = parseFloat(vehiculo.Latitud);
            var longitud = parseFloat(vehiculo.Longitud);

            var opciones = {
                zoom: 17,
                center: new google.maps.LatLng(latitud, longitud), //Ubicacion del vehiculo
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            
            mapaIndividual = new google.maps.Map(document.getElementById('mapaIndividual'), opciones);
            mostrarUbicacionIndividual();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            mostrarMensaje(errorThrown);
            ocultarCargando();
        }
    });
}

function verVehiculo(id, e) {
    e.preventDefault();
    $("#idVehiculo").val(id);
    inicializarMapaIndividual();
    setInterval(function () {
        actualizarUbicacionIndividual();
    }, 5000);
    $("#modalMapa").modal('show');
}
