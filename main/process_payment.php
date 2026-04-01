<?php
include 'db.php';
try{
   if (isset($_POST['save_payment'])) {
    $c_id = $_POST['contract_id'];
    $shuma = $_POST['shuma'];
    $data = $_POST['data_pageses'];
    $metoda = $_POST['metoda_pageses'];
    $pershkrimi = $_POST['pershkrimi'];

    try {
        $sql = "INSERT INTO Payments (contract_id, shuma, data_pageses, metoda_pageses, pershkrimi) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$c_id, $shuma, $data, $metoda, $pershkrimi]);

        header("Location: pagesat.php?success=1");
    } catch (PDOException $e) {
        die("Gabim: " . $e->getMessage());
    }
}

if (isset($_GET['delete_id'])) {
    $stmt = $conn->prepare("DELETE FROM Payments WHERE id = ?");
    $stmt->execute([$_GET['delete_id']]);
    header("Location: pagesat.php?deleted=1");
} 
}catch (PDOException $e) {
        // This will display the exact SQL error if it fails
        die("Gabim gjatë ruajtjes: " . $e->getMessage());
    }
?>