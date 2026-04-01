<?php
include 'db.php';

try {
   $sql = "SELECT s.*, c.emertimi AS kategoria_emri 
            FROM Shops s 
            LEFT JOIN ShopCategories c ON s.kategoria_ID = c.id 
            ORDER BY s.kati ASC";
    $stmt = $conn->query($sql);
    $shops = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Gabim gjatë marrjes së të dhënave: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Dyqanet | City Mall</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">CITY<span>MALL</span></div>
            <ul class="nav-links">
                <li><a href="index.html">Ballina</a></li>
                <li><a href="dyqanet.php">Dyqanet</a></li>
                <li><a href="kontakti.html">Kontakt</a></li>
            </ul>
        </nav>
    </header>

    <section class="container" style="margin-top: 100px;">
        <h2 class="section-title">Brendet tona</h2>
        <div class="grid">
            <?php if (count($shops) > 0): ?>
                <?php foreach ($shops as $shop): ?>
                    <div class="card">
                        <div class="category"><?php echo htmlspecialchars($shop['kategoria_emri'] ?? 'Pa Kategori'); ?></div>
                        <h3><?php echo htmlspecialchars($shop['Emertimi']); ?></h3>
                        <p>Kati: <?php echo htmlspecialchars($shop['Kati'] ?? 'N/A'); ?></p>
                        <p><?php echo htmlspecialchars($shop['Pershkrimi'] ?? ''); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nuk u gjet asnjë dyqan i regjistruar.</p>
            <?php endif; ?>
        </div>
    </section>

    <footer><p>&copy; 2026 City Mall. Designed by Leart Shulina</p></footer>
</body>
</html>