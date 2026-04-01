<link rel="stylesheet" href="admin-style.css">
<?php
include 'db.php';
// SHTIMI
if (isset($_POST['save_category'])) {
    $emri = $_POST['Emertimi'] ?? '';
    $pershkrimi = $_POST['Pershkrimi'] ?? '';
    $ikona = $_POST['Ikona'] ?? '';

    try {
        $sql = "INSERT INTO ShopCategories (Emertimi, Pershkrimi,Ikona) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$emri, $pershkrimi,$ikona]) ?? null;
        header("Location: kategorite.php?success=1");
    } catch (PDOException $e) {
        die("Gabim: " . $e->getMessage());
    }
}

if (isset($_GET['delete_id'])) {
    try {
        $stmt = $conn->prepare("DELETE FROM ShopCategories WHERE ID = ?");
        $stmt->execute([$_GET['delete_id']]);
        header("Location: kategorite.php?deleted=1");
    } catch (PDOException $e) {
        die("Nuk mund të fshihet: Ka dyqane që i përkasin kësaj kategorie!");
    }
}

if (isset($_POST['update_shop'])) { 
    try {
        
        $sql = "UPDATE shops SET Emertimi = ?, Kati = ?, Siperfaqja_m2 = ? WHERE ID = ?";
        
        $stmt = $conn->prepare($sql);
        
        $stmt->execute([
            $_POST['Emertimi'], 
            $_POST['Kati'], 
            $_POST['Siperfaqja_m2'], 
            $_POST['shop_id']
        ]);
        
        header("Location: dashboard.php?edited=1");
        exit();

    } catch (PDOException $e) {
        die("Gabim gjatë përditësimit: " . $e->getMessage());
    }
}
?>