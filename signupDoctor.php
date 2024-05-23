<?php
session_start();
include("connect.php");

if (isset($_POST['add_medecin'])) {
    // Prepare the SQL query
    $checkID = $bdd->prepare("SELECT * FROM medcin WHERE MedcinID = :id");
    $checkID->execute(['id' => $_POST['nom']]);

    if ($checkID->rowCount() == 0) {
        // Prepare the insert query
        $insertQuery = $bdd->prepare("INSERT INTO medcin (MedcinID, Name, Specialty, PhoneNumber, Email, Password) 
                                      VALUES (:id, :name, :specialty, :phone, :email, :password)");

      

        // Execute the query
        $register = $insertQuery->execute([
            'id' => $_POST['nom'],
            'name' => $_POST['nom'],
            'specialty' => $_POST['specialite'],
            'phone' => $_POST['number'],
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ]);

        if ($register) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Get the popup
                    var popup = document.getElementById('popupWindow');
                    
                    // Display the popup
                    popup.style.display = 'block';
                    
                    // Get the <span> element that closes the popup
                    var span = document.getElementById('closeButton');
                    
                    // When the user clicks on <span> (x), close the popup
                    span.onclick = function() {
                        popup.style.display = 'none';
                    }
                    
                    // When the user clicks anywhere outside of the popup, close it
                    window.onclick = function(event) {
                        if (event.target == popup) {
                            popup.style.display = 'none';
                        }
                    }
                });
            </script>";
        } else {
            echo "Error: Unable to register the doctor.";
        }
    } else {
        echo "A doctor with this ID already exists.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Fonctionelle</title>
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
                    <div class="col-md-7" style="display: flex;justify-content: center;">
                        <div class="card-body" style="text-align:center;">
                            <p class="login-card-description"> MEDECIN </p>

                            <form name='add_medecin' action="" method="post" style="margin: 0 auto;">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="mail" required>
                                </div>
                                <div class="form-group">
                                    <label for="number">Number</label>
                                    <input type="number" name="number" class="form-control" placeholder="phone number" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password">Mot de Passe</label>
                                    <input type="password" name="password" class="form-control" placeholder="***********" required>
                                </div>
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" class="form-control" placeholder="nom" required>
                                </div>
                                <div class="form-group">
                                    <label for="specialite">Specialité</label>
                                    <input type="text" name="specialite" class="form-control" placeholder="specialité" required>
                                </div>
                                <input name="add_medecin" class="btn btn-block login-btn mb-4" id="popupButton" type="submit" value="Ajouter">
                                <div id="popupWindow" class="popup">
                                    <div class="popup-content">
                                        <span id="closeButton" class="close">&times;</span>
                                        <h2>Doctor added successfully!</h2>
										<a class="btn" href="index.html">go to home page </a>
										<a class="btn" href="login.php"> go to login page 
										</a>
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
        (function() {
            var imgmulti = document.getElementById('imgmulti'),
                i = 1;
            var intervalID = setInterval(function() {
                imgmulti.src = 'image/login' + i + '.jpg';
                i = (i + 1) % 3;
            }, 3000);
        })();
    </script>
</body>
</html>
