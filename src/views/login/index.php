<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <title>Register</title>
    <script src="js/login.js"></script>
</head>
<body>
    <div class="container">
        <div class="register">
            <div class="title">
                <h1>Log in to Stopify</h1>
            </div>
            <div class="form">
                <form action="" method="post">
                    <div class="form_input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="Enter your email ">
                    </div>
                    <p id="emailError" class="error-input" ></p>

                    <div class="form_input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password">
                    </div>
                    <p id="passwordError" class="error-input" ></p>

                    
                    
                    <div class="submit_form">
                        <input id="submitButton" type="submit" name="submit" value="Log in" onclick="sendForm()">
                    </div>
                    <p>Don't have an account?<a href="register">Sign up for stopify</a></p>
                    
                </form>
            </div>
        </div>
    </div>
    
</body>