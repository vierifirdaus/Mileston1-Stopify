<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/register.css">
    <title>Register</title>
    <script src="/js/register.js"></script>
</head>
<body>
    <div class="container">
        <div class="register">
            <div class="title">
                <h1>Sign up</h1>
            </div>
            <div class="form">
                <form method="post" id="registrationForm" onsubmit="sendForm()">
                    <div class="form_input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="Enter your email">
                    </div>
                    <p id="emailError" class="error-input" ></p>

                    <div class="form_input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password">
                    </div>
                    <div class="form_input">
                        <label for="confpassword">Confirm Password</label>
                        <input type="password" name="confpassword" id="confpassword" placeholder="Enter your confirm password">
                    </div>
                    <p id="passwordError" class="error-input" ></p>

                    <div class="form_input">
                        <label for="profilname">What should we call you?</label>
                        <input type="text" name="name" id="name" placeholder="Enter a profile name">
                    </div>
                    <p id="nameError" class="error-input"></p>
                    <div class="submit_form">
                        <input type="submit" name="submit" value="Sign up" id="submitButton" disabled>
                    </div>
                    <p>Already have an account?<a href="login">Log in</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
