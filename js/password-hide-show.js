/* USING IDS FOR JUST ONE PASSWORD INPUT */

const id = "eye-icon";
const passwordId = "password";

const eyeIcon = document.getElementById(id);
const passwordInput = document.getElementById(passwordId);

if(eyeIcon !== null) {
    eyeIcon.onclick = (e) => {
        element = e.target;
        if(element.classList.contains("fa-eye")) {
            element.classList.remove("fa-eye");
            element.classList.add("fa-eye-slash");
            passwordInput.type = "password";
        }
        else {
            element.classList.add("fa-eye");
            element.classList.remove("fa-eye-slash");
            passwordInput.type = "text";
        }
    }
}


/* USING CLASSES FOR MORE THAN ONE PASSWORD INPUTS. JUST MAKE SURE THEY'RE IN THE RIGHT ORDER..
    FOR EXAMPLE, THE FIRST ELEMENT WITH EYE-ICON CLASS SHOULD USED WITH THE FIRST ELEMENT WITH 
    PASSWORD CLASS */

const classes = "eye-icon";
const passwordClasses = "password";

const eyeIconArr = Array.from(document.getElementsByClassName(classes));
const passwordInputArr = Array.from(document.getElementsByClassName(passwordClasses));

eyeIconArr.forEach((element) => {
    if(element !== null) {
        element.onclick = (e) => {
            let index = eyeIconArr.indexOf(e.target);
            console.log(eyeIconArr[index] + " has been clicked.");
            if(element.classList.contains("fa-eye")) {
                element.classList.remove("fa-eye");
                element.classList.add("fa-eye-slash");
                passwordInputArr[index].type = "password";
            }
            else if(element.classList.contains("fa-eye-slash")) {
                element.classList.add("fa-eye");
                element.classList.remove("fa-eye-slash");
                passwordInputArr[index].type = "text";
            }
        }
    }
})

