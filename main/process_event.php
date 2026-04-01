<?php include 'db.php'; ?>
<div class="container">
    <h2>Shto Ngjarje të Re</h2>
    <form action="process_event.php" method="POST">
        <input type="text" name="Titulli" placeholder="Titulli i Ngjarjes" required>
        <textarea name="Pershkrimi" placeholder="Detajet e ngjarjes..."></textarea>
        
        <div style="display: flex; gap: 10px;">
            <input type="datetime-local" name="Data_Fillimit" required>
            <input type="datetime-local" name="Data_Mbarimit" required>
        </div>

        <input type="text" name="Lokacioni" placeholder="Lokacioni (psh. Holli Kryesor)">
        
        <select name="shop_id">
            <option value="">Ngjarje e Përgjithshme (Pa Dyqan)</option>
            <?php
            $shops = $conn->query("SELECT id, Emertimi FROM Shops");
            while($s = $shops->fetch()) echo "<option value='{$s['id']}'>{$s['Emertimi']}</option>";
            ?>
        </select>
        
        <button type="submit" name="save_event">Ruaj Ngjarjen</button>
    </form>

    <hr>

    <h2>Kalendari i Ngjarjeve</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Titulli</th>
                <th>Data & Ora</th>
                <th>Lokacioni</th>
                <th>Organizatori</th>
                <th>Veprimet</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT e.*, s.Emertimi FROM Events e LEFT JOIN Shops s ON e.shop_id = s.id ORDER BY e.Data_Fillimit ASC";
            $stmt = $conn->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($row['Titulli']); ?></strong></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($row['Data_Fillimit'])); ?></td>
                    <td><?php echo htmlspecialchars($row['Lokacioni']); ?></td>
                    <td><?php echo $row['Emertimi'] ?? 'City Mall'; ?></td>
                    <td>
                        <a href="process_event.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('A jeni i sigurt?')">Fshij</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>