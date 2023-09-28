let pendingReceipts = [];
let successfulReceipts = [];
let incompleteReceipts = [];
let cancelledReceipts = [];
let totalReceipts = Array.from(document.querySelectorAll("table tr:not(#header):not(#no-results)"));

let noRecords = document.getElementById("no-records");
if(noRecords.classList.contains("active"))
    noRecords.classList.remove("active");

const params = new URLSearchParams(window.location.search);
const type = params.get("type");

if(type) {
    switch(type) {
        case "pending":
            totalReceipts.forEach(row => {
                if(row.children[2]) {
                    if(!(row.children[2].innerHTML === "Pending"))
                        row.style.display = "none";
                    else
                        pendingReceipts.push(row);
                }
            }); 
            document.querySelector(".title").innerHTML = "Pending Receipts";
            console.log(pendingReceipts);
            if(pendingReceipts.length === 0)
                noRecords.classList.add("active");
            break;
        
        case "successful":
            totalReceipts.forEach(row => {
                if(row.children[2]) {
                    if(!(row.children[2].innerHTML === "Completed"))
                        row.style.display = "none";
                    else
                        successfulReceipts.push(row);
                }
            });
            document.querySelector(".title").innerHTML = "Successful Receipts";
            if(successfulReceipts.length === 0)
                noRecords.classList.add("active");
            break;

        case "incomplete":
            totalReceipts.forEach(row => {
                if(row.children[2]) {
                    console.log(row.children[2]);
                    if(!(row.children[2].innerHTML === "Incomplete"))
                        row.style.display = "none";
                    else
                        incompleteReceipts.push(row);
                }
            });
            document.querySelector(".title").innerHTML = "Incomplete Receipts";
            if(incompleteReceipts.length === 0)
                noRecords.classList.add("active");
            break;
            
        case "cancelled":
            totalReceipts.forEach(row => {
                if(row.children[2]) {
                    if(!(row.children[2].innerHTML === "Cancelled"))
                        row.style.display = "none";
                    else
                        cancelledReceipts.push(row);
                }
            });
            document.querySelector(".title").innerHTML = "Cancelled Receipts";
            if(cancelledReceipts.length === 0)
                noRecords.classList.add("active");
            break;

        case "total":
            document.querySelector(".title").innerHTML = "Total Receipts";
            if(totalReceipts.length === 0)
                noRecords.classList.add("active");
            break;
    }
}