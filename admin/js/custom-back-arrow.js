const backArrows = Array.from(document.querySelectorAll(".table-item .back-arrow"));
backArrows.forEach(backArrow => {
    backArrow.onmouseenter = () => {
        backArrow.children[0].classList.remove("fa-regular");
        backArrow.children[0].classList.add("fa-solid");
    }
    backArrow.onmouseleave = () => {
        backArrow.children[0].classList.remove("fa-solid");
        backArrow.children[0].classList.add("fa-regular");
    }
})

const tableItems = Array.from(document.querySelectorAll(".table-item"));

for(let i = 0; i < backArrows.length-1; i++) {
    backArrows[i+1].onclick = () => {
        removeActiveExcept(tableItems[i], tableItems);
    }
}