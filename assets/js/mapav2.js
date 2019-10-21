$(document).ready(function () {
    cargarVehiculos();
    inicializarMapa();
    setInterval(function () {
        actualizarUbicaciones();
    }, 6000);
    setInterval(function () {
        cargarVehiculos();
    }, 5000);
});
var mapa;
var ubicaciones = []; // Create a marker array to hold your ubicaciones
var directionsService;
var directionsRenderer;

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
        timeout: 5000,
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
                    var infowindow = new google.maps.InfoWindow;
                    infowindow.setContent("Tel: " + vehiculo.Telefono);
                    var image = 'assets/img/marker-auto.png';
                    var ubicacion = new google.maps.Marker({
                        position: posicion,
                        map: mapa,
                        animation: null,//google.maps.Animation.DROP,
                        title: vehiculo.Nombre,
                        zIndex: i+1,
                        icon: image
                    });
                    ubicacion.addListener('click', function () {
                        infowindow.open(mapa, ubicacion);
                        /*mapa.setZoom(15);
                        mapa.setCenter(ubicacion.getPosition());*/
                    });
                    ubicaciones.push(ubicacion);
                }
            }
            ocultarCargando();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR+ " : " + textStatus + " : " + errorThrown);
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
    
    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer({suppressMarkers: true});
    
    mapa = new google.maps.Map(document.getElementById('mapa'), opciones);
    mapa.addListener('click', function (e) {
        placeMarkerAndPanTo(e.latLng, mapa);
    });
    
    var trafficLayer = new google.maps.TrafficLayer();
    trafficLayer.setMap(mapa);
    directionsRenderer.setMap(mapa);
    
    var centerControlDiv = document.createElement('div');
    var centerControl = new CenterControl(centerControlDiv, mapa);
    centerControlDiv.index = 1;
    mapa.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);
        
    mostrarUbicaciones();
}

function placeMarkerAndPanTo(latLng, map) {
    var image = 'assets/img/marker-emergencia.png';
    var marker = new google.maps.Marker({
        position: latLng,
        map: mapa,
        animation: null, //google.maps.Animation.DROP,
        zIndex: 1,
        icon: image,
        title: 'Emergencia'
    });
    var infowindow = new google.maps.InfoWindow({
        content: 'Emergencia'
    });
    marker.addListener('click', function () {
        findNearestMarker(latLng);
    });
    mapa.panTo(latLng);
    //infowindow.open(map, marker);
}

function setOrigen(newOrigen){
    origen = newOrigen;
}

function cargarVehiculos() {
    $.ajax({
        type: "get",
        url: "bd/vehiculos/vehiculos_mapa.php",
        timeout: 5000,
        beforeSend: function () {
            mostrarCargando();
        },
        success: function (response) {
            $('#listaVehiculos').html(response);
            ocultarCargando();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR+ " : " + textStatus + " : " + errorThrown);
            ocultarCargando();
        }
    });
}

function simularRuta() {
    var latitud = latInicial;
    var longitud = lonInicial;
    var posicion = new google.maps.LatLng(latitud, longitud);
    var image = 'assets/img/marker-auto.png';
    var ubicacion = new google.maps.Marker({
        position: posicion,
        map: mapa,
        animation: null, //google.maps.Animation.DROP,
        title: 'Vehículo 5',
        zIndex: 1,
        icon: image
    });
    
    var infowindow = new google.maps.InfoWindow;
    infowindow.setContent('Tel: 9982643875');
    
    ubicacion.addListener('click', function () {
        infowindow.open(mapa, ubicacion);
        /*mapa.setZoom(15);
        mapa.setCenter(ubicacion.getPosition());*/
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

function rad(x) {
    return x * Math.PI / 180;
}

function findNearestMarker(latLng) {
    var lat = latLng.lat();
    var lng = latLng.lng();
    var R = 6371; // radius of earth in km
    var distances = [];
    var closest = -1;
    for (i = 0; i < ubicaciones.length; i++) {
        var mlat = ubicaciones[i].position.lat();
        var mlng = ubicaciones[i].position.lng();
        var dLat = rad(mlat - lat);
        var dLong = rad(mlng - lng);
        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(rad(lat)) * Math.cos(rad(lat)) * Math.sin(dLong / 2) * Math.sin(dLong / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var d = R * c;
        distances[i] = d;
        if (closest === -1 || d < distances[closest]) {
            closest = i;
        }
    }

    calculateAndDisplayRoute(latLng, ubicaciones[closest].position);
    alert("El vehículo más cercano es el " + ubicaciones[closest].title);
}

function calculateAndDisplayRoute(origen, destino) {
    directionsService.route(
        {
            origin: origen,
            destination: destino,
            travelMode: 'DRIVING'
        },
        function (response, status) {
            if (status === 'OK') {
                directionsRenderer.setDirections(response);
            } else {
                window.alert('Error al trazar la ruta: ' + status);
            }
        }
    );
}

function CenterControl(controlDiv, map) {

    // Set CSS for the control border.
    var controlUI = document.createElement('div');
    controlUI.style.backgroundColor = '#fff';
    controlUI.style.border = '2px solid #fff';
    controlUI.style.borderRadius = '3px';
    controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
    controlUI.style.cursor = 'pointer';
    controlUI.style.marginTop = '10px';
    controlUI.style.textAlign = 'center';
    controlUI.title = 'Click para limpiar las emergencias y rutas';
    controlDiv.appendChild(controlUI);

    // Set CSS for the control interior.
    var controlText = document.createElement('div');
    controlText.style.color = 'rgb(25,25,25)';
    controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
    controlText.style.fontSize = '12px';
    controlText.style.padding = '8px';
    controlText.innerHTML = 'Limpiar mapa';
    controlUI.appendChild(controlText);

    // Setup the click event listeners: simply set the map to Chicago.
    controlUI.addEventListener('click', function () {
        location.reload();
    });
}