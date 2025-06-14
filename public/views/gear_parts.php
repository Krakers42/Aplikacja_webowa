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

    <link href="public/styles/gear_parts.css" rel="stylesheet" />
    <link href="public/styles/aside_main.css" rel="stylesheet" />

    <title>GEAR & PARTS</title> 
</head>

<body>
    <?php include 'aside.php'; ?>

    <i id="hamburger_menu" class="fa-solid fa-bars"></i>

    <main>
        <h1>GEAR & PARTS</h1>

        <form method="POST" action="gear_parts" style="margin-bottom:20px;">
            <input type="hidden" name="action" value="add" />
            <label>
                Purchase date:
                <input type="date" name="purchase_date" />
            </label>
            <label>
                Name:
                <input type="text" name="name" required />
            </label>
            <label>
                Value:
                <input type="number" name="value" />
            </label>
            <label>
                Comment:
                <input type="text" name="comment" />
            </label>
            <button type="submit">Add part</button>
        </form>


        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Purchase date</th>
                    <th>Name</th>
                    <th>Value</th>
                    <th>Comment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($gearParts as $part): ?>
                <tr>
                    <td><?= htmlspecialchars($part['id_gear_part']) ?></td>
                    <td><?= htmlspecialchars($part['purchase_date']) ?></td>
                    <td><?= htmlspecialchars($part['name']) ?></td>
                    <td><?= htmlspecialchars($part['value']) ?></td>
                    <td><?= htmlspecialchars($part['comment']) ?></td>
                    <td>
                        <form method="POST" action="gear_parts" style="display:inline;">
                            <input type="hidden" name="action" value="delete" />
                            <input type="hidden" name="id" value="<?= $part['id'] ?>" />
                            <button type="submit" onclick="return confirm('Delete part?')">Delete</button>
                        </form>
                        <button onclick="editPart(<?= $part['id'] ?>,
                                '<?= addslashes(htmlspecialchars($part['purchase_date'])) ?>',
                                '<?= addslashes(htmlspecialchars($part['name'])) ?>,
                                '<?= addslashes(htmlspecialchars($part['value'])) ?>,
                                '<?= addslashes(htmlspecialchars($part['comment'])) ?>
                                ')">Edit
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div id="editForm" style="display:none; margin-top:20px; border:1px solid #ccc; padding:10px; max-width:400px;">
            <h3>Edit part</h3>
            <form method="POST" action="/gear_parts">
                <input type="hidden" name="action" value="edit" />
                <input type="hidden" name="id" id="editId" />
                <label>
                    Purchase_date:
                    <input type="date" name="purchase_date" id="editPurchaseDate"/>
                </label><br/><br/>
                <label>
                    Name:
                    <input type="text" name="name" id="editName" />
                </label><br/><br/>
                <label>
                    Value:
                    <input type="number" name="value" id="editValue" />
                </label><br/><br/>
                <label>
                    Comment:
                    <input type="text" name="comment" id="editComment"/>
                </label><br/><br/>
                <button type="submit">Save changes</button>
                <button type="button" onclick="document.getElementById('editForm').style.display='none'">Cancel</button>
            </form>
        </div>

    </main>
    <button id="add-gear-parts">Add gear & parts +</button>
    <script src="public/scripts/main.js"></script>
    <script src="public/scripts/gear_parts.js"></script>
</body>

</html>