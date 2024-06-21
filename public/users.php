<?php
require_once '../src/db.php';

$users = getUsers();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="bg-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="assets/images/logo.png" alt="Airbnb Logo" class="logo">
            <nav>
                <a href="index.php" class="mx-2">Logements</a>
                <a href="#" class="mx-2">Expériences</a>
                <a href="#" class="mx-2">Expériences en ligne</a>
            </nav>
            <div>
                <a href="#" class="btn btn-outline-secondary">Mettre mon logement sur Airbnb</a>
                <a href="#" class="bi bi-glob"><i class="bi bi-globe-americas"></i></a>
                <a href="#" class="btn btn-outline-secondary"><i class="fas fa-bars"></i></a>
                <a href="users.php" class="btn btn-outline-secondary"><i class="fas fa-user"></i></a>
            </div>
        </div>
    </header>
    <div class="container mt-4">
        <h2>Users</h2>
        <div class="row">
            <?php foreach ($users as $user): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?></h5>
                            <p class="card-text">Email: <?= htmlspecialchars($user['email']) ?></p>
                            <p class="card-text">Phone: <?= htmlspecialchars($user['phone']) ?></p>
                            <p class="card-text">Status: <?= $user['is_active'] ? 'Active' : 'Inactive' ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
