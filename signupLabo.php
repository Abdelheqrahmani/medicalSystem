<?php
session_start();
include("connect.php");

if (isset($_POST['add_laboratoire'])) {
    // Préparer la requête SQL pour vérifier l'existence d'un laboratoire avec le même e-mail ou numéro de téléphone
    $checkQuery = $bdd->prepare("SELECT * FROM laboratoire WHERE Email = :email OR PhoneNumber = :phone");
    $checkQuery->execute(['email' => $_POST['email'], 'phone' => $_POST['phone']]);

    if ($checkQuery->rowCount() == 0) {
        // Préparer la requête d'insertion
        $insertQuery = $bdd->prepare("INSERT INTO laboratoire (Name, Address, PhoneNumber, Email, Password) 
                                      VALUES (:name, :address, :phone, :email, :password)");

        // Exécuter la requête
        $register = $insertQuery->execute([
            'name' => $_POST['name'],
            'address' => $_POST['address'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ]);

        if ($register) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var popup = document.getElementById('popupWindow');
                    popup.style.display = 'block';
                    var span = document.getElementById('closeButton');
                    span.onclick = function() {
                        popup.style.display = 'none';
                    }
                    window.onclick = function(event) {
                        if (event.target == popup) {
                            popup.style.display = 'none';
                        }
                    }
                });
            </script>";
        } else {
            echo "Erreur : Impossible d'inscrire le laboratoire.";
        }
    } else {
        echo "Un laboratoire avec cet e-mail ou ce numéro de téléphone existe déjà.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrer un Laboratoire</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card" style="box-shadow: 0px 0px 10px #555,0px 0px 30px #777;">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="images/login0.jpg" alt="login" class="login-card-img" id="imgmulti">
                    </div>
                    <div class="col-md-7" style="display: flex; justify-content: center;">
                        <div class="card-body" style="text-align: center;">
                            <p class="login-card-description">Enregistrement d'un Laboratoire</p>

                            <form name='add_laboratoire' action="" method="post" style="margin: 0 auto;">
                                <div class="form-group">
                                    <label for="name">Nom</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nom" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Adresse</label>
                                    <input type="text" name="address" class="form-control" placeholder="Adresse" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Numéro de Téléphone</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="Numéro de Téléphone" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                                </div>
                                <input name="add_laboratoire" class="btn btn-block login-btn mb-4" type="submit" value="Enregistrer">

                                <div id="popupWindow" class="popup">
                                    <div class="popup-content">
                                        <span id="closeButton" class="close">&times;</span>
                                        <h2>Laboratoire enregistré avec succès !</h2>
                                        <a class="btn" href="index.html">Aller à la Page d'Accueil</a>
                                        <a class="btn" href="login.php">Aller à la Page de Connexion</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var imgmulti = document.getElementById('imgmulti'),
                i = 1;
            setInterval(function() {
                imgmulti.src = 'images/login' + i + '.jpg';
                i = (i % 3) + 1;
            }, 3000);
        });
    </script>
</body>
</html>
