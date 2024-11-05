jQuery(function ($) {
    let map, marker, address, latlng,
        mapContainer = $('.map-container'),
        locationField = mapContainer.find('.tfre-map-location-field'),
        addressField = mapContainer.find('.tfre-map-address-field input'),
        fullAddressFieldProperty = $('#property_address'),
        fullAddressFieldAgency = $('#agency_address');

    function runMapBox() {
        mapboxgl.accessToken = map_box_variables.api_key_map_box;

        map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/'+map_box_variables.map_box_style,
            center: [-122.25948, 37.87221], // Starting position [lng, lat]
            zoom: map_box_variables.map_zoom,
            draggable: true,
            pitchWithRotate: false,
            projection: 'equirectangular'
        });

        // Create custom marker
        const el = document.createElement('div');
        el.className = 'marker';
        el.style.backgroundImage = `url(${map_box_variables.default_marker_image ? map_box_variables.default_marker_image :
            map_box_variables.plugin_url + 'public/assets/image/map/map-marker.png'})`;
        el.style.width = map_box_variables.marker_image_width;
        el.style.height = map_box_variables.marker_image_height;
        el.style.backgroundSize = '100%';
        el.style.backgroundRepeat= 'no-repeat';
        // Initialize the marker
        marker = new mapboxgl.Marker({ element: el, draggable: true });

        const geocoder = new MapboxGeocoder({
            // Initialize the geocoder
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl,
            marker: false, // Do not use the default marker style
            placeholder: 'Search',
        });

        // Add the geocoder to the map
        map.addControl(geocoder);

        map.on('load', () => {
            map.loadImage(
                map_box_variables.default_marker_image ? map_box_variables.default_marker_image :
                    map_box_variables.plugin_url + 'public/assets/image/map/map-marker.png',
                (error, image) => {
                    if (error) throw error;
                    map.addImage('custom-marker', image);
                });

            map.addSource('single-property', {
                'type': 'geojson',
                'data': {
                    'type': 'FeatureCollection',
                    'features': []
                }
            });

            map.addLayer({
                'id': 'point',
                'source': 'single-property',
                'type': 'symbol',
                'layout': {
                    'icon-image': 'custom-marker',
                    'icon-size': 0.25
                }
            });

            // Listen for the `result` event from the Geocoder 
            // `result` event is triggered when a user makes a selection
            //  Add a marker at the result's coordinates
            geocoder.on('result', (event) => {
                marker.setLngLat(event.result.geometry.coordinates).addTo(map);
                locationField.val(event.result.geometry.coordinates[1] + ',' + event.result.geometry.coordinates[0]);
                addressField.val(event.result.place_name);
                fullAddressFieldProperty.val(event.result.place_name);
                fullAddressFieldAgency.val(event.result.place_name);
            });
        });

        function onDragEnd() {
            const lngLat = marker.getLngLat();
            marker.setLngLat(lngLat).addTo(map);
            $.ajax({
                type: "GET",
                url: "https://api.mapbox.com/geocoding/v5/mapbox.places/" + lngLat.lng + "," + lngLat.lat + ".json?access_token=" + mapboxgl.accessToken,
                success: function (res) {
                    locationField.val(lngLat.lat + ',' + lngLat.lng);
                    addressField.val(res.features[0].place_name);
                    fullAddressFieldProperty.val(res.features[0].place_name);
                    fullAddressFieldAgency.val(res.features[0].place_name);
                }
            });
        }

        marker.on('dragend', onDragEnd);

        if (locationField.length && locationField.val() !== '') {
            latlng = locationField.val();
            if (latlng) {
                latlng = latlng.split(',');
                map.flyTo({
                    center: [latlng[1],latlng[0]],
                    zoom: map_box_variables.map_zoom,
                    pitch: 45,
                    bearing: 0,
                    essential: true,
                    duration: 3000,
                    speed: 1,
                });
                marker.setLngLat([latlng[1],latlng[0]]).addTo(map);
            }
        }
    }

    if (fullAddressFieldProperty.length) {
        $('.ui-tabs .ui-tabs-nav li[aria-controls="location-map"]').click(function () {
            runMapBox();
        })
    }
    if (fullAddressFieldAgency.length) {
        runMapBox();
    }
});