class Switch {
    static dashboard = document.getElementById("dashboard");
    static btnArray = Array.from(document.getElementsByClassName("action-btn"));
    static elementArray = Array.from(document.querySelectorAll("#right-pane main > .content"));

    
    static switchToDashboard() {
        switchActive(this.elementArray[0], this.btnArray[0], this.elementArray, this.btnArray);
    }

    static switchToDonations() {
        switchActive(this.elementArray[1], this.btnArray[1], this.elementArray, this.btnArray);
        //removeActiveExcept(document.getElementById("donation-history"), document.querySelectorAll("#donations .table-item"));

        let totalDonations = Array.from(document.querySelectorAll("#donations #donation-history table tr:not(#header)"));
        totalDonations.forEach(row => {
            row.style.display = "table-row";
            document.querySelector("#donations #donation-history .top-info > h2").innerHTML = "Donations Table";
        });
        
        Switch.resetDonationBackArrow();
    }

    static activateDonationBackArrow() {
        let backArrow = this.elementArray[1].children[0].children[0].children[1];
        backArrow.classList.remove("not-active");
        backArrow.onclick = () => {
            this.switchToDashboard();
        }
    }

    static resetDonationBackArrow() {
        let backArrow = this.elementArray[1].children[0].children[0].children[1];
        backArrow.classList.add("not-active");
    }

    static switchToDonors() {
        switchActive(this.elementArray[2], this.btnArray[2], this.elementArray, this.btnArray);
        removeActiveExcept(document.getElementById("donor-table"), document.querySelectorAll("#donors .table-item"));
        handleAddresses("donor");
        handleEmails("donor");
        handleNames("donor");
        

        let totalDonors = Array.from(document.querySelectorAll("#donors #donor-table table tr:not(#header)"));
        totalDonors.forEach(row => {
            row.style.display = "table-row";
            document.querySelector("#donors #donor-table .top-info > h2").innerHTML = "Donors Table";
        });
        
        Switch.resetDonorsBackArrow();
    }

    static activateDonorsBackArrow() {
        let backArrow = this.elementArray[2].children[0].children[0].children[1];
        backArrow.classList.remove("not-active");
        backArrow.onclick = () => {
            this.switchToDashboard();
        }
    }

    static resetDonorsBackArrow() {
        let backArrow = this.elementArray[2].children[0].children[0].children[1];
        backArrow.classList.add("not-active");
    }

    static switchToReceivers() {
        switchActive(this.elementArray[3], this.btnArray[3], this.elementArray, this.btnArray);
        removeActiveExcept(document.getElementById("receiver-table"), document.querySelectorAll("#receivers .table-item"));
        handleAddresses("receiver");
        handleEmails("receiver");
        handleNames("receiver");

        let totalReceivers = Array.from(document.querySelectorAll("#receivers #receiver-table table tr:not(#header)"));
        totalReceivers.forEach(row => {
            row.style.display = "table-row";
            document.querySelector("#receivers #receiver-table .top-info > h2").innerHTML = "Receivers Table";
        });
        
        Switch.resetReceiversBackArrow();
    }

    static activateReceiversBackArrow() {
        let backArrow = this.elementArray[3].children[0].children[0].children[1];
        backArrow.classList.remove("not-active");
        backArrow.onclick = () => {
            this.switchToDashboard();
        }
    }

    static resetReceiversBackArrow() {
        let backArrow = this.elementArray[3].children[0].children[0].children[1];
        backArrow.classList.add("not-active");
    }
}
const clickHandler = (e) => {
    const dashboard = Switch.dashboard;

    const btnArray = Switch.btnArray;

    const elementArray = Switch.elementArray;

    if(e.target === btnArray[0]) {
        Switch.switchToDashboard();
    }
    else if(e.target === btnArray[1]) {
        Switch.switchToDonations();
    }
    else if(e.target === btnArray[2]) {
        Switch.switchToDonors();
    }
    else if(e.target === btnArray[3]) {
        Switch.switchToReceivers();
    }
}

const toggleActive = (element, elementBtn, except=null) => {
    if(element.classList.contains("active") || elementBtn.classList.contains("active")) {
        element.classList.remove("active");
        elementBtn.classList.remove("active");
        if(except)
            except.classList.add("active");
        return;
    }
    element.classList.add("active");
    elementBtn.classList.add("active");
    except.classList.remove("active");
}

