<?php
session_start();
include("connect.php");

if (isset($_POST['add_patient'])) {
    // Prepare the SQL query to check for existing patient with the same email or phone number
    $checkQuery = $bdd->prepare("SELECT * FROM patient WHERE Email = :email OR PhoneNumber = :phone");
    $checkQuery->execute(['email' => $_POST['email'], 'phone' => $_POST['phone']]);

    if ($checkQuery->rowCount() == 0) {
        // Prepare the insert query
        $insertQuery = $bdd->prepare("INSERT INTO patient (Name, Birthdate, Address, PhoneNumber, Email, Password) 
                                      VALUES (:name, :birthdate, :address, :phone, :email, :password)");

        // Execute the query
        $register = $insertQuery->execute([
            'name' => $_POST['name'],
            'birthdate' => $_POST['birthdate'],
            'address' => $_POST['address'],
            'phone' => $_POST['phone'],
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
            echo "Error: Unable to register the patient.";
        }
    } else {
        echo "A patient with this email or phone number already exists.";
    }
}
$sms=0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Patient</title>
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
                            <p class="login-card-description">Patient Registration</p>

                            <form name='add_patient' action="" method="post" style="margin: 0 auto;">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="birthdate">Birthdate</label>
                                    <input type="date" name="birthdate" class="form-control" placeholder="Birthdate" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Address" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <input name="add_patient" class="btn btn-block login-btn mb-4" type="submit" value="Register">

                                <div id="popupWindow" class="popup">
                                    <div class="popup-content">
                                        <span id="closeButton" class="close">&times;</span>
                                        <h2>Patient registered successfully!</h2>
                                        <a class="btn" href="index.html">Go to Home Page</a>
                                        <a class="btn" href="login.php">Go to Login Page</a>
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
