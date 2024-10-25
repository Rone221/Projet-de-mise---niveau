<?php
include 'conn.php';

// Récupérer l'ID de l'article depuis l'URL
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// Récupérer les données de l'article depuis la base de données
$sql = "SELECT * FROM article WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    die("Article non trouvé");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom = htmlspecialchars(filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING));
    $quantite = htmlspecialchars(filter_input(INPUT_POST, 'quantite', FILTER_SANITIZE_NUMBER_INT));
    $date_expiration = htmlspecialchars(filter_input(INPUT_POST, 'date_expiration', FILTER_SANITIZE_STRING));
    $id = htmlspecialchars(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));

    // Mettre à jour l'article dans la base de données
    $sql = "UPDATE article SET nom = :nom, quantite = :quantite, date_expiration = :date_expiration WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':quantite', $quantite, PDO::PARAM_INT);
    $stmt->bindParam(':date_expiration', $date_expiration, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Article mis à jour avec succès";
    } else {
        echo "Erreur lors de la mise à jour de l'article";
    }
}

header("Location: afficher.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Article</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card animate__animated animate__fadeIn">
                    <div class="card-header bg-primary text-white">
                        <h4>Modifier un Article</h4>
                    </div>
                    <div class="card-body">
                        <form action="modifier.php?id=<?php echo htmlspecialchars($id); ?>" method="POST">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                            <div class="form-group">
                                <label for="nom">Nom de l'article</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($article['nom']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="quantite">Quantité</label>
                                <input type="number" class="form-control" id="quantite" name="quantite" value="<?php echo htmlspecialchars($article['quantite']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="date_expiration">Date d'expiration</label>
                                <input type="date" class="form-control" id="date_expiration" name="date_expiration" value="<?php echo htmlspecialchars($article['date_expiration']); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                            <a href="afficher.php" class="btn btn-secondary">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>