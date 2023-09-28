const menuToggler = document.getElementById("menu-toggler");
const leftPane = document.getElementById("left-pane");

const settings = document.getElementById("settings");
const settingsBtn = document.getElementById("settings-btn");

/* HANDLING THE MENU TOGGLER FOR SMALLER SCREENS AND SETTING UP THE LEFT PANE FLYOUT */
menuToggler.onclick = () => {
    if(settingsBtn.classList.contains("active"))
        settingsBtn.click();

    if(menuToggler.classList.contains("active"))
    {
        menuToggler.classList.remove("active");
        leftPane.classList.remove("active");
        removeOverlay();
        removeDocListener();
    }
    else if(!menuToggler.classList.contains("active"))
    {
        menuToggler.classList.add("active");
        leftPane.classList.add("active");
        setOverlay();
        setDocListener(leftPane, menuToggler);
    }
};

/* SETTING UP THE SETTINGS FLYOUT */
settingsBtn.onclick = () => {
    if(menuToggler.classList.contains("active"))
        menuToggler.click();

    if(!settings.classList.contains("active")) {
        settings.classList.add("active");
        setTimeout(()=>{settings.style.right = "2vw"}, 500);
        setOverlay();
        setDocListener(settings, settingsBtn);
    }
    else {  
        settings.style.right = "-30%";
        setTimeout(()=>{
            settings.classList.remove("active");
        }, 500);
        removeOverlay();
        removeDocListener();
    }
}

/* SETTING AND REMOVING DOCUMENT LISTENER FOR THE FLYOUTS */

function setDocListener(element, elementBtn) {
    document.onclick = (e) => {
        let targetElement = e.target;

        while(targetElement) {
            if(targetElement === element || targetElement === elementBtn)
                return;
            targetElement = targetElement.parentElement;
        }

        
        if(element === settings) {
            element.style.right = "-30%";
            setTimeout(()=>{
                element.classList.remove("active");
                elementBtn.classList.remove("active");
            }, 500);
        }
        else {
            element.classList.remove("active");
            elementBtn.classList.remove("active");
        }

        removeOverlay();
        removeDocListener();
    };
}

function removeDocListener() {
    document.onclick = null;
}

function setOverlay() {
    const overlay = document.getElementById("overlay");
    if(overlay)
        overlay.style.display = "block";
}

function removeOverlay() {
    const overlay = document.getElementById("overlay");
    if(overlay)
        overlay.style.display = "none";
}