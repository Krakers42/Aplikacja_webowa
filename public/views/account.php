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

    <link href="public/styles/account.css" rel="stylesheet" />
    <link href="public/styles/aside_main.css" rel="stylesheet" />

    <title>ACCOUNT</title>
</head>

<body>

    <?php include 'aside.php'; ?>

    <i id="hamburger_menu" class="fa-solid fa-bars"></i>

    <main>
        <h1>ACCOUNT</h1>
        <div id="user-info">
            <p><strong>Name:</strong> <span id="name">Geralt</span></p>
            <p><strong>Surname:</strong> <span id="surname">Wiedzmin</span></p>
            <p><strong>Username:</strong> <span id="username">user123</span></p>
            <p><strong>Account created:</strong> <span id="created">2024-11-01</span></p>
        </div>

        <div id="admin-section" class="hidden">
            <h3>All Users</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Username</th>
                        <th>Created</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="users-table">
                    
                </tbody>
            </table>
        </div>
    </main>
    <script src="public/scripts/main.js"></script>
    <script src="public/scripts/account.js"></script>
</body>

</html>