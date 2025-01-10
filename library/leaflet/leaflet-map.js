;(function ($, window) {
    $(document).ready(function () {
        $(window).load(function () {
            leaf_map();
        });
    });

    function leaf_map() {
        var map_id = document.getElementById("map-canvas");
        if ( map_id !== null) {
            var map_key = map_id.getAttribute("data-map-key");
            var map_icon = map_id.getAttribute("data-pin-icon");
            var map_zoom = map_id.getAttribute("data-zoom");
            var map_latitude = map_id.getAttribute("data-latitude");
            var map_longitude = map_id.getAttribute("data-longitude");
            var map_address = map_id.getAttribute("data-address");

            // also use mapbox/emerald-v8/ for alternate style
            var mapquestUrl = 'https://api.mapbox.com/styles/v1/montanasteele/cjcw6p8fp14r32rpaj0kevyd1/tiles/{z}/{x}/{y}@2x?access_token=' + map_key,
                mapquest = new L.TileLayer(mapquestUrl, {
                    maxZoom: 18,
                    minZoom: 15,
                    tileSize: 512,
                    zoomOffset: -1,
                    subdomains: ['1', '2', '3', '4'],
                    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                    '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="http://mapbox.com">Mapbox</a>'
                }),
                stadium = new L.LatLng(map_latitude, map_longitude);

            leafmap = new L.Map('map-canvas', {
                    center: stadium,
                    zoom: map_zoom,
                    layers: [mapquest]
                }
            );

            var LeafIcon = L.Icon.extend({
                options: {
                    iconSize: [80, 80],
                    iconAnchor: [45, 90],
                    popupAnchor: [-3, -76]
                }
            });

            var greenIcon = new LeafIcon({
                iconUrl: map_icon
            });

            L.marker([map_latitude, map_longitude], {icon: greenIcon}).addTo(leafmap);
            L.marker([map_latitude, map_longitude], {icon: greenIcon}).bindPopup(map_address).addTo(leafmap);

            leafmap.scrollWheelZoom.disable()
        }


    }
})(jQuery, window);