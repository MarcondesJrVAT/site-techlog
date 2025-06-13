(function($) {

    "use strict";
    google.maps.event.addDomListener(window, 'load', init);

    function init() {}

    var myLatlng = new google.maps.LatLng(-3.108208,-60.0351885);
    var locationArray = [myLatlng];
    var locationNameArray = ['myLatlng'];
    var GALL_PETERS_RANGE_X = 800;
    var GALL_PETERS_RANGE_Y = 510;

    function degreesToRadians(deg) {
        return deg * (Math.PI / 180);
    }

    function radiansToDegrees(rad) {
        return rad / (Math.PI / 180);
    }
    /**
			 * @constructor
			 * @implements {google.maps.Projection}
			 */
    function GallPetersProjection() {
        // Using the base map tile, denote the lat/lon of the equatorial origin.
        this.worldOrigin_ = new google.maps.Point(GALL_PETERS_RANGE_X * 400 / 800,GALL_PETERS_RANGE_Y / 2);
        // This projection has equidistant meridians, so each longitude degree is a linear
        // mapping.
        this.worldCoordinatePerLonDegree_ = GALL_PETERS_RANGE_X / 360;
        // This constant merely reflects that latitudes vary from +90 to -90 degrees.
        this.worldCoordinateLatRange = GALL_PETERS_RANGE_Y / 2;
    }

    GallPetersProjection.prototype.fromLatLngToPoint = function(latLng) {
        var origin = this.worldOrigin_;
        var x = origin.x + this.worldCoordinatePerLonDegree_ * latLng.lng();
        // Note that latitude is measured from the world coordinate origin
        // at the top left of the map.
        var latRadians = degreesToRadians(latLng.lat());
        var y = origin.y - this.worldCoordinateLatRange * Math.sin(latRadians);
        return new google.maps.Point(x,y);
    }

    GallPetersProjection.prototype.fromPointToLatLng = function(point, noWrap) {
        var y = point.y;
        var x = point.x;
        if (y < 0) {
            y = 0;
        }
        if (y >= GALL_PETERS_RANGE_Y) {
            y = GALL_PETERS_RANGE_Y;
        }
        var origin = this.worldOrigin_;
        var lng = (x - origin.x) / this.worldCoordinatePerLonDegree_;
        var latRadians = Math.asin((origin.y - y) / this.worldCoordinateLatRange);
        var lat = radiansToDegrees(latRadians);
        return new google.maps.LatLng(lat,lng,noWrap);
    }

    function initialize() {
        var gallPetersMap;
        var gallPetersMapType = new google.maps.ImageMapType({
            getTileUrl: function(coord, zoom) {
                var numTiles = 1 << zoom;
                // Don't wrap tiles vertically.
                if (coord.y < 0 || coord.y >= numTiles) {
                    return null ;
                }
                // Wrap tiles horizontally.
                var x = ((coord.x % numTiles) + numTiles) % numTiles;
                // For simplicity, we use a tileset consisting of 1 tile at zoom level 0
                // and 4 tiles at zoom level 1. Note that we set the base URL to a
                // relative directory.
                var baseURL = 'assets/images/';
                baseURL += 'gall-peters_' + zoom + '_' + x + '_' + coord.y + '.png';
                return baseURL;
            },
            tileSize: new google.maps.Size(800,512),
            isPng: true,
            minZoom: 0,
            maxZoom: 1,
            name: 'Gall-Peters'
        });

        gallPetersMapType.projection = new GallPetersProjection();
        var mapOptions = {
            zoom: 17,
            zoomControl: true,
            scrollwheel: false,
            disableDefaultUI: true,
            center: myLatlng
        };

        var mapElement = document.getElementById('map');
        var map = new google.maps.Map(mapElement,mapOptions);
        var marker = new google.maps.Marker({
            position: myLatlng,
            animation: google.maps.Animation.DROP,
            map: map,
            icon: 'assets/images/marker.png'
        });

        function toggleBounce() {
            if (marker.getAnimation() != null ) {
                marker.setAnimation(null );
            } else {
                marker.setAnimation(google.maps.Animation.BOUNCE);
            }
            if (marker1.getAnimation() != null ) {
                marker.setAnimation(null );
            } else {
                marker1.setAnimation(google.maps.Animation.BOUNCE);
            }
        }
        var contentString = '<div id="content-map">' + '<div id="siteNotice">' + '</div>' + '<h5 id="firstHeading" class="firstHeading">VAT S.A. Amazonas</h5>' + '<div id="http://csshake.surge.sh/csshake.min.css, São Jorge, Manaus - AM, CEP 69033-010' + ' </p>' + '</div>' + '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString,
            maxWidth: 350
        });
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);


})(jQuery);

//AIzaSyC7wKeRdyFcjx6XLYVoLtTGIJ5Vefz5Eew