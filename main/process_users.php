<?php
include 'db.php';

// KRIJIMI I PËRDORUESIT
if (isset($_POST['save_user'])) {
    $emri = $_POST['emri_mbiemri'];
    $user = $_POST['username'];
    $email = $_POST['email'];
    $roli = $_POST['roli'];
    
    // Siguria: Hashimi i fjalëkalimit
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO Users (username, emri_mbiemri, email, password, roli) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user, $emri, $email, $pass, $roli]);
        header("Location: perdoruesit.php?success=1");
    } catch (PDOException $e) {
        die("Gabim: " . $e->getMessage());
    }
}

// FSHIRJA
if (isset($_GET['delete_id'])) {
    $stmt = $conn->prepare("DELETE FROM Users WHERE id = ?");
    $stmt->execute([$_GET['delete_id']]);
    header("Location: perdoruesit.php?deleted=1");
}
?>