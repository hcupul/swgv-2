$(document).ready(function () {
    cargarVehiculos();
    inicializarMapa();
    setInterval(function () {
        actualizarUbicaciones();
    }, 5000);
    setInterval(function () {
        cargarVehiculos();
    }, 60000);
});
var mapa;
var ubicaciones = []; // Create a marker array to hold your ubicaciones

function mostrarUbicaciones() {
    dataToSend = {
        id: "0"
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

            if (vehicles.length < 1) {
                $("#lblMapa").html("<i class='fas fa-map-marked-alt'></i> Mapa <small> / No hay vehículos activos en la última hora</small>");
            } else {
                $("#lblMapa").html("<i class='fas fa-map-marked-alt'></i> Mapa");
                for (var i = 0; i < vehicles.length; i++) {
                    var vehiculo = vehicles[i];
                    var latitud = parseFloat(vehiculo.Latitud);
                    var longitud = parseFloat(vehiculo.Longitud);
                    var posicion = new google.maps.LatLng(latitud, longitud);
                    var ubicacion = new google.maps.Marker({
                        position: posicion,
                        map: mapa,
                        animation: null,//google.maps.Animation.DROP,
                        title: vehiculo.Numero,
                        zIndex: i
                    });
                    ubicaciones.push(ubicacion);
                }
            }
            ocultarCargando();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            mostrarMensaje(errorThrown);
            ocultarCargando();
        }
    });
}

function actualizarUbicaciones() {
    for (var i = 0; i < ubicaciones.length; i++) {
        ubicaciones[i].setMap(null);
    }
    ubicaciones = [];
    mostrarUbicaciones();
}

function inicializarMapa() {
    var opciones = {
        zoom: 10,
        center: new google.maps.LatLng(21.1620165, -86.8516553), //Cancún
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    mapa = new google.maps.Map(document.getElementById('mapa'), opciones);
    mostrarUbicaciones();
}

function cargarVehiculos() {
    $.ajax({
        type: "get",
        url: "bd/vehiculos/vehiculos_mapa.php",
        beforeSend: function () {
            mostrarCargando();
        },
        success: function (response) {
            $('#listaVehiculos').html(response);
            ocultarCargando();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            mostrarMensaje(errorThrown);
            ocultarCargando();
        }
    });
}