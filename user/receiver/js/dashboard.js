let totalReceipts = Array.from(document.querySelectorAll("table tr:not(#header)"));
const arrows = Array.from(document.querySelectorAll(".fa-angles-right"));
arrows[0].onclick = () => {
    window.parent.postMessage({message: "history", origin: "receiver"}, "*");
    window.location.assign("receipt-history.html?type=pending");
}
arrows[1].onclick = () => {
    window.parent.postMessage({message: "history", origin: "receiver"}, "*");
    window.location.assign("receipt-history.html?type=successful");
}
arrows[2].onclick = () => {
    window.parent.postMessage({message: "history", origin: "receiver"}, "*");
    window.location.assign("receipt-history.html?type=incomplete");
}
arrows[3].onclick = () => {
    window.parent.postMessage({message: "history", origin: "receiver"}, "*");
    window.location.assign("receipt-history.html?type=cancelled");
}
arrows[4].onclick = () => {
    window.parent.postMessage({message: "history", origin: "receiver"}, "*");
    window.location.assign("receipt-history.html?type=total");
}