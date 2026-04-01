<?php
include 'db.php';

// SHTIMI
if (isset($_POST['save_space'])) {
    $kodi = $_POST['Kodi_Hapesires'];
    $kati = $_POST['Kati'];
    $sip = $_POST['Siperfaqja_m2'];
    $statusi = $_POST['Statusi'];

    $sql = "INSERT INTO Spaces (Kodi_Hapesires, Kati, Siperfaqja_m2, Statusi) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$kodi, $kati, $sip, $statusi]);
    header("Location: hapesirat.php?success=1");
}

// FSHIRJA
if (isset($_GET['delete_id'])) {
    $stmt = $conn->prepare("DELETE FROM Spaces WHERE id = ?");
    $stmt->execute([$_GET['delete_id']]);
    header("Location: hapesirat.php?deleted=1");
}

// UPDATE (Përditësimi)
if (isset($_POST['update_space'])) {
    $id = $_POST['id'];
    $kodi = $_POST['Kodi_Hapesires'];
    $kati = $_POST['Kati'];
    $sip = $_POST['Siperfaqja_m2'];
    $statusi = $_POST['Statusi'];

    $sql = "UPDATE Spaces SET Kodi_Hapesires=?, Kati=?, Siperfaqja_m2=?, Statusi=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$kodi, $kati, $sip, $statusi, $id]);
    header("Location: hapesirat.php?updated=1");
}
?>