const switchActive = (element, elementBtn, elementArr, elementBtnArr, except=null) => {
    element.classList.add("active");
    elementBtn.classList.add("active");
    if(except)
        except.classList.remove("active");

    for(let e of elementBtnArr) {
        if(e !== elementBtn && e.classList.contains("active"))
            e.classList.remove("active");
    }

    for(let e of elementArr) {
        if(e !== element && e.classList.contains("active"))
            e.classList.remove("active");
    }
}

const handleAddresses = (type) => {
    const addresses = Array.from(document.querySelectorAll("#" + type + "-table .address"));
    addresses.forEach((address) => {
        if(address.innerHTML.length >= 10) {
            if(!address.innerHTML.includes("...")) {
                let addressStr = address.innerHTML;
                address.innerHTML = addressStr.substring(0, 14) + "...";
                address.title = addressStr;
            }
        }
    });
}

const handleEmails = (type) => {
    const emails = Array.from(document.querySelectorAll("#" + type + "-table .email"));
    emails.forEach((email) => {
        if(email.innerHTML.length >= 15) {
            if(!email.innerHTML.includes("...")) {
                let emailStr = email.innerHTML;
                email.innerHTML = emailStr.substring(0, 14) + "...";
                email.title = emailStr;
            }
        }
    });
}

const handleNames = (type) => {
    const names = Array.from(document.querySelectorAll("#" + type + "-table .donor-name"));
    names.forEach((name) => {
        if(name.innerHTML.length >= 15) {
            if(!name.innerHTML.includes("...")) {
                let nameStr = name.innerHTML;
                name.innerHTML = nameStr.substring(0, 14) + "...";
                name.title = nameStr;
            }
        }
    });
}

let newDonations = []
let incompleteDonations = [];
let successfulDonations = [];
let totalDonations = Array.from(document.querySelectorAll("#donations #donation-history table tr:not(#header)"));
const arrows = Array.from(document.querySelectorAll(".fa-angles-right"));
arrows[0].onclick = () => {
    Switch.switchToDonations();
    Switch.activateDonationBackArrow();
    totalDonations.forEach(row => {
        if(row.children[2].innerHTML === "New")
            newDonations.push(row);
        else
            row.style.display = "none";
        document.querySelector("#donations #donation-history .top-info > h2").innerHTML = "New Donations";
    });
}
arrows[1].onclick = () => {
    Switch.switchToDonations();
    Switch.activateDonationBackArrow();
    totalDonations.forEach(row => {
        if(row.children[2].innerHTML === "Pending")
            incompleteDonations.push(row);
        else
            row.style.display = "none";
        document.querySelector("#donations #donation-history .top-info > h2").innerHTML = "Incomplete Donations";
    });
}
arrows[2].onclick = () => {
    Switch.switchToDonations();
    Switch.activateDonationBackArrow();
    totalDonations.forEach(row => {
        if(row.children[2].innerHTML === "Completed") {
            incompleteDonations.push(row);
        }
        else
            row.style.display = "none";
        document.querySelector("#donations #donation-history .top-info > h2").innerHTML = "Successful Donations";
    });
}
arrows[3].onclick = () => {
    Switch.switchToDonations();
    Switch.activateDonationBackArrow();
    document.querySelector("#donations #donation-history .top-info > h2").innerHTML = "Total Donations";
}
arrows[4].onclick = () => {
    Switch.switchToDonors();
    Switch.activateDonorsBackArrow();
    document.querySelector("#donors #donor-table .top-info > h2").innerHTML = "Total Reg. Donors";
}
// arrows[5].onclick = () => {
//     Switch.switchToReceivers();
//     Switch.activateReceiversBackArrow();
//     document.querySelector("#receivers #receiver-table .top-info > h2").innerHTML = "Total Reg. Receivers";
// }








/* HANDLING THE BUTTONS THAT CHANGE THE PAGES FOR DONATION CATEGORY! */

const viewDetail = Array.from(document.querySelectorAll("#donation-history .view-detail button"));
viewDetail.forEach((button) => {
    const row = button.parentElement.parentElement.parentElement;
    button.onclick = () => {
        var donorId, donorName, receiverId, receiverName, donationStatus;
        
        Array.from(row.children).forEach((rowChild) => {
            if(rowChild.classList.contains("donation-id"))
            donorId = rowChild;
            else if(rowChild.classList.contains("receiver-id"))
            receiverId = rowChild;
            else if(rowChild.classList.contains("status"))
            donationStatus = rowChild;
        })

        // viewDetailFn(donorId, donorName, receiverId, receiverName, donationStatus);

        viewDetailFn(donorId, "John Doe", receiverId, "Mary Ann", donationStatus);
    }
});

