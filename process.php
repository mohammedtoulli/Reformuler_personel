<?php
$file = "data.pdf"; // Storage file

// Store data
if (isset($_POST['enregistrer'])) {
    $nom = $_POST['nom'];
    $age = $_POST['age'];
    $note = $_POST['note'];

    if ($nom && $age && $note) {
        file_put_contents($file, "$nom, $age, $note\n", FILE_APPEND);
    }
}

// Display data
$data = [];
if (isset($_GET['afficher']) && file_exists($file)) {
    $lines = file($file, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        $data[] = explode(", ", $line);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <link rel="stylesheet" href="pro.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>

    </style>
</head>
<body>
    <h2>Liste des utilisateurs</h2>

    <?php if ($data): ?>
        <table class="table">
            <tr>
                <th>Nom</th>
                <th>Âge</th>
                <th>Note</th>
            </tr>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row[0]) ?></td>
                    <td><?= htmlspecialchars($row[1]) ?></td>
                    <td><?= htmlspecialchars($row[2]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Aucune donnée enregistrée.</p>
    <?php endif; ?>

    <a href="index.html" class="btn btn-secondary">⬅ Retour</a>
</body>
</html>
