<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $quantite = $_POST['quantite'];
    $date_expiration = $_POST['date_expiration'];

    $pgsql = "INSERT INTO article (nom, quantite, date_expiration) VALUES ('$nom', '$quantite', '$date_expiration')";

    if ($conn->query($pgsql) == true) {
        echo "🎉 Article ajouté avec succès";
    } else {
        echo "❌ Erreur : " . $pgsql;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <title>Ajouter article</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            display: flex;
            justify-content: center;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .form-group input[type="text"]:hover,
        .form-group input[type="number"]:hover,
        .form-group input[type="date"]:hover {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
    </style>
</head>

<body>


    <div class="container">
        <div class="form-container animate__animated animate__fadeInUp">
            <h2 class="text-center mb-4">Ajouter un article 📦</h2>
            <form action="ajouter.php" method="POST">
                <div class="form-group mb-3">
                    <label for="nom">Nom 📝</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="form-group mb-3">
                    <label for="quantite">Quantite 🔢</label>
                    <input type="number" class="form-control" id="quantite" name="quantite" required>
                </div>
                <div class="form-group mb-3">
                    <label for="date_expiration">Date d'expiration 📅</label>
                    <input type="date" class="form-control" id="date_expiration" name="date_expiration" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3">Ajouter ➕</button>
                <div class="d-flex justify-content-between">
                    <a href="afficher.php" class="btn btn-secondary">Voir les articles 📋</a>
                    <a href="index.php" class="btn btn-secondary">Retour à l'accueil 🏠</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>