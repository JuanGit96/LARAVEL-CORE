function initMap() 
{

    var myLatLng = {lat: 4.6097100, lng: -74.0817500};

    /*Mostrando mapa*/
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: myLatLng
    });

    /* Mapa foto satelital
    
    var map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 18,
        mapTypeId: 'satellite'
    });
    map.setTilt(45);*/        
    
    /*Mostrando marcador */
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Hello World!'
    });

    /*Evento click en el mapa */
    google.maps.event.addListener(map,'click',function(event) {

        marker.setPosition(event.latLng);

        document.getElementById('latitud').value = event.latLng.lat();
        document.getElementById('longitud').value = event.latLng.lng();

        var geocoder = new google.maps.Geocoder();

        var yourLocation = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());

        geocoder.geocode({ 'latLng': yourLocation },function(results, status) {
            document.getElementById('address').value = results[0].formatted_address;
        });

    });

    /*Autocompletar direccion*/
    autocomplete = new google.maps.places.Autocomplete(
        (document.getElementById('address')),
        { types: ['geocode'],
            componentRestrictions:{'country': 'co'} });
    // Cuando el usuario selecciona una dirección en el menú desplegable,
    // rellena los campos de dirección en el formulario.
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();

        marker.setPosition(new google.maps.LatLng( place.geometry.location.lat(), place.geometry.location.lng()));
        map.panTo(new google.maps.LatLng( place.geometry.location.lat(), place.geometry.location.lng()));

        document.getElementById('latitud').value = place.geometry.location.lat();
        document.getElementById('longitud').value = place.geometry.location.lng();
    });


}

