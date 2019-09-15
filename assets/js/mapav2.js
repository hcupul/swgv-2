$(document).ready(function () {
    cargarVehiculos();
    inicializarMapa();
    setInterval(function () {
        actualizarUbicaciones();
    }, 2500);
    setInterval(function () {
        cargarVehiculos();
    }, 5000);
});
var mapa;
var ubicaciones = []; // Create a marker array to hold your ubicaciones

var division = 50;
var latInicial = 21.111364;
var latFinal = 21.0519188;
var lonInicial = -86.8389616;
var lonFinal = -86.848631;
var latSalto = (latInicial - latFinal) / division;
var lonSalto = (lonInicial - lonFinal) / division;
var esida = true;

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
            simularRuta();
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
                        title: vehiculo.Identificador,
                        zIndex: i+1
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

function simularRuta() {
    var latitud = latInicial;
    var longitud = lonInicial;
    var posicion = new google.maps.LatLng(latitud, longitud);
    var ubicacion = new google.maps.Marker({
        position: posicion,
        map: mapa,
        animation: null, //google.maps.Animation.DROP,
        title: 'Vehículo 5 - 9982643875',
        zIndex: 1
    });
    ubicaciones.push(ubicacion);
    
    if(esida){
        ida();
    } else {
        vuelta();
    }
}

function ida() {
    if ((latInicial - latFinal) > 0)
    {
        latInicial -= latSalto;
        lonInicial -= lonSalto;
    } else {
        latFinal = 21.111364;
        latInicial = 21.0519188;
        lonFinal = -86.8389616;
        lonInicial = -86.848631;
        latSalto = (latFinal - latInicial) / division;
        lonSalto = (lonFinal - lonInicial) / division;
        esida = false;
    }
}

function vuelta() {
    if ((latFinal - latInicial) > 0)
    {
        latInicial += latSalto;
        lonInicial += lonSalto;
    } else {
        latInicial = 21.111364;
        latFinal = 21.0519188;
        lonInicial = -86.8389616;
        lonFinal = -86.848631;
        latSalto = (latInicial - latFinal) / division;
        lonSalto = (lonInicial - lonFinal) / division;
        esida = true;
    }
}