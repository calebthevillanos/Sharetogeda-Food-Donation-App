const colors = ['#1A73E8', '#DF362A', '#FCBE0B', '#EC407A', '#7B1FA2', '#33691E'];
const randNum = Math.floor(Math.random() * 6);
const randColor = colors[randNum];
document.getElementById("user-logo").style.backgroundColor = randColor;
document.getElementById("initial").innerHTML = document.getElementById("name").innerHTML.charAt(0).toUpperCase();
document.documentElement.style.setProperty("--color", randColor);

const emailBtn = document.getElementById("email-btn");
const passwordBtn = document.getElementById("password-btn");
const changePasswordBtn = document.getElementById("change-password-btn");
const cancelPasswordBtn = document.getElementById("cancel-password-btn");

emailBtn.onclick = (e) => {
    e.preventDefault();
    const emailInput = document.getElementById("email-input");
    emailBtn.style.display = "none";
    emailInput.style.display = "initial";
    emailInput.focus();
}

passwordBtn.onclick = (e) => {
    e.preventDefault();

    document.getElementById("update-form").style.display = "none";
    document.getElementById("password-form").style.display = "block";
}

const newPasswordInput = document.getElementById("new-password-input");
const retypePasswordInput = document.getElementById("retype-password-input");
const errorMessage = document.getElementById("error-message");

const checkChange = () => {
    if(newPasswordInput.value !== retypePasswordInput.value) {
        errorMessage.innerHTML = "Retyped password doesn't match.";
        changePasswordBtn.disabled = true;
    }else {
        errorMessage.innerHTML = "";
        changePasswordBtn.disabled = false;
    }
}

newPasswordInput.oninput = checkChange;
retypePasswordInput.oninput = checkChange;

cancelPasswordBtn.onclick = (e) => {
    e.preventDefault();
    document.getElementById("update-form").style.display = "block";
    document.getElementById("password-form").style.display = "none";
}