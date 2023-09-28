<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../resources/fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="css/make-donation.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <title>Make Donation</title>
</head>
<body>
<?php
      session_start();
       $name = $_SESSION["fullname"];
    //   $email = $_SESSION["donoremail"];
    //   $phone = $_SESSION["donortel"];

    //   if(empty($name))
    //   {
    //     header("Location: login")
    //   }
    ?>
    <main>
        <section id="left-side">
            <h2>Make Donation</h2>
            <form id="form" action="server/action_donation.php" enctype="multipart/form-data" method="POST">
                <div id="error" style="color: tomato;"></div>
                <div id="food-entry1" class="entry">
                    <label for="food-input1">Food Description</label>
                </div>
                <div id="quantity-entry1" class="entry">
                    <label for="quantity-input1">Name</label>
                    <div id="quantity-div1" class="input quantity">
                        <input onfocusout="validate(event)" type="text" name="foodName" id="foodName" placeholder="Food Name" required>
                        <i class="fa-solid fa-pizza-slice"></i>
                    </div>
                </div>
                <div id="quantity-entry2" class="entry">
                    <label for="quantity-input2">Quantity</label>
                    <div id="quantity-div2" class="input quantity">
                        <input type="text" name="quantity" onfocusout="validate(event)" id="quantity" min="1" placeholder="Quantity Amount" required>
                    </div>
                </div>
                <div id="food-entry2" class="entry">
                    <label for="food-input2">Expiry Date</label>
                    <div id="food-div2" class="input">
                        <input onfocusout="validate(event);" type="datetime-local" id="donordatetime" name="donordatetime" placeholder="Enter the expiry date" />
                    </div>
                </div>
                <div id="food-entry2" class="entry">
                    <label for="food-input2">Drop Off Location</label>
                    <div id="food-div2" class="input">
                        <select name="sitename" onchange="toGetSelectedSite(event)" required>
                        <?php
                          require "server/sites.php";
                         foreach($sites as $row)
                         {
                        ?>
                        <option value="<?= $row["name"]."-".$row['longitude']."-".$row['latitude'] ?>"><?= $row["name"] ?> </option>
                        <?php } ?>
                        </select>
                </div>
                <!-- <p id="address-line-1" style="text-align:center;" class="address"></p> -->
                    <button type="submit" name="submit" id="add-button" style="">
                        Donate
                    </button>

            </form>
        </section>
        
        <section id="right-side">
        <b id="distance-cal"></b>
            <!-- Google Map Here...  -->
            <div id="googleMap" style="width:100%;height:400px;margin-bottom: 3%;"></div>
        </section>
    </main>
</body>

<script>
    window.onload = () => {
        getMapInfoLatLong(1,1)
        document.getElementById("address-line-1").innerHTML = `<b>Longitude: </b>${sessionStorage.getItem("longitude")} <b>Latitude: </b>${sessionStorage.getItem("latitude")}`
    }
function myMap() {
    var latitude = parseFloat(sessionStorage.getItem("latitude"))
    var longitude = parseFloat(sessionStorage.getItem("longitude"))
    var marker = new google.maps.Marker({
    position: {latitude, longitude},
    animation:google.maps.Animation.BOUNCE
});
var mapProp= {
  center:new google.maps.LatLng(latitude? latitude : -20.2667, longitude? longitude : 57.3667),
  zoom:7,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
const myLatlng = { lat: latitude, lng: longitude };
 // Create the initial InfoWindow.
 let infoWindow = new google.maps.InfoWindow({
    content: "Click to save drop off location",
    position: myLatlng,
  });

  infoWindow.open(map);
  // Configure the click listener.
  map.addListener("click", (mapsMouseEvent) => {

    console.log("Click Position: ",mapsMouseEvent.latLng.toJSON())
    // Close the current InfoWindow.
    infoWindow.close();
    // Create a new InfoWindow.
    infoWindow = new google.maps.InfoWindow({
      position: mapsMouseEvent.latLng,
    });
    infoWindow.setContent(
      JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
    );
    infoWindow.open(map);
  });


  

marker.setMap(map);
}

window.initMap = myMap;


function getMapInfoLatLong(longitude,latitude){
    const API_KEY = "AIzaSyD972QQNhdx7-VQS75dl1pLnZyfSOrnyMY"
    const url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=-20.282268758633432,57.37767056529228&key=${API_KEY}`
    fetch(url)
    .then(res => res.json())
    .then(data => console.log("Geocoding info: ",data))
    .catch(err => console.log("Geocoding error: ",err))
}

// function to claculate distance between 2 points
function haversine_distance() {
    const obj = JSON.parse(sessionStorage.getItem("pointTwo"))
    let mk2 = {}
    let mk1 = {}

      mk2['lng'] = parseFloat(obj.lng)
      mk2['lat'] = parseFloat(obj.lat)

      mk1['lng'] = parseFloat(sessionStorage.getItem("longitude"))
      mk1['lat'] = parseFloat(sessionStorage.getItem("latitude"))

      console.log("mk1",mk1)
      console.log("mk2",mk2)


      var R = 3958.8; // Radius of the Earth in miles
      var rlat1 = mk1.lat * (Math.PI/180); // Convert degrees to radians
      var rlat2 = mk2.lat * (Math.PI/180); // Convert degrees to radians
      var difflat = rlat2-rlat1; // Radian difference (latitudes)
      var difflon = (mk2.lng - mk1.lng) * (Math.PI/180); // Radian difference (longitudes)

      var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat/2)*Math.sin(difflat/2)+Math.cos(rlat1)*Math.cos(rlat2)*Math.sin(difflon/2)*Math.sin(difflon/2)));
      return d;
}

function toGetSelectedSite(e){
    const pos = e.target.value.split("-");
    console.log("pos",pos)
    sessionStorage.setItem("pointTwo",JSON.stringify({lng: pos[1], lat: pos[pos.length-1]}))

    const dis = haversine_distance().toFixed(2);
    document.getElementById("distance-cal").innerHTML = `Distance: ${dis}m`
}



</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD972QQNhdx7-VQS75dl1pLnZyfSOrnyMY&callback=myMap"></script>

<script>
    function validate(e)
    {
        e.preventDefault()
        var error = ""
        var foodName = document.getElementById("foodName").value
        var quantity = document.getElementById("quantity").value
        var datetime = document.getElementById("donordatetime").value
        if(e.srcElement.id==="foodName")
     {
         var regexName = /^([a-zA-Z ,]+)$/
         if(!foodName.match(regexName))
          error = "Invalid food name"
          else
          error = ""
          document.getElementById("error").innerHTML = error
    }
    if(e.srcElement.id==="quantity")
    {    
    var regexQuantity = /^([0-9 ,]+)$/
    if(!quantity.match(regexQuantity))
         error = "Invalid quantity"    
         else
          error = ""
         document.getElementById("error").innerHTML = error
    }    
    if(e.srcElement.id==="donordatetime")
    {
    if(new Date(datetime) < new Date())
         error = "Expiry date is less than current date"
         else
          error = ""     
         document.getElementById("error").innerHTML = error
    }
    if(error==="" && (foodName!="" && quantity!="" && datetime!=""))
     document.getElementById("add-button").style.display=""
    }
</script>
</html>