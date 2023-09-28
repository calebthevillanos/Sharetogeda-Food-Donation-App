<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../resources/fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../css/track-location.css">
    <title>Track Location Details</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="../js/google-map-api.js"></script>
    </head>
<body>
    <main>
        <div class="top-info">
            <span id="back-arrow">
                <i class="fa-regular fa-circle-left"></i>
            </span>
            <h1>Track Location</h1>
        </div>

        <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3742.464787026017!2d57.392444626586446!3d-20.281019988503477!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x217c5c9f4d1c80b5%3A0x9088d2393f5f29c8!2sMiddlesex%20University%20Mauritius!5e0!3m2!1sen!2sng!4v1679964121284!5m2!1sen!2sng" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div id="legend-container">
            <h3 class="legend-title">Legends</h3>
            <div id="legends">
                <div id="shipping-destination" class="legend">
                    <img src="../../resources/images/green-dot.png" alt="">
                    <span class="content">Shipping Destination</span>
                </div>
                <div id="shipping-origin" class="legend">
                    <img src="../../resources/images/blue-dot.png" alt="">
                    <span class="content">Shipping Origin</span>
                </div>
                <div id="shipping-vehicle" class="legend">
                    <img src="../../resources/images/truck.png" alt="">
                    <span id="vehicle-content" class="content">Shipping Vehicle</span>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="../../js/back-arrow.js"></script>
<!-- <script async
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly"
  defer
></script> -->
</html>