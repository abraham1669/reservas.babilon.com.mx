


window.mapa = function( divMapa, mapaDetalles, inputGuardaConfiguracion ){
	/*
	* divMapa -> Nombre deñ div donde el mapa se guardaria
	* mapaDetalles -> Se pasa un objeto donde recibe las configuraciones iniciales
	* inputGuardaConfiguracion -> Donde se guardarian en formato de string las configuraciones del mapa a guardar
	*
	*/

	/** Ejemplo
	var mapConf = {
	    mapa : [20.5745654, -87.3834575],  
	    tipo : "roadmap",
	    zoom : 9,
	    marcador : {
	        mapa : [ 20.5745654, -87.3834575]
	    }
	};
	*/
	/**  Para agregar ubicacion al mapa **/

	/* Borramos el mapa primero */
	$("#"+divMapa).empty();

	var map;
	var markers = [];
	var opciones = {};

	function initialize() {
		var marcador = new google.maps.LatLng( mapaDetalles.marcador.mapa[0], mapaDetalles.marcador.mapa[1] );
		var posicion = new google.maps.LatLng( mapaDetalles.mapa[0], mapaDetalles.mapa[1] );

		var mapOptions = {
			zoom: mapaDetalles.zoom,
			center: posicion,
			streetViewControl: false,
			mapTypeId: mapaDetalles.tipo
		};
	  
		map = new google.maps.Map(document.getElementById(divMapa), mapOptions);


		// atachamos el evento para registrar el marcador
		google.maps.event.addListener(map, 'click', function(event) {
			addMarker(event.latLng);
		});
        // agregagamos un marcador por defaul
		addMarker(marcador);
    }

	// Agrega el marcador al mapa
	function addMarker(location) {
		clearMarkers(); // eliminamos el ultimo marcador registrado
		var marker = new google.maps.Marker({
			position: location,
			map: map
		});
		markers.push(marker);
		setInput(inputGuardaConfiguracion, location.A, location.F ); //agregamos los registros del marcador
	}

	// Sets the map on all markers in the array.
	function setAllMap(map) {
	  for (var i = 0; i < markers.length; i++)
	    markers[i].setMap(map);
	}

	// Removes the markers from the map, but keeps them in the array.
	function clearMarkers() {
		setAllMap(null);
		markers = [];
	}

	function setInput( nombre, lat, lng ){
	    /*
	        - recibimos el nombre del input donde se va a poner los datos.
	        - recibimos la latitud y longitud.
	    */
	    opciones = {
	        mapa : [map.center.lat(), map.center.lng()],  
	        tipo : map.mapTypeId,
	        zoom : map.zoom,
	        marcador : {
	            mapa : [lat, lng]
	        }
	    };
	    $("#"+nombre).val(JSON.stringify(opciones)); //guardamos el json en formato string
	}


    setTimeout(function(){
        initialize(); //cargamos el mapa.
    }, 2000);
};
