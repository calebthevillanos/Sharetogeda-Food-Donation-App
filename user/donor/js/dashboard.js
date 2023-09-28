let totalDonations = Array.from(document.querySelectorAll("table tr:not(#header)"));
const arrows = Array.from(document.querySelectorAll(".fa-angles-right"));

console.log("Arrows size: ",arrows.length)
arrows[0].onclick = () => {
    window.parent.postMessage({message: "history", origin: "donor"}, "*");
    window.location.assign("donation-history.php?type=new");
}
arrows[1].onclick = () => {
    window.parent.postMessage({message: "history", origin: "donor"}, "*");
    window.location.assign("donation-history.php?type=pending");
}
// arrows[2].onclick = () => {
//     window.parent.postMessage({message: "history", origin: "donor"}, "*");
//     window.location.assign("donation-history.php?type=successful");
// }
// arrows[3].onclick = () => {
//     window.parent.postMessage({message: "history", origin: "donor"}, "*");
//     window.location.assign("donation-history.php?type=incomplete");
// }
// arrows[4].onclick = () => {
//     window.parent.postMessage({message: "history", origin: "donor"}, "*");
//     window.location.assign("donation-history.php?type=cancelled");
// }
// arrows[5].onclick = () => {
//     window.parent.postMessage({message: "history", origin: "donor"}, "*");
//     window.location.assign("donation-history.php?type=total");
// }