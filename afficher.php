<?php
include 'conn.php';

$pgsql = "SELECT * FROM article";
$result = $conn->query($pgsql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <title>Affichage</title>
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h1 class="text-center mb-4 animate__animated animate__fadeInDown">📋 Liste des Articles</h1>

        <table class="table table-hover animate__animated animate__fadeInUp">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">📛 Nom</th>
                    <th scope="col">📦 Quantité</th>
                    <th scope="col">📅 Date d'expiration</th>
                    <th scope="col">⚙️ Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $i++; ?></th>
                        <td><?php echo $row['nom']; ?></td>
                        <td><?php echo $row['quantite']; ?></td>
                        <td><?php echo $row['date_expiration']; ?></td>
                        <td>
                            <a href="modifier.php?id=<?php echo $row['id']; ?>" class="btn btn-primary animate__animated animate__bounceIn">✏️ Modifier</a>
                            <a href="supprimer.php?id=<?php echo $row['id']; ?>" class="btn btn-danger animate__animated animate__bounceIn">🗑️ Supprimer</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between mt-4">
            <a href="index.php" class="btn btn-secondary animate__animated animate__fadeInLeft">🏠 Accueil</a>
            <a href="ajouter.php" class="btn btn-success animate__animated animate__fadeInRight">➕ Ajouter un Article</a>
        </div>
    </div>

</body>

</html>