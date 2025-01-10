;(function ($, window) {
    $(document).ready(function () {
        $(window).on('load', function(){
            google_maps();
        });
    });

    function google_maps() {

        $('.google-map').each(function () {
            var $this = $(this),
                $id = $this.attr('id'),
                $zoom = parseInt($this.attr('data-zoom')),
                $min_zoom = 13, // set the minimum zoom
                $latitude = $this.attr('data-latitude'),
                $longitude = $this.attr('data-longitude'),
                $address = $this.attr('data-address'),
                $map_type = $this.attr('data-map-type'),
                $pin_icon = $this.attr('data-pin-icon'),
                $pan_control = $this.attr('data-pan-control') === "true",
                $map_type_control = $this.attr('data-map-type-control') === "true",
                $scale_control = $this.attr('data-scale-control') === "true",
                $draggable = $this.attr('data-draggable') === "true",
                $zoom_control = $this.attr('data-zoom-control') === "true",
                $modify_coloring = $this.attr('data-modify-coloring') === "true",
                $saturation = $this.attr('data-saturation'),
                $hue = $this.attr('data-hue'),
                $lightness = $this.attr('data-lightness');


            if ($modify_coloring === true) {
                var $styles =
                    [
                        {
                            "featureType": "water",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#e9e9e9"
                                },
                                {
                                    "lightness": 17
                                }
                            ]
                        },
                        {
                            "featureType": "landscape",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#f5f5f5"
                                },
                                {
                                    "lightness": 20
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 17
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 29
                                },
                                {
                                    "weight": 0.2
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 18
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 16
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#f5f5f5"
                                },
                                {
                                    "lightness": 21
                                }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#dedede"
                                },
                                {
                                    "lightness": 21
                                }
                            ]
                        },
                        {
                            "elementType": "labels.text.stroke",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 16
                                }
                            ]
                        },
                        {
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "saturation": 36
                                },
                                {
                                    "color": "#333333"
                                },
                                {
                                    "lightness": 40
                                }
                            ]
                        },
                        {
                            "elementType": "labels.icon",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#f2f2f2"
                                },
                                {
                                    "lightness": 19
                                }
                            ]
                        },
                        {
                            "featureType": "administrative",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "color": "#fefefe"
                                },
                                {
                                    "lightness": 20
                                }
                            ]
                        },
                        {
                            "featureType": "administrative",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "color": "#fefefe"
                                },
                                {
                                    "lightness": 17
                                },
                                {
                                    "weight": 1.2
                                }
                            ]
                        }
                    ];
            }


            var map;

            function initialize() {


                var bounds = new google.maps.LatLngBounds();


                var mapOptions = {
                    zoom: $zoom,
                    minZoom: $min_zoom,
                    panControl: $pan_control,
                    zoomControl: $zoom_control,
                    mapTypeControl: $map_type_control,
                    scaleControl: $scale_control,
                    draggable: $draggable,
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId[$map_type],
                    styles: $styles
                };

                map = new google.maps.Map(document.getElementById($id), mapOptions);
                map.setTilt(45);

                // Multiple Markers

                var markers = [];
                var infoWindowContent = [];

                if ($latitude !== '' && $longitude !== '') {
                    markers[0] = [$address, $latitude, $longitude];
                    infoWindowContent[0] = [$address];
                }


                var infoWindow = new google.maps.InfoWindow(),
                    marker, i;


                for (i = 0; i < markers.length; i++) {
                    var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                    bounds.extend(position);
                    marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        title: markers[i][0],
                        icon: $pin_icon
                    });

                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                        return function () {
                            if (infoWindowContent[i][0].length > 1) {
                                infoWindow.setContent('<div class="info_content"><p>' + infoWindowContent[i][0] + '</p></div>');
                            }

                            infoWindow.open(map, marker);
                        }
                    })(marker, i));

                    map.fitBounds(bounds);

                }


                var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function (event) {
                    this.setZoom($zoom);
                });
                setTimeout(function(){google.maps.event.removeListener(boundsListener)}, 2000);


                // console.log('google map should be initialised');
            }

            //$('#show-map-button').on('click',initialize);

            initialize();
            // google.maps.event.addDomListener(window, "load", initialize);
            // $(window).load(initialize)

            function googleMapsResize() {
                //google.maps.event.trigger(map, 'resize');
                initialize();
            }

        });
    }
})(jQuery, window);
