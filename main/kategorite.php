<?php include 'db.php'; ?>
<link rel="stylesheet" href="/project/dashboard.css">
<div class="container">
    <h2>Shto Kategori të Re</h2>
    <form action="process_category.php" method="POST">
        <input type="number" name="ID" placeholder="ID e Kategorise" required>
        <input type="text" name="Emertimi" placeholder="Emri i Kategorisë" required>
        <textarea name="Pershkrimi" placeholder="Përshkrim i shkurtër i kategorisë..."></textarea>
        <input type="text" name="Ikona" placeholder="Ikona" required>
        <button type="submit" name="save_category">Ruaj Kategorinë</button>
    </form>

    <hr>

    <h2>Kategoritë Ekzistuese</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Emërtimi</th>
                <th>Përshkrimi</th>
                <th>Ikona</th>
                <th>Veprimet</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $conn->query("SELECT * FROM ShopCategories ORDER BY emertimi ASC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo htmlspecialchars($row['Emertimi']); ?></td>
                    <td><?php echo htmlspecialchars($row['Pershkrimi']); ?></td>
                    <td><?php echo htmlspecialchars($row['Ikona'])?></td>
                    <td style="text-align: center;">
                        <a href="edit_shop.php?id=<?php echo $row['ID']; ?>" class="btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="process_shop.php?delete_id=<?php echo $row['ID']; ?>" 
                           class="btn-delete" 
                           onclick="return confirm('A jeni i sigurt?')">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>