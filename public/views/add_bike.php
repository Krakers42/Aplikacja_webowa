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

    <link href="public/styles/bikes.css" rel="stylesheet" />
    <link href="public/styles/aside_main.css" rel="stylesheet" />

    <title>BIKES</title>
</head>

<body>

    <aside>
        <h2>Bike Base</h2>
        <nav class="flex-row-center-center">
            <ul class="flex-column-center-center">
                <a href="dashboard.php" class="menu-link flex-row-center-center">
                    <i class="fa-solid fa-gauge"></i>
                    Dashboard
                </a>
                <a href="bikes.html" class="menu-link flex-row-center-center">
                    <i class="fa-solid fa-bicycle"></i>
                    Bikes
                </a>
                <a href="gear_parts.html" class="menu-link flex-row-center-center">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    Gear & Parts
                </a>
                <a href="photos.html" class="menu-link flex-row-center-center">
                    <i class="fa-solid fa-image"></i>
                    Photos
                </a>
                <a href="trips.html" class="menu-link flex-row-center-center">
                    <i class="fa-solid fa-road"></i>
                    Trips
                </a>
                <a href="account.html" class="menu-link flex-row-center-center">
                    <i class="fa-solid fa-user"></i>
                    Account
                </a>
            </ul>
        </nav>

        <button onclick="window.location.href='login.html'">Logout</button>
    </aside>

    <i id="hamburger_menu" class="fa-solid fa-bars"></i>

    <main>
        <section class="add-bike">
            <h1>UPLOAD</h1>
            <form action="addBike">
                <div class="messages">
                    <?php if (isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>

                <input name="bike" type="text" placeholder="bike">
                <textarea name="description" rows="6" placeholder="description"></textarea>

                <input type="file" name="file">
                <button type="submit">SEND</button>
            </form>

        </section>

    </main>
    <button id="add-bike">Add Bike +</button>
    <script src="public/scripts/main.js"></script>
</body>

</html>