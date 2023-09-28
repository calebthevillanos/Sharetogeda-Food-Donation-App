// const details = Array.from(document.getElementsByClassName("detail"));
// details.forEach((detail) => {
//     detail.onmouseenter = () => {
//         const children = Array.from(detail.children);
//         children.forEach((child) => {
//             if(child.classList.contains("info-detail")) {
//                 child.style.boxShadow = "0 5px 5px #C3C4C6";
//             }
//         })
//     }
//     detail.onmouseleave = () => {
//         const children = Array.from(detail.children);
//         children.forEach((child) => {
//             if(child.classList.contains("info-detail")) {
//                 child.style.boxShadow = "none";
//             }
//         })
//     }
// })

const params = new URLSearchParams(window.location.search);
const statusContent = document.getElementById("status-content");
const donationStatus = params.get("status");
console.log(donationStatus);
if(donationStatus)
    statusContent.innerHTML = donationStatus;

console.log(document.getElementById("receiver-id").innerHTML);
if(statusContent.innerHTML === "New") {
    if(statusContent.innerHTML === "Cancelled")
        statusContent.nextElementSibling.style.display = "none";
        
    document.getElementById("receiver-name").innerHTML = "NIL";
}


const trackDonation = document.querySelector("#status a");
trackDonation.onclick = (e) => {
    e.preventDefault();
    window.location.assign("tracking-status.php?status=" + donationStatus);
}