const id = params.get("id");
console.log("Id = " + id);
if(id) {
    const donorId = document.getElementById("donor-id");
    donorId.innerHTML = id;
}

const receiverID = params.get("receiverId");
console.log("ReceiverId = " + receiverID);
if(receiverID) {
    const receiverId = document.getElementById("receiver-id");
    receiverId.innerHTML = receiverID;
}

const donorName = document.getElementById("donor-name");
const receiverName = document.getElementById("receiver-name");

if(donorName.innerHTML.length > 20) {
    var donorStr = donorName.innerHTML;
    var modifiedDonorStr = donorStr.substring(0, donorStr.length-5);
    donorName.innerHTML = donorStr.substring(0, 14) + "...(You)";
    donorName.parentElement.title = modifiedDonorStr;
}

if(receiverName.innerHTML.length > 20) {
    var receiverStr = receiverName.innerHTML;
    receiverName.innerHTML = receiverStr.substring(0, 19) + "...";
    receiverName.parentElement.title = receiverStr;
}


// const links = Array.from(document.querySelectorAll(".links-list a"));
// console.log(links[1].children[0]);
// links[0].onmouseenter = (event) => {
//     event.currentTarget.children[0].classList.remove("fa-facebook");
//     event.currentTarget.children[0].classList.add("fa-facebook-f");
// }
// links[0].onmouseleave = (event) => {
//     event.currentTarget.children[0].classList.remove("fa-facebook-f");
//     event.currentTarget.children[0].classList.add("fa-facebook");
// }

// links[1].onmouseenter = (event) => {
//     event.currentTarget.children[0].classList.remove("fa-whatsapp");
//     event.currentTarget.children[0].classList.add("fa-square-whatsapp");
// }
// links[1].onmouseleave = (event) => {
//     event.currentTarget.children[0].classList.remove("fa-square-whatsapp");
//     event.currentTarget.children[0].classList.add("fa-whatsapp");
// }

// links[2].onmouseenter = (event) => {
//     event.currentTarget.children[0].classList.remove("fa-twitter");
//     event.currentTarget.children[0].classList.add("fa-square-twitter");
// }
// links[2].onmouseleave = (event) => {
//     event.currentTarget.children[0].classList.remove("fa-square-twitter");
//     event.currentTarget.children[0].classList.add("fa-twitter");
// }

// links[3].onmouseenter = (event) => {
//     event.currentTarget.children[0].classList.remove("fa-instagram");
//     event.currentTarget.children[0].classList.add("fa-square-instagram");
// }
// links[3].onmouseleave = (event) => {
//     event.currentTarget.children[0].classList.remove("fa-square-instagram");
//     event.currentTarget.children[0].classList.add("fa-instagram");
// }