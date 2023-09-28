const id = params.get("id");
console.log("Id = " + id);
if(id) {
    const donorId = document.getElementById("donor-id");
    donorId.innerHTML = id;
}

const donorID = params.get("receiverId");
console.log("ReceiverId = " + donorID);
if(donorID) {
    const receiverId = document.getElementById("receiver-id");
    receiverId.innerHTML = donorID;
}

const donorName = document.getElementById("donor-name");
const receiverName = document.getElementById("receiver-name");

if(donorName.innerHTML.length > 20) {
    var donorStr = donorName.innerHTML;
    var modifiedDonorStr = donorStr.substring(0, donorStr.length-5);
    donorName.innerHTML = donorStr.substring(0, 19) + "...";
    donorName.parentElement.title = modifiedDonorStr;
}

if(receiverName.innerHTML.length > 20) {
    var receiverStr = receiverName.innerHTML;
    receiverName.innerHTML = receiverStr.substring(0, 14) + "...(You)";
    receiverName.parentElement.title = receiverStr;
}