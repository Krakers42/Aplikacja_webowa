<?php
if (!isset($_SESSION['user'])) {
    header("Location: /login");
    exit();
}

$user = $_SESSION['user'];

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
            <p><strong>Name:</strong> <span id="name"><?= htmlspecialchars($user['name']) ?></span></p>
            <p><strong>Surname:</strong> <span id="surname"><?= htmlspecialchars($user['surname']) ?></span></p>
            <p><strong>Email:</strong> <span id="username"><?= htmlspecialchars($user['email']) ?></span></p>
            <p><strong>Role:</strong> <span id="role"><?= htmlspecialchars($user['role']) ?></span></p>
            <p><strong>ID user:</strong> <span id="id_user"><?= htmlspecialchars($user['id_user']) ?></span></p>
        </div>

        <?php if ($user['role'] !== 'admin'): ?>
            <div class="delete-btn-wrapper">
                <button class="delete-btn" data-id="<?= htmlspecialchars($user['id_user']) ?>">Delete my account</button>
            </div>
        <?php endif; ?>

        <?php if ($user['role'] === 'admin'): ?>
            <div id="admin-section">
                <h3>All Users</h3>
                <table>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>ID User</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="users-table">
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>
    <script src="public/scripts/main.js"></script>
    <script src="public/scripts/account.js"></script>
</body>

</html>