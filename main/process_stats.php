<?php
include 'db.php';

if (isset($_POST['save_stats'])) {
    $data = $_POST['data_vizites'];
    $vizitore = $_POST['numri_vizitoreve'];
    $blerje = $_POST['numri_blerjeve'];
    $shenime = $_POST['shenime'];

    try {
        $sql = "INSERT INTO VisitorStats (data_vizites, numri_vizitoreve, numri_blerjeve, shenime) 
                VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE numri_vizitoreve = ?, numri_blerjeve = ?, shenime = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$data, $vizitore, $blerje, $shenime, $vizitore, $blerje, $shenime]);
        header("Location: vizitoret.php?success=1");
    } catch (PDOException $e) {
        die("Gabim: " . $e->getMessage());
    }
}

if (isset($_GET['delete_id'])) {
    $stmt = $conn->prepare("DELETE FROM VisitorStats WHERE id = ?");
    $stmt->execute([$_GET['delete_id']]);
    header("Location: vizitoret.php?deleted=1");
}
?>