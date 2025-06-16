<?php
if (!isset($_SESSION['user'])) {
    header("Location: /login");
    exit();
}
?>

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

    <link href="public/styles/dashboard.css" rel="stylesheet" />
    <link href="public/styles/aside_main.css" rel="stylesheet" />

    <title>DASHBOARD</title>
</head>

<body>
    <?php include 'aside.php'; ?>

    <i id="hamburger_menu" class="fa-solid fa-bars"></i>

    <main>
        <h1>DASHBOARD</h1>

        <section>
            <div>
                <h3>Longest ride:</h3>
                <p><?= $longestRide ?> km</p>
            </div>

            <div>
                <h3>Trips:</h3>
                <p><?= $tripCount ?></p>
            </div>

            <div>
                <h3>Distance:</h3>
                <p><?= $totalDistance ?> km</p>
            </div>

            <div>
                <h3>Photos:</h3>
                <p><?= $photoCount ?></p>
            </div>

            <div>
                <h3>Biggest elevation:</h3>
                <p><?= $maxElevation ?> m</p>
            </div>
        </section>

    </main>
    <script src="public/scripts/main.js"></script>
    
</body>

</html>