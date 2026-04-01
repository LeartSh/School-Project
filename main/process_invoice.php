<?php
include 'db.php';

// KRIJIMI I FATURËS
if (isset($_POST['save_invoice'])) {
    $c_id = $_POST['contract_id'];
    $nr = $_POST['nr_fatures'];
    $data_f = $_POST['data_faturimit'];
    $data_s = $_POST['data_skadimit'];

    // Marrim çmimin automatikisht nga kontrata
    $stmtPrice = $conn->prepare("SELECT qmimi_muaj_euro FROM LeaseContracts WHERE id = ?");
    $stmtPrice->execute([$c_id]);
    $price = $stmtPrice->fetchColumn();

    try {
        $sql = "INSERT INTO Invoices (contract_id, nr_fatures, shuma_totale, data_faturimit, data_skadimit) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$c_id, $nr, $price, $data_f, $data_s]);
        header("Location: faturat.php?created=1");
    } catch (PDOException $e) {
        die("Gabim: " . $e->getMessage());
    }
}

// NDRYSHIMI I STATUSIT (Mark as Paid)
if (isset($_GET['mark_paid'])) {
    $id = $_GET['mark_paid'];
    $stmt = $conn->prepare("UPDATE Invoices SET statusi = 'E Paguar' WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: faturat.php?updated=1");
}
?>