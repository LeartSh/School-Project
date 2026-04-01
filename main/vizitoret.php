<?php include 'db.php'; ?>
<div class="container">
    <h2>Regjistro Statistikat e Ditës</h2>
    <form action="process_stats.php" method="POST">
        <input type="date" name="data_vizites" value="<?php echo date('Y-m-d'); ?>" required>
        <input type="number" name="numri_vizitoreve" placeholder="Nr. i Vizitorëve" required>
        <input type="number" name="numri_blerjeve" placeholder="Nr. i Transaksioneve">
        <textarea name="shenime" placeholder="Ngjarje të veçanta (psh. Festë, Fundjavë)"></textarea>
        <button type="submit" name="save_stats">Ruaj të Dhënat</button>
    </form>

    <hr>

    <h2>Historiku i Vizitave</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Data</th>
                <th>Vizitorë</th>
                <th>Blerje</th>
                <th>Shkalla e Konvertimit</th>
                <th>Veprimet</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $conn->query("SELECT * FROM VisitorStats ORDER BY data_vizites DESC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $konvertimi = ($row['numri_vizitoreve'] > 0) ? round(($row['numri_blerjeve'] / $row['numri_vizitoreve']) * 100, 2) : 0;
                ?>
                <tr>
                    <td><?php echo $row['data_vizites']; ?></td>
                    <td><?php echo number_format($row['numri_vizitoreve']); ?></td>
                    <td><?php echo number_format($row['numri_blerjeve']); ?></td>
                    <td><?php echo $konvertimi; ?>%</td>
                    <td>
                        <a href="edit_stats.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                        <a href="process_stats.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('A jeni i sigurt?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>