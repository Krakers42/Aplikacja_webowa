<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>404 - Not Found</title>
</head>

<body>
    <h1>Error 404</h1>
    <p>The page with this address has not been found.</p>
    <?php if (!empty($error)): ?>
        <p style="color: red"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <a href="/">Go back to login page</a>
</body>

</html>