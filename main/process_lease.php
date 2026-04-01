<?php
include 'db.php';

if (isset($_POST['save_lease'])) {
    $s_id = $_POST['Dyqani_id'] ?? 0;
    $t_id = $_POST['Qiramarresi_id'] ?? 0;
    $Data_fillimit = $_POST['Data_fillimit'] ?? 0;
    $end = $_POST['Data_perfundimit'] ?? 0;
    $qiraja_mujore = $_POST['Qiraja_mujore'] ?? 0;
    $depozita = $_POST['Depozita'] ?? 0;
    $Kushtet = $_POST['Kushtet'] ?? 0;
    $Statusi = $_POST['Statusi'] ?? 0;

    try {
        $sql = "INSERT INTO LeaseContracts(Dyqani_id,Qiramarresi_id,Data_fillimit,Data_perfundimit,Qiraja_mujore,Depozita,Kushtet,Statusi) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$s_id,$t_id,$Data_fillimit,$end,$qiraja_mujore,$depozita,$Kushtet,$Statusi]);

         $conn->prepare("UPDATE Shops SET Statusi = 0 WHERE id = ?")->execute([$s_id]);

        header("Location: kontratat.php?success=1");
    } catch (PDOException $e) {
        die("Gabim: " . $e->getMessage());
    }
}

if (isset($_GET['delete_id'])) {
    $stmt = $conn->prepare("DELETE FROM LeaseContracts WHERE id = ?");
    $stmt->execute([$_GET['delete_id']]);
    header("Location: kontratat.php?deleted=1");
}
?>