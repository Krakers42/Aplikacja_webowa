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

        <form method="POST" action="trips" class="trips-form">
            <input type="hidden" name="action" value="add" />
            <label>
                Date:
                <input type="date" name="date" required/>
            </label>
            <label>
                Time:
                <input type="time" name="time" />
            </label>
            <label>
                Distance:
                <input type="number" name="distance" />
            </label>
            <label>
                Elevation:
                <input type="number" name="elevation" />
            </label>
            <label>
                Description:
                <input type="text" name="description" />
            </label>
            <button type="submit" class="add-trip-button">Add trip</button>
        </form>

        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Distance</th>
                    <th>Elevation</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trips as $trip): ?>
                    <tr>
                        <td><?= htmlspecialchars($trip['id_trip']) ?></td>
                        <td><?= htmlspecialchars($trip['date']) ?></td>
                        <td><?= htmlspecialchars($trip['time']) ?></td>
                        <td><?= htmlspecialchars($trip['distance']) ?></td>
                        <td><?= htmlspecialchars($trip['elevation']) ?></td>
                        <td><?= htmlspecialchars($trip['description']) ?></td>
                        <td>
                            <form method="POST" action="trips" style="display:inline;">
                                <input type="hidden" name="action" value="delete" />
                                <input type="hidden" name="id" value="<?= $trip['id_trip'] ?>" />
                                <button type="submit" onclick="return confirm('Delete trip?')">Delete</button>
                            </form>
                            <?php
                            $tripData = json_encode([
                                'id_trip' => $trip['id_trip'],
                                'date' => $trip['date'],
                                'time' => $trip['time'],
                                'distance' => $trip['distance'],
                                'elevation' => $trip['elevation'],
                                'description' => $trip['description']
                            ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
                            ?>
                            <button onclick='editTrip(<?= $tripData ?>)'>Edit</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="editForm" style="display:none; margin-top:20px; border:1px solid #ccc; padding:10px; max-width:400px;">
            <h3>Edit trip</h3>
            <form method="POST" action="/trips">
                <input type="hidden" name="action" value="edit" />
                <input type="hidden" name="id" id="editId" />
                <label>
                    Date:
                    <input type="date" name="date" id="editDate"/>
                </label><br/><br/>
                <label>
                    Time:
                    <input type="time" name="time" id="editTime" step="1"/>
                </label><br/><br/>
                <label>
                    Distance:
                    <input type="number" name="distance" id="editDistance" />
                </label><br/><br/>
                <label>
                    Elevation:
                    <input type="text" name="elevation" id="editElevation"/>
                </label><br/><br/>
                <label>
                    Description:
                    <input type="text" name="description" id="editDescription"/>
                </label><br/><br/>
                <button type="submit" class="save-changes-button">Save changes</button>
                <button type="button" onclick="document.getElementById('editForm').style.display='none'">Cancel</button>
            </form>
        </div>

    </main>
    <script src="public/scripts/main.js"></script>
    <script src="public/scripts/trips.js"></script>
</body>

</html>