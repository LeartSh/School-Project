<?php
include 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: dashboard.php"); exit(); }

// Merr të dhënat aktuale të dyqanit
$stmt = $conn->prepare("SELECT * FROM Shops WHERE id = ?");
$stmt->execute([$id]);
$shop = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$shop) { die("Dyqani nuk u gjet!"); }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Shop</title>
    <link rel="stylesheet" href="style.css">
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

            <button type="submit" name="save_shop">Përditëso Dyqanin</button>
            <a href="dashboard.php">Anulo</a>
        </form>
    </div>
</body>
</html>