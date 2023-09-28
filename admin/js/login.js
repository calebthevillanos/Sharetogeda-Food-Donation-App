const inputArr = Array.from(document.querySelectorAll(".entry .input input"))
inputArr.forEach((input) => {
    input.onfocus = () => {
        changeColor(input.parentElement, "#3C59F4");
    }
    input.onblur = () => {
        changeColor(input.parentElement, "#CCC");
    }
    input.parentElement.onmouseenter = () => {
        if(input !== document.activeElement)
            changeColor(input.parentElement, "#000");
    }
    input.parentElement.onmouseleave = () => {
        if(input !== document.activeElement)
            changeColor(input.parentElement, "#CCC");
    }
})

const changeColor = (input, color) => {
    input.style.borderColor = color;
}