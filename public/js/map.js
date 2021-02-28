let inputLocation = document.getElementById('location');
let inputLong = document.getElementById('long');
let inputLat = document.getElementById('lat');
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(position => { 
        localCoord = position.coords;
        objLocalCoord = {
            lat: localCoord.latitude,
            lng: localCoord.longitude,
        }


        // Initialize the platform object:
        let platform = new H.service.Platform({
            'apikey': window.hereApiKey
        });

        reverseGeocode(platform);


        // Obtain the default map types from the platform object
        let defaultLayers = platform.createDefaultLayers();

        // Instantiate (and display) a map object:
        let map = new H.Map(
            document.getElementById('map'),
            defaultLayers.vector.normal.map,
            {
                zoom: 14,
                center: objLocalCoord,
                pixelRatio: window.devicePixelRatio || 1

            });
            window.addEventListener('resize', () => map.getViewPort().resize());


        let ui = H.ui.UI.createDefault(map, defaultLayers);
        let mapEvents = new H.mapevents.MapEvents(map);
        let behavior = new H.mapevents.Behavior(mapEvents);
        
        // create marker 
        marker = new H.map.Marker(objLocalCoord);
        map.addObject(marker);

        function reverseGeocode(platform) {
            var geocoder = platform.getSearchService(),
                reverseGeocodingParameters = {
                  at: `${objLocalCoord.lat},${objLocalCoord.lng}`, 
                  limit: '1'
                };
            geocoder.reverseGeocode(
              reverseGeocodingParameters,
              onSuccess,
              onError
            );
        }

        function onSuccess(result) {
            let locations = result.items;
            let locationLabel = locations[0].address.label;
            // console.log(locations);

            inputLocation.value = locationLabel;
            inputLat.value = locations[0].position.lat;
            inputLong.value = locations[0].position.lng;
          
        }
          
        /**
         * This function will be called if a communication error occurs during the JSON-P request
         * @param  {Object} error  The error message received.
         */
        function onError(error) {
            alert('Can\'t reach the remote server');
        }


    });

}else{
    alert("Geolocation is not supported by this browser");
}
