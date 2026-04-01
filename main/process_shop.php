<?php
include 'db.php';

if (isset($_POST['save_shop'])) {
    $emri = $_POST['Emertimi'] ?? null;
    $kategoria_id = $_POST['kategoria_ID'] ?? 0;
    $Pronari = $_POST['Pronari'] ?? null;
    $Pronari_id = $_POST['Pronari_ID'] ?? 0;
    $kati = $_POST['Kati'] ?? 0;
    $siperfaqja = $_POST['Siperfaqja_m2'] ?? 0;
    $statusi = $_POST['Statusi'] ?? 0;
    $pershkrimi = $_POST['Pershkrimi'] ?? null;
    $data_hapjes = $_POST['Data_hapjes'] ?? date('Y-m-d');
    $numri_njesise = $_POST['Numri_njesise'] ?? 0;

    try {
        if ($emri === null || $kategoria_id == 0) {
            header("Location: dashboard.php?error=" . urlencode("Emri dhe Kategoria janë të detyrueshme."));
            exit();
        }

        $sql = "INSERT INTO shops 
                (Emertimi, Pronari_ID, kategoria_ID, Pronari, Kati, Siperfaqja_m2, Statusi, Pershkrimi, Data_hapjes, Numri_njesise) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $emri,
            $Pronari_id,
            $kategoria_id,
            $Pronari,
            $kati,
            $siperfaqja,
            $statusi,
            $pershkrimi,
            $data_hapjes,
            $numri_njesise
        ]);

        header("Location: dashboard.php?success=" . urlencode("Dyqani u shtua me sukses."));
        exit();

    } catch (PDOException $e) {
        header("Location: dashboard.php?error=" . urlencode($e->getMessage()));
        exit();
    }   
}
if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];

    try {
        $sql = "DELETE FROM shops WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        header("Location: dashboard.php?deleted=1");
        exit();
    } catch (PDOException $e) {
        die("Gabim gjatë fshirjes: " . $e->getMessage());
    }
}

// Nëse asnjëra nuk është aktive, kthehu mbrapa
header("Location: dashboard.php");
exit();
?>