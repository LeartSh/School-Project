<?php
include 'db.php';

if (isset($_POST['save_maintenance'])) {
    // 1. Capture data - names must match the 'name' attribute in your HTML form exactly
    $Dyqani_id = $_POST['Dyqani_id'];
    $Qiramarresi_id = $_POST['Qiramarresi_id'];
    $lloji = $_POST['lloji'];
    $Pershkrimi = $_POST['Pershkrimi'];
    $Prioriteti = $_POST['Prioriteti'];
    $Data_kerkeses = $_POST['Data_kerkeses'];
    $Statusi = $_POST['Statusi'];
    
    // Use null coalescing for optional fields
    $Tekniku_id = !empty($_POST['Tekniku_id']) ? $_POST['Tekniku_id'] : null;
    $Data_perfundimit = !empty($_POST['Data_perfundimit']) ? $_POST['Data_perfundimit'] : null;

    try {
        $sql = "INSERT INTO maintenancerequests 
                (Dyqani_id, Qiramarresi_id, lloji, Pershkrimi, Prioriteti, Data_kerkeses, Statusi, Tekniku_id, Data_perfundimit) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $Dyqani_id,
            $Qiramarresi_id,
            $lloji,
            $Pershkrimi,
            $Prioriteti,
            $Data_kerkeses,
            $Statusi,
            $Tekniku_id,
            $Data_perfundimit
        ]);
        
        header("Location: mirembajtja.php?success=1");
        exit();
    } catch (PDOException $e) {
        // This will display the exact SQL error if it fails
        die("Gabim gjatë ruajtjes: " . $e->getMessage());
    }
}
?>