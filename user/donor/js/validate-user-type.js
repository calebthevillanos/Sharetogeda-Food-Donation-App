
window.onload=function(){
    if(!sessionStorage.getItem('location')){
        getLocation();
    }
    
}

//function to very that only one user type is selected
function toggleUserType(e,id){
    e.checked = true;
    document.getElementById(id).checked = false;
}

//getting user current location
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(savePosition);
  } else {
    alert('Geolocation is not supported by this browser. Use a more recent version please !!!')
  }
}

async function savePosition(position) {
  sessionStorage.setItem('location','already collected info')
  sessionStorage.setItem("longitude", position.coords.longitude)
   sessionStorage.setItem("latitude", position.coords.latitude)
  fetch(`process.php?q=saveLongLat&longitude=${parseFloat(position.coords.longitude)}&latitude=${parseFloat(position.coords.latitude)}`)
  .then(res => {
    if(res.statusText.toLowerCase() === 'ok'){
        alert('Location saved successfully !!!')
    }
  })
  .then(data => {
    console.log("response",data)
  })
  .catch(err => console.log(err))
}