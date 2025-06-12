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

    <link href="public/styles/trips.css" rel="stylesheet" />
    <link href="public/styles/aside_main.css" rel="stylesheet" />

    <title>TRIPS</title>
</head>

<body>
    <?php include 'aside.php'; ?>

    <i id="hamburger_menu" class="fa-solid fa-bars"></i>

    <main>
        <h1>TRIPS</h1>
        <table id="tripsTable">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Distance</th>
                    <th>Elevation</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </main>
    <button id="add-trip">Add trip +</button>
    <script src="public/scripts/main.js"></script>
    <script src="public/scripts/trips.js"></script>
</body>

</html>