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

    <link href="public/styles/add_bike.css" rel="stylesheet" />
    <link href="public/styles/aside_main.css" rel="stylesheet" />

    <title>BIKES</title>
</head>

<body>
    <?php include 'aside.php'; ?>

    <i id="hamburger_menu" class="fa-solid fa-bars"></i>

    <main>
        <section class="add-bike">
            <h1>UPLOAD</h1>
            <form action="add_bike" method="POST" ENCTYPE="multipart/form-data">
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
    <script src="public/scripts/main.js"></script>
</body>

</html>