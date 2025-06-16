
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/68d18855ea.js" crossorigin="anonymous"></script>
    <link rel="icon" href="public/images/favicon.svg" type="image/svg+xml">

    <link href="public/styles/main.css" rel="stylesheet" />

    <title>RESET PASSWORD</title>
</head>

<body id="reset_password_page" class="flex-row-center-center">

    <div class="container">
        <img src="public/images/logo.svg" class="logo"/>

        <div class="content flex-column-center-center">
            <h1>RESET PASSWORD</h1>
            <h2>Forgotten password? No worries!</h2>
            
            <form class="reset-password-form flex-column-center-center" method="POST" action="reset_password_handler.php">
                <h3>Enter new password:</h3>
    
                <div class="whole-input">
                    <i class="icon fa-solid fa-door-open"></i>
                    <input type="password" id="password1" name="password1" placeholder="password" required/>
                </div>
    
                <h3>Enter new password again:</h3>
    
                <div class="whole-input">
                    <i class="icon fa-solid fa-door-open"></i>
                    <input type="password" id="password2" name="password2" placeholder="password" required/>
                </div>
    
                <button type="submit"><i>CONTINUE</i></button>

                <div class="links">
                    <a href="/login">Back</a>
                </div>
                
            </form>
        </div>
        
    </div>
    <script src="public/scripts/main.js"></script>
</body>
</html>