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

        <?php if (isset($bike_cards)): ?>
            <section>
                <?php foreach ($bike_cards as $bike): ?>
                    <?php if (isset($bike)): ?>
                        <div class="bike-card">
                            <div class="bike-actions">
                                <button class="edit-bike">Edit</button>
                                <button class="delete-bike">Delete</button>
                            </div>

                            <div class="bike-visual">
                                <h3><?= htmlspecialchars($bike['name']) ?></h3>
                                <img
                                        src="data:<?= htmlspecialchars($bike['image_mime']) ?>;base64,<?= base64_encode($bike['image']) ?>"
                                        alt="<?= htmlspecialchars($bike['name']) ?>"
                                />
                            </div>

                            <div class="bike-text">
                                <p><?= htmlspecialchars($bike['description']) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>

        <section>
            <div class="bike-card">
                <div class="bike-actions">
                    <button class="edit-bike">Edit</button>
                    <button class="delete-bike">Delete</button>
                </div>

                <div class="bike-visual" >
                    <h3>Kross Esker 6.0</h3>
                    <img src="public/images/esker.jpg" alt="Kross Esker 6.0" />
                </div>
            
                <div class="bike-text">
                    <p>The KROSS Esker 6.0 is a versatile gravel bike that is perfect for both long trips and everyday rides. Equipped with a second-generation aluminum frame and a carbon fork, it provides durability and comfort while maintaining low weight. The Shimano GRX drive in a 2x12 system and hydraulic disc brakes will give you full control on every trail - both on fast asphalt sections and on demanding gravel roads. KROS Esker 6.0 is a bike created for people who want to discover new routes and value high quality equipment.</p>
                </div>
            </div>

            <div class="bike-card">
                <div class="bike-actions">
                    <button class="edit-bike">Edit</button>
                    <button class="delete-bike">Delete</button>
                </div>

                <div class="bike-visual">
                    <h3>Marin Alpine Trail 7</h3>
                    <img src="public/images/alpine-trail-7.jpg" alt="Marin Alpine Trail 7" />
                </div>
            
                <div class="bike-text">
                    <p>Marin Alpine Trail 7 is a 29-inch Full-Suspension MTB designed for enduro trails. Its versatile capabilities are perfect for all-day riding. The aluminum frame with geometry that fits the latest trends and the full RockShox suspension with the DebonAir air system (150/160 mm travel) make it one of the best models for aggressive singletrack descents in its price class.</p>
                </div>
            </div>

            <?php if (isset($bike)): ?>
                <div class="bike-card">
                    <div class="bike-actions">
                        <button class="edit-bike">Edit</button>
                        <button class="delete-bike">Delete</button>
                    </div>

                    <div class="bike-visual">
                        <h3><?= htmlspecialchars($bike->getTitle()) ?></h3>
                        <img src="public/uploads/<?= htmlspecialchars($bike->getImage()) ?>" alt="<?= htmlspecialchars($bike->getTitle()) ?>" />
                    </div>

                    <div class="bike-text">
                        <p><?= nl2br(htmlspecialchars($bike->getDescription())) ?></p>
                    </div>
                </div>
            <?php endif; ?>

        </section>

    </main>
    <button id="add-bike">Add Bike +</button>
    <script src="public/scripts/main.js"></script>
</body>

</html>