const trackStatus = document.querySelector("#history-detail #items #status .track-status");
trackStatus.onclick = trackStatusFn;

const trackLocation = document.querySelector("#track-status .track-location");
trackLocation.onclick = trackLocationFn;

function viewDetailFn(donorId, donorName, receiverId, receiverName, donationStatus) {
    if((donorId && donorId.innerHTML !== "NIL") && (donorName && donorName !== "NIL")) {
        document.querySelector("#history-detail #info-container #donor-id .user-id").innerHTML = donorId.innerHTML + " - Click for more info";
        document.querySelector("#history-detail #info-container #donor-name span").innerHTML = donorName;
    }
    else {
        document.querySelector("#history-detail #info-container #donor-id .user-id").innerHTML = "NIL";
        document.querySelector("#history-detail #info-container #donor-name span").innerHTML = "NIL";
    }


    if((receiverId && receiverId.innerHTML !== "NIL") && (receiverName && receiverName !== "NIL")) {
        if(!document.querySelector("#history-detail #info-container #receiver-id .user-id")) {
            document.querySelector("#history-detail #info-container #receiver-id span").classList.add("user-id");
        }
        document.querySelector("#history-detail #info-container #receiver-id .user-id").innerHTML = receiverId.innerHTML + " - Click for more info";
        document.querySelector("#history-detail #info-container #receiver-name span").innerHTML =  receiverName;
    }
    else {
        document.querySelector("#history-detail #info-container #receiver-id .user-id").innerHTML = "NIL";
        document.querySelector("#history-detail #info-container #receiver-id .user-id").classList.remove("user-id");
        document.querySelector("#history-detail #info-container #receiver-name span").innerHTML =  "NIL";
    }

    document.querySelector("#history-detail #info-container #status span").innerHTML = donationStatus && donationStatus.innerHTML !== "NIL" ? donationStatus.innerHTML : "NIL";

    if(donationStatus.innerHTML === "New" || donationStatus.innerHTML === "Cancelled")
        document.querySelector("#history-detail #info-container #status span").nextElementSibling.style.display = "none";
    else
        document.querySelector("#history-detail #info-container #status span").nextElementSibling.style.display = "block";

    let table = document.getElementById("history-detail");
    let tables = Array.from(document.querySelectorAll("#donations .table-item"));
    
    removeActiveExcept(table, tables);
}

const userID = Array.from(document.querySelectorAll("#history-detail #info-container .user-id"));
userID.forEach((user) => {
    user.onclick = () => {
        if(user.parentElement.id.includes("donor")) {

            
            Switch.switchToDonors();

            let userName = user.parentElement.nextElementSibling.children[1].innerHTML;
            let email = userName.replace(" ", "").toLowerCase() + "@gmail.com";
            viewDonorDetail_Fn(user.innerHTML.replace(" - Click for more info", ""), userName, email, "2023-09-03 10:46");
        }
        else if(user.parentElement.id.includes("receiver")) {


            Switch.switchToReceivers();

            let userName = user.parentElement.nextElementSibling.children[1].innerHTML;
            let email = userName.replace(" ", "").toLowerCase() + "@gmail.com";
            viewReceiverDetail_Fn(user.innerHTML.replace(" - Click for more info", ""), userName, email, "2023-09-03 10:46");
        }
    }
})


function trackStatusFn(donationId, donorId, receiverId, donationStatus) {
    let table = document.getElementById("track-status");
    let tables = Array.from(document.querySelectorAll("#donations .table-item"));
    
    removeActiveExcept(table, tables);
}

function trackLocationFn(donationId, donorId, receiverId, donationStatus) {
    let table = document.getElementById("track-location");
    let tables = Array.from(document.querySelectorAll("#donations .table-item"));
    
    removeActiveExcept(table, tables);
}


