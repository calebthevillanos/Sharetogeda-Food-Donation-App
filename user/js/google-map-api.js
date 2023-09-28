// The following example creates complex markers to indicate beaches near
// Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
// to the base of the flagpole.

// global array to store the marker object 
let markersArray = [];

function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 10,
    center: { lat: -20.280466484625542, lng: 57.39536286979589},
    });

    setMarker({ lat: -20.282378580574886, lng: 57.387723938801344}, map, "yellow-dot"); //Origin Marker
    setMarker({ lat: -20.28095960637219, lng: 57.39186526941146}, map, "truck"); //Shipping Vehicle Marker
    setMarker({ lat: -20.280466484625542, lng: 57.39536286979589}, map, "yellow-dot"); //Destination Marker
}

function setMarker(latlng, map, image) {
    // Adds markers to the map.
    let marker = new google.maps.Marker({
        map: map,
        position: latlng,
        icon: {
            url: "http://maps.google.com/mapfiles/ms/icons/" + image + ".png"
        }
    }); 

    //store the marker object drawn in global array
    markersArray.push(marker);
}

window.initMap = initMap;