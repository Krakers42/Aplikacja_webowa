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

    <title>REGISTER</title>
</head>

<body id="register_page" class="flex-row-center-center">

    <div class="container">
        <img src="public/images/logo.svg" class="logo"/>

        <div class="content flex-column-center-center">
            <h1>REGISTER</h1>
            <h2>Welcome!</h2>
            <form class="register-form flex-column-center-center">
                <div class="whole-input">
                    <i class="fa-solid fa-person"></i>
                    <input type="name" placeholder="name" />
                </div>

                <div class="whole-input">
                    <i class="fa-solid fa-person"></i>
                    <input type="surname" placeholder="surname" />
                </div>

                <div class="whole-input">
                    <i class="icon fa-solid fa-envelope"></i>
                    <input type="email" placeholder="email" />
                </div>

                <div class="whole-input">
                    <i class="icon fa-solid fa-door-open"></i>
                    <input type="password" placeholder="password" />
                </div>

                <button type="submit"><i>CONTINUE</i></button>

                <div class="links">
                    <a href="login.php">Login</a>
                </div>
            </form>
        </div>
        
    </div>
    <script src="public/scripts/main.js"></script>
</body>
</html>