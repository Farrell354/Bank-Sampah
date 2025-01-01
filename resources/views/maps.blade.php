<!DOCTYPE html>
<html>
<head>
    <title>Google Maps Example</title>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Google Maps API</h1>
    <div id="map"></div>

    <!-- Tambahkan Script Google Maps -->
    <script>
        function initMap() {
            var location = {lat: -7.250445, lng: 112.768845}; // Surabaya example
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: location
            });
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
    </script>
</body>
</html>
