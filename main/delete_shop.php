<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        $sql = "DELETE FROM Shops WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        header("Location: dashboard.php?deleted=1");
        exit();
    } catch (PDOException $e) {
        die("Gabim gjatë fshirjes: " . $e->getMessage());
    }
} else {
    header("Location: dashboard.php");
}
?>