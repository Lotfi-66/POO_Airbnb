<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airbnb Clone</title>
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
                <a href="#" class="btn btn-outline-secondary">Langue</a>
                <a href="#" class="btn btn-outline-secondary"><i class="fas fa-bars"></i></a>
                <a href="users.php" class="btn btn-outline-secondary"><i class="fas fa-user"></i></a>
            </div>
        </div>
    </header>
    <div class="container mt-4">
        <div class="search-bar p-3 bg-light rounded d-flex justify-content-between align-items-center">
            <div>Destination <br> <span class="text-muted">Rechercher une destination</span></div>
            <div>Arrivée <br> <span class="text-muted">Quand ?</span></div>
            <div>Départ <br> <span class="text-muted">Quand ?</span></div>
            <div>Voyageurs <br> <span class="text-muted">Ajouter des voyageurs</span></div>
            <button class="btn btn-danger rounded-circle"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row text-center">
            <div class="col-2">
                <img src="assets/images/design.jpg" alt="Design">
                <p>Design</p>
            </div>
            <div class="col-2">
                <img src="assets/images/avecvue.jpg" alt="Avec vue">
                <p>Avec vue</p>
            </div>
            <div class="col-2">
                <img src="assets/images/Plages.jpg" alt="Plages">
                <p>Plages</p>
            </div>
            <div class="col-2">
                <img src="assets/images/yourte.jpg" alt="Yourtes">
                <p>Yourtes</p>
            </div>
            <div class="col-2">
                <img src="assets/images/tinyhouses.jpg" alt="Tiny houses">
                <p>Tiny houses</p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
