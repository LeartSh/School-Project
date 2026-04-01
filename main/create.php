<?php
include('/Config/db.php');

if(isset($_POST['ruaj_dyqanin'])) {
    $emri = $_POST['emri'];
    
    $sql = "INSERT INTO Dyqanet (Emri) VALUES (:emri)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['emri' => $emri]);
    
    header("Location: dashboard.php");
}
?>
<form method="POST">
    <input type="text" name="emri" placeholder="Emri i dyqanit">
    <button type="submit" name="ruaj_dyqanin">Save</button>
</form>