document.getElementById("registrationForm").addEventListener("submit", function(event) {
    event.preventDefault();

    // Validate the entire form on submission
    validateUsername();
    validateEmail();
    validatePhone();
    checkPassword();
    validateConfirmPassword();

    const username = document.getElementById("username").value.trim();
    const email = document.getElementById("email").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmPassword = document.getElementById("confirmPassword").value.trim();

    if (username && email && phone && password && password === confirmPassword) {
        alert("Registration Successful!");
    }
});

// Dynamic validation on input

function validateUsername() {
    const username = document.getElementById("username").value.trim();
    if (username === "") {
        showError("usernameError", "Username cannot be empty.");
    } else {
        hideError("usernameError");
    }
}

function validateEmail() {
    const email = document.getElementById("email").value.trim();
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$/;
    if (email === "") {
        showError("emailError", "Email cannot be empty.");
    } else if (!emailPattern.test(email)) {
        showError("emailError", "Please enter a valid email address.");
    } else {
        hideError("emailError");
    }
}

function validatePhone() {
    const phone = document.getElementById("phone").value.trim();
    const phonePattern = /^\d{10}$/;
    if (phone === "") {
        showError("phoneError", "Phone number cannot be empty.");
    } else if (!phonePattern.test(phone)) {
        showError("phoneError", "Phone number must be 10 digits and only contain numbers.");
    } else {
        hideError("phoneError");
    }
}

function validateConfirmPassword() {
    const password = document.getElementById("password").value.trim();
    const confirmPassword = document.getElementById("confirmPassword").value.trim();
    if (confirmPassword === "") {
        showError("confirmPasswordError", "Confirm password cannot be empty.");
    } else if (password !== confirmPassword) {
        showError("confirmPasswordError", "Passwords do not match.");
    } else {
        hideError("confirmPasswordError");
    }
}

function checkPassword() {
    const password = document.getElementById("password").value.trim();
    
    const lengthCriteria = document.getElementById("length");
    const uppercaseCriteria = document.getElementById("uppercase");
    const numberCriteria = document.getElementById("number");
    const specialCriteria = document.getElementById("special");

    const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{7,}$/;
    
    // Validate length (at least 7 characters)
    if (password.length >= 7) {
        lengthCriteria.classList.add("valid");
        lengthCriteria.classList.remove("invalid");
        hideError("passwordError");
    } else {
        lengthCriteria.classList.add("invalid");
        lengthCriteria.classList.remove("valid");
        showError("passwordError", "Password must be at least 7 characters long.");
    }

    // Validate uppercase letter
    if (/[A-Z]/.test(password)) {
        uppercaseCriteria.classList.add("valid");
        uppercaseCriteria.classList.remove("invalid");
    } else {
        uppercaseCriteria.classList.add("invalid");
        uppercaseCriteria.classList.remove("valid");
    }

    // Validate number
    if (/\d/.test(password)) {
        numberCriteria.classList.add("valid");
        numberCriteria.classList.remove("invalid");
    } else {
        numberCriteria.classList.add("invalid");
        numberCriteria.classList.remove("valid");
    }

    // Validate special character
    if (/[@$!%*?&#]/.test(password)) {
        specialCriteria.classList.add("valid");
        specialCriteria.classList.remove("invalid");
    } else {
        specialCriteria.classList.add("invalid");
        specialCriteria.classList.remove("valid");
    }

    // If all criteria are met, hide the error
    if (passwordPattern.test(password)) {
        hideError("passwordError");
    }
}

// Function to show error message
function showError(elementId, message) {
    const errorElement = document.getElementById(elementId);
    errorElement.textContent = message;
    errorElement.style.display = "block";
}

// Function to hide error message
function hideError(elementId) {
    const errorElement = document.getElementById(elementId);
    errorElement.textContent = "";
    errorElement.style.display = "none";
}
