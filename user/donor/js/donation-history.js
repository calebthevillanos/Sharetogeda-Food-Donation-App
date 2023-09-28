let newDonations = [];
let pendingDonations = [];
let successfulDonations = [];
let incompleteDonations = [];
let cancelledDonations = [];
let totalDonations = Array.from(document.querySelectorAll("table tr:not(#header):not(#no-results)"));

let noRecords = document.getElementById("no-records");
if(noRecords.classList.contains("active"))
    noRecords.classList.remove("active");

const params = new URLSearchParams(window.location.search);
const type = params.get("type");

if(type) {
    switch(type) {
        case "new":
            totalDonations.forEach(row => {
                if(row.children[2]) {
                    if(!(row.children[2].innerHTML === "New"))
                        row.style.display = "none";
                    else
                        newDonations.push(row);
                }
            }); 
            document.querySelector(".title").innerHTML = "New Donations";
            console.log(newDonations);
            if(newDonations.length === 0)
                noRecords.classList.add("active");
            break;
        
        case "pending":
            totalDonations.forEach(row => {
                if(row.children[2]) {
                    if(!(row.children[2].innerHTML === "Pending"))
                        row.style.display = "none";
                    else
                        pendingDonations.push(row);
                }
            }); 
            document.querySelector(".title").innerHTML = "Pending Donations";
            console.log(pendingDonations);
            if(pendingDonations.length === 0)
                noRecords.classList.add("active");
            break;
        
        case "successful":
            totalDonations.forEach(row => {
                if(row.children[2]) {
                    if(!(row.children[2].innerHTML === "Completed"))
                        row.style.display = "none";
                    else
                        successfulDonations.push(row);
                }
            });
            document.querySelector(".title").innerHTML = "Successful Donations";
            if(successfulDonations.length === 0)
                noRecords.classList.add("active");
            break;

        case "incomplete":
            totalDonations.forEach(row => {
                if(row.children[2]) {
                    if(!(row.children[2].innerHTML === "Incomplete"))
                        row.style.display = "none";
                    else
                        incompleteDonations.push(row);
                }
            });
            document.querySelector(".title").innerHTML = "Incomplete Donations";
            if(incompleteDonations.length === 0)
                noRecords.classList.add("active");
            break;
            
        case "cancelled":
            totalDonations.forEach(row => {
                if(row.children[2]) {
                    if(!(row.children[2].innerHTML === "Cancelled"))
                        row.style.display = "none";
                    else
                        cancelledDonations.push(row);
                }
            });
            document.querySelector(".title").innerHTML = "Cancelled Donations";
            if(cancelledDonations.length === 0)
                noRecords.classList.add("active");
            break;

        case "total":
            document.querySelector(".title").innerHTML = "Total Donations";
            if(totalDonations.length === 0)
                noRecords.classList.add("active");
            break;
    }
}