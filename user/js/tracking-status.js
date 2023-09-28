document.addEventListener("DOMContentLoaded", () => {

    /* BODY IS HIDDEN, MAKE ANY INTERFACE CHANGES THAT YOU WANT TO MAKE HERE BEFORE THE BODY IS SHOWN */

    const params = new URLSearchParams(window.location.search);
    const trackDonation = document.querySelector("#track-location a");
    const donationStatus = params.get("status");
    console.log(donationStatus);
    if(donationStatus !== "Pending")
        trackDonation.style.display = "none";

    const images = document.querySelectorAll(".gallery img");
    if(images.length > 0)
        document.getElementById("no-documentation").style.display = "none";

    /* SHOW BODY ******************/

    const body = document.querySelector("body");
    body.style.display = "initial";

    /* BODY IS SHOWN, SET EVENT LISTENERS HERE **************/
    
});