const markComplete = (event) => {
    let element = event.target;
    
    if(element.nodeName === "I")
    element = element.parentElement.parentElement;
    else if(element.nodeName === "BUTTON")
    element = element.parentElement;
    
    let statusAncestor = element.parentElement;
    let prevAncestor = statusAncestor.parentElement.previousElementSibling.children[1];
    while (prevAncestor) {
        
        if(!prevAncestor.classList.contains("complete"));
        doMark(prevAncestor.children[2]);
        
        if(prevAncestor.parentElement.previousElementSibling)
        prevAncestor = prevAncestor.parentElement.previousElementSibling.children[1];
        else
        prevAncestor = null;
    }
    
    doMark(element);
    
    function doMark(element) {
        element.previousElementSibling.previousElementSibling.innerHTML = "Completed";
        element.previousElementSibling.classList.remove("fa-solid");
        element.previousElementSibling.classList.remove("fa-spinner");
        element.previousElementSibling.classList.remove("fa-spin-pulse");
        element.previousElementSibling.classList.add("fa-regular"); 
        element.previousElementSibling.classList.add("fa-circle-check");
        element.classList.remove("active");
        element.parentElement.classList.add("complete");
    }
}




/* HANDLING THE BUTTONS THAT CHANGE THE PAGES FOR DONORS CATEGORY! */


const viewDonorDetail = Array.from(document.querySelectorAll("#donor-table .view-detail button"));
viewDonorDetail.forEach((button) => {
    const row = button.parentElement.parentElement.parentElement;
    button.onclick = () => {
        var donorId, donorName, email, dateJoined;
        
        Array.from(row.children).forEach((rowChild) => {
            if(rowChild.classList.contains("donor-id"))
                donorId = rowChild;
            else if(rowChild.classList.contains("donor-name"))
                donorName = rowChild;
            else if(rowChild.classList.contains("email"))
                email = rowChild;
        })

        if(button.parentElement.previousElementSibling.classList.contains("date-joined"))
            dateJoined = button.parentElement.previousElementSibling;
        
        viewDonorDetailFn(donorId, donorName, email, dateJoined);
    }
});

function viewDonorDetailFn(donorId, donorName, email, dateJoined) {
    viewDonorDetail_Fn(donorId.innerHTML, donorName.innerHTML, email.innerHTML.includes("...") ? email.title : email.innerHTML, dateJoined.innerHTML);
}

function viewDonorDetail_Fn(donorId, donorName, email, dateJoined) {
    
    let table = document.getElementById("donor-detail");
    let tables = Array.from(document.querySelectorAll("#donors .table-item"));
    
    removeActiveExcept(table, tables);
    
    document.querySelector("#donor-detail #donor-id-input").value = donorId;
    document.querySelector("#donor-detail #donor-name-input").value = donorName;
    document.querySelector("#donor-detail #donor-email-input").value = email;
    document.querySelector("#donor-detail #donor-date-joined-input").value = dateJoined;
}


/* HANDLING THE BUTTONS THAT CHANGE THE PAGES FOR RECEIVERS CATEGORY! */


const viewReceiverDetail = Array.from(document.querySelectorAll("#receiver-table .view-detail button"));
viewReceiverDetail.forEach((button) => {
    const row = button.parentElement.parentElement.parentElement;
    button.onclick = () => {
        var receiverId, receiverName, email, dateJoined;
        
        Array.from(row.children).forEach((rowChild) => {
            if(rowChild.classList.contains("receiver-id"))
                receiverId = rowChild;
            else if(rowChild.classList.contains("receiver-name"))
                receiverName = rowChild;
            else if(rowChild.classList.contains("email"))
                email = rowChild;
        })

        if(button.parentElement.previousElementSibling.classList.contains("date-joined"))
            dateJoined = button.parentElement.previousElementSibling;
        
        viewReceiverDetailFn(receiverId, receiverName, email, dateJoined);
    }
});

function viewReceiverDetailFn(receiverId, receiverName, email, dateJoined) {
    viewReceiverDetail_Fn(receiverId.innerHTML, receiverName.innerHTML, email.innerHTML.includes("...") ? email.title : email.innerHTML, dateJoined.innerHTML);
}

function viewReceiverDetail_Fn(receiverId, receiverName, email, dateJoined) {
    let table = document.getElementById("receiver-detail");
    let tables = Array.from(document.querySelectorAll("#receivers .table-item"));
    
    removeActiveExcept(table, tables);
    
    document.querySelector("#receiver-detail #receiver-id-input").value = receiverId;
    document.querySelector("#receiver-detail #receiver-name-input").value = receiverName;
    document.querySelector("#receiver-detail #receiver-email-input").value = email;
    document.querySelector("#receiver-detail #receiver-date-joined-input").value = dateJoined;
}







const removeActiveExcept = (element, array) => {
    for(i = 0; i < array.length; i++) {
        array[i] == element ? array[i].classList.add("active") : array[i].classList.remove("active");
    }
}