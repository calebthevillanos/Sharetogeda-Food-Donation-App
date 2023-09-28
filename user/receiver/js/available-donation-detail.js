const form = document.querySelector("#donation-detail .info-container form");

const submitBtn = document.querySelector("#donation-detail .info-container form button");
submitBtn.onclick = (e) => {
    e.preventDefault();
    const button = e.currentTarget;

    const circle = document.createElement("span");
    const diameter = Math.max(button.clientWidth, button.clientHeight);
    const radius = diameter / 2;

    circle.style.width = circle.style.height = `${diameter}px`;
    circle.style.left = `${e.clientX - (button.offsetLeft + radius)}px`;
    circle.style.top = `${e.clientY - (button.offsetTop + radius)}px`;
    circle.classList.add("ripple");
    const icon = document.createElement("i");
    icon.classList.add("fa-solid", "fa-check");
    icon.style.position = "absolute";
    icon.style.right = "20px";
    icon.style.top = "50%";
    icon.style.color = "chartreuse";
    icon.style.transform = "translateY(-50%)";
    icon.style.fontSize = "1rem";
    button.innerHTML = "Reserved";
    // button.style.color = "gold";
    button.appendChild(icon);
    
    
    // const ripple = button.getElementsByClassName("ripple")[0];
    
    // if (ripple) {
    //     ripple.remove();
    // }

    button.appendChild(circle);
    
    setTimeout(()=>{
        form.submit();
        window.parent.postMessage({target: "dashboard", origin: "available-donation-detail"}, "*");
    }, 1500);
};