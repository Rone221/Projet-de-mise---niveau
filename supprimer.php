<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Préparer la requête de suppression
    $pgsql = "DELETE FROM article WHERE id = :id";
    $stmt = $conn->prepare($pgsql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Exécuter la requête
    if ($stmt->execute()) {
        // Rediriger vers la page d'affichage après suppression
        header("Location: afficher.php");
        exit();
    } else {
        echo "Erreur lors de la suppression de l'article.";
    }
} else {
    echo "ID de l'article non spécifié.";
}
