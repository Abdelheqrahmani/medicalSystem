<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:index.html');
    exit;
}

include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ordonnanceID = $_POST['ordonnanceID'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["resultFile"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an actual image or fake image
    $check = getimagesize($_FILES["resultFile"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["resultFile"]["size"] > 5000000) { // Allow files up to 5MB
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "pdf") {
        echo "Sorry, only JPG, JPEG, PNG & PDF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["resultFile"]["tmp_name"], $target_file)) {
            // Insert file information into the database
            $stmt = $bdd->prepare("INSERT INTO `rapport` (`OrdonnanceID`, `title`, `description`, `file`) VALUES (:ordonnanceID, :title, :description, :file)");
            $stmt->bindParam(':ordonnanceID', $ordonnanceID);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':file', $target_file);

            if ($stmt->execute()) {
                echo "The file ". basename($_FILES["resultFile"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
