<?php
require_once '../config.php';

function getResidences() {
    $conn = connect();
    $sql = "SELECT * FROM Residence";
    $result = $conn->query($sql);

    $residences = [];
    while ($row = $result->fetch_assoc()) {
        $residences[] = $row;
    }

    $conn->close();
    return $residences;
}

function getUsers() {
    $conn = connect();
    $sql = "SELECT * FROM User";
    $result = $conn->query($sql);

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    $conn->close();
    return $users;
}

// Ajoutez des fonctions similaires pour les autres entités
?>
