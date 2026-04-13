<?php
include 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: dashboard.php"); exit(); }

if (isset($_POST['update_shop'])) {
    $id = $_POST['id'];
    $emri = $_POST['Emertimi'];
    $kategoria_id = $_POST['kategoria_id'];
    $kati = $_POST['Kati'];

    try {
        // Përdorim UPDATE në vend të INSERT
        $sql = "UPDATE Shops SET 
                Emertimi = ?, 
                kategoria_ID = ?, 
                Kati = ? 
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$emri, $kategoria_id, $kati, $id]);

        // Ridrejtimi te dashboard pas suksesit
        header("Location: dashboard.php?success=Dyqani u përditësua");
        exit();

    } catch (PDOException $e) {
        die("Gabim gjatë përditësimit: " . $e->getMessage());
    }
}

$stmt = $conn->prepare("SELECT * FROM Shops WHERE id = ?");
$stmt->execute([$id]);
$shop = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$shop) { die("Dyqani nuk u gjet!"); }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Shop</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="container">
        <h2>Edito Dyqanin: <?php echo htmlspecialchars($shop['Emertimi']); ?></h2>
        <form action="process_shop.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $shop['id']; ?>">
            
            <div class="form-group">
                <label>Emri i Dyqanit:</label>
                <input type="text" name="Emertimi" value="<?php echo htmlspecialchars($shop['Emertimi']); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Kategoria ID:</label>
                <input type="number" name="kategoria_id" value="<?php echo $shop['kategoria_ID']; ?>" class="form-control">
            </div>

            <div class="form-group">
                <label>Kati:</label>
                <input type="number" name="Kati" value="<?php echo $shop['Kati']; ?>" class="form-control">
            </div>

            <button type="submit" name="update_shop">Përditëso Dyqanin</button>
            <a href="dashboard.php">Anulo</a>
        </form>
    </div>
</body>
</html>