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
    <?php include 'aside.php'; ?>

    <i id="hamburger_menu" class="fa-solid fa-bars"></i>

    <main>
        <h1>BIKES</h1>

        <?php if (!empty($bike_cards)): ?>
            <section>
                <?php foreach ($bike_cards as $bike): ?>
                    <?php if (isset($bike)): ?>
                        <div class="bike-card">
                            <div class="bike-actions">
                                <button class="edit-bike">Edit</button>
                                <button class="delete-bike">Delete</button>
                            </div>

                            <div class="bike-visual">
                                <h3><?= htmlspecialchars($bike->getTitle()) ?></h3>
                                <img
                                        src="data:<?= $bike->getImageType() ?>;base64,<?= base64_encode($bike->getImage()) ?>"
                                        alt="<?= htmlspecialchars($bike->getTitle()) ?>"
                                />
                            </div>

                            <div class="bike-text">
                                <p><?= nl2br(htmlspecialchars($bike->getDescription())) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </section>
        <?php else: ?>
            <p>No bikes available.</p>
        <?php endif; ?>

    </main>
    <button id="add-bike">Add Bike +</button>
    <script src="public/scripts/main.js"></script>
</body>

</html>