document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const submitButton = document.getElementById('submitButton');

    function validateEmail() {
        const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value);
        emailError.textContent = isValid ? '' : 'Invalid email address';
        return isValid;
    }


    function validatePassword() {
        const isValid = passwordInput.value.length != "";
        passwordError.textContent = isValid ? '' : 'Passwords cannot be empty';
        return isValid;
    }

    function validateForm() {
        const isEmailValid = validateEmail();
        const isPasswordValid = validatePassword();
        submitButton.disabled = !(isEmailValid && isPasswordValid);
    }

    emailInput.addEventListener('input', validateForm);
    passwordInput.addEventListener('input', validateForm);
});

function sendForm() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/api/login", true);

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                try {
                    const responseData = JSON.parse(xhr.responseText);
                    console.log(responseData);
                    if (responseData.message == "gagal") {
                        window.location.href = "login";
                        alert("Login failed!");
                    } else {
                        window.location.href = "home";
                        alert("Logged in!");
                    }
                } catch (error) {
                    console.error("Error parsing JSON response:", error);
                    alert("An error occurred while processing the login.");
                }
            } else {
                console.error("Request failed with status:", xhr.status);
                alert("An error occurred while processing the login.");
            }
        }
    };

    var data = `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`;
    xhr.send(data);
}
