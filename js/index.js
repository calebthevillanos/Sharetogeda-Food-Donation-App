let isActive = false;
let isHovering = false;
const separator = document.querySelector(".horizontal-separator");
const linkContainer = document.querySelector("nav#navbar .primary .links");
console.log(linkContainer);
// linkContainer.onmouseenter = (e) => {
//     e.currentTarget.style.display = "flex";
//     separator.style.marginTop = "150px";
//     // separator.style.opacity = "0";
//     isHovering = true;
// }
// linkContainer.onmouseleave = (e) => {
//     if(!isActive) {
//         e.currentTarget.style.display = "none";
//         separator.style.marginTop = "20px";
//         // separator.style.opacity = "1";
//     }
//     isHovering = false;
// }

const menuBtn = document.querySelector("nav#navbar .primary .menu");
// menuBtn.onmouseenter = (e) => {
//     setTimeout(()=>{linkContainer.style.display = "flex";}, 500);
//     separator.style.marginTop = "150px";
//     // separator.style.opacity = "0";
//     isHovering = true;
// }

// menuBtn.onmouseleave = (e) => {
//     if(!isActive) {
//         linkContainer.style.display = "none";
//         separator.style.marginTop = "20px";
//         // separator.style.opacity = "1";
//         isHovering = false;
//     }
// }

menuBtn.onclick = (e) => {
    if(!isActive) {
        setTimeout(()=>{linkContainer.style.display = "flex";}, 500);
        separator.style.marginTop = "150px";
        // separator.style.opacity = "0";
        isActive = true;
    }
    else {
        // if(!isHovering) {
        //     linkContainer.style.display = "none";
        //     separator.style.marginTop = "20px";
        //     // separator.style.opacity = "1";
        // }
        linkContainer.style.display = "none";
        separator.style.marginTop = "20px";
        // separator.style.opacity = "1";
        isActive = false;
    }
}