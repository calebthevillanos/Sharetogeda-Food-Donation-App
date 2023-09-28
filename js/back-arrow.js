const backArrow = document.getElementById("back-arrow");
backArrow.onclick = () => {
    window.history.back();
}
backArrow.onmouseenter = () => {
    backArrow.children[0].classList.remove("fa-regular");
    backArrow.children[0].classList.add("fa-solid");
}
backArrow.onmouseleave = () => {
    backArrow.children[0].classList.remove("fa-solid");
    backArrow.children[0].classList.add("fa-regular");
}