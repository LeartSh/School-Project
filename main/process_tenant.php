<?php
include 'db.php';

if (isset($_POST['save_tenant'])) {
    $Emri = $_POST['Emri'] ?? null;
    $Mbiemri = $_POST['Mbiemri'] ?? null;
    $Emertimi = $_POST['Emertimi_kompanise'] ?? null;
    $Kontakti = $_POST['kontakti'] ?? null;
    $Email = $_POST['email'] ?? null;    
    $Telefoni = $_POST['telefoni'] ?? null;
    $Nr_biznesit = $_POST['nr_biznesit'] ?? null;
    $Adresa = $_POST['adresa'] ?? null;
    $data_regjistrimit = $_POST['data_regjistrimit'] ?? null;
    
    if (empty($Emertimi)) {
        die("Gabim: Emri i kompanisë është i detyrueshëm!");
    }

    try {
        $stmt = $conn->prepare("INSERT INTO tenants (Emri, Mbiemri, Emertimi_kompanise, kontakti, email, telefoni, nr_biznesit, adresa, data_regjistrimit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([
            $Emri, $Mbiemri, $Emertimi, $Kontakti, $Email, $Telefoni, $Nr_biznesit, $Adresa, $data_regjistrimit
        ]);

        header("Location: qiramarresit.php?success=1");
        exit();
    } catch (PDOException $e) {
        die("Gabim në database: " . $e->getMessage());
    }
}

// DELETE TENANT
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    // Changed table name to 'tenants' (lowercase) to be safe
    $stmt = $conn->prepare("DELETE FROM tenants WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: qiramarresit.php?deleted=1");
    exit();
}

// UPDATE TENANT
if (isset($_POST['update_tenant'])) {
    $id = $_POST['ID'];
    $emri = $_POST['Emri'];
    $mbiemri = $_POST['Mbiemri'];
    $email = $_POST['email'];
    $telefoni = $_POST['telefoni'];

    $sql = "UPDATE tenants SET Emri=?, Mbiemri=?, email=?, telefoni=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$emri, $mbiemri, $email, $telefoni, $id]);
    header("Location: qiramarresit.php?updated=1");
    exit();
}